<?php
//连接数据库
var mysqlHost="45.76.134.241";
var mysqlPwd="root";
var mysqlUser="root";
$conn = mysql_connect(mysqlHost,mysqlUser,mysqlPwd);
mysql_select_db("test");

if( $_POST["tid"])
{
	//查询samples表，将所有tid为$_POST["tid"]的blocks
	$str = "";
	$maxlen = 0;
	$tid = intval($_POST["tid"]);
	$sql = "SELECT * FROM samples WHERE tid='{$tid}';";
	$result = mysql_query($sql);
	$allblokcs="";
	$sum = 0;   //相与后的结果
	while($row = mysql_fetch_assoc($result)){
		$num = 0;   //将字符串转换为数字
		//修改  &
		$blocks = $row['blocks'];
		//将01字符串转换为int
		$len = strlen($blocks);
		if($len > $maxlen){
			$maxlen = $len;
		}
		if ($sum==0){
			$allblokcs=$blocks;
		}
		for($i=0;$i<$len;$i++){
			if ($blocks[$i]=='1'){
				$allblokcs[$i]='1';
			}
			$num = ($num*2) + ($blocks[$i] - '0');
		}
		//与运算
		$sum += 1;
	}
	//将最后结果转换为二进制-> 字符串形式
	
	echo $allblokcs;
}

//关闭数据库
mysql_close($conn);
?>
