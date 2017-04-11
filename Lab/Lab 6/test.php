<?php
 
	$HOST_NAME = "127.0.0.1";
	$DB_NAME = "webtech";
	$CHAR_SET = "charset=utf8"; // เช็ตให้อ่านภาษาไทยได้
 
	$USERNAME = "a";     // ตั้งค่าตามการใช้งานจริง
	$PASSWORD = "mypass";  // ตั้งค่าตามการใช้งานจริง
 
 
	try {
	
		$db = new PDO('mysql:host='.$HOST_NAME.';dbname='.$DB_NAME.';'.$CHAR_SET,$USERNAME,$PASSWORD);
		$db->exec("INSERT INTO customers (customerID,citizenID,fname,lname) VALUES ('123','456','aa','bb')");
		$db->exec("INSERT INTO customers (customerID,citizenID,fname,lname) VALUES ('789','110','cc','dd')");
		echo "Success";
	
	
	} catch (PDOException $e) {
	
		echo "Failed : ".$e->getMessage();
	
	}
 
?>