<?php 

/**
* Gerador dos metodos
*/
class Gerador{
	//hospedar no git
	private $atributos = array();
	private $className;

	function __construct($className)
	{
		$this->className = $className;	
	}

	public function setVariaveis($variaveis){
		$this->atributos = $variaveis;
	}
	/*
	public function toUperFirstChar(){
		foreach ($this->atributos as $variavel) {
			echo strtoupper(substr($variavel,0,1));
		}
	}*/

	public function getVariaveis(){
		return $this->atributos;
	}

	public function getClassName(){
		return $this->className;
	}


	public function generateDefaultConstruct(){

		$text = "\r\r\tfunction __construct(){ \r\t}";
		return $text;
	}

	public function generateConstruct(){
		$varsCons = null;
		$listVars = array();
		$cont = 0;
		$text;
		foreach ($this->atributos as $value) {
			$value = "$".$value;
			$varsCons = $varsCons.",".$value;
		}

		$text = "\r\r\tfunction __construct(".$varsCons."){";
		foreach ($this->atributos as $variavel) {
			$text = $text."\r\t\t".'$this->'.$variavel." = $".$variavel.";";
		}
		$listVars[$cont] = $text."\r\t}";
		$cont++;
		return $listVars;
	}

	public function generateSetters(){
		$listSetters = array();
		$cont = 0;
		foreach ($this->atributos as $variavel) {
			$resul = $this->identar(1)."\t".'public function set'.ucfirst($variavel).'($'.$variavel.'){'.
			$this->identar(1)."\t\t".'$this->'.$variavel.' = $'.$variavel.';'.$this->identar(1)."\t".'}';
			$listSetters[$cont] = $resul;
			$cont++;
		}
		return $listSetters;
	}

	public function generateGetters(){
		$listGetters = array();
		$cont = 0;
		foreach ($this->atributos as $variavel) {
			$resul = $this->identar(1)."\t".'public function get'.ucfirst($variavel).'(){'
			."\r\t\t".'return $this->'.$variavel.';'.$this->identar(1)."\t".'}';
				$listGetters[$cont] = $resul;
				$cont++;
		}
		return $listGetters;
	}




	/**
	* Método responsavel por identar o código
	* &nbsp ESPAÇO
	* \t TAB
	*/
	public function identar($qnt){
		return str_repeat("\t\r",$qnt);
	}



	
}



 ?>