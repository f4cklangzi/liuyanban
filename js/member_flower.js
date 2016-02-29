window.onload=function(){
	var all=document.getElementById('all');
	var fm=document.getElementsByTagName('form')[0];
	all.onclick=function(){
		//form.elements.length获取表单内所有表单
		for (var i = 0; i <fm.elements.length; i++) {
			if (fm.elements[i].name!=='chkall') {
				fm.elements[i].checked=fm.chkall.checked;
			};
		};
	}
	//确认删除
	fm.onsubmit=function(){
		for (var i = 0; i <fm.elements.length; i++) {
			if (fm.elements[i].name!=='chkall') {
				if (fm.elements[i].checked) {
					break;	
				}else{
					if (i==fm.elements.length-1) {
						alert('至少选择一条记录！');
						return false;
					};
				};
			};
		};
		if (confirm('确认要删除？')) {
			return true;
		}else{
			return false;
		};
	};
};