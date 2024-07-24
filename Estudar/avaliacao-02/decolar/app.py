# Importa as bibliotecas necessárias do Flask, sqlite3 e requests.
from flask import Flask, json, render_template, request, redirect, jsonify
import sqlite3
import requests

# Define as URLs base para os serviços das companhias aéreas Gol e LATAM.
URL_BASE_GOL ="http://localhost:8081" 
URL_BASE_LATAM ="http://localhost:8082" 

# Cria uma instância do aplicativo Flask e define a pasta de templates.
app = Flask(__name__, template_folder='.')

# Define a rota '/listar' e permite os métodos GET e POST.
@app.route('/listar', methods=['GET', 'POST'])
def listar ():
    # Verifica se o método da requisição é POST.
    if request.method == 'POST':
        # Obtém a data dos valores da requisição.
        data = request.values.get('data')
        print(data)
        
        # Converte a data para um JSON e envia uma requisição POST para o serviço de voos da Gol.
        txt = json.dumps({"data": data}) 
        respostaGol = requests.post(url=URL_BASE_GOL + "/servico-voos.php", data=txt)
        txt = respostaGol.content
        
        # Carrega a resposta da Gol em uma lista.
        listaGol = json.loads(txt)
        print(listaGol)
        
        # Envia uma requisição POST para o serviço de voos da LATAM com a mesma data.
        txt = json.dumps({"data": data}) 
        respLatam = requests.post(url=URL_BASE_LATAM + "/servico-voos.php", data=txt)
        txt = respLatam.content
        
        # Carrega a resposta da LATAM em uma lista.
        listaLatam = json.loads(txt)
        print(listaLatam)
        
        # Renderiza o template 'listar.html' passando as listas de voos da Gol e da LATAM.
        return render_template('listar.html', listaGol=listaGol, listaLatam=listaLatam)
    
    # Se o método da requisição não for POST, renderiza o template 'listar.html' sem dados.
    return render_template('listar.html')

# Define a rota '/comprar' e permite apenas o método GET.
@app.route('/comprar', methods=['GET'])
def comprar ():
    # Obtém os valores 'id' e 'voo' da requisição.
    id = request.values.get('id')
    voo = request.values.get('voo')
    
    # Renderiza o template 'comprar.html' passando os valores 'id' e 'voo'.
    return render_template('comprar.html', resultado={'id':id, 'voo':voo})

# Define a rota '/confirmar' e permite os métodos GET e POST.
@app.route('/confirmar', methods=['GET', 'POST'])
def confirmar ():
    # Verifica se o método da requisição é POST.
    if request.method == 'POST':
        # Obtém os valores 'cpf', 'nome', 'id' e 'voo' da requisição.
        cpf = request.values.get('cpf')
        nome = request.values.get('nome')
        id = request.values.get('id')
        voo = request.values.get('voo')
        
        # Determina a URL do serviço de compra com base na companhia aérea (Gol ou LATAM).
        if 'Gol' in voo:
            urlTxt = URL_BASE_GOL + "/servico-compra.php"
        else:
            urlTxt = URL_BASE_LATAM + "/servico-compra.php"
        
        # Converte os dados de compra para um JSON e envia uma requisição POST para o serviço correspondente.
        txt = json.dumps({"id": id, "cpf": cpf, "nome": nome}) 
        resp = requests.post(url=urlTxt, data=txt)
        txt = resp.content
        
        # Carrega a resposta do serviço de compra em um dicionário.
        resultado = json.loads(txt)
        
        # Renderiza o template 'confirmar.html' passando o resultado da compra.
        return render_template('confirmar.html', resultado=resultado)
    
    # Se o método da requisição não for POST, renderiza o template 'confirmar.html' sem dados.
    return render_template('confirmar.html')

# Define a rota raiz '/' e redireciona para a rota '/listar'.
@app.route('/', methods=['GET', 'POST'])
def index():
    return redirect('/listar')

# Inicia o aplicativo Flask na porta 5001 com a opção de recarregamento automático.
app.run(port=5001, use_reloader=True)
