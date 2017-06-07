function desenharFriends(dados){
$("ul#friends li").remove();
	$.each( dados, function( key, value ) {
		var htmlTemplate = `
                           <li class="left clearfix"><span class="chat-img pull-left">
                            <img src="`+value.img_photo+`" alt="User Avatar" class="img-circle" />
                        </span>
                        <div class="userlist-body clearfix">
                                <div class="header headername">
                                    <strong class="primary-font">`+value.username+`</strong>
                                </div>
                                <div class="buttonRight">
                                    <a href="profile.html" type="button"  class="btn btn-md btn-info"><span class="glyphicon glyphicon-option-horizontal"></span></a>
                                    <button type="button" class="btn btn-md btn-danger">
                                      <span class="glyphicon glyphicon-minus"></span>
                                    </button>
                                </div>
                            </div>
                        </li>`;

	
			$("ul#friends").append(htmlTemplate);

	});
}


$(function() {
  friendsComAjax(sessionStorage.getItem('token'));
});