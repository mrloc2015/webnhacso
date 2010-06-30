// JavaScript Document

//Trang ThemBaiHat.php - Xử lý cho điểm - 
function rate_over(val)
{
	for(i=1;i<=val;i++)
		$("#" + i).attr("src","images/sao2.png");
}
function rate_out(val)
{			
	var n = $("#Th_Rate").attr("value");
	for(i=5;i>n;i--)
		$("#" + i).attr("src","images/sao1.png");
}
function rate_click(val)
{	
	if($("#user_id").attr("value") < 1)
	{
		alert("Chỉ có user mới đánh giá được");
		return;
	}
	
	if($("#user_id").attr("value") > 0)
	{
		//alert($("#Th_Rate").attr("value"));
			
		var para = "user_id=" + $("#user_id").attr("value");
		para += "&song_id=" + $("#song_id").attr("value");
		para += "&rate=" + $("#Th_Rate").attr("value");
		var t = $.ajax({url:"xulyDanhGia.php",
						data:""+para,
						/*success:function(kq)
								{
									//alert("Thêm vào Playlist thành Công");
									vt1 = kq.search("<body>") + 6;
									vt2 = kq.search("</body>");
									kq = kq.substring(vt1, vt2);
									//alert(kq);
									//if(kq != "")
										alert(kq);
									//else
										//alert("Thêm vào Playlist thành Công");
								}*/
						});
	}
	
	$("#Th_Rate").attr("value",val);
	for(i=5;i>val;i--)
		$("#" + i).attr("src","images/sao1.png");
}
