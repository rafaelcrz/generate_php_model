<?php
session_start();
?>
<!DOCTYPE html>
<html ng-app="GeraMetodos">
<!-- 
-->
<head>
	<meta charset="utf-8">
	<title>PHP Model Generator</title>
	
	<link rel="stylesheet" type="text/css" href="/generate_model/assets/css/custom.css">
	<link rel="stylesheet" type="text/css" href="/generate_model/assets/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="/generate_model/assets/css/estilo.css">
	
	<!--<script src="http://code.angularjs.org/1.0.1/angular-1.0.1.min.js"></script>-->
		<script scrc="../generate_model/assets/js/formularioJavaScript.js"></script>

</head>
<script type="text/javascript">
	var lista = new Array();
	var cont = 0;

	function getId(id) {
		return document.getElementById(id);
	}

	function showValue(id) {
		if(getId(id).value != ""){
			getId("nomeClasse").innerHTML = "Class "+getId("classeNome").value;//mostra o nome da classe
		}
	}

	function editar(){
		var n = document.getElementById("nomeVariavel").readOnly = false;
		//angular.element(document.getElementById('gerador')).scope().addAtributo();
	}

	function getScope(name) {
		return angular.element(document.getElementById('gerador')).scope();
	}
</script>

<body>
<script src="../generate_model/assets/js/angular.min.js"></script>
<!-- GeradorController Angular -->
<script src="../generate_model/assets/js/geradorController.js"></script>



<nav class="navbar navbar-inverse navbar-static-top">
  <div class="container">
    <ul class="nav navbar-nav">
    	<li><a href="index.php">Home</a></li>
    	<li><a href="#">Forkme in GitHub</a></li>
    	<li><a href="#">PHP Official Documentation</a></li>
    </ul>
  </div>
</nav>

<div class="container">
<div class="row">
<div class="col-md-12" id="gerador" ng-controller="geradorController">
	<h2>PHP Model Generator</h2>
	<br>
	
	<!-- form -->
	<aside class="col-md-12">
	<aside class="col-md-8">
	<input type="text" id="classeNome" class="form-control" placeholder="Class name" required>
	</aside>
	<aside class="col-md-4">
	<button class="btn btn-primary" onclick="showValue('classeNome')" id="addAtrib">Confirm</button>
	</aside>
	</aside>

	<br></br>

	<aside class="col-md-12">
	<aside class="col-md-8">
	<input type="text" ng-model="atributoNome" id="atributoNome" class="form-control" placeholder="{{mensagem}}">
	</aside>
	<aside class="col-md-4">
	<button class="btn btn-primary" id="addAtrib" ng-disable="formulario.$invalid" ng-click="addAtributo()">Add atribute</button>
	</aside>
	</aside>
	<br></br>

	<!-- ng-disable="formulario.$invalid" -->
	
	<aside class="col-md-12">
	<h3><div id="nomeClasse"></div></h3> <!-- Exibe o nome da classe -->
	
	<p></p>
	<div> 

	<table class="table table-striped table-hover">
		<tr>
			<td><strong>Atribute name</strong></td>
		</tr>
		<tr ng-repeat="atributo in atributos">
			<td>
			<aside class="col-md-12">
			<aside class="col-md-10">
			<input type="text" value="{{atributo.nome}}" id="nomeVariavel" class="form-control" readonly="true"">
			</aside>
			<aside class="col-md-2">
			<!--<button class="btn btn-danger" id="btEditar" onclick="editar()">Editar</button>-->
			</aside>
			</aside>
			</td>
		</tr>
	</table>

	<div class="checkbox">
		<p><label><input type="checkbox" id="Gerarconstrutor"><strong> Construct generate</strong>
		</label>
	</div>
	</div>

	</aside>
	
	<p></p>
	<form name="formulario" action="/generate_model/app/view/showClass.php" method="post">
	<input type="hidden" name="nomeClass" id="nomeClass" value="">
	<input type="hidden" name="construtor" id="construtor" value="">
	<input type="hidden" name="id" id="id" value="">
	
	<div class="col-md-12">
		
		<input type="submit" name="submitGerar" value="Generate class" class="btn btn-success" onclick="sendValor()">
	</div>
	</form>
	<script type="text/javascript">

	

	function sendValor() {
		
		//var $scope = getScope();
		//var list = $scope.atributos.valueOf();
		var listAtr = getListaAtributos();
		document.getElementById("id").value = listAtr.join("|");
		var isConstrutor = document.getElementById('Gerarconstrutor').checked;
		document.getElementById("construtor").value = isConstrutor;
		var nomeDaClasse = document.getElementById("nomeClasse").innerHTML;
		document.getElementById("nomeClass").value = nomeDaClasse;
	}

	function getListaAtributos() {
		var novaLista = [];
		var $scope = getScope();
		var list = $scope.atributos.valueOf();
		var count = list.length;
		for (var i = 0; i < count; i++) {
			novaLista[i] = list[i].nome;
		}
		return novaLista;
	}

	</script>
</div><!-- GERADOR DO CODIGO-->


</div> <!-- CONTAINER-->
<br><br><br><br><br>
	<div class="col-md-12">
		Development by <strong>Rafael Ramos</strong> - 2016 <a href="#"><strong>My GitHub</strong></a>

		<P>
		Referencies: 
		<a href="#">Bootstrap</a>
		<a href="#">Javascript</a>
		<a href="#">AngularJs</a>
	</div>

	<!--<script src="http://code.angularjs.org/1.0.1/angular-1.0.1.min.js"></script>-->

</body>
</html>