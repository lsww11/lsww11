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

mysql_select_db($database_dlzc, $dlzc);
$query_Recordset1 = "SELECT * FROM dlxx";
$Recordset1 = mysql_query($query_Recordset1, $dlzc) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
?>
<?php
// *** Validate request to login to this site.
if (!isset($_SESSION)) {
  session_start();
}

$loginFormAction = $_SERVER['PHP_SELF'];
if (isset($_GET['accesscheck'])) {
  $_SESSION['PrevUrl'] = $_GET['accesscheck'];
}

if (isset($_POST['账号'])) {
  $loginUsername=$_POST['账号'];
  $password=$_POST['密码'];
  $MM_fldUserAuthorization = "";
  $MM_redirectLoginSuccess = "dlcg.html";
  $MM_redirectLoginFailed = "dlsb.html";
  $MM_redirecttoReferrer = false;
  mysql_select_db($database_dlzc, $dlzc);
  
  $LoginRS__query=sprintf("SELECT `账号`, `密码` FROM dlxx WHERE `账号`=%s AND `密码`=%s",
    GetSQLValueString($loginUsername, "-1"), GetSQLValueString($password, "-1")); 
   
  $LoginRS = mysql_query($LoginRS__query, $dlzc) or die(mysql_error());
  $loginFoundUser = mysql_num_rows($LoginRS);
  if ($loginFoundUser) {
     $loginStrGroup = "";
    
	if (PHP_VERSION >= 5.1) {session_regenerate_id(true);} else {session_regenerate_id();}
    //declare two session variables and assign them
    $_SESSION['MM_Username'] = $loginUsername;
    $_SESSION['MM_UserGroup'] = $loginStrGroup;	      

    if (isset($_SESSION['PrevUrl']) && false) {
      $MM_redirectLoginSuccess = $_SESSION['PrevUrl'];	
    }
    header("Location: " . $MM_redirectLoginSuccess );
  }
  else {
    header("Location: ". $MM_redirectLoginFailed );
  }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>登录界面</title>
    <link rel="icon" href="img/logo图标.png" sizes="64x64">
<style type="text/css">
	 body{
	 background-image:url(images/6.png);
	 background-size:cover;
	 }
		
        .bordered {
            border-style:solid;
            width:448px;
         height:348px;
        }
   #bg{
        width:450px;
         height:350px;
       background: linear-gradient(
    to bottom right,
    #0e92eb 0%,
    #5f90ec 50%,
    #b08fe5 100%
  );
	  margin:10% auto;
     
   }

	  
    </style>
<script type="text/javascript">
function MM_goToURL() { //v3.0
  var i, args=MM_goToURL.arguments; document.MM_returnValue = false;
  for (i=0; i<(args.length-1); i+=2) eval(args[i]+".location='"+args[i+1]+"'");
}
</script>
</head>
 
<body>
    <body align="center">
    <body style="color:black"/>
    <div id="bg">
    <div class="bordered"  >
    <form ACTION="<?php echo $loginFormAction; ?>" id="myform2" name="myform2"  method="POST">
    <fieldset>
        <legend><h1 align="center" >登录界面</h1></legend>
        <p align="center">账号：
          <label for="textfield"></label>
          <input type="text" name="账号" id="账号" required >
        </p>
        <p align="center">&nbsp;</p>
        <p align="center">密码：
          <label for="textfield2"></label>
          <input type="password" name="密码" id="密码" required >
        </p>
        <p align="center">&nbsp;</p>
        <p align="center">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          <input name="button" type="submit" id="button" style="width:60px;height:25px" value="登录">
          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input name="button2" type="submit" id="button2" style="width:60px;height:25px" onClick="MM_goToURL('parent','zc.php');return document.MM_returnValue" value="注册">
        </p>
        <p>&nbsp;</p>

     
    </fieldset>
    </form>
    </div>
    </div>
</body>
</html>
<?php
mysql_free_result($Recordset1);
?>
