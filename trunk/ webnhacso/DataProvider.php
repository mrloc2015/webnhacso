<?php
	class DataProvider
	{
		public static function ExecuteQuery($sql)
		{
			$connection = mysql_connect("localhost","root","") or die ("Không kết nối được với CSDL");
			
			mysql_query("set names 'utf8'",$connection);
			
			mysql_select_db("fantasy_music",$connection);
			
			$result = mysql_query($sql,$connection);
			
			mysql_close($connection);
			
			return $result;
			
		}
	}	
?>