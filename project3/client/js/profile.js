function desenharMessagesUser(dados){
$("ul.chat li").remove();
$("div.content-subheader-2.row").remove();

    var htmldadosIniciais = `  <div class="content-subheader-2 row">
                <div class=" userinfoheader">
                <img src="`+dados.image_photo+`" alt="User Avatar" class="img-circle" />   
                <h1></h1>
                </div>`;

  $("div.content-subheader-2.row").append(htmldadosIniciais);


$.each( dados, function( key, value ) {
		var htmlTemplate1 = `
                             <li class="left clearfix">
                            <div class="chat-body clearfix">
                                <div class="header">
                                    <strong class="primary-font">&nbsp;</strong> <small class="pull-right text-muted">
                                        <span class="glyphicon glyphicon-time"></span>`+value.data_time+`</small>
                                </div>
                                <p>
                                      `+value.msg+`
                                </p>
                            </div>
                        `;

    var htmlTemplate2 = `<div class="chat-msgimg">
                              <a href="original_image.html"><img src="`+value.img+`" alt="Image associated to message number 32467"></a>
                            </div>`;


		var htmlTemplate3 = "</li>";

     
		if (value.img==""){
			$("ul.chat").append(htmlTemplate1+htmlTemplate3);
		} else {
			$("ul.chat").append(htmlTemplate1+htmlTemplate2+htmlTemplate3);
		}	
	});


}

$(function() {
   messagesUserComAjax(sessionStorage.getItem('token'));
});