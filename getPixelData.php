<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
require_once("class.db.php");
$db = new DB();
$connection = $db->dbConnection();
$response = array();
$stmt = $connection->prepare("SELECT * FROM traffic_data_images");
$stmt->execute();
while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
extract($row);
$imageitem = array(
"TDI_ID" => $TDI_ID,
"IMG_DATA" => $IMG_DATA,
"TDI_DATETIME" => $TDI_DATETIME
);
array_push($response, $imageitem);
}
http_response_code(200);
echo json_encode($response);
?>