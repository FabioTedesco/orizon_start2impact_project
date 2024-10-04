<?php

//Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');


include_once '../../core/db.php';
include_once '../../models/Country.php';

//Instatiate DB & connect
$database = new Database();
$db = $database->connect();


//Instantiate object
$country = new Country($db);

$country->country = $_POST['country'] ?? null;

// Se country è null, blocca la creazione
if (!$country->country) {
  echo json_encode(
    array('message' => 'No country provided')
  );
  exit;
}


// Create country
if (isset($_POST['submit'])) {
  if ($country->create()) {
    echo json_encode(
      array('message' => 'Country created:')
    );
    echo ' ' . $country->country;
  } else {
    echo json_encode(
      array('message' => 'Country  NOT created')
    );
  }
}
