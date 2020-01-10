<?php		
$keyword = strval($_GET['term']);
$search_param = "{$keyword}%";
$conn =new mysqli('localhost', 'root', '' , 'stpolsis45');

$sql = $conn->prepare("SELECT * FROM sta_entreprise WHERE nom LIKE ?");
$sql->bind_param("s",$search_param);			
$sql->execute();
$result = $sql->get_result();
if ($result->num_rows > 0) {
	while($row = $result->fetch_assoc()) {
	$countryResult[] = $row["nom"];
	}
	echo json_encode($countryResult);
}
$conn->close();
?>