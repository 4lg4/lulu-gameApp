function ajaxCall(stringCall, callback){
	var httpRequest = new XMLHttpRequest;
    
	httpRequest.onreadystatechange = function(){
		if (httpRequest.readyState === 4) {
			if (httpRequest.status === 200) {
			  callback(httpRequest.responseText);
			}
		}
	};
	httpRequest.open('GET', stringCall);
	httpRequest.send();
}

// Service client to communicate with the backend
// var / let / const
const service = (()=> {
	const baseURL = 'backend/?action=';

	const ajaxCall = (stringCall, callback) => {
		const httpRequest = new XMLHttpRequest;
		
		httpRequest.onreadystatechange = function(){
			if (httpRequest.readyState === 4) {
				if (httpRequest.status === 200) {
				  callback(JSON.parse(httpRequest.responseText).data);
				}
			}
		};
		httpRequest.open('GET', stringCall);
		httpRequest.send();
	}

	const get = (action, params, callback)=> {
		return ajaxCall(`${baseURL}${action}`, callback);
	};

	const create = (action, params, callback)=> {
		return ajaxCall(`${baseURL}${action}`, callback);
	};

	const del = (action, params, callback)=> {
		return ajaxCall(`${baseURL}${action}`, callback);
	};

	return {get, create, del};
})();

function inicializa(){
	// service.get('users', null, inicializaSelecaoCidades);
	ajaxCall("games.php?action=recuperaCidades", inicializaSelecaoCidades);
	ajaxCall("games.php?action=recuperaFabricantes", inicializaSelecaoFabricantes);
	service.get('users', null, listaUsuarios);
	// ajaxCall("games.php?action=users", listaUsuarios);
	// service.get('games', null, listaJogos);
	service.get('games', null, listaJogos);
	ajaxCall("backend/old/?action=mostraJogos", listaJogos2);
	ajaxCall("games.php?action=mostraRemetente", listaRemetentes);
}

function insereUsuario(){	
	var i_use = document.getElementById('i_use').value;
	var i_nic = document.getElementById('i_nic').value;
	var i_ema = document.getElementById('i_ema').value;
	var i_ida = document.getElementById('i_ida').value;
	var i_cid = document.getElementById('listaCidades').value;
	//limpeza dos campos do form	
	document.getElementById('i_use').value = '';
	document.getElementById('i_nic').value = '';
	document.getElementById('i_ema').value = '';
	document.getElementById('i_ida').value = '';
	document.getElementById('listaCidades').value = 0;
	
	parms= "&usuario="+i_use+"&nick="+i_nic+"&email="+i_ema+"&idade="+i_ida+"&cidade="+i_cid;	
	ajaxCall("games.php?action=ins" + parms, listaUsuarios);
}
function insereJogo(){	
	var i_jog = document.getElementById('i_jog').value;
	var i_fab = document.getElementById('listaFabricantes').value;
	var i_pre = document.getElementById('i_pre').value;
	var i_cla = document.getElementById('i_cla').value;
	//limpeza dos campos do form
	document.getElementById('i_jog').value = '';
	document.getElementById('listaFabricantes').value = 0;
	document.getElementById('i_pre').value = '';
	document.getElementById('i_cla').value = '';
	
	parms= "&jogo="+i_jog+"&fab="+i_fab+"&preco="+i_pre+"&class="+i_cla;
	ajaxCall("games.php?action=insJogo" + parms, listaJogos);
}
function deletaUsuario(codUsuario){
		ajaxCall("games.php?action=del&id=" + codUsuario, listaUsuarios);
}
function deletaJogo(codJogo){
		ajaxCall("games.php?action=delJogo&id=" + codJogo, listaJogos);
}
function inicializaSelecao(lis, elemento){
	var x = document.getElementById(elemento);	
	var jsonData = JSON.parse(lis);

	for(i=0;i<jsonData.length;i++){
		var option = document.createElement("option");
		option.text = jsonData[i];
		option.value = i + 1;
		if (i==0) option.selected = true;
		x.add(option);
	}
}
function inicializaSelecaoCidades(lisCidades){  
  inicializaSelecao(lisCidades, "listaCidades");
}
function inicializaSelecaoFabricantes(lisFabricantes){  
  inicializaSelecao(lisFabricantes, "listaFabricantes");
}
function listaUsuarios(lisUsuarios){
	document.getElementById('tab_usuarios').innerHTML = lisUsuarios;
}

function listaJogos(games){
	console.log('BACKEND', games);
	const table = document.querySelector('#games tbody');

	games.map((r)=>{ r.push('actions'); return r;}).forEach(function(row, rowIndex) {
		const tr = document.createElement('tr');
		tr.vAlign = 'center';
	
		row.forEach(function(column, columnIndex) {
			const td = document.createElement('td');
			td.classList.add('tabv');

			if (column === 'actions') {
				const button = document.createElement('button');
				button.innerText = "X";
				button.addEventListener('click', ()=> alert(row[rowIndex][4]));
				tr.appendChild(button);
			} else {
				td.innerText = column;
			}

			tr.appendChild(td);
		});

		table.appendChild(tr);
	});

	

	// <tr valign="center">
	//     <td class="tabv"><img src="img/sp.gif" width="10" height="8"></td>
	//     <td class="tabv" width="180" height="6">Avadon&nbsp;</td>
	//     <td class="tabv"><button type="button" onclick="deletaJogo(EA)">X</button></td>
	//     <td class="tabv"></td>
	// </tr>
}

function listaJogos2(lisJogos){
	document.getElementById('tab_jogos2').innerHTML = lisJogos;
}

function inicializaSelecaoRemetentes(lisRemetentes){  
  inicializaSelecao(lisRemetentes, "listaRemetentes");
}

(function(){
	inicializa();
})();
