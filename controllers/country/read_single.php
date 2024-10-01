<?php

//Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../core/db.php';
include_once '../../models/Country.php';

//Instatiate DB & connect
$database = new Database();
$db = $database->connect();


//Instantiate blog post object
$country = new Country($db);


//Get ID 
$country->id = isset($_GET['id']) ? $_GET['id'] : die();

//Get post 
$country->read_single();

//Create array
$country_arr = array(
  'id' => $country->id,
  'country' => $country->country

);

//make Json
print_r(json_encode($country_arr));
