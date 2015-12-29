<?php
	require_once dirname(__File__).'/../common/commonFunc.php';
	
	session_start();
	$path = "app/pages/";
	$userId = $_GET['userId'];
	
	$conn = createConn(); // 创建数据库连接
	// 查询角色为系统管理员的用户
	$listRs = mysql_query("select u.user_id from user_role_relation urr join user u on urr.user_id = u.user_id where urr.role_id = 1");
	$adminList = array();
	while($admin = mysql_fetch_array($listRs)){
		$adminList[] = $admin['user_id'];
	}
	
	$rs = mysql_query("select * from user where user_id = '$userId'");
	$user = mysql_fetch_assoc($rs);
	$listRs = mysql_query("select role_id from user_role_relation where user_id = '$userId'"); // 查询用户拥有的所有角色
	$roleList = array();
	while($row = mysql_fetch_array($listRs)){
		$roleList[] = $row['role_id'];
	}
?>

<link href="css/page.css" rel="stylesheet" type="text/css" media="screen"/> 

<h2 class="contentTitle" align="center">编辑用户信息</h2>

<div class="pageContent" align="right">
	<form method="post" action="<?php echo $path;?>updateUser&userId=<?php echo $userId;?>" class="pageForm required-validate" onsubmit="return validateCallback(this,navTabAjaxDone)">
		<div class="pageFormContent nowrap" layoutH="97">
			<dl>
				<dt>用户ID：</dt>
				<dd>
					<span class="text"><?php echo $user['user_id'];?></span>
				</dd>
			</dl>
			<dl>
				<dt>姓名：</dt>
				<dd>
					<span class="text"><?php echo $user['user_name'];?></span>
				</dd>
			</dl>
			<dl>
				<dt>性别：</dt>
				<dd><span class="text"><?php echo $user['gender']=="M"?"男":"女";?></span></dd>
			</dl>
			<dl>
				<dt>选择角色：</dt>
				<dd>
					<div class="floatLeft">
						<?php
							$roleRs = mysql_query("select * from role order by role_id");
							while ($role = mysql_fetch_array($roleRs)) {
								if ($role['role_id']==1 && in_array($_SESSION['userId'], $adminList)) {
									// 当前角色为系统管理员 && 目前登录用户为系统管理员
									if (in_array($role['role_id'], $roleList)) {
										echo "<input type='checkbox' name='roleList[]' value='" . $role['role_id'] . "' checked/><span>" . $role['role_name'] . "</span>";
									} else {
										echo "<input type='checkbox' name='roleList[]' value='" . $role['role_id'] . "'/><span>" . $role['role_name'] . "</span>";
									}
								} else { // 除系统管理员外的其他角色
									if (in_array($role['role_id'],$roleList)) {
										echo "<input type='checkbox' name='roleList[]' value='" . $role['role_id'] . "' checked/><span>" . $role['role_name'] . "</span>";
									} else {
										echo "<input type='checkbox' name='roleList[]' value='" . $role['role_id'] . "'/><span>" . $role['role_name'] . "</span>";
									}
								}
							}
							mysql_close($conn);
						?>
					</div>
					<div><span class="info">请为其授予角色（至少选一个）</span></div>
				</dd>
			</dl>
			</div>
		<div class="formBar">
			<ul>
				<li><div class="buttonActive"><div class="buttonContent"><button type="submit">修改</button></div></div></li>
				<li><div class="buttonActive"><div class="buttonContent"><button type="reset">重置</button></div></div></li>
				<li><div class="button"><div class="buttonContent"><button type="button" class="close">返回</button></div></div></li>
			</ul>
		</div>
		
	</form>
	
</div>


