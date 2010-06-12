// JavaScript Document

//Trang ThemBaiHat.php - Xử lý cho điểm - 
function rate_over(val)
{
	for(i=1;i<=val;i++)
		$("#" + i).attr("src","images/sao2.jpg");
}
function rate_out(val)
{			
	var n = $("#Th_Rate").attr("value");
	for(i=5;i>n;i--)
		$("#" + i).attr("src","images/sao1.jpg");
}
function rate_click(val)
{	
	$("#Th_Rate").attr("value",val);
	for(i=5;i>val;i--)
		$("#" + i).attr("src","images/sao1.jpg");
}

//Trang Nghe.php - Xử lý thêm vào playlist
function ThemVaoPlayList(song_id, source, user_name)
{
	//alert(song_id + "   " + source + "   " + user_name);
	
}