
$(function(){
    $(".iconUrlButton").on('click',function(){
	//console.log($(this));
	userId=$(this).parent().prev().prev().prev().text();
	//userId=$(this).data("id");
	$.ajax(
		{"url":"/?action_userinfo=true&id="+userId+""}
	).done(
	    function(response,status,successObj){
		alert("icon url:\n"+data["icon_url"])
	    }
	).fail(
	    function(errorObj,msg,statusText){
		//console.log(errorObj,msg,statusText);
		alert("api access error:\n"+JSON.parse(errorObj["responseText"])["error"]);}
	)
    })
})
