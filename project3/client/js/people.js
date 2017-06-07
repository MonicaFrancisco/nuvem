function desenharPeople(dados){
 $("ul.chat li").remove();

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
                                    <button type="button" id="`+value.userid+`"  onclick="addfriendAjax(sessionStorage.getItem('token'),this.id)" class="btn btn-md btn-success">
                                      <span class="glyphicon glyphicon-plus"></span>
                                    </button>
                                </div>
                            </div>
                        </li><script src="js/apiaccess.js"></script> `;

			$("ul.chat").append(htmlTemplate);
	
	});

}


$(function() {
  desenharPeopleComAjax();

});