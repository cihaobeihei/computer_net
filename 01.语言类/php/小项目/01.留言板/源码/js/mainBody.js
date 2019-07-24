$("#title").html("Hello "+$.cookie("username"));
$("#btn_search").click(function(){
	var boardId = $("#boardId").val();
	search(boardId);
	$.cookie("curentBoardId",boardId);
});
$("#btn_del").click(function(){
	var messageId = $("#del_message").val();
	var my_url = "http://www.myubuntu.com/index.php?s=/index/message/del&messageId="+messageId;
	$.ajax({
        url : my_url,
        type : "get",
        dataType : "json",
        cache : false,
        async : false,
        success : function(data, textStatus, jqXHR) {
            if ('success' == textStatus) {
            	var jsondata = $.parseJSON(data);
                 console.log(jsondata);
                if(0 == jsondata.code){
                	search($.cookie("curentBoardId"));
                }
            }
        },
        error : function(XMLHttpRequest, textStatus, errorThrown) {
            layer.msg("textStatus = " + textStatus + ", XMLHttpRequest.status = " + XMLHttpRequest.status + ", XMLHttpRequest.readyState = " + XMLHttpRequest.readyState);
        }
    });
});
$("#btn_add").click(function(){
	var message = $("#message").val();
	var my_url = "http://www.myubuntu.com/index.php?s=/index/message/add&boardId="+$.cookie("curentBoardId")+"&content="+message;
    $.ajax({
        url : my_url,
        type : "get",
        dataType : "json",
        cache : false,
        async : false,
        success : function(data, textStatus, jqXHR) {
            if ('success' == textStatus) {
            	var jsondata = $.parseJSON(data);
                 console.log(jsondata);
                if(0 == jsondata.code){
                	search($.cookie("curentBoardId"));
                }
            }
        },
        error : function(XMLHttpRequest, textStatus, errorThrown) {
            layer.msg("textStatus = " + textStatus + ", XMLHttpRequest.status = " + XMLHttpRequest.status + ", XMLHttpRequest.readyState = " + XMLHttpRequest.readyState);
        }
    });
});
function search(boardId){
	$("#message_table").empty();
	$("#message_table").append("<tr><td>用户ID</td><td>内容</td><td>messageId</td></tr>");
	var my_url = "http://www.myubuntu.com/index.php?s=/index/message/search&boardId="+boardId;
    $.ajax({
        url : my_url,
        type : "get",
        dataType : "json",
        cache : false,
        async : false,
        success : function(data, textStatus, jqXHR) {
            if ('success' == textStatus) {
            	var jsondata = $.parseJSON(data);
//            	debugger;
                if(0 == jsondata.code){
                	console.log(my_url);
                	console.log(jsondata);
                	
                	for(i=0;i<jsondata.data.length;i++){
                		$("#message_table").append("<tr><td>"+jsondata.data[i].user_id+"</td><td>"+jsondata.data[i].content+"</td><td>"+jsondata.data[i].id+"</td></tr>");
                	}
                }
            }
        },
        error : function(XMLHttpRequest, textStatus, errorThrown) {
            layer.msg("textStatus = " + textStatus + ", XMLHttpRequest.status = " + XMLHttpRequest.status + ", XMLHttpRequest.readyState = " + XMLHttpRequest.readyState);
        }
    });
}


search($.cookie("boardId"));
$.cookie("curentBoardId",$.cookie("boardId"));