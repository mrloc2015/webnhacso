﻿// JavaScript Document
function GetXmlHttpObject()
{
	//Khởi tạo cho đối tượng XMLHTTP
	var objXmlHttp = null;
	if(window.XMLHttpRequest)
	{
		objXmlHttp = new XMLHttpRequest();//Dùng cho Fire Fox
	}
	else if(window.ActiveXObject)
	{
		objXmlhttp = new ActiveXObject("Microsoft.XMLHTTP");//Dùng cho IE
	}
	return objXmlHttp;
}

//gởi bằng phương thức GET
function TaoDangNhap() 
{		
	var xmlHttp = GetXmlHttpObject();
	var url = "xulyDangNhap.php";
	xmlHttp.open("GET",url,true);
	xmlHttp.send(null);
	xmlHttp.onreadystatechange=function(){
											if(xmlHttp.readyState == 4 || xmlHttp.readyState == "complete")
											{
												$("#idLoginBox").html(xmlHttp.responseText);
											}
										};
}


function LayThanhPhanCuaForm(form)//Lấy các thành phần của form (các input).
{
    var mangThamSo = new Array();
    
    for (var i=0 ; i < form.elements.length; i++) 
	{
        var chuoiThamSo = encodeURIComponent(form.elements[i].name);
        chuoiThamSo += "=";
        chuoiThamSo += encodeURIComponent(form.elements[i].value);
        mangThamSo.push(chuoiThamSo);
    } 
    
    return mangThamSo.join("&");
}

	
function Post(oForm)//Gửi bằng phương thức POST 
{
    var sBody = LayThanhPhanCuaForm(oForm);
    var XmlHttp = GetXmlHttpObject();
    XmlHttp.open("post", oForm.action, true);
    XmlHttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	
    XmlHttp.onreadystatechange = function () 
	{
        if (XmlHttp.readyState == 4) 
		{
			
            if (XmlHttp.status == 200) 
			{
			   
               $("#idLoginBox").html(XmlHttp.responseText);//saveResult(XmlHttp.responseText);
            } 
			else 
			{
                saveResult("An error occurred: " + XmlHttp.statusText);
            }
        }            
    };
    XmlHttp.send(sBody);     
}

//Dùng phương thức GET để gởi thông tin xử lý đăng xuất
function DangXuat()
{
	var xmlHttp = GetXmlHttpObject();
	var url = "xulyThoat.php";
	xmlHttp.open("GET",url,true);
	xmlHttp.send(null);
	xmlHttp.onreadystatechange=function(){
											if(xmlHttp.readyState == 4 || xmlHttp.readyState == "complete")
											{
												$("#idLoginBox").html(xmlHttp.responseText);
											}
										};
}

//Tạo hiệu ứng
function TaoHieuUng()
{
	$("#idDanhMuc").css("display","none");
}

function HienRa(id)
{
	if($("#"+id).css("display")=="none")
	{
		$("#"+id).show("normal");
	}
	else
	{
		$("#"+id).hide("normal");
	}

}


var add=true;
function MoRongDieuKhien(btnAdd)
{
	if(add==true)
	{
		$(btnAdd).attr("class","remove-cp");
		add=false;
		$("#cpUser").show("fast");
	}
	else
	{
		$(btnAdd).attr("class","add-cp");
		add=true;
		$("#cpUser").hide("fast");
	}
}



