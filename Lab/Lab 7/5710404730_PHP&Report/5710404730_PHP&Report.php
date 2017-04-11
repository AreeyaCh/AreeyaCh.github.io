<?php

 function fetch_data(){
	$HOST_NAME = "127.0.0.1";
	$DB_NAME = "dreamhome";
	$CHAR_SET = "charset=utf8"; // เช็ตให้อ่านภาษาไทยได้
 
	$USERNAME = "root";     // ตั้งค่าตามการใช้งานจริง
	$PASSWORD = "";  // ตั้งค่าตามการใช้งานจริง
 

 // Create connection
  $conn = new mysqli($HOST_NAME, $USERNAME, $PASSWORD, $DB_NAME);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$output = '';
$sql = "SELECT avg(rent),type from PropertyForRent group by type";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    
    // output data of each row
    while($row = $result->fetch_assoc()) {
        $output .= "<tr><td>".$row["type"]."</td><td>".$row["avg(rent)"]."</td></tr>";
    }
} 
mysqli_free_result($result);

mysqli_close($conn);
return $output;
}

if(isset($_POST["submit"])){
	$cre = $_POST["nameCreate"];
	if($cre == "Create PDF"){
		echo createPDF();
	}
	else if($cre == "Create Excel"){
		echo createExcel();
	}
	else if($cre == "Create CSV"){
		echo createCSV();
	}
}

// if(isset($_POST["create_pdf"])){
function createPDF(){

	require_once('tcpdf/tcpdf.php');  
      $obj_pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);  
      $obj_pdf->SetCreator(PDF_CREATOR);  
      $obj_pdf->SetTitle("Export HTML Table data to PDF using TCPDF in PHP");  
      $obj_pdf->SetHeaderData('', '', PDF_HEADER_TITLE, PDF_HEADER_STRING);  
      $obj_pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));  
      $obj_pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));  
      $obj_pdf->SetDefaultMonospacedFont('helvetica');  
      $obj_pdf->SetFooterMargin(PDF_MARGIN_FOOTER);  
      $obj_pdf->SetMargins(PDF_MARGIN_LEFT, '5', PDF_MARGIN_RIGHT);  
      $obj_pdf->setPrintHeader(false);  
      $obj_pdf->setPrintFooter(false);  
      $obj_pdf->SetAutoPageBreak(TRUE, 10);  
      $obj_pdf->SetFont('helvetica', '', 12);  
      $obj_pdf->AddPage();  
      $content = '';  
      $content .= '  
      <h3 align="center">Export HTML Table data to PDF using TCPDF in PHP</h3><br /><br />  
      <table border="1" cellspacing="0" cellpadding="5">  
           <tr>  
                <th >Type</th>  
                <th >Average Rent</th>  
           </tr>  
      ';  
      $content .= fetch_data();  
      $content .= '</table>';  
      $obj_pdf->writeHTML($content);  
      $obj_pdf->Output('sample.pdf', 'I');  
}

function createExcel(){
  header('Content-Type: application/xls');
  header('Content-Disposition: attachment; filename=download.xls');
  $content .= fetch_data(); 
  echo $content;
}

function createCSV(){
  $HOST_NAME = "127.0.0.1";
  $DB_NAME = "dreamhome";
  $CHAR_SET = "charset=utf8"; // เช็ตให้อ่านภาษาไทยได้
 
  $USERNAME = "root";     // ตั้งค่าตามการใช้งานจริง
  $PASSWORD = "";  // ตั้งค่าตามการใช้งานจริง

    $connect = mysqli_connect($HOST_NAME, $USERNAME, $PASSWORD, $DB_NAME);  
      header('Content-Type: text/csv; charset=utf-8');  
      header('Content-Disposition: attachment; filename=data.csv');  
      $output = fopen("php://output", "w");  
      fputcsv($output, array('Type', 'Average Rent'));
      $query = "SELECT type,agv(rent) from PropertyForRent group by type";  
      $result = mysqli_query($connect, $query);  
      while($row = mysqli_fetch_assoc($result))  
      {  
           fputcsv($output, $row);  
      }  
      fclose($output); 
  }
?>


<!DOCTYPE html>
<html>
<head>
	<title>...</title>
</head>
<body>
	<table>
		<tr>
			<th>Type</th>
			<th>Average Rent</th>
		</tr>
		<?php
		echo fetch_data();
		?>
	</table>
	<br/>
	<form method = "post">
		<select name = "nameCreate" id = "nameCreate">
  			<option name = "create_pdf" value="Create PDF">PDF</option>
 			<option name = "create_excel" value="Create Excel">Excel</option>
  			<option name = "create_csv" value="Create CSV">CSV</option>
		</select>
		<input type = "submit" name = "submit"/>
	</form>
</body>
</html>