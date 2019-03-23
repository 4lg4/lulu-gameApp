<?php

function getGames(){
	$con = dbConnect();
	$r = dbGetContent(
		mysqli_query($con, "SELECT titulos.nome,fabricantes.nome,preco,classificacao,titulos.cod FROM titulos,fabricantes WHERE titulos.fabricante = fabricantes.cod ORDER BY titulos.nome")
	);
	$con->close();
	return $r;
}

function deleteGames($id){
	$con = dbConnect();
	$res = mysqli_query($con, "DELETE FROM titulos WHERE titulos.cod  =  ".$id);
	$con->close();
}

function createGames($game){
	$con = dbConnect();

	$con = conectaDB();
	$jogo = dbScapeString($game['jogo']);
	$fabricante = dbScapeString($game['fab']);
	$preco = floatval($game['preco']);
	$classificacao = intval($game['class']);
	
	mysqli_query($con,"INSERT INTO titulos (nome,fabricante,preco,classificacao) VALUES('$jogo','$fabricante','$preco','$classificacao');");
	$con->close();
}

// Routes users
// GET games
if(@$_REQUEST['action'] == "games") {
	$allGames = getGames();
	httpSuccess($allGames);
	exit;
}

// DELETE games
if(@$_REQUEST['action'] == "gamesDelete") {
	deleteGames($_REQUEST['id']);
	httpSuccess(
		getGames()
	);
	exit;
}

// CREATE games
if(@$_REQUEST['action'] == "gamesCreate") {
	createGames([
		'jogo' => $_REQUEST['jogo'],
		'fab' => $_REQUEST['fab'],
		'preco' => $_REQUEST['preco'],
		'class' => $_REQUEST['class'],
	]);
	
	httpSuccess(
		getGames()
	);
	exit;
}
