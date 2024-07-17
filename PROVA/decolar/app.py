from flask import Flask, json, render_template, request, redirect, jsonify
import sqlite3
import requests

app = Flask(__name__, template_folder='.')

@app.route('/listar', methods=['GET'])
def listar ():
	return render_template('listar.html')

@app.route('/comprar', methods=['GET'])
def comprar ():
	return render_template('comprar.html')

@app.route('/confirmar', methods=['GET', 'POST'])
def confirmar ():
	return render_template('confirmar.html')

@app.route('/', methods=['GET', 'POST'])
def index():
	return redirect('/listar')
	
app.run(port=5001, use_reloader=True)
