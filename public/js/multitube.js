var app = angular.module('multitube', ['ngRoute']);

app.config(function($routeProvider, $httpProvider) {
    $routeProvider.when('/', {
        templateUrl: '../main.html',
        controller: 'MainController'
    });
});
