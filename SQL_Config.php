<?php

  class SQL_Config{
    private $conn,$result,$query,$pizzas,$serverName, $userName, $password, $databaseName;

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

    public function process(){
      $result = mysqli_query($this->connection(), $this->query);//make query to $conn and get query(result)
      $pizzas = mysqli_fetch_all($result, MYSQLI_ASSOC);//fetching result as associative array
      mysqli_free_result($result);//freeing memory from vriable $result
      mysqli_close($this->connection());//closing connection to DB
      return $pizzas;
    }
  }

 ?>
