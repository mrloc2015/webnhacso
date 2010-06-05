<?php 
$date = getdate();
$today=$date["year"]."-".$date["mon"]."-".$date["mday"];

include_once("DataProvider.php");
if(isset($_REQUEST["issubmit"]))
{
		$tendangnhap = $_REQUEST["txttendangnhap"];
		$matkhau = $_REQUEST["txtmatkhau"];
		$laplaimatkhau = $_REQUEST["txtlaplaimatkhau"];
		$email = $_REQUEST["txtemail"];
		$laplaiemail=$_REQUEST["txtlaplaiemail"];
		$hovaten=$_REQUEST["txthovaten"];
		$ngaysinh=$_REQUEST["txtnam"]."/".$_REQUEST["cmbthang"]."/".$_REQUEST["cmbngay"];
		$location=$_REQUEST["cmblocation"];	
		$nam=$_REQUEST["txtnam"];
		
		if ( ! $tendangnhap || ! $matkhau || ! $laplaimatkhau || ! $email || ! $laplaiemail || ! 	$hovaten || ! $ngaysinh || !$location ||!$nam)
		{
			echo "Xin vui lòng điển đầy đủ thông tin!<br/><a href='javascript:history.go(-1)'>Nhấp vào đây để quay trở lại</a>";	
			exit;			
		}
//Kiểm tra tên đăng nhập đã tồn tại hay chưa:
		$list_user=DataProvider::ExecuteQuery("SELECT username, count( ID ) FROM user WHERE username = '$tendangnhap' group by username");
		if($list_user!=false)
		{
			$row=mysql_fetch_array($list_user);
			if($row["count( ID )"]>=1)
			{
				echo "Tên đăng nhập này đã có người sử dụng,vui lòng chọn tên khác!<br/><a href='javascript:history.go(-1)'>Nhấp vào đây để quay trở lại</a>";	
			exit;			}
		}		
//Kiểm tra email
		$list_email=DataProvider::ExecuteQuery("SELECT Email, count( ID ) FROM user_info WHERE Email = '$email' group by Email");
		if($list_email!=false)
		{
			$row=mysql_fetch_array($list_email);
			if($row["count( ID )"]>=1)
			{
				echo "Địa chỉ email đã được sử dụng!<br/><a href='javascript:history.go(-1)'>Nhấp vào đây để quay trở lại</a>";	
			exit;
			}
		}
		if($email!=$laplaiemail)
		{
			echo "Địa chỉ Email không trùng khớp!<br/><a href='javascript:history.go(-1)'>Nhấp vào đây để quay trở lại</a>";	
			exit;
		}
		
//Kiểm tra mật khẩu
		if($matkhau!=$laplaimatkhau)
		{
			echo "Mật khẩu không trùng khớp!<br/><a href='javascript:history.go(-1)'>Nhấp vào đây để quay trở lại</a>";	
			exit;
		}
//Kiểm tra năm sinh	

//Tiến hành tạo tài khoản
$sql="INSERT INTO user (UserName,Pass,UserStyleID) value ('$tendangnhap','$matkhau','2')";
DataProvider::ExecuteQuery($sql);

$temp_user = DataProvider::ExecuteQuery("select * from user where UserName='$tendangnhap'");
$row_user = mysql_fetch_array($temp_user);
$userID=$row_user["ID"];

$temp_Location=DataProvider::ExecuteQuery("select * from Location where Local='$location'");
$row_Location = mysql_fetch_array($temp_Location);
$localID =$row_Location["ID"];

$sql="INSERT INTO user_info (FullName,UserID,BirthDay,JoinDay,Email,LocationID) value ('$hovaten','$userID','$ngaysinh','$today','$email','$localID')";
DataProvider::ExecuteQuery($sql);

echo("<blink>Chào mừng $tendangnhap đã trở thành thành viên của nhạc số!</blink>");
}
?> 