app.controller('AdminUserController', function ($scope, $timeout, $mdSidenav, $log, $http, $mdDialog, $mdToast) {
	$scope.$parent.loading = 'indeterminate';
	$scope.usuariosAdmin = [];
	$scope.usuariosAlumno = [];
	$scope.usuariosMaestro = [];
	$scope.$parent.toolbar_title = 'Gestión de usuarios';
	$scope.usuarioResponsableForm = null;
	$scope.usuarioAdminForm = null;
	$scope.usuarioMaestroForm = null;

	$http.get('Admin/ajaxGetAdminUsers')
	.then(function(response) {
		$scope.usuariosAdmin = response.data;
	})
	.finally(function() {
		$scope.$parent.loading = null;
	});

	$http.get('Admin/ajaxGetAlumnoUsers')
	.then(function(response) {
		$scope.usuariosAlumno = response.data;
	})
	.finally(function() {
		$scope.$parent.loading = null;
	});

	$http.get('Admin/ajaxGetMaestroUsers')
	.then(function(response) {
		$scope.usuariosMaestro = response.data;
	})
	.finally(function() {
		$scope.$parent.loading = null;
	});

	$scope.modAlumnoDialog = function(ev, index) {
		$scope.usuarioResponsableForm = $scope.usuariosAlumno[index];
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
.controller('AdmiClasesController', function ($scope, $timeout, $mdSidenav, $log, $http, $mdDialog, $mdToast) {
	$scope.$parent.loading = 'indeterminate';
	$scope.clasesA = [];
	$scope.clasesB = [];
	$scope.clasesC = [];
	$scope.clasesD = [];
	$scope.$parent.toolbar_title = 'Gestión de clases';
	$scope.claseForm = null;

	$http.get('Admin/ajaxGetClases?clasetype=A')
	.then(function(response) {
		$scope.clasesA = response.data;
	})
	.finally(function() {
		$scope.$parent.loading = null;
	});

	$http.get('Admin/ajaxGetClases?clasetype=B')
	.then(function(response) {
		$scope.clasesB = response.data;
	})
	.finally(function() {
		$scope.$parent.loading = null;
	});

	$http.get('Admin/ajaxGetClases?clasetype=C')
	.then(function(response) {
		$scope.clasesC = response.data;
	})
	.finally(function() {
		$scope.$parent.loading = null;
	});

	$http.get('Admin/ajaxGetClases?clasetype=D')
	.then(function(response) {
		$scope.clasesD = response.data;
	})
	.finally(function() {
		$scope.$parent.loading = null;
	});

	$scope.modAlumnoDialog = function(ev, index) {
		$scope.claseForm = $scope.usuariosAlumno[index];
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
});
