	
function desenharValidacoes(username, name, password, password2, resposta){

	$("div.alert").remove();

	if(username == "" || name == "" || password == "" || password2 == ""){
		 var htmlTemplate = `<div class="alert alert-danger"><strong>Erro!</strong> Os campos são obrigatórios.</div>`;
	}
	else if(password != password2){
		 var htmlTemplate = `<div class="alert alert-danger"><strong>Erro!</strong> As passwords são diferentes.</div>`;
	}
	else if(resposta==false){
		var htmlTemplate = `<div class="alert alert-danger"><strong>Erro!</strong> Ocorreu um erro.</div>`;
	}
	else if(resposta==true){
		var htmlTemplate = `<div class="alert alert-success">O registo foi efectuado com sucesso</div>`;
	}

	$("div.message").append(htmlTemplate);
}