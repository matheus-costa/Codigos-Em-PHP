from flask import Flask, json, render_template, request, redirect,jsonify
import sqlite3
import requests
import base64

app = Flask (__name__, template_folder=".")

@app.route('/', methods=['GET'])
def index():
	return redirect('/buscarvoos')

@app.route('/buscar_voos', methods=['POST', 'GET'])
def buscarvoos():
	if request.method == 'POST':
		origem = request.values.get('origem')
		destino = request.values.get('destino')
		datahora1 = request.values.get('datahora1')
		datahora2 = request.values.get('datahora2')

		# inicia o vetor do resultado vazio
		resultado=[]

		# executa a busca no serviço 1 e o adiciona ao resultado
		resultado += buscaServico(origem, destino, datahora1, datahora2, 8081)
		# executa a busca no serviço 2 e o adiciona ao resultado
		resultado += buscaServico(origem, destino, datahora1, datahora2, 8082)
		
		# ordena o resultado baseado no preco de cada voo
		resultado.sort(key=lambda x: x['preco']) 

		return render_template("buscar_voos.html", resultado=resultado)
	else:
		return render_template("buscar_voos.html", resultado=[])
	
@app.route('/comprar_passagem', methods=['POST', 'GET'])
def comprarpassagem():
	if request.method == 'POST':
		companhia = request.values.get('companhia')
		voo = request.values.get('voo')
		nome = request.values.get('nome')
		cpf = request.values.get('cpf')

		if companhia == 'gol':
			porta=8081
		elif companhia == 'latam':
			porta=8082
	
		
		resultado = compraServico(voo, nome, cpf, porta)
		
		return render_template("resultado.html", dados=resultado)
	else:
		companhia = request.values.get('companhia')
		voo = request.values.get('voo')
		origem = request.values.get('origem')
		destino = request.values.get('destino')
		data = request.values.get('data')
		preco = request.values.get('preco')

		dados = { 'companhia':companhia, 'voo':voo, 'origem': origem,'destino': destino, 'data': data, 'preco': preco}

		return render_template("comprar_passagem.html", dados=dados)

def buscaServico(origem, destino, datahora1, datahora2, porta):
	# cria objeto json pra executar a consulta
	dados={'origem':origem, 'destino':destino, 'datahora1':datahora1, 'datahora2':datahora2}
	# transforma objeto em string
	dados=json.dumps(dados)
	# executa a chamada pro servico da "companhia", passando os dados da busca
	r=requests.post(f'http://localhost:{porta}/servico_disponibilidade.php', data=dados)
	print (r.text)
	# converte a resposta do servico em um objeto json
	resposta=r.json()
	return resposta

def compraServico(voo, nome, cpf, porta):
	# cria objeto json pra executar a compra da passage
	dados={'cliente':-1,'voo':voo, 'nome':nome, 'cpf':cpf}
	# transforma objeto em string
	dados=json.dumps(dados)
	# executa a chamada pro servico da "companhia", passando os dados para a compra
	r=requests.post(f'http://localhost:{porta}/servico_comprar.php', data=dados)
	# converte a resposta do servico em um objeto json
	resposta=r.json()
	return resposta

app.run(port="8080", use_reloader=True)
  