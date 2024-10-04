<?php

//Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: DELETE');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');


include_once '../../core/db.php';
include_once '../../models/Country.php';

//Instatiate DB & connect
$database = new Database();
$db = $database->connect();


//Instantiate blog post object
$country = new Country($db);

//Get rew posted data
$data = json_decode(file_get_contents("php://input"));

//Set ID to delete
$country->id = $data->id;


//delete post
if ($country->delete()) {
  echo json_encode(
    array('message' => 'Country deleted')
  );
} else {
  echo json_encode(
    array('message' => 'Country  NOT deleted')
  );
}
