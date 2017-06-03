var urlBase = "http://localhost/project3/";

function desenharPeopleComAjax(){
    $.ajax({
      method: "GET",
      url: urlBase + "users.php",
    }).done(function( dados ) {
        console.log(dados);
        desenharPeople(dados);
    }).fail(function() {
        //
    }).always(function() {
        //
    });
 
}

//envia dados de pesquisa para o servidor 
function pesquisaPeopleComAjax(substring_name){
    $.ajax({
      method: "GET",
      url: urlBase + "users.php",
      data: { "name": substring_name}
    }).done(function( dados ) {
        desenharPeople(dados);
        console.log(dados);
    }).fail(function() {
        //
    }).always(function() {
        //
    });
 
}

function pesquisaPeople() {
  substring_name = document.getElementById("username").value; 
  pesquisaPeopleComAjax(substring_name);

}


function desenharMessagesComAjax(){
    $.ajax({
      method: "GET",
      url: urlBase + "messages.php",
    }).done(function( dados ) {
        console.log(dados);
        desenhaMessages(dados);
    }).fail(function() {
    }).always(function() {
    });
 
}


//envia dados de pesquisa para o servidor 
function pesquisaMessagesComAjax(substring_name, substring_msg){
    $.ajax({
      method: "GET",
      url: urlBase + "messages.php",
      data: { "username": substring_name , "msg": substring_msg}
    }).done(function( dados ) {
        desenhaMessages(dados);
        console.log(substring_name,substring_msg);
        console.log(dados);
    }).fail(function() {
        //
    }).always(function() {
        //
    });
 
}

//esta e a que se chamou no btn
function pesquisaMessages() {
  substring_name = document.getElementById("username").value; 
  substring_msg = document.getElementById("msgtext").value; 
  pesquisaMessagesComAjax(substring_name,substring_msg);

}


function registoComAjax(username, name, password, password2){
    $.ajax({
      method: "POST",
      url: urlBase + "register.php",
      data: {"username": username, "name": name, "password" : password, "password2": password2}
    }).done(function( resposta ) {
      console.log(username, name, password, password2, resposta);
       desenharValidacoes(username, name, password, password2, resposta);
    }).fail(function() {
    }).always(function() {
    });
 
}

