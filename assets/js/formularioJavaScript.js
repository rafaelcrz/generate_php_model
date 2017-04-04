	var lista = new Array();
	var cont = 0;

	function getId(id) {
		return document.getElementById(id);
	}

	function addLista() {
		var atributo = getId("atributoNome");
		//lista[0] = atributo.value;

		//getId("exibe").value = "\n"+atributo.value;//+lista.toString();
		//cont++;
	}

	function showValue(id) {
		if(getId(id).value != ""){
			//getId("exibe").style = ":inline";
			//getId("alterarClasse").style = ":inline";
			//getId("exibe").value = getId(id).value;
			getId("nomeClasse").innerHTML = "Class "+getId("classeNome").value;//mostra o nome da classe
			//getId("classeNome").value = "";
			//getId("classeNome").style = "display:none";
			//getId("addAtrib").style = "display:none";
		}
	}

	function getSize() {
		return lista.valueOf();
	}

	function sendPage() {
		//alert("ddd");
		document.formulario.action = "teste.php?id=1";
		document.formulario.submit();
	}

	function editar(){
		var n = document.getElementById("nomeVariavel").readOnly = false;
		//angular.element(document.getElementById('gerador')).scope().addAtributo();
	}

	function getScope(name) {
		//var sel = 'div[ng-controller=geradorController]';
		//return angular.element(sel).scope();
		return angular.element(document.getElementById('gerador')).scope();
		//document.getElementById("id").value = "novoteste";
	}