<?php

/**
ShowClass.php
After generate the PHP model this page show it. Is a 'preview class'.
The user can copy the code and past in her php file or do download and save it in
local.
*/
$root = "$_SERVER[DOCUMENT_ROOT]";
include_once "$root/generate_model/app/model/methodsToPreview.php";

session_start();
?>
<!DOCTYPE html>
<html>

<head>	
	<meta charset="utf-8">
	<title>PHP Model Generator</title>
	
	<link rel="stylesheet" type="text/css" href="/generate_model/assets/css/custom.css">
	<link rel="stylesheet" type="text/css" href="/generate_model/assets/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="/generate_model/assets/css/estilo.css">
	
</head>

<body>
<nav class="navbar navbar-inverse navbar-static-top">
  <div class="container">
    <ul class="nav navbar-nav">
    	<li><a href="/generate_model/index.php">Home</a></li>
    </ul>
  </div>
</nav>

<div class="container">
<div class="col-md-8" id="show">
	<h2>Class preview</h2>
	If you can, copy the code and past in your php file
	<p>
	<div class="panel panel-default">
	  <div class="panel-body" id="panelGuest">
		    <?php
		    if(isset($_POST['submitGerar'])){

		    $nomeClasse = $_POST['nomeClass'];
		    $isConstrutor = $_REQUEST['construtor'];
		    $_SESSION['isConstrutor'] = $isConstrutor;
		    $lista = explode("|", $_REQUEST["id"]);
			$count = sizeof($lista);

			if(strcmp($nomeClasse,"") != 0 && $count > 1){
		    	$x = 0;
		    	$listaDeVariaveis = array();
			    foreach ($lista as $valor) {
			    	if(strcmp($valor, "")>0){
			    		$listaDeVariaveis[$x] = $valor;
			    	}
			    	$x++;
			    }

			    $_SESSION['nomeVariaveis'] = $listaDeVariaveis;
			    $nomeClasse = substr($nomeClasse, 6);
			    $_SESSION['nomeClasse'] = $nomeClasse;

			    $variaveis = $listaDeVariaveis;
			    //$variaveis = array('codigo');//comparar seo array esta com valores
				
				$viewClass = new GeneratePreviewMethods($nomeClasse);
				
				$viewClass->setVariaveis($variaveis); //seta os atributos

				$setters = $viewClass->generateSetters(); //retorna os metodos setters
				$getters = $viewClass->generateGetters(); //retorno os metodos getters
				$values = $viewClass->getVariaveis(); //retorna os atributos

				
				$className = $viewClass->getClassName(); //retorna o nome da classe

				echo "<strong>class</strong> ".$className."{<br>"; //exibe o inicio da classe

				/*
				* Mostra todos os atributos da classe
				* private <atributo>;
				*/
				foreach ($values as $key) {
					echo "<br><strong>private</strong> $".$key.";";
				}

				echo "<br><br>"; //espaço antes do nome da classe

				if(strcmp($isConstrutor,"true")==0){
					$construtor = $viewClass->generateConstruct();

					/*
					* Mostra o construtor
					*/
					foreach ($construtor as $const) {
						echo "<font color = '#4caf50'>$const</font>";
					}
				}else{
					$construtorDefault = $viewClass->generateDefaultConstruct();
					echo "<font color = '#4caf50'>$construtorDefault</font>";
				}

				/*
				* Mostra todos os metodos setters
				*/
				foreach ($setters as $set) {
					echo "<font color = '#2769b1'>$set</font>";
				}

				/*
				* Mostra todos os metodos getters
				*/
				foreach ($getters as $get) {
					echo "<font color = '#f9263e'>$get</font>";
				}

				echo "}<br>"; //fim da classe

			}else{
				//echo($nomeClasse);
				//echo($count);
				header("Location: /generate_model/index.php");
			}
			}
		    ?>
	  	</div>
	</div>
</div> <!-- CONTAINER-->
<div class="col-md-4">
	Save the php file.<br></br>
	<form action="/generate_model/app/control/generateClassToFile.php" method="POST">
		
		<input type="submit" name="submitCreateClass" class="btn btn-primary" value="Save .php file">
	</form>
</div>
<br><br><br><br><br>
	<div class="col-md-12">
		Development by <strong>Rafael Ramos</strong> - 2016 <a href="#"><strong>My GitHub</strong></a>
		<P>
		Referencies: 
		<a href="#">Bootstrap</a>
		<a href="#">Javascript</a>
		<a href="#">AngularJs</a>
	</div>

</body>
</html>