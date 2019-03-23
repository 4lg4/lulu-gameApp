<?php

function getUsers() {
	$con = dbConnect();
	$r = dbGetContent(
		mysqli_query($con,"SELECT usuarios.nome,nick,cidades.nome,email,idade,usuarios.cod FROM usuarios,cidades WHERE usuarios.cidade  =  cidades.cod ORDER BY usuarios.nome")
	);
	$con->close();
	return $r;
}

function deleteUsers($id) {
	$con = dbConnect();
	$res = mysqli_query($con,"DELETE FROM usuarios WHERE usuarios.cod  =  ".$id);
	$con->close();
}

function createUsers($user) {
	$con = dbConnect();

	$nomeUsuario = dbScapeString($user['usuario']);
	$nick = dbScapeString($user['nick']);
	$email = dbScapeString($user['email']);
	$idade = intval($user['idade']);
	if($idade == "") {
		$idade = "NULL";
	}  //no input do form em index.html eh empregado min = "1" para limitar a idade minima a 1
	$cidade = dbScapeString($user['cidade']);
	
	mysqli_query($con,"INSERT INTO usuarios (nome,nick,email,idade,cidade) VALUES('$nomeUsuario','$nick','$email','$idade','$cidade');");

	$con->close();
}

// Routes users
// GET users
if(@$_REQUEST['action'] == "users") {
	httpSuccess(getUsers());
	exit;
}

// CREATE users
if(@$_REQUEST['action'] == "usersCreate") {
	createUsers([
		'usuario'=> $_REQUEST['usuario'],
		'email'=> $_REQUEST['email'],
		'nick'=> $_REQUEST['nick'],
		'idade'=> $_REQUEST['idade'],
		'cidade'=> $_REQUEST['cidade'],
	]);

	httpSuccess(getUsers());
	exit;
}

// DELETE users
if(@$_REQUEST['action'] == "usersDel") {
	deleteUsers($_REQUEST['id']);
	httpSuccess(getUsers());
	exit;
}