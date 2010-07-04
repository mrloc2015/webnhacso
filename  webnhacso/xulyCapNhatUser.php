<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
	session_start();
	include_once("DataProvider.php");
	if($_SESSION["IsAdmin"] == true)
	{
		if(isset($_REQUEST["btnCapNhatThongTin"]))
		{
			$userID = $_REQUEST["txtUserID"];
			
			$fullName = $_REQUEST["txthovaten"];
			$ngaysinh=$_REQUEST["txtnam"] . "-" . $_REQUEST["cmbthang"] . "-" . $_REQUEST["cmbngay"];
			$localID = $_REQUEST["cmblocation"];
			$email = $_REQUEST["txtemail"];
			
			$sql = "UPDATE user_info SET FullName='$fullName',Birthday='$ngaysinh',LocationID='$localID',Email='$email' WHERE UserID = '$userID'";
			DataProvider::ExecuteQuery($sql);
			
			$userName = $_REQUEST["txttendangnhap"];
			$pass = $_REQUEST["txtMatKhauMoi"];
			
			if($pass != "")
			{
				$pass = md5($_REQUEST["txtMatKhauMoi"]);
				$sql = "UPDATE user SET Pass='$pass' WHERE ID = '$userID'";
				DataProvider::ExecuteQuery($sql);
			}
			
			if($userName != "")
			{
				$sql = "UPDATE user SET UserName='$userName' WHERE ID = '$userID'";
				DataProvider::ExecuteQuery($sql);
			}
			
			echo("<script>alert('Đã cập nhật thông tin cho user!');</script>");
		}
	}
	else
	{
		echo("Hãy đăng nhập với quyền Admin.");
	}
?>
