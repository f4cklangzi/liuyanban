//等待网页加载完毕再执行
window.onload=function(){
	code();
	//表单验证
	var fm=document.getElementsByTagName('form')[0];
	fm.onsubmit=function(){
		//网站名验证
		if (fm.webname.value.length>20 || fm.webname.value=='') {
			alert('网站名称不得为空或者大于20字符!');
			fm.webname.value='凌云网络';
			fm.webname.focus();
			return false;
		};
		//非法字符验证
		if (fm.string.value!='') {
			if (fm.string.value.length>200) {
				alert('非法字符过滤不得超过200字符！');
				fm.string.focus();
				return false;
			};
		};
		//发帖间隔验证
		if (fm.post.value>500 || fm.post.value=='') {
			alert('发帖间隔不得为空或者大于500秒!');
			fm.post.value='300';
			fm.post.focus();
			return false;
		};
		//回帖间隔验证
		if (fm.re.value>200 || fm.re.value=='') {
			alert('回帖间隔不得为空或者大于200秒!');
			fm.re.value='30';
			fm.re.focus();
			return false;
		};
		//验证码简单验证
		if (fm.viry_code.value.length!=4) {
			alert('验证码格式不正确！');
			fm.viry_code.value='';
			fm.viry_code.focus();
			return false;
		};
	return true;	
	};
};
