/*function desenharPerfil(){
var dados = fakeMensagens();

var dadosUsers = fakeUsers();

$("ul.chat li").remove();
$("div.content-subheader-2.row").remove();

$.each( dadosUsers, function( key, value ) {
    var htmldadosIniciais = `  <div class="content-subheader-2 row">
                <div class=" userinfoheader">
                <img src="`+value.imgProfile+`" alt="User Avatar" class="img-circle" />   
                <h1>`+value.name+`</h1>
                </div>`;
	});
  $("div.content-subheader-2.row").append(htmldadosIniciais);


$.each( dados, function( key, value ) {
		var htmlTemplate1 = `
                             <li class="left clearfix">
                            <div class="chat-body clearfix">
                                <div class="header">
                                    <strong class="primary-font">&nbsp;</strong> <small class="pull-right text-muted">
                                        <span class="glyphicon glyphicon-time"></span>`+value.date+`</small>
                                </div>
                                <p>
                                      `+value.msg+`
                                </p>
                            </div>
                        `;

        var htmlTemplate2 = `<div class="chat-msgimg">
                              <a href="original_image.html"><img src="`+value.imgMsg+`" alt="Image associated to message number 32467"></a>
                            </div>`;


		var htmlTemplate3 = "</li>";

     
		if (value.imgMsg==""){
			$("ul.chat").append(htmlTemplate1+htmlTemplate3);
		} else {
			$("ul.chat").append(htmlTemplate1+htmlTemplate2+htmlTemplate3);
		}	
	});


}

$(function() {
  desenharPerfil();
});*/