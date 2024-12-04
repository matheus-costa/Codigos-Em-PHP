from flask import Flask, redirect, json, request, render_template
import sqlite3

app = Flask(import_name=__name__, template_folder='.')

@app.route('/prato')
@app.route('/prato/listar')
def pratolistar ():
    conexao = sqlite3.connect('banco')
    sql = "select id, nome, valor from prato order by nome;"
    resultado = conexao.execute(sql).fetchall()
    conexao.close()
    return render_template('prato_listar.html', resultado=resultado)

@app.route('/prato/inserir', methods=['GET', 'POST'])
def pratoinserir ():
    if request.method == 'POST':
        nome = request.values.get('nome')
        valor = request.values.get('valor')
        conexao = sqlite3.connect('banco')
        sql = "insert into prato values ( null, '"+nome+"', '"+valor+"' );"
        resultado = conexao.execute(sql)
        conexao.commit()
        conexao.close()
        return redirect('/prato')
    else:
        return render_template('prato_cadastro.html')

@app.route('/prato/remover')
def pratoremover ():
    id = request.values.get('id')
    conexao = sqlite3.connect('banco')
    sql = "delete from prato where id = '"+id+"'"
    resultado = conexao.execute(sql)
    conexao.commit()
    conexao.close()
    return redirect('/prato')

@app.route('/cliente')
@app.route('/cliente/listar')
def clientelistar ():
    conexao = sqlite3.connect('banco')
    sql = "select id, nome, cpf from cliente order by nome;"
    resultado = conexao.execute(sql).fetchall()
    conexao.close()
    return render_template('cliente_listar.html', resultado=resultado)

@app.route('/cliente/inserir', methods=['GET', 'POST'])
def clienteinserir ():
    if request.method == 'POST':
        nome = request.values.get('nome')
        cpf = request.values.get('cpf')
        conexao = sqlite3.connect('banco')
        sql = "insert into cliente values ( null, '"+nome+"', '"+cpf+"' );"
        resultado = conexao.execute(sql)
        conexao.commit()
        conexao.close()
        return redirect('/cliente')
    else:
        return render_template('cliente_cadastro.html')

@app.route('/cliente/remover')
def clienteremover ():
    id = request.values.get('id')
    conexao = sqlite3.connect('banco')
    sql = "delete from cliente where id = '"+id+"'"
    resultado = conexao.execute(sql)
    conexao.commit()
    conexao.close()
    return redirect('/cliente')

@app.route('/')
def index():
    conexao = sqlite3.connect('banco')
    conexao.execute("create table if not exists prato ( id integer primary key autoincrement, nome text, valor float );")
    conexao.execute("create table if not exists cliente ( id integer primary key autoincrement, nome text, cpf text );")
    conexao.execute("create table if not exists venda ( id integer primary key autoincrement, data date, prato integer references prato (id), cliente references cliente (id), valor float );")
    conexao.commit()
    conexao.close()
    return redirect('/venda')

@app.route('/venda')
@app.route('/venda/listar')
def vendalistar ():
    conexao = sqlite3.connect('banco')
    sql = "select v.id, p.nome pnome, c.nome cnome, p.valor pvalor, v.valor vvalor, v.data from venda v join cliente c on v.cliente = c.id join prato p on v.prato = p.id order by v.id;"
    resultado = conexao.execute(sql).fetchall()
    conexao.close()
    return render_template('venda_listar.html', resultado=resultado)

@app.route('/venda/inserir', methods=['GET', 'POST'])
def vendainserir ():
    if request.method == 'POST':
        prato = request.values.get('prato')
        cliente = request.values.get('cliente')
        conexao = sqlite3.connect('banco')
        sql = "insert into venda values ( null, date('now'), '"+prato+"', '"+cliente+"', (select valor from prato where id = '"+prato+"') );"
        resultado = conexao.execute(sql)
        conexao.commit()
        conexao.close()
        return redirect('/venda')
    else:
        conexao = sqlite3.connect('banco')
        pratos = conexao.execute("select id, nome from prato order by 2").fetchall()
        clientes = conexao.execute("select id, nome from cliente order by 2").fetchall()
        conexao.close()
        return render_template('venda_cadastro.html', pratos=pratos, clientes=clientes)

@app.route('/venda/remover')
def vendaremover ():
    id = request.values.get('id')
    conexao = sqlite3.connect('banco')
    sql = "delete from venda where id = '"+id+"'"
    resultado = conexao.execute(sql)
    conexao.commit()
    conexao.close()
    return redirect('/venda')
@app.route('/verifica')
def verifica():
    conexao = sqlite3.connect('banco')
    txt = request.get_data()
    obj = json.loads(txt)
    cpf = obj['cpf']
    nome = obj['nome']
#SQL QUE VERIFICA SE O CLIENTE DESTE RESTAURANTE COMPROU EM OUTRO RESTAURANTE
    sql = f"select v.id, p.nome pnome, c.nome cnome, p.valor pvalor, v.valor vvalor, v.data 
            from venda v 
            join cliente c 
                         on v.cliente = c.id 
            join prato p 
                         on v.prato = p.id order by v.id
            where pnome ='{nome}' and cnome ='{cnome}' ;
             "
    conexao.close()
    obj = false     
    if len(resultado) > 0: #VERIFICO SE HOUVE RETORNO DA BUSCA POR ESSE CLIENTE    
        obj = true
    txt = json.dumps(obj)
    return txt
    
app.run(port=5003, use_reloader=True)
