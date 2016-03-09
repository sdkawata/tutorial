
function showIconUrl(id){
jQuery.ajax(
	{"url":"/?action_userinfo=true&id="+id+"",
	 "success":function(data,dataType){
		alert("icon url:\n"+data["icon_url"])
	 }}
	 )
}
