	
function desenharLogin(resposta){

	$("div.alert").remove();

	if(resposta==false){
		var htmlTemplate = `<div class="alert alert-danger"><strong>Erro!</strong> Autenticação inválida.</div>`;
	}
	else{
		var htmlTemplate = `<div class="alert alert-success">O registo foi efectuado com sucesso.</div>`;
		sessionStorage.setItem("token", resposta);
		window.location.href = '../client/index.html'; 
	}

	$("div.message").append(htmlTemplate);
}
