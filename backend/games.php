<?php

function getGames(){
	$con = dbConnect();
	$result = mysqli_query($con,"SELECT titulos.nome,fabricantes.nome,preco,classificacao,titulos.cod FROM titulos,fabricantes WHERE titulos.fabricante  =  fabricantes.cod ORDER BY titulos.nome"); 		
	dbGetContent(1,$result,'Jogo');
	$con->close();
}

// Route users
if(@$_REQUEST['action'] == "games") {
	echo "get games";
	getGames();
	exit;
}
