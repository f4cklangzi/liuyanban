window.onload = function () {
	var ubb=document.getElementById('ubb');
	var reclick=document.getElementsByName('reclick');
	if(ubb){
		code();
		var ubbimg=ubb.getElementsByTagName('img');
		var fm=document.getElementsByTagName('form')[0];
		var font=document.getElementById('font');
		var html=document.getElementsByTagName('html')[0];
		var color=document.getElementById('color');
		html.onmouseup=function(){
			font.style.display='none';
			color.style.display='none';
		}
		function content(string){
			fm.content.value += string;
			fm.content.focus();
		}
		//UBB代码
		ubbimg[0].onclick=function(){
			font.style.display='block';
		}
		ubbimg[2].onclick=function(){
			content('[b][/b]');
		}
		ubbimg[3].onclick=function(){
			content('[i][/i]');
		}
		ubbimg[4].onclick=function(){
			content('[u][/u]');
		}
		ubbimg[5].onclick=function(){
			content('[s][/s]');
		}
		ubbimg[7].onclick=function(){
			color.style.display='block';
			fm.t.focus();
		}
		fm.t.onmouseup=function(){
			showcolor(this.value);
		}
		ubbimg[8].onclick=function(){
			var url=prompt('请输入网址：','http://');
			if (url) {
				if (/^((http|ftp|https):\/\/)?[\w\-_]+(\.[\w\-_\/]+)+/.test(url)) {
					content('[url]'+url+'[/url]');
				}else{
					alert('网址格式不正确！');
				};	
			}
		}
		ubbimg[9].onclick=function(){
			var email=prompt('请输入邮件地址：','@');
			if (email) {
				if (/^[\w\-\.]+@[\w-.]+(\.\w+)+$/.test(email)) {
					content('[email]'+email+'[/email]');
				}else{
					alert('邮件地址格式不正确！');
				};	
			}
		}
		ubbimg[10].onclick=function(){
			var img=prompt('请输入图片地址：','');
			if (img) {
				content('[img]'+img+'[/img]');
			};	
		}
		ubbimg[11].onclick=function(){
			var flash=prompt('请输入flash地址：','http://');
			if (flash) {
				if (/^((http|ftp|https):\/\/)?[\w\-_]+(\.[\w\-_\/]+)+/.test(flash)) {
					content('[flash]'+flash+'[/flash]');
				}else{
					alert('flash地址格式不正确！');
				};	
			}
		}
		ubbimg[12].onclick=function(){
			var movie=prompt('请输入视频地址：','http://');
			if (movie) {
				if (/^((http|ftp|https):\/\/)?[\w\-_]+(\.[\w\-_\/]+)+$/.test(movie)) {
					content('[movie]'+movie+'[/movie]');
				}else{
					alert('视频地址格式不正确！');
				};	
			}
		}
		ubbimg[18].onclick=function(){
			fm.content.rows += 2;
		}
		ubbimg[19].onclick=function(){
			fm.content.rows -= 2;
		}
		fm.onsubmit=function(){
		//标题验证
		if (fm.title.value.length>40 || fm.title.value.length<1) {
			alert('标题不得为空或大于20字符!');
			fm.title.focus();
			return false;
		};
		//内容验证
		if (fm.content.value.length>200 || fm.content.value.length<1) {
			alert('内容不得为空或大于200字符!');
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
	};
	for (var i = 0; i < reclick.length; i++) {
			reclick[i].onclick=function (){
			if (document.getElementsByTagName('form')[0]==null) {
				alert('请先登录！');
				location.href='login.php';
			}else{
				document.getElementsByTagName('form')[0].title.value=this.title;
			}
		}
	};
}
//选择字体大小
function font(size){
	document.getElementsByTagName('form')[0].content.value += '[size='+size+'][/size]';
}
//选择字体颜色
function showcolor(color){
	document.getElementsByTagName('form')[0].content.value += '[color='+color+'][/color]';
}
