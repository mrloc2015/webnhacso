// JavaScript Document
function rate_over(val)
{
	for(i=1;i<=val;i++)
	{
		var x = document.getElementById(i);
		x.src="images/sao2.jpg";
	}
}
function rate_out(val)
{			
	for(i=1;i<=5;i++)
	{
		var y = document.getElementById(i);
		y.src="images/sao1.jpg";
	}
	rate_over(document.getElementById("Th_Rate").value);
}
function rate_click(val)
{
	document.getElementById("Th_Rate").value = 0;
	for(i=1;i<=5;i++)
	{
		var y = document.getElementById(i);
		y.src="images/sao1.jpg";
	}
	document.getElementById("Th_Rate").value = val;
	rate_over(val);				
}