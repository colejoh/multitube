var express = require('express');
var bodyParser = require('body-parser');
var logger = require('morgan');
var app = express();
var port = 8080;

// Sets up angular app
app.use(express.static(__dirname + '/public'));

// bodyParser to use for parsing JSON requests
app.use(bodyParser.json());

// Logs requests
app.use(logger('dev'));

// Starts server
app.listen(port);
console.log("listening on port " + port + "...");
