<?php		
$keyword = strval($_GET['term']);
$search_param = "{$keyword}%";
$conn =new mysqli('localhost', 'root', '' , 'stpolsis45');

$sql = $conn->prepare("SELECT * FROM sta_cp WHERE Codepos LIKE ?");
$sql->bind_param("s",$search_param);			
$sql->execute();
$result = $sql->get_result();
if ($result->num_rows > 0) {
	while($row = $result->fetch_assoc()) {
    $Result[] = $row["Codepos"]." : ".$row["Commune"];
	}
	echo json_encode($Result);
}
$conn->close();
?>