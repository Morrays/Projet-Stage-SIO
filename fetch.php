<?php
//fetch.php
$connect = mysqli_connect("localhost", "root", "", "stpolsis45");
$request = mysqli_real_escape_string($connect, $_POST["query"]);
$query = " SELECT nom FROM sta_entreprise WHERE nom LIKE '%".$request."%'";

$result = mysqli_query($connect, $query);

$data = array();

if(mysqli_num_rows($result) > 0)
{
 while($row = mysqli_fetch_assoc($result))
 {
  $data[] = $row["nom"];
 }
 echo json_encode($data);
}

?>