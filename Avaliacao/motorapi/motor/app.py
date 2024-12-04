from flask import Flask, json, request
import requests

app = Flask (import_name=__name__)

@app.route(rule='/consulta', methods=['POST'])
def consulta ():
    txt = request.get_data()
    obj = json.loads(txt)
    cpf = obj['cpf']

    ## consome o serviço 1 -- cartório sete de setembro
    obj = { "cpf" : cpf }
    txt = json.dumps(obj)
    resposta = requests.post(url='http://localhost:5001/verifica', data=txt)
    txt = resposta.content
    obj = json.loads(txt)
    assinatura01 = obj['assinatura']

    ## consome o serviço 2 -- cartório general osório
    obj = { "cpf" : cpf }
    txt = json.dumps(obj)
    resposta = requests.post(url='http://localhost:5002/verifica', data=txt)
    txt = resposta.content
    obj = json.loads(txt)
    assinatura02 = obj['assinatura']

    ## aqui vão os consumos dos serviços dos demais cartórios ...
    
    ## neste exemplo, os cartórios são iguais. 
    ## em cenário reais, os sistemas e seus serviços não são nem parecidos entre si.
    ## URL, entrada e saída de cada serviço geralmente são diferentes.
    ## é tarefa do "motor de API" unificar todas respostas em uma estrutura para dar de resposta a quem consome seus serviços.

    obj = { "assinaturas" : [ assinatura01, assinatura02 ] }
    txt = json.dumps(obj)
    return txt

app.run(host='0.0.0.0', port='6000', use_reloader=True)