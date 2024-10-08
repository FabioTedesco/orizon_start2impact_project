<?php

class Trip
{
  //DB stuff
  private $conn;
  private $table = 'trips';

  //properties
  public $trip_id;
  public $trip_name;
  public $available_slots;
  public $country_id;


  //Constructor with DB
  public function __construct($db)
  {
    $this->conn = $db;
  }


  //Get Trip
  public function read($trip_id = null, $available_slots = null)
  {
    // Query base
    $query = 'SELECT 
                    t.trip_id, 
                    t.trip_name, 
                    t.available_slots, 
                    c.country 
                  FROM ' . $this->table . ' t
                  LEFT JOIN country c ON t.country_id = c.id';


    // Aggiungere condizioni per i filtri se sono presenti
    $conditions = array();
    if (!is_null($trip_id)) {
      $conditions[] = 't.trip_id = :trip_id';
    }
    if (!is_null($available_slots)) {
      $conditions[] = 't.available_slots = :available_slots';
    }

    // Se ci sono condizioni, aggiungerle alla query
    if (count($conditions) > 0) {
      $query .= ' WHERE ' . implode(' AND ', $conditions);
    }

    // Preparare la query
    $stmt = $this->conn->prepare($query);

    // Bind dei parametri se esistono
    if (!is_null($trip_id)) {
      $stmt->bindParam(':trip_id', $trip_id);
    }
    if (!is_null($available_slots)) {
      $stmt->bindParam(':available_slots', $available_slots);
    }

    // Eseguire la query
    $stmt->execute();

    return $stmt;
  }

  //Create Trip
  public function create()
  {
    // create query
    $query = 'INSERT INTO ' . $this->table . ' 
             (trip_name, available_slots, country_id)
              VALUES (:trip_name, :available_slots, :country_id)';


    //Prepare statement
    $stmt = $this->conn->prepare($query);

    // clean data
    $this->trip_name = htmlspecialchars(strip_tags($this->trip_name));
    $this->available_slots = htmlspecialchars(strip_tags($this->available_slots));
    $this->country_id = htmlspecialchars(strip_tags($this->country_id));


    //Bind data -> 
    $stmt->bindParam(':trip_name', $this->trip_name);
    $stmt->bindParam(':available_slots', $this->available_slots);
    $stmt->bindParam(':country_id', $this->country_id);


    //Execute query
    if ($stmt->execute()) {
      return true;
    }

    //Print error if something goes wrong
    printf("Error: %s.\n", $stmt->error);

    return false;
  }

  // Update trip
  public function update()
  {
    // create query
    $query = 'UPDATE '
      . $this->table . '
              SET
              trip_name = :trip_name,
              available_slots = :available_slots,
              country_id = :country_id
              WHERE 
              trip_id = :trip_id';

    //Prepare statement
    $stmt = $this->conn->prepare($query);

    //Clean data
    $this->trip_name = htmlspecialchars(strip_tags($this->trip_name));
    $this->available_slots = htmlspecialchars(strip_tags($this->available_slots));
    $this->country_id = htmlspecialchars(strip_tags($this->country_id));
    $this->trip_id = htmlspecialchars(strip_tags($this->trip_id));

    //Bind data -> occuparsi dei : di prima davanti a title etc...
    $stmt->bindParam(':trip_name', $this->trip_name);
    $stmt->bindParam(':available_slots', $this->available_slots);
    $stmt->bindParam(':country_id', $this->country_id);
    $stmt->bindParam(':trip_id', $this->trip_id);

    //Execute query
    if ($stmt->execute()) {
      return true;
    }

    //Print error if something goes wrong
    printf("Error: %s.\n", $stmt->error);

    return false;
  }

  //Delete trip
  public function delete()
  {
    //Create query
    $query = 'DELETE FROM ' . $this->table . ' WHERE trip_id=:trip_id';

    //Prepare statement
    $stmt = $this->conn->prepare($query);

    //Clean data
    $this->trip_id = htmlspecialchars(strip_tags($this->trip_id));

    //Bind data
    $stmt->bindParam(':trip_id', $this->trip_id);

    //Execute query
    if ($stmt->execute()) {
      return true;
    }

    //Print error if something goes wrong
    printf("Error: %s.\n", $stmt->error);

    return false;
  }
}
