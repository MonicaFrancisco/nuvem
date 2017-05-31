function desenhaMessages(dados){
$("ul.chat li").remove();
	$.each( dados, function( key, value ) {
		var htmlTemplate1 = `
                           <li class="left clearfix"><span class="chat-img pull-left">
                            <img src="`+value.img_photo+`" alt="User Avatar" class="img-circle" />
                        </span>
                            <div class="chat-body clearfix">
                                <div class="header">
                                    <strong class="primary-font">`+value.username+`</strong> <small class="pull-right text-muted">
                                        <span class="glyphicon glyphicon-time"></span> `+value.date_time+`</small>
                                </div>
                                <p>`
                                   +value.msg+`
                                </p>
                            </div>`;

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
  desenharMessagesComAjax();
});