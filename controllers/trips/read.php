<?php

//Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../core/db.php';
include_once '../../models/Trip.php';

//Instatiate DB & connect
$database = new Database();
$db = $database->connect();


//Instantiate trip object
$trip = new Trip($db);


//Get ID & available_slots
$id_condition = isset($_GET['id']) ? $_GET['id'] : null;
$available_slots_condition = isset($_GET['available_slots']) ? $_GET['available_slots'] : null;

//Get trip 
$result = $trip->read($id_condition, $available_slots_condition);

// Controllare se ci sono risultati
if ($result->rowCount() > 0) {
  $trips_arr = array();
  $trips_arr['data'] = array();

  // Estrarre i dati riga per riga
  while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
    extract($row);
    $trip_item = array(
      'trip_id' => $trip_id,
      'trip_name' => $trip_name,
      'available_slots' => $available_slots,
      'country' => $country
    );
    // Aggiungere ogni viaggio all'array dei viaggi
    array_push($trips_arr['data'], $trip_item);
  }

  // Convertire l'array in formato JSON e inviarlo al client
  echo json_encode($trips_arr);
} else {
  // Nessun viaggio trovato
  echo json_encode(
    array('message' => 'No trips found.')
  );
}
