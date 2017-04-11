<?php
 
	$HOST_NAME = "127.0.0.1";
	$DB_NAME = "dreamhome";
	$CHAR_SET = "charset=utf8"; // เช็ตให้อ่านภาษาไทยได้
 
	$USERNAME = "root";     // ตั้งค่าตามการใช้งานจริง
	$PASSWORD = "";  // ตั้งค่าตามการใช้งานจริง
 
 
	try {
	
		$db = new PDO('mysql:host='.$HOST_NAME.';dbname='.$DB_NAME.';'.$CHAR_SET,$USERNAME,$PASSWORD);
		
		
		echo "Q.11</br>";
		$sql = "SELECT avg(rent) from PropertyForRent group by type";
		$result = $db->query($sql);

	if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "type: " . $row["type"]. " - avg(rent): " . $row["avg(rent)"]. "<br>";
    }
	} else {
    echo "0 results";
	}

		echo "<table>
	<tr>
		<th>
			
		</th>
	</tr>
	<tr>
		<td>

		</td>
	</tr>
	<tr>
		<td>
		
		</td>
	</tr>
	</table>";

		echo "Success";
	
	
	} catch (PDOException $e) {
	
		echo "Failed : ".$e->getMessage();
	
	}
 
?>

