<?php
require_once("class.db.php");
$db = new DB();
$connection = $db->dbConnection();
// required headers do not remove
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
$data_object = file_get_contents("php://input");
if(!empty($data_object)){
http_response_code(200);
$object = json_decode($data_object);
$imagedata = $object->IMAGE_DATA;
$stmt = $connection->prepare("INSERT INTO traffic_data_images SET
IMG_DATA = :uimgdata,
TDI_DATETIME = NOW()");
$stmt->bindParam(":uimgdata", $imagedata);
if($stmt->execute()){
echo json_encode(array("message" => "Data saved successfully", "status" =>"success"));
}

}else{
http_response_code(404);
echo json_encode(array("message" => "Imcomplete request", "status" =>"failed"));
}

?>