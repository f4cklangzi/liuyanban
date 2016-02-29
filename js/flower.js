window.onload = function () {
	code();
	//表单验证
	var fm=document.getElementsByTagName('form')[0];
	fm.onsubmit=function(){
		//能用客户端的尽量客户端
		//JS对于PHP课程来说，选学，不强制掌握
		//用户名验证
		if (fm.content.value.length>20 || fm.content.value.length<1) {
			alert('信息不得为空或大于20字符!');
			fm.content.focus();
			return false;
		};
		//验证码简单验证
		if (fm.code.value.length!=4) {
			alert('验证码格式不正确！');
			fm.code.value='';
			fm.code.focus();
			return false;
		};
		return true;
		
		};
}