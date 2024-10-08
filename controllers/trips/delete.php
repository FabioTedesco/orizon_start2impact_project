<?php

//Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: DELETE');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');


include_once '../../core/db.php';
include_once '../../models/Trip.php';

//Instatiate DB & connect
$database = new Database();
$db = $database->connect();


//Instantiate Trip object
$trip = new Trip($db);

//Get data
$data = json_decode(file_get_contents("php://input"));

//Set ID to delete
$trip->trip_id = $data->trip_id;


//delete trip
if ($trip->delete()) {
  echo json_encode(
    array('message' => 'Trip deleted')
  );
} else {
  echo json_encode(
    array('message' => 'Trip  NOT deleted')
  );
}
