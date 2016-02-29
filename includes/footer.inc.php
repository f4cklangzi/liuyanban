<?php
/**
*===================================================
*Author:f4ck_langzi@foxmail.com
*Date:2015年12月5日
*===================================================
**/
//防止恶意调用
if (!defined('IN_TG')) {
	die('Access Defined!');
}
@_close();
?>
<div id="footer">
	<p>本程序执行耗时为<?php echo round(_runtime()-START_TIME,4)?>秒</p>
	<p>版权所有 翻版必究</p>
	<p>本程序由凌云网络提供技术支持(C)</p>
</div>