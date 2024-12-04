from flask import Flask, render_template, redirect, json, request
import sqlite3
import requests
import base64

app = Flask(import_name=__name__, template_folder='.')

@app.route(rule='/cadastropessoa', methods=['GET'])
def cadastropessoa():
    return render_template('cadastropessoa.html')

@app.route(rule='/insertpessoa', methods=['POST'])
def insertpessoa():
    cpf = request.values.get('cpf')
    nome = request.values.get('nome')
    arquivo = request.files.get('assinatura')
    arquivo = base64.b64encode(arquivo.read()).decode('utf-8')
    sql = f"insert into pessoa values ( null, '{cpf}', '{nome}', '{arquivo}' )"
    conexao = sqlite3.connect('banco')
    conexao.execute(sql)
    conexao.commit()
    conexao.close()
    return redirect('/listapessoa')

@app.route(rule='/listapessoa', methods=['GET'])
def listapessoa():
    sql = " select * from pessoa; "
    conexao = sqlite3.connect('banco')
    resultado = conexao.execute(sql).fetchall()
    conexao.close()
    return render_template('listapessoa.html', resultado=resultado)

@app.route(rule='/deletepessoa', methods=['GET'])
def deletepessoa():
    id = request.values.get('id')
    sql = f" delete from pessoa where id = '{id}'; "
    conexao = sqlite3.connect('banco')
    conexao.execute(sql)
    conexao.commit()
    conexao.close()
    return redirect('/listapessoa')

@app.route(rule='/cadastrodocumento', methods=['GET'])
def cadastrodocumento():
    id = request.values.get('id')
    cpf = request.values.get('cpf')
    obj = { "cpf" : cpf }
    txt = json.dumps(obj)
    resposta = requests.post(url='http://localhost:6000/consulta', data=txt)
    txt = resposta.content
    obj = json.loads(txt)
    assinaturas = obj['assinaturas']
    return render_template('cadastrodocumento.html', assinaturas=assinaturas, id=id )

@app.route(rule='/verifica', methods=['POST'])
def verifica ():
    txt = request.get_data()
    obj = json.loads(txt)
    cpf = obj['cpf']
    sql = f" select assinatura from pessoa where cpf = '{cpf}' limit 1; "
    conexao = sqlite3.connect('banco')
    resultado = conexao.execute(sql).fetchall()
    conexao.close()
    obj = { "assinatura" : "" }
    if len(resultado) > 0:
        obj = { "assinatura" : resultado[0][0] }
    txt = json.dumps(obj)
    return txt 

@app.route(rule="/uploaddocumento", methods=['POST'])
def uploadocumento():
    arquivo = request.files.get('arquivo')
    id = request.values.get('id')
    arquivo = base64.b64encode(arquivo.read()).decode('utf-8')
    sql = f" insert into arquivo values ( null, '{arquivo}', datetime('now'), '{id}' ); "
    conexao = sqlite3.connect('banco')
    conexao.execute(sql)
    conexao.commit()
    conexao.close()
    return redirect ('/listapessoa')

@app.route(rule="/listadocumento", methods=['GET'])
def listadocumento():
    id = request.values.get('id')
    conexao = sqlite3.connect('banco')
    sql = f" select cpf, nome from pessoa where id = '{id}'; "
    pessoa = conexao.execute(sql).fetchone()
    sql = f" select conteudo, datahora from arquivo where pessoa = '{id}'; "
    arquivos = conexao.execute(sql).fetchall()
    conexao.close()
    return render_template('listadocumento.html', pessoa=pessoa, arquivos=arquivos)

app.run(host="0.0.0.0", port="5002", use_reloader=True)