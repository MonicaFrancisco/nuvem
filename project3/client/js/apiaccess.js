var urlBase = "http://localhost/nuvem/project3/";

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
       //console.log(username, name, password, password2, resposta);
       desenharValidacoes(username, name, password, password2, resposta);
    }).fail(function() {
    }).always(function() {
    });
}

function loginComAjax(username, password){
    $.ajax({
      method: "POST",
      url: urlBase + "login.php",
      data: {"username": username, "password": password}
    }).done(function( resposta ) {
       console.log(username, password, resposta);
       desenharLogin(resposta);
    }).fail(function() {
    }).always(function() {
    });
}

function userFromTokenAjax(token){
    $.ajax({
      method: "GET",
      url: urlBase + "userInfFromToken.php",
      data: {"token": token}
    }).done(function( resposta ) {
      $("span.user").append(resposta);

    }).fail(function() {
    }).always(function() {
    });
}

function desenharUserInfo(token){
   $.ajax({
      method: "POST",
      url: urlBase + "userInfo.php",
      data: {"token": token}
    }).done(function( resposta ) {
      document.getElementById('username').value = resposta.username;
      document.getElementById('name').value = resposta.name;
      document.getElementById('img').src= resposta.img_photo;
    }).fail(function() {
    }).always(function() {
    });
}

function alterarUserComAjax(token, user, name, img){
  $.ajax({
      method: "POST",
      url: urlBase + "alteraruser.php",
      data: {"token": token, "user": user, "name": name, "img": img}
    }).done(function( resposta ) {
       //document.getElementById('img').value = resposta.img_photo;
    }).fail(function() {
    }).always(function() {
    });
}

function alterarPassComAjax(token, oldpass, newpass, repeatnew){
  $.ajax({
      method: "POST",
      url: urlBase + "alterarpass.php",
      data: {"token": token, "old": oldpass, "new": newpass, "repeatnew": repeatnew}
    }).done(function( resposta ) {
      desenharChangePass(resposta);
    }).fail(function() {
    }).always(function() {
    });
}

function inserirMessageComAjax(token, msg){
  $.ajax({
      method: "POST",
      url: urlBase + "insertmessage.php",
      data: {"token": token, "msg": msg}
    }).done(function( resposta ) {
    }).fail(function() {
    }).always(function() {
    });
}

function messagesUserComAjax(token){
  $.ajax({
      method: "GET",
      url: urlBase + "messagesuser.php",
      data: {"token": token}
    }).done(function( resposta ) {
      console.log("teste");
      console.log(resposta);
      desenharMessagesUser(resposta);
    }).fail(function() {
    }).always(function() {
    });
}

function friendsComAjax(token){
  $.ajax({
      method: "GET",
      url: urlBase + "friends.php",
      data: {"token": token}
    }).done(function( resposta ) {
      console.log(resposta);

      desenharFriends(resposta);
    }).fail(function() {
    }).always(function() {
    });
}


function addReqfriendsComAjax(token,id){
  $.ajax({
      method: "POST",
      url: urlBase + "addRequest.php",
      data: {"token": token , "id": id}
    }).done(function( resposta ) {
    }).fail(function() {
    }).always(function() {
    });
}


function logout(){
  sessionStorage.clear();
  window.location.href = '../client/index.html'; 
}

function verificarLogin(){
  if (sessionStorage.getItem("token") != null) {
     window.location.href = '../client/messageboard.html'; 
  }
  else{
     window.location.href = '../client/login.html'; 
  }
}


