
function makeButton(){
    $(".deleteButton").on('click',function(){
	//console.log($(this));
	userId=$(this).parent().parent().children(".userId").text();
	$.ajax(
		{"url":"/?action_deletejson=true&id="+userId+""}
	).done(
	    function(response,status,successObj){
		$("#userList tr").remove();
		for(user in response["users"]){
		    $("#userList").append(
			"<tr>"+
			    "<td class=\"userId\">"+user["id"]+"</td>"+
			    "<td>"+user["passwd"]+"</td>"+
			    "<td><input type=\"button\" class=\"deleteButton\" value=\"DELETE!\"></td>"+
			    "<td><input type=\"button\" class=\"iconUrlButton\" value=\"show icon url\"></td>"+
			    "</tr>"
			    
			    
		    )
		}
		alert("delete success");
	    }
	).fail(
	    function(errorObj,msg,statusText){
		//console.log(errorObj,msg,statusText);
		alert("api access error:\n"+JSON.parse(errorObj["responseText"])["error"]);}
	)
    })
    $(".iconUrlButton").on('click',function(){
	//console.log($(this));
	userId=$(this).parent().parent().children(".userId").text();
	//userId=$(this).data("id");
	$.ajax(
		{"url":"/?action_userinfo=true&id="+userId+""}
	).done(
	    function(response,status,successObj){
		alert("icon url:\n"+response["icon_url"])
	    }
	).fail(
	    function(errorObj,msg,statusText){
		//console.log(errorObj,msg,statusText);
		alert("api access error:\n"+JSON.parse(errorObj["responseText"])["error"]);}
	)
    })
}
$(function(){
    makeButton();
})
