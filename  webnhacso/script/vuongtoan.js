// JavaScript Document
function cleartextfield()
{
	var nam =$("#txtnam").attr("value","")	;																	
}
//Loại bỏ khoảng trắng của 1 chuỗi
function remove_space(chuoi)
{												
	var tem="";
	var arrchar = chuoi.split(" ");
	for(i=0; i < arrchar.length; i ++)
	{
		tem = tem + arrchar[i];
	}
	return tem;
}
//Kiểm tra 1 chuỗi có rỗng hay không
function IsEmpty(chuoi)
{
	if(remove_space(chuoi)=="")
	{
		return true;
	}
	else
	{
		return false;
	}
}
//Kiểm tra 2 chuỗi có giống nhau hay khong
function IsSame(chuoi1,chuoi2)
{
	if(chuoi1==chuoi2)
	{
		return true;
	}
	else
	{
		return false;
	}
}
//Kiểm tra tính hợp lệ của Email,tham số là 1 chuỗi 
function KiemTraEmail(chuoi)
{
	var OnEmail = /^([a-zA-Z0-9_\.\-])+@(([\yahoo\gmail\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
	if(OnEmail.test(chuoi) == false)
	{
		return false;
	}
	else
	{
		return true;
	}
}
//Kiểm tra tính hợp lệ của 1 năm sinh
function KiemTraNam(chuoi)
{
	var OnYear = /^([0-9]+)$/;
	if(OnYear.test(chuoi)==false)
	{
		return false;
	}
	else
	{
		return true;
	}
}
//hàm nhận đối số là đối tượng thể hiện và địa chỉ gửi đi
function ajaxFunction(object,url)
{
var xmlHttp;
try
  {
  // Firefox, Opera 8.0+, Safari
  xmlHttp=new XMLHttpRequest();
  //alert("Khoi tao thanh cong doi tuong xmlHttp");
  }
catch (e)
  {
  // Internet Explorer
  try
    {
    xmlHttp=new ActiveXObject("Msxml2.XMLHTTP");
    }
  catch (e)
    {
    try
      {
      xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
      }
    catch (e)
      {
      alert("Your browser does not support AJAX!");
      return false;
      }
    }
  }
  xmlHttp.onreadystatechange=function()
    {
    if(xmlHttp.readyState==4)
      {
       object.html(xmlHttp.responseText);
      }
    }  
  xmlHttp.open("GET",url,true);
  xmlHttp.send(null);
}

//Hàm kiểm tra trên thông tin cá nhân
function KiemTraThongTinCaNhan()
{	
	//Kiểm tra họ tên
	if(IsEmpty($("#txthovaten").attr("value"))==true)
	{
		alert("Xin vui lòng nhập họ tên đầy đủ của bạn!");
		$("#txthovaten").focus();
		return false;
	}	
	//Kiểm tra năm sinh
	if(IsEmpty($("#txtnam").attr("value"))!=true)
	{
		var date = new Date()
		var namhientai=date.getFullYear();
		var namsinh=$("#txtnam").attr("value");		
		if(KiemTraNam(namsinh)==false||namhientai-namsinh<6||namsinh>namhientai||namhientai-namsinh>100)
		{
			alert("Năm sinh không hợp lệ");			
			$("#txtnam").focus();			
			return false;
		}
	}
	else
	{
		alert("Vui lòng nhập năm sinh!");
		$("#txtnam").focus();
		return false;
	}
	//Kiểm tra email
	if(IsEmpty($("#txtemail").attr("value"))!=true)
	{
		var email=$("#txtemail").attr("value");
		if(KiemTraEmail(email)==false)
		{
			alert("Địa chỉ email không hợp lệ");
			$("#txtemail").attr("value","");
			$("#txtemail").focus();
			return false;
		}
	}
	else
	{
		alert("Vui lòng nhập địa chỉ Email!");
		$("#txtemail").focus();
		return false;
	}
	return true;
}
//Hàm lấy thông tin cá nhân và gửi di.
function GuiThongTinCaNhan()
{
	$ten=$("#txthovaten").attr("value");
	$ngaysinh=$("#txtnam").attr("value")+"-"+$("#cmbthang").attr("value")+"-"+$("#cmbngay").attr("value");
	$email=$("#txtemail").attr("value");
	$dentu=$("#cmbdentu").attr("value");
	var array =new Array($ten,$ngaysinh,$email,$dentu);
	$object=$("#kq1");
	$url="XuLyCapNhatThongTin.php?thongtincanhan="+array;
	ajaxFunction($object,$url);	
}


function CapNhatThongTinCaNhan()
{
	var a =document.getElementById("kq1");
	if(KiemTraThongTinCaNhan()==true)
	{		
		a.innerHTML='<img id="img1" src="images/load.gif" />';
		$("#img1").attr("src","images/load.gif");
		setTimeout("GuiThongTinCaNhan()",3000);			
	}		
}
//Kiem tra mật khẩu
function KiemTraMatKhau()
{
	if(IsEmpty($("#txtmatkhaucu").attr("value"))==true)
	{
		alert("Bạn chưa nhập mật khẩu!");
		$("#txtmatkhaucu").focus();
		return false;
	}
	if(IsEmpty($("#txtmatkhaumoi").attr("value"))==true)
	{
		alert("Hãy nhập mật khẩu mới!");
		$("#txtmatkhaumoi").focus();
		return false;
	}
	if(IsEmpty($("#txtlaplaimatkhaumoi").attr("value"))==true)
	{
		alert("Hãy nhập lại mật khẩu mới!");
		$("#txtlaplaimatkhaumoi").focus();
		return false;
	}	
	if($("#txtmatkhaumoi").attr("value")!=$("#txtlaplaimatkhaumoi").attr("value"))
	{
		alert("Mật khẩu mới không trùng khớp!");
		$("#txtmatkhaumoi").attr("value","");
		$("#txtlaplaimatkhaumoi").attr("value","");	
		$("#txtmatkhaumoi").focus();
		return false;
	}
	return true;
}
function GuiThongTinMatKhau()
{
	$matkhaucu=$("#txtmatkhaucu").attr("value");
	$matkhaumoi=$("#txtmatkhaumoi").attr("value");
	$laplaimatkhaumoi=$("#txtlaplaimatkhaumoi").attr("value");
	
	$arr_thongtin= new Array($matkhaucu,$matkhaumoi,$laplaimatkhaumoi);
	$object=$("#kq2");
	$url="XuLyCapNhatThongTin.php?thongtinmatkhau="+$arr_thongtin;
	ajaxFunction($object,$url);	
}
function ThayDoiMatKhau()
{		
	var a =document.getElementById("kq2");
	if(KiemTraMatKhau()==true)
	{	
		a.innerHTML='<img id="img1" src="images/load.gif" />';
		$("#img2").attr("src","images/load.gif");
		setTimeout("GuiThongTinMatKhau()",3000);	
	}		
}


function CheckInput()
{
	//Kiểm tra tên đăng nhập
	if(IsEmpty($("#txttendangnhap").attr("value"))==true)
	{
		alert("Xin vui lòng nhập tên đăng nhập của bạn!");
		$("#txttendangnhap").focus();
		return false;
	}
	
	//Kiểm tra mật khẩu
	if(IsEmpty($("#txtmatkhau").attr("value"))==true)
	{
		alert("Xin vui lòng nhập mật khẩu của bạn!");
		$("#txtmatkhau").focus();
		return false;
	}		
	//Kiểm tra sự trùng khớp của 2 mật khẩu
	if($("#txtmatkhau").attr("value")!=$("#txtlaplaimatkhau").attr("value"))
	{
		alert("Mật khẩu không trùng khớp!");
		$("#txtmatkhau").attr("value","");
		$("#txtlaplaimatkhau").attr("value","");
		$("#txtmatkhau").focus();
		return false;
	}	
	//Kiểm tra email
	if(IsEmpty($("#txtemail").attr("value"))!=true)
	{
		var OnEmail = /^([a-zA-Z0-9_\.\-])+@(([\yahoo\gmail\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
		if(OnEmail.test($("#txtemail").attr("value")) == false)
		{
			alert("Địa chỉ Email không hợp lệ. Chỉ cho phép Yahoo mail hoặc Google mail.");
			$("#txtemail").focus();
			return false;
		}
	}
	else
	{
		alert("Vui lòng nhập địa chỉ email!");
		$("#txtemail").focus();
		return false;
	}
	//Kiểm tra lặp lại email
	if(remove_space($("#txtemail").attr("value"))!=remove_space($("#txtlaplaiemail").attr("value")))
	{
		alert("Email không trùng khớp!");
		$("#txtemail").attr("value","");
		$("#txtlaplaiemail").attr("value","");
		$("#txtemail").focus();
		return false;
	}
	//Kiểm tra họ và tên
	if(IsEmpty($("#txthovaten").attr("value"))==true)
	{
		alert("Xin vui lòng nhập họ tên của bạn!");
		$("#txthovaten").focus();
		return false;
	}
	//Kiểm tra ngày,tháng,năm sinh
	if($("#cmbngay").attr("value")==0)
	{							
		alert("Vui lòng nhập ngày sinh!");
		$("#cmbngay").focus();
		return false;
	}
	if($("#cmbthang").attr("value")==0)
	{							
		alert("Vui lòng nhập đầy đủ ngày sinh!");
		$("#cmbthang").focus();
		return false;
	}  
	var OnYear = /^([0-9]+)$/;
	var date = new Date();
	var namhientai = date.getFullYear();
	var namsinh=$("#txtnam").attr("value");
	if(namsinh!="[Năm]" && IsEmpty(namsinh)!=true)
	{		
		if(OnYear.test(namsinh) == false||namhientai-namsinh >100 || namhientai-namsinh < 6)
		{
			alert("Năm sinh không hợp lệ!")							
			$("#txtnam").attr("value","");
			$("#txtnam").focus();
			return false;
		}					
	}
	else
	{				
		alert("Vui lòng nhập năm sinh!");
		$("#txtnam").attr("value","");
		$("#txtnam").focus();
		return false;				
	}	
	//Kiểm tra nơi ở
	if($("#cmblocal").attr("value")==0)						
	{
		alert("Vui lòng nhập nơi ở của bạn!");
		$("#cmblocal").focus();
		return false;
	}	
	//Kiểm tra mã xác nhận	
	if(IsEmpty($("#txtmaxacnhan").attr("value"))==true)
	{
		alert("Xin vui lòng nhập mã xác nhận!");
		$("#txtmaxacnhan").focus();
		return false;
	}				
}
function KtUser(idTenDn,idKetQua)
{
	$object=$("#"+idKetQua);
	$url="KiemTraDangKi.php?username="+$("#"+idTenDn).attr("value");
	ajaxFunction($object,$url);	
}
function KtEmail()
{
	$object=$("#ktemail");
	$url="KiemTraDangKi.php?email="+$("#txtemail").attr("value");
	ajaxFunction($object,$url);
}
function KtMaXacNhan()
{
	$object=$("#ktmaxacnhan");
	$url="KiemTraDangKi.php?maxacnhan="+$("#txtmaxacnhan").attr("value");
	ajaxFunction($object,$url);
}


$(document).ready(function()
{
	$('#imgmaxacnhan').click(function()
	{							
		var maxacnhan = $('#imgmaxacnhan');
		var maxacnhan_new_src = maxacnhan.attr('src') + '?' + Math.floor(Math.random()*11);
		maxacnhan.attr('src', maxacnhan_new_src );
		return false;
	}	);
}	);

