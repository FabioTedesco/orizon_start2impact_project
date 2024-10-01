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
  public function read()
  {
    //create query
    $query = 'SELECT 
              id, country
              FROM
              ' . $this->table . ' 
              ORDER BY
              id ASC';

    //prepare statement
    $stmt = $this->conn->prepare($query);

    //Execute the query
    $stmt->execute();

    return $stmt;
  }

  //Get single Country
  public function read_single()
  {
    $query = 'SELECT 
              id, country
              FROM
              ' . $this->table . ' 
              WHERE
              id =  ?
              LIMIT 0,1';

    //prepare stmt
    $stmt = $this->conn->prepare($query);

    //Bind ID
    $stmt->bindParam(1, $this->id);

    //Execute the query
    $stmt->execute();

    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    // set properties
    $this->country = $row['country'];
  }

  //Crate post
  public function create()
  {
    // create query
    $query = 'INSERT INTO '
      . $this->table . '
              SET
              country = :country';


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

  //Delete post
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
