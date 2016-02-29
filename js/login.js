//等待网页加载完毕再执行
window.onload=function(){
	code();
	//登录表单验证
	var fm=document.getElementsByTagName('form')[0];
	fm.onsubmit=function(){
		//用户名验证
		if (fm.username.value.length<2 || fm.username.value.length>20) {
			alert('用户名不得小于2位或者大于20位!');
			fm.username.value='';
			fm.username.focus();
			return false;
		};
		if (/[<>\'\"\ \ ]/.test(fm.username.value)) {
			alert('用户名不得包含非法字符！');
			fm.username.value='';
			fm.username.focus();
			return false;
		};
		//密码验证
		if (fm.password.value.length<6) {
			alert('密码不得小于6位!');
			fm.password.value='';
			fm.password.focus();
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
};