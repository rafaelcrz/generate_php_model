	angular.module('GeraMetodos',[]). //cria o modulo
	controller('geradorController',['$scope',function($scope){
		$scope.atributos = [
			{'nome':''}
		];

		$scope.mensagem = "Atribute name";

		$scope.addAtributo = function(){

			if($scope.atributoNome.length > 0){
				$scope.mensagem = "Atribute name";
				$scope.atributos.push({'nome':$scope.atributoNome})
				$scope.atributoNome = ''
			}else{
				$scope.mensagem = "Campo obrigatorio";
			}
		}

		$scope.getList = function () {
			return $scope.atributos
		}


	}])