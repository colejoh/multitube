var app = angular.module('letterToRep', ['ngRoute']);

app.config(function($routeProvider, $httpProvider) {
    $routeProvider.when('/', {
        templateUrl: '../main.html',
        controller: 'MainController'
    });
});
