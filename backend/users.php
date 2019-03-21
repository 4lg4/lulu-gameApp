<?php

function getUsers() {
	$con = conectaDB();
	$result = mysqli_query($con,"SELECT usuarios.nome,nick,cidades.nome,email,idade,usuarios.cod FROM usuarios,cidades WHERE usuarios.cidade  =  cidades.cod ORDER BY usuarios.nome"); //eh retornada nesta consulta o campo de codigo do usuario (na ultima posicao) 		
	mostraTabela(5,$result,'Usuario');    //este codigo eh usado como parametro na funcao javascript de delecao
	$con->close();                        //o html da chamada desta funcao de delecao eh montado na funcao php mostraTabela
}

// Route users
if(@$_REQUEST['action'] == "users") {
	echo "get users";
	// getUsers();

	exit;
}
