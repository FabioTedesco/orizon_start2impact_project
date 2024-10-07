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


// insert country depending on form or http request POST
if (isset($_POST['submit'])) {
  //get and clean form data
  $country_form = htmlspecialchars(strip_tags($_POST['country']));

  $query = "INSERT INTO 
            country (country)
            VALUES
            ('$country_form')";

  //Prepare statement
  $stmt = $db->prepare($query);

  //Execute query
  if ($stmt->execute()) {
    echo $country_form . ' inserito';
    return true;
  }
} else {
  //Instantiate object
  $country = new Country($db);

  //Get raw data
  $data = json_decode(file_get_contents("php://input"));

  $country->country = $data->country;

  //Create country
  if ($country->create()) {
    echo json_encode(
      array('message' => 'Country created')
    );
  } else {
    echo json_encode(
      array('message' => 'Country  NOT created')
    );
  }
}
