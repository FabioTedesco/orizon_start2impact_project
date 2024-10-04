<?php

//Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');


include_once '../../core/db.php';
include_once '../../models/Trip.php';

//Instatiate DB & connect
$database = new Database();
$db = $database->connect();


//Instantiate object
$trip = new Trip($db);

//Get raw data
$data = json_decode(file_get_contents("php://input"));

$trip->trip_name = $data->trip_name;
$trip->available_slots = $data->available_slots;
$trip->country_id = $data->country_id;


//Create Trip
if ($trip->create()) {
  echo json_encode(
    array('message' => 'Trip created')
  );
} else {
  echo json_encode(
    array('message' => 'Trip  NOT created')
  );
}
