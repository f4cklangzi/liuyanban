window.onload=function () {
	var fm=document.getElementsByTagName('form')[0];
	var pass=document.getElementById('pass');
	var up=document.getElementById('up');
	fm[1].onclick=function(){
		pass.style.display='none';
	}
	fm[2].onclick=function(){
		pass.style.display='block';
	}
	fm.onsubmit=function(){
		if (fm.name.value.length<2 || fm.name.value.length>20) {
			alert('图片名不得小于2位或者大于20位!');
			fm.name.value='';
			fm.name.focus();
			return false;
		};
			if (fm.url.value.length=='') {
			alert('图片地址不得为空!');
			fm.url.value='';
			fm.url.focus();
			return false;
			};
		if (fm.content.value.length>200) {
			alert('图片描述不得大于200位!');
			fm.content.focus();
			return false;
		};
	return true;
	}
	up.onclick=function(){
		centerwindow('upimg.php?dir='+this.title,'上传','200','400');
	}
	function centerwindow (url,title,height,width) {
	var top=(screen.height-height)/2;
	var left=(screen.width-width)/2;
	window.open(url,title,'height='+height+',width='+width+'top='+top+',left='+left);
}
}