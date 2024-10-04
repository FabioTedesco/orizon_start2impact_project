<?php

//Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: PUT');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');


include_once '../../core/db.php';
include_once '../../models/Trip.php';

//Instatiate DB & connect
$database = new Database();
$db = $database->connect();


//Instantiate blog post object
$trip = new Trip($db);

//Get rew posted data
$data = json_decode(file_get_contents("php://input"));

//Set ID to update
$trip->trip_id = $data->trip_id;

$trip->trip_name = $data->trip_name;
$trip->available_slots = $data->available_slots;
$trip->country_id = $data->country_id;

//update trip
if ($trip->update()) {
  echo json_encode(
    array('message' => 'Trip updated')
  );
} else {
  echo json_encode(
    array('message' => 'Trip  NOT updated')
  );
}
