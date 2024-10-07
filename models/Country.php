<?php

class Country
{
  //DB stuff
  private $conn;
  private $table = 'country';

  //properties
  public $id;
  public $country;

  //Constructor with DB
  public function __construct($db)
  {
    $this->conn = $db;
  }

  //Get Country
  public function read($country = null)
  {
    //create query
    $query = 'SELECT 
              id, country
              FROM
              ' . $this->table;

    $condition = $country != null ? 'country = :country' : null;

    if ($condition) {
      $query .= ' WHERE ' . $condition;
    }

    //prepare statement
    $stmt = $this->conn->prepare($query);

    // Bind dei parametri se esistono
    if (!is_null($country)) {
      $stmt->bindParam(':country', $country);
    }

    //Execute the query
    $stmt->execute();

    return $stmt;
  }

  //Create country
  public function create()
  {
    // create query 
    $query = 'INSERT INTO '
      . $this->table . '
              (country)
              VALUES
              (:country)';


    //Prepare statement
    $stmt = $this->conn->prepare($query);

    // clean data
    $this->country = htmlspecialchars(strip_tags($this->country));


    //Bind data -> 
    $stmt->bindParam(':country', $this->country);


    //Execute query
    if ($stmt->execute()) {
      return true;
    }

    //Print error if something goes wrond
    printf("Error: %s.\n", $stmt->error);

    return false;
  }



  //Update country
  public function update()
  {
    // create query
    $query = 'UPDATE '
      . $this->table . '
              SET
              country = :country
              WHERE 
              id = :id';

    //Prepare statement
    $stmt = $this->conn->prepare($query);

    //Clean data
    $this->country = htmlspecialchars(strip_tags($this->country));


    // //Bind data
    $stmt->bindParam(':country', $this->country);
    $stmt->bindParam(':id', $this->id);


    //Execute query
    if ($stmt->execute()) {
      return true;
    }

    //Print error if something goes wrong
    printf("Error: %s.\n", $stmt->error);

    return false;
  }

  //Delete country
  public function delete()
  {
    //Create query
    $query = 'DELETE FROM ' . $this->table . ' WHERE id=:id';

    //Prepare statement
    $stmt = $this->conn->prepare($query);

    //Clean data
    $this->id = htmlspecialchars(strip_tags($this->id));

    //Bind data
    $stmt->bindParam(':id', $this->id);

    //Execute query
    if ($stmt->execute()) {
      return true;
    }

    //Print error if something goes wrong
    printf("Error: %s.\n", $stmt->error);

    return false;
  }
}
