function desenhaMensagens(){
	var dados = dadosTestes();
	$("ul.chat li").remove();

	$.each( dados, function( key, value ) {
		var htmlTemplate1 = `
                        <li class="left clearfix"><span class="chat-img pull-left">
                            <img src="`+value.imgProfile+`" alt="User Avatar" class="img-circle" />
                        </span>
                            <div class="chat-body clearfix">
                                <div class="header">
                                    <strong class="primary-font">`+value.name+`</strong> <small class="pull-right text-muted">
                                        <span class="glyphicon glyphicon-time"></span>`+value.date+` ago</small>
                                </div>
                                <p>
                                      `+value.msg+`
                                </p>
                            </div>`;

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

function dadosTestes(){
	dados = [
		{
			"id": 123432,
			"date" : "5 mins",
			"name" : "Monica Francisco",
			"msg" : "Olá, está tudo bem?",
			"imgProfile" : "img_photo/408.png",
			"imgMsg" : "",
		},
		{
			"id": 654345,
			"date" : "6 mins",
			"name" : "Ana Margarida Weber",
			"msg" : "Urghhhhhh!",
			"imgProfile" : "img_photo/492.jpg",
			"imgMsg" : "img_msg/r-msg32902.jpg",
		},		{
			"id": 54545,
			"date" : "9 mins",
			"name" : "Monica Francisco",
			"msg" : "fg sg d dtyrt rthdfggsg",
			"imgProfile" : "img_photo/408.png",
			"imgMsg" : "",
		},
		{
			"id": 75,
			"date" : "12 mins",
			"name" : "Monica Francisco",
			"msg" : "ffff",
			"imgProfile" : "img_photo/408.png",
			"imgMsg" : "",
		}
	];
	return dados;
}

$(function() {
  desenhaMensagens();
});