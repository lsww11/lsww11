<?php require_once('Connections/dlzc.php'); ?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "myform2")) {
  $insertSQL = sprintf("INSERT INTO dlxx (昵称, 账号, 密码, 邮箱, 年龄, 性别) VALUES (%s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['昵称'], "text"),
                       GetSQLValueString($_POST['账号'], "text"),
                       GetSQLValueString($_POST['密码'], "int"),
                       GetSQLValueString($_POST['邮箱'], "text"),
                       GetSQLValueString($_POST['年龄'], "text"),
                       GetSQLValueString($_POST['性别'], "text"));

  mysql_select_db($database_dlzc, $dlzc);
  $Result1 = mysql_query($insertSQL, $dlzc) or die(mysql_error());

  $insertGoTo = "注册成功.html";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}

mysql_select_db($database_dlzc, $dlzc);
$query_Recordset1 = "SELECT * FROM dlxx";
$Recordset1 = mysql_query($query_Recordset1, $dlzc) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);

$query_Recordset1 = "SELECT * FROM dlxx";
$Recordset1 = mysql_query($query_Recordset1, $dlzc) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>个人信息注册——忘忧君馆</title>
<link rel="icon" href="img/logo图标.png" sizes="64x64">
</head>
 <style>
 body{
	 background-image:url(images/6.png);
	 background-size:cover;
	 }
     #tp{
         width:450px;
         height:440px;
         background: linear-gradient(
    to bottom right,
    #0e92eb 0%,
    #5f90ec 50%,
    #b08fe5 100%
  );
		 margin:5% auto;
     }
	 .zcl{
		 max-width:225px;
		 margin:0 auto;
		 }
    </style>
<body>
<form action="<?php echo $editFormAction; ?>" id="myform2" name="myform2"  method="POST">
  <div id="tp">
  <body style="color:white"/>
  <fieldset>
  <legend><h1  align="center">个人信息注册</h1></legend>
  <hr align="center">
 
  <p>&nbsp;</p>
  <div class="zcl">
  <p align="justify">昵称：
    <label for="textfield"></label>
    <input type="text" name="昵称" id="昵称" placeholder="请输入昵称" required pattern="[\u4E00-\u9FA5A-Za-z0-9_]+">
  </p>
  <p align="justify">账号：
    <label for="textfield"></label>
    <input type="text" name="账号" id="账号" placeholder="手机号" required pattern="(13[0-9]|14[0-9]|15[0-9]|18[0-9]|19[0-9])\d{8}">
  </p>
  <p align="justify">密码：
    <input type="password" name="密码" id="密码" placeholder="全数字6位及以上的密码" required pattern="[0-9]\w{5,9}">
  </p>
  <p align="justify">邮箱：
    <input type="email" name="邮箱" id="邮箱" placeholder="邮箱" required pattern="\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*">
  </p>
  <p align="justify">年龄：
    <input type="text" name="年龄" id="年龄" placeholder="年龄" required pattern="[0-9]\d{1,1}">
    <br>
  </p>
  <p align="justify">性别：
    <input type="radio" name="性别" id="性别" value="男" required>
    <label for="radio3"></label>
    男
    <input type="radio" name="性别" id="性别" value="女" required>
    <label for="radio4"></label>
    女</p>
    </div>
  <p align="center">
    <input name="button" type="submit" id="button" style="width:60px;height:25px" value="注册">
  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a href="zc.php">取&nbsp;消</a></p>
  <input type="hidden" name="MM_insert" value="myform2">
</form>
</body>
</html>
<?php
mysql_free_result($Recordset1);
?>
