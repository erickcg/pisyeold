app.controller('AdminUserController', function ($scope, $timeout, $mdSidenav, $log, $http, $mdDialog, $mdToast) {
	$scope.$parent.loading = 'indeterminate';
	$scope.usuariosAdmin = [];
	$scope.usuariosResponsable = [];
	$scope.$parent.toolbar_title = 'Gestión de usuarios';
	$scope.usuarioResponsableForm = null;
	$scope.usuarioAdminForm = null;

	$http.post('Admin/ajaxGetUsuarioAdmin', {})
	.then(function(response) {
		$scope.usuariosAdmin = response.data;
	})
	.finally(function() {
		$scope.$parent.loading = null;
	});

	$http.post('Admin/ajaxGetUsuarioResponsable', {})
	.then(function(response) {
		$scope.usuariosResponsable = response.data;
	})
	.finally(function() {
		$scope.$parent.loading = null;
	});

	$scope.modPymeDialog = function(ev, index) {
		$scope.usuarioResponsableForm = $scope.usuariosResponsable[index];
		$mdDialog.show({
			controller: DialogController,
			templateUrl: 'index.php?controller=Template&action=modificarCliente',
			parent: angular.element(document.body),
			targetEvent: ev,
			clickOutsideToClose:false,
			scope: $scope,
			preserveScope: true
		})
		.then(function(resp) { //se guarda el cambio
			if (resp) {
				$http.post('Admin/ajaxUpdateUsuarioResponsable', $scope.usuarioResponsableForm)
				.then(function(response) {
					$mdToast.show(
						$mdToast.simple()
						.position('right')
						.content('Guardado Usuario Responsable')
						.parent(document.querySelector( '#pagecontent' ))
						.hideDelay(3000)
					);
				});
			}
		});
	};

	$scope.modAdminDialog = function(ev, index) {
		$scope.usuarioAdminForm = $scope.usuariosAdmin[index];
		$mdDialog.show({
			controller: DialogController,
			templateUrl: 'Templates/modificarUsuarioAdmin.html',
			parent: angular.element(document.body),
			targetEvent: ev,
			clickOutsideToClose:false,
			scope: $scope,
			preserveScope: true
		})
		.then(function(resp) { //se guarda el cambio
			if (resp) {
				$http.post('Admin/ajaxUpdateUsuarioResponsable', $scope.usuarioAdminForm)
				.then(function(response) {
					$mdToast.show(
						$mdToast.simple()
						.position('right')
						.content('Guardado Usuario Admin')
						.parent(document.querySelector( '#pagecontent' ))
						.hideDelay(3000)
					);
				});
			}
		});
	};
})
.controller('AdminClientesController', function ($scope, $timeout, $mdSidenav, $log, $http, $mdDialog, $mdToast) {
	$scope.$parent.loading = 'indeterminate';
	$scope.clientes = [];
	$scope.$parent.toolbar_title = 'Gestión de clientes';
	$scope.clienteForm = null;

	$http.post('Admin/ajaxGetCliente', {})
	.then(function(response) {
		$scope.clientes = response.data;
	})
	.finally(function() {
		$scope.$parent.loading = null;
	});

	$scope.modClienteDialog = function(ev, index) {
		$scope.clienteForm = $scope.clientes[index];
		$mdDialog.show({
			controller: DialogController,
			templateUrl: 'Templates/modificarCliente.html',
			parent: angular.element(document.body),
			targetEvent: ev,
			clickOutsideToClose:false,
			scope: $scope,
			preserveScope: true
		})
		.then(function(resp) { //se guarda el cambio
			if (resp) {
				$http.post('Admin/ajaxUpdateUsuarioResponsable', $scope.clienteForm)
				.then(function(response) {
					$mdToast.show(
						$mdToast.simple()
						.position('right')
						.content('Guardado Usuario Admin')
						.parent(document.querySelector( '#pagecontent' ))
						.hideDelay(3000)
					);
				});
			}
		});
	};
});
