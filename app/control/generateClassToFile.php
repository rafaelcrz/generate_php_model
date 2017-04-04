<?php
/**
* Receive the parameters values, construct value and class name
* Ident the file, create a class format and save the file
*
**/
	$root = "$_SERVER[DOCUMENT_ROOT]";
	include_once "$root/generate_model/app/control/fileManager.php";
	include_once "$root/generate_model/app/model/methodsToFile.php";
	
	session_start();

	if(isset($_POST['submitCreateClass'])){

		$nomeClasse = $_SESSION['nomeClasse'];
		$nomeVariaveis = $_SESSION['nomeVariaveis'];
		$isConstrutor = $_SESSION['isConstrutor'];

		//print_r($nomeVariaveis);

		$gerador = new Gerador($nomeClasse);
		$arquivo = new Arquivo();

		$gerador->generateSetters();
		$variaveis = $nomeVariaveis; //comparar seo array esta com valores

		$gerador->setVariaveis($variaveis);

		$values = $gerador->getVariaveis();

		$className = $gerador->getClassName();

		$arquivo->escrever("$className.php","<?php".$gerador->identar(1)."\r\rclass $className{\r");

		foreach ($values as $atributo) {
			$arquivo->escrever("$className.php","\r\tprivate $".$atributo);
		}

		if(strcmp($isConstrutor,"true")==0){
			$construtor = $gerador->generateConstruct();

			foreach ($construtor as $const) {
				$arquivo->escrever("$className.php",$const);
			}
		}else{
			$construtorDefault = $gerador->generateDefaultConstruct();
			$arquivo->escrever("$className.php",$construtorDefault);
		}	

		$arquivo->escrever("$className.php","\t\r ");

		$setters = $gerador->generateSetters();
		$getters = $gerador->generateGetters();

		foreach ($setters as $set) {
		$arquivo->escrever("$className.php",$set);
		}

		foreach ($getters as $get) {
		$arquivo->escrever("$className.php",$get);
		}

		$arquivo->escrever("$className.php","\r\r}");
		$arquivo->escrever("$className.php","\r\r?>\r");

		//header("Content-Disposition: attachment");

	}

?>