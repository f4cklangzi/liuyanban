<?php
	header('Content-Type: text/html;charset=utf-8');
	/**
	*===================================================
	*Author:f4ck_langzi@foxmail.com
	*Date:2015年12月5日
	*===================================================
	**/
	@session_start();
	//验证码防外部调用
	$_SESSION['checkcode']='code';
	//定义一个常量用来调用includes里面的文件，防止恶意调用
	define('IN_TG',true);
	//定义一个常量指定本页CSS
	define('SCRIPT', 'reg');
	//引入公共文件
	include dirname(__FILE__).'/includes/common.inc.php';
    //连接数据库
    include ROOT_PATH.'/includes/conn.php';
	//判断是否提交了
	if (@$_POST['action']=='register' && $_system['register']==1) {
		//判断验证码是否正确,核心函数库
		if ($_system['code']==1){
			@_check_code($_POST['code'],$_SESSION['code']);
		}
		//引入验证文件
		require ROOT_PATH.'includes/check.func.php';
		//创建一个数组存放提交的安全数据
		$clean=array();
		//接受唯一标识符,用于验证信息和制作COOKIE
		$clean['uniqid']=@_check_uniqid($_POST['uniqid'],$_SESSION['uniqid']);
		//也是一个唯一标识符，用于刚注册用户的激活处理
		$clean['active']=@_sha1_uniqid();
		$clean['username']=_check_username($_POST['username'],2,20);                                           
		$clean['password']=@_check_password($_POST['password'],$_POST['notpassword'],6);
		$clean['question']=@_check_question($_POST['question'],2,20);
		$clean['answer']=@_check_answer($_POST['question'],$_POST['answer'],2,20);
		$clean['sex']=@_check_sex($_POST['sex']);
		$clean['face']=@_check_face($_POST['face']);
		$clean['email']=@_check_email($_POST['email'],6,40);
		$clean['qq']=@_check_qq($_POST['qq']);
		$clean['url']=@_check_url($_POST['url'],40);
		//判断用户名是否重复
		_is_repeat(
			"SELECT tg_username FROM tg_user WHERE tg_username='{$clean['username']}'LIMIT 1",
			'对不起,此用户名已存在！'
			);
		//新增用户,在双引号中，直接放变量是可以的，但如果是数组变量就必须加上{}
		_query(
					"INSERT INTO tg_user(
										tg_uniqid,
										tg_active,
										tg_username,
										tg_password,
										tg_question,
										tg_answer,
										tg_sex,
										tg_face,
										tg_email,
										tg_qq,
										tg_url,
										tg_reg_time,
										tg_last_time,
										tg_last_ip
										) 
								VALUES(
										'{$clean['uniqid']}',
										'{$clean['active']}',
										'{$clean['username']}',
										'{$clean['password']}',
										'{$clean['question']}',
										'{$clean['answer']}',
										'{$clean['sex']}',
										'{$clean['face']}',
										'{$clean['email']}',
										'{$clean['qq']}',
										'{$clean['url']}',
										now(),
										now(),
										'{$_SERVER["REMOTE_ADDR"]}'
										)"
					);
		if (_mysql_affected_rows()==1) {
			//获取新增ID
			$clean['id']=_insert_id();
			//关闭连接
			_close();
			//生成XML
			_set_xml('new.xml',$clean);
			//跳转
			_location('恭喜你，注册成功！','active.php?active='.$clean['active']);
		}else{
			_location('很遗憾，注册失败！','register.php');
		}
		
	}else{
		//创建唯一标识符，如果放到if上面的话，提交的时候又执行了一遍上面的语句，导致$_SESSION['uniqid']发生改变。
		$_SESSION['uniqid']=$_uniqid=_sha1_uniqid();
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $_system['webname'] ?>--注册</title>
<?php
	require ROOT_PATH.'includes/title.inc.php'
?>
<script type="text/javascript" src="js/code.js"></script>
<script type="text/javascript" src="js/register.js"></script>
</head>
<body>
<?php
	require ROOT_PATH.'includes/header.inc.php';
?>
<div id="register">
	<h2>会员注册</h2>
	<form action="register.php" name="register" method="post">
	<input type="hidden" name="action" value="register" />
	<input type="hidden" name="uniqid" value="<?php echo $_uniqid?>" />
        <?php
            if ($_system['register']!=1) {
                echo('<h3 style="text-align: center;font-weight: normal">管理员已经关闭注册功能！</h3>');
            }else{
        ?>
		<dl>
                    <dt>请认真填写以下内容</dt>
                    <dd><span>用 户 名：(必填，至少两位)</span><input type="text" name="username" class="text"/></dd>
                    <dd><span>密    码：(必填，至少六位)</span><input type="password" name="password" class="text"/></dd>
                    <dd><span>确认密码：(必填，同上)</span><input type="password" name="notpassword" class="text"/></dd>
                    <dd><span>密码提示：(必填，至少两位)</span><input type="text" name="question" class="text"/></dd>
                    <dd><span>密码回答：(必填，至少两位)</span><input type="text" name="answer" class="text"/></dd>
                    <dd><span>性    别：<input type="radio" name="sex" value="男" checked="checked"/>男<input type="radio"
                                                                                                         name="sex"
                                                                                                         value="女"/>女</span>
                    </dd>
                    <dd><input type="hidden" name="face" value="image/face/1.png" id="face"/><img src="image/face/1.png"
                                                                                                  alt="头像选择"
                                                                                                  id="faceimg"/></dd>
                    <dd><span>电子邮件：(必填，用于激活账户)</span><input type="text" name="email" class="text"/></dd>
                    <dd><span>Q      Q：</span><input type="text" name="qq" class="text"/></dd>
                    <dd><span>主页地址：</span><input type="text" name="url" class="text" value="http://"/></dd>
            <?php
				if ($_system['code']==1){
					echo '<dd class="code" ><span>验 证 码：<input type="text" name="code" class="text yzm"/><img id="code" src="code.php" alt="验证码" /></span></dd>';
				}
			?>
			<input type="submit" value="注册" class="submit" />
		</dl>
        <?php } ?>
	</form>
</div>
<?php
	require ROOT_PATH.'includes/footer.inc.php';
?>
</body>
</html>