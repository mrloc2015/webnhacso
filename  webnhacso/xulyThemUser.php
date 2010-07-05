<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php 
session_start();
$date = getdate();
$today=$date["year"]."-".$date["mon"]."-".$date["mday"];

include_once("DataProvider.php");
if(isset($_REQUEST["DangKi"]))
{
		$tendangnhap = $_REQUEST["txttendangnhap"];
		$matkhau = md5($_REQUEST["txtmatkhau"]);
		$laplaimatkhau = md5($_REQUEST["txtlaplaimatkhau"]);
		$email = $_REQUEST["txtemail"];
		$laplaiemail=$_REQUEST["txtlaplaiemail"];
		$hovaten=$_REQUEST["txthovaten"];
		$ngaysinh=$_REQUEST["txtnam"]."/".$_REQUEST["cmbthang"]."/".$_REQUEST["cmbngay"];
		$location=$_REQUEST["cmblocation"];	
		$nam=$_REQUEST["txtnam"];
		$txtmaxacnhan=$_REQUEST["txtmaxacnhan"];
		
		//Kiểm tra mã xác nhận
		if($txtmaxacnhan!=$_SESSION['code'])
		{
			echo "Mã xác nhận không dúng!<br/><a href='javascript:history.go(-1)'>Nhấp vào đây để quay trở lại</a>";	
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
//Tiến hành tạo tài khoản
$sql="INSERT INTO user (UserName,Pass,UserStyleID,IsDelete,IsBanned) values ('$tendangnhap','$matkhau','2',0,0)";

DataProvider::ExecuteQuery($sql);

$temp_user = DataProvider::ExecuteQuery("select * from user where UserName='$tendangnhap'");
$row_user = mysql_fetch_array($temp_user);
$userID=$row_user["ID"];

$sql="UPDATE user set PlayListID =  $userID where ID = $userID";
DataProvider::ExecuteQuery($sql);
//$temp_Location=DataProvider::ExecuteQuery("select * from Location where Local='$location'");
//$row_Location = mysql_fetch_array($temp_Location);
//$localID =$row_Location["ID"];


$sql="INSERT INTO user_info (FullName,UserID,BirthDay,JoinDay,Email,LocationID) value ('$hovaten','$userID','$ngaysinh','$today','$email','$location')";
DataProvider::ExecuteQuery($sql);

echo("<html >
<head>

<meta http-equiv='Content-Type' content='text/html; charset=utf-8'/>
<title>Untitled Document</title>
</head>
<body onload='TimeCount();'>
<script language='javascript'>
var c=5;
function TimeCount()
{
	document.getElementById('txt').value=c;
	c=c-1;
	t=setTimeout('TimeCount()',1000);
	if(c==-1)
	{
		window.location='trangchu.php';
		c=5;
	}
}

</script>
<form id='form1' name='form1' method='post' >
<div align='center' style='text-align:center'><strong><font color='#0000FF'>Chao mừng $tendangnhap đã trở thành thành viên của nhạc số!</font></strong></div>
<div align='center' style='text-align:center'><strong><font color='#0000FF'>Bạn sẽ trở lại trang chủ sau 5 giây nữa!</font></strong></div>
<div align='center' style='text-align:center'><strong><font color='#0000FF'>Click vào <a href='TrangChu.php'>đây</a> nếu trình duyệt không tự chuyển</font></strong></div>
<div align='center' style='text-align:center'><input type='text' id='txt' style='width:30px;border:hidden'  / ></div>
<div align='center' style='text-align:center'><label id='txt'></label></div>
</form>
</body>
</html>");

//*****sau_con_89******
$sql="Update user Set PlayListID = $userID Where ID = $userID";
DataProvider::ExecuteQuery($sql);
//tạo folder + playlist cho mỗi người dùng => tiện việc xử lý nghe nhạc
mkdir("Du_Lieu/USER/$tendangnhap",1);

$noi_dung = "<?wpl version=\"1.0\"?>\n";
$noi_dung .= "<smil>\n";
$noi_dung .= "\t<head>\n";
$noi_dung .= "\t\t<meta name=\"Generator\" content=\"Microsoft Windows Media Player -- 12.0.7600.16385\"/>\n";
$noi_dung .= "\t\t<meta name=\"ItemCount\" content=\"2\"/>\n";
$noi_dung .= "\t\t<title>$tendangnhap</title>\n";
$noi_dung .= "\t</head>\n";
$noi_dung .= "\t<body>\n";
$noi_dung .= "\t\t<seq>\n\n";
$noi_dung .= "\t\t</seq>\n";
$noi_dung .= "\t</body>\n";
$noi_dung .= "</smil>\n";

$playlist_id = "";

$sql = "Insert Into playlist (CreateDate, ListenCount, DownLoadCount) values('$today',0,0)";
DataProvider::ExecuteQuery($sql);
$temp = DataProvider::ExecuteQuery("Select MAX(ID) From playlist");
if($temp != false)
{
	$row = mysql_fetch_array($temp);
	$playlist_id = $row["MAX(ID)"];
}

$fp = fopen("DU_LIEU/USER/$tendangnhap/$playlist_id.wpl","w");
fwrite($fp,$noi_dung);
//*********************
}
?> 