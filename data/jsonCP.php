<?php		
include 'define.php';
$keyword = strval($_GET['term']);
$search_param = "{$keyword}%";
$conn = new mysqli(PDO_HOST, PDO_USER_NAME , PDO_USER_PSW, PDO_DB_NAME);

$sql = $conn->prepare("SELECT DISTINCT Codepos FROM sta_cp WHERE Codepos LIKE ?");
$sql->bind_param("s",$search_param);			
$sql->execute();
$result = $sql->get_result();
if ($result->num_rows > 0) {
	while($row = $result->fetch_assoc()) {
    $Result[] = $row["Codepos"]."";
	}
	echo json_encode($Result);
}
$conn->close();
?>