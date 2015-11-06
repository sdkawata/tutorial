Uploader.config={
endpoint:"s3-ap-northeast-1.amazonaws.com",
bucket:"kawata.8122.jp",
acl:"public-read",
prefix:"",
meta:{}
}
window.onload=function(){
document.getElementById('files').addEventListener('change',
	function(event){
		var files=event.target.files;
		Uploader.uploadFiles(files);
	}
	,false);
Uploader.log('waiting for upload.');
}
