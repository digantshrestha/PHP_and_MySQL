<?php

  class SQL_Config{
    private $conn,$result,$query,$pizzas;
    private $serverName, $userName, $password, $databaseName;
    private $title, $email, $ingredients;
    private $singleResult, $pizza;

    function __construct(){}

    function setQuery($query){
      $this->query=$query;
    }

    function setConn($serverName, $userName, $password, $databaseName){
      $this->serverName=$serverName;
      $this->userName=$userName;
      $this->password=$password;
      $this->databaseName=$databaseName;
    }

    public function connect(){
      $conn = mysqli_connect($this->serverName, $this->userName, $this->password, $this->databaseName);
      if(!$conn){
        return "Connection Error" . mysqli_connect_error();
      }
    }

    public function connection(){
      $conn = mysqli_connect($this->serverName, $this->userName, $this->password, $this->databaseName);
      if(!$conn){
        return "Connection Error" . mysqli_connect_error();
      }else{
        return $conn;
      }
    }

    public function getSQL(){
      $result = mysqli_query($this->connection(), $this->query);//make query to $conn and get query(result)
      $pizzas = mysqli_fetch_all($result, MYSQLI_ASSOC);//fetching result as associative array
      mysqli_free_result($result);//freeing memory from vriable $result
      mysqli_close($this->connection());//closing connection to DB
      return $pizzas;
    }

    public function getSingleSQL(){
      $singleResult = mysqli_query($this->connection(), $this->query);
      $pizza = mysqli_fetch_assoc($singleResult);//to get single record
      mysqli_free_result($singleResult);
      mysqli_close($this->connection());
      return $pizza;
    }

    public function setSQL(){
      if(mysqli_query($this->connection(), $this->query)){
        header('Location: index.php');
      }else{
        echo "Query error : " . mysqli_error($this->connection());
      }

    }

    public function queryCheck($title, $email, $ingredients){
      // mysqli_real_escape_string -> used to prevent maliceous sql code
      $this->title = mysqli_real_escape_string($this->connection(), $title);
      $this->email = mysqli_real_escape_string($this->connection(), $email);
      $this->ingredients = mysqli_real_escape_string($this->connection(), $ingredients);
    }

    public function getTitle(){
      return $this->title;
    }

    public function getEmail(){
      return $this->email;
    }

    public function getIngredients(){
      return $this->ingredients;
    }
  }

 ?>
