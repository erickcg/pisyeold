app.config(function($routeProvider) {
	$routeProvider
	.when('/p/users', {
		templateUrl: 'index.php?controller=Admin&action=users',
		controller: 'AdminUserController'
	})
	.when('/p/clientes', {
		templateUrl: 'index.php?controller=Admin&action=clientes',
		controller: 'AdminClientesController'
	})
	.otherwise({
		redirectTo: '/p/users'
	});
});

