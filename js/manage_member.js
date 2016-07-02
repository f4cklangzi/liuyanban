window.onload=function(){
	var del=document.getElementsByName('del');
	//确认删除
	for (var i = 0; i < del.length; i++) {
		del[i].onclick=function(){
			if (confirm('确认要删除？')) {
				return true;
			}else{
				return false;
			};
		};
	};
};