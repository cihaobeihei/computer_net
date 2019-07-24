$("#btn").click(function(){
	var username = $("#username").val();
	var passwd = $("#pass").val();
	console.log(username);
	console.log(passwd);
	
    var my_url = 'http://www.myubuntu.com/index.php?s=/index/user/login&username='+username+'&password='+passwd;
    
    $.ajax({
        url : my_url,
        type : "get",
        dataType : "json",
        cache : false,
        async : false,
        success : function(data, textStatus, jqXHR) {
            if ('success' == textStatus) {
            	var jsondata = $.parseJSON(data);
//                debugger;
                if(0 == jsondata.code){
                	console.log(jsondata);
                	$.cookie('userId', jsondata.data.id);
                	$.cookie('boardId', jsondata.data.board_id);
                	$.cookie('role', jsondata.role);
                	$.cookie('username', jsondata.data.username);
                	$(location).attr("href","http://www.myubuntu.com/mainBody.html");
                }
            }
        },
        error : function(XMLHttpRequest, textStatus, errorThrown) {
            layer.msg("textStatus = " + textStatus + ", XMLHttpRequest.status = " + XMLHttpRequest.status + ", XMLHttpRequest.readyState = " + XMLHttpRequest.readyState);
        }
    });
    
});