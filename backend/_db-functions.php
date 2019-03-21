<?php

function dbConnect(){
	$con  =  mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_DB);
	
	if(!$con){
		echo "<h2>Erro na conexao com a base dados...</h2>"; 
		echo "<h2> Erro " . mysqli_connect_errno() . ".</h2>";
		die();
	}
	$con->set_charset("utf8");
	return $con;
}

function dbGetContent($qtdeColunas, $consulta, $func){
	$i = 0;
	$tab = "";
	while( $row = mysqli_fetch_array($consulta, MYSQLI_NUM) ) 
	{
		$tab .=  "<tr valign = center>";
		$tab .=  "<td class=tabv><img src=img/sp.gif width=10 height=8></td>";
		for($j = 0; $j < $qtdeColunas; $j++){
			$tab .=  "<td class = tabv width = 180 height = 6>".htmlspecialchars($row[$j])."&nbsp;</td>"; 
		}		
		$tab .=  "<td class = tabv><button type = \"button\" onclick = \"deleta".$func."(".htmlspecialchars($row[$j]).")\">X</button></td>";
		$tab .=  "<td class = tabv></td>"; //exemplo de html gerado: "... onclick = deletaJogo(3)><X> ..."
		$tab .=  "</tr>";
		$i++;
	}
	$tab .=  "<p></p>";
	echo $tab;
}

function dbGetTable($tabela){
	$con = conectaDB();				
	$result  =  mysqli_query($con, "SELECT nome FROM ".$tabela);
	$retData  =  array();
	while( $row = mysqli_fetch_array($result, MYSQLI_NUM) ){
		$retData[] = $row[0];
	}
	echo json_encode($retData);
	$con->close();
}
