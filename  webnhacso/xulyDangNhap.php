<html>
<head>
<meta http-equiv="refresh" content="3;url=http://localhost/webnhacso/TrangChu.php">
</head>
</html>
<?php	
	session_start();			
	include_once("DataProvider.php");	
	if(isset($_REQUEST["btnDangNhap"])) 					   
	{		
		$UserName=$_REQUEST["txtTenDangNhap"];
		$PassWord=$_REQUEST["txtMatKhau"];		
		if(trim($UserName)=="")
		{
			?>
			<script type="text/javascript" language="javascript">
        	alert("Vui lòng nhập UserName!");			
			window.history.go(-1);
        	</script>
            <?php			
		}
		else
		{
			if(trim($PassWord)=="")
			{
				?>
				<script type="text/javascript" language="javascript">
                alert("Chưa nhập PassWord");			
                window.history.go(-1);
                </script>
                <?php				
			}
			else
			{
				$User=DataProvider::ExecuteQuery("Select * from user where UserName='$UserName' ");
				$Row = mysql_fetch_array($User);
				if($Row!=null)
				{
					if($PassWord!=$Row["Pass"])
					{
						?>
						<script type="text/javascript" language="javascript">
                        alert("Sai PassWord!");			
                        window.history.go(-1);
                        </script>
                        <?php						
					}
					else
					{
						$_SESSION["UserName"]=$Row["UserName"];
						$_SESSION["Pass"]=$Row["Pass"];
						$_SESSION["IsLogin"]=true;
						$_SESSION["UserType"]=$Row["UserStyleID"];
						echo("Xin chào $UserName!<br/>Click <a href='TrangChu.php'>vào đây</a> để trở lại trang chủ nếu trình duyệt không tự chuyển!");																                        
                    						
					}
				}				
				else
				{
						?>
						<script type="text/javascript" language="javascript">
                        alert("Tài khoản chưa được đăng kí!");			
                        window.history.go(-1);
                        </script>
                        <?php					
				}
			}
		}				
	}
			
	session_unset();
	session_destroy();
	
?>