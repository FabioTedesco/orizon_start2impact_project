<?php

//Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../core/db.php';
include_once '../../models/Country.php';

//Instatiate DB & connect
$database = new Database();
$db = $database->connect();


//Instantiate category object
$country = new Country($db);

// Category read query
$result = $country->read();
// Get row count
$num = $result->rowCount();

//Check if any categories
if ($num > 0) {
  //Cat array
  $country_arr = array();
  $country_arr['data'] = array();

  while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
    extract($row);

    $country_item = array(
      'id' => $id,
      'country' => $country
    );

    //Push to "data"
    array_push($country_arr['data'], $country_item);
  }

  //Turn to JSON & output
  echo json_encode($country_arr);
} else {
  // no categories
  echo json_encode(
    array('message' => 'No categories found')
  );
}
