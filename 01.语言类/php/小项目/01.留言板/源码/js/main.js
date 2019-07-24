var boardId = getUrlParam("board_id");
console.log("board_id>>:"+boardId);
var url = "http://www.myubuntu.com/index.php?s=/index/message/search&boardId="+boardId;
console.log(url);
//请求参数
var list = {};
//
$.ajax({
    //请求方式
    type : "GET",
    //请求的媒体类型
    contentType: "application/json;charset=UTF-8",
    //请求地址
    url : url,
    //数据，json字符串
    data : JSON.stringify(list),
    //请求成功
    success : function(result) {
        console.log(result);
        mainFunction(result);
    },
    //请求失败，包含具体的错误信息
    error : function(e){
        console.log(e.status);
        console.log(e.responseText);
    }
});

function mainFunction(jsonCode){
	var jsonObject= $.parseJSON(jsonCode);
	if(jsonObject.code == '0'){
//		var myarray = (array)jsonObject.data;
	}else {
		alert(jsonObject.data);
	}
}

function getUrlParam(name) {
	//构造一个含有目标参数的正则表达式对象
	var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)");
	//匹配目标参数
	var r = window.location.search.substr(1).match(reg);
	//返回参数值
	if(r != null) {
		return decodeURI(r[2]);
	}
	return null;
}