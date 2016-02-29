window.onload=function(){
	var ret=document.getElementById('return');
	var del=document.getElementById('delete');
	ret.onclick=function(){
		// history.back();
		window.location.href="member_message.php"
	}
	del.onclick=function(){
		if (confirm('确定删除此条短信？')) {
			window.location.href="?action=delete&id="+this.name;
		};
	}
};