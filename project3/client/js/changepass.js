	
function desenharChangePass(resposta){

	$("div.alert").remove();

	if(resposta == "vazio"){
		 var htmlTemplate = `<div class="alert alert-danger"><strong>Erro!</strong> Os campos são obrigatórios.</div>`;
	}
	else if(resposta == "passwords_diferentes"){
		 var htmlTemplate = `<div class="alert alert-danger"><strong>Erro!</strong> As passwords são diferentes.</div>`;
	}
	else if(resposta == "password_errada"){
		var htmlTemplate = `<div class="alert alert-danger"><strong>Erro!</strong> A password antiga está errada.</div>`;
	}
	else if(resposta==false){
		var htmlTemplate = `<div class="alert alert-danger"><strong>Erro!</strong> Ocorreu um erro.</div>`;
	}
	else if(resposta==true){
		var htmlTemplate = `<div class="alert alert-success">A password foi alterada com sucesso</div>`;
	}

	$("div.message").append(htmlTemplate);
}