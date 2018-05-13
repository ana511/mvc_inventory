<?php 
  class Accounts{
    public function __construct(){
      
    }

    private function validate($user){
      try{
        if(isset($user['name']) && strlen($user['name']) < 3){
          throw new Exception("name");
        }

        if(strlen($user['username']) < 4){
          throw new Exception("invalid username");
        }

        if(isset($user['email']) && filter_var($user['email'], FILTER_VALIDATE_EMAIL) == false){
          throw new Exception("invalid email");
        }

        if(strlen($user['password']) < 4){
          throw new Exception("invalid password");
        }
      }
      catch(Exception $e){
        return $e->getMessage();
      }

      return true;
    }

    private function sanitize(){ 
      $user;

      if(sizeof($_POST) === 4){
        $user = array(
          "username" => filter_var($_POST['username'], FILTER_SANITIZE_STRING),
          "password" => filter_var($_POST['password'], FILTER_SANITIZE_STRING)
        );
      }
      else{
        $user = array(
          "name"     => filter_var($_POST['name'], FILTER_SANITIZE_STRING),
          "username" => filter_var($_POST['username'], FILTER_SANITIZE_STRING),
          "email"    => filter_var($_POST['email'], FILTER_SANITIZE_EMAIL),
          "password" => filter_var($_POST['password'], FILTER_SANITIZE_STRING)
        );
      }

      return $user;
    }

    static function register(){
      global $mysqli;

      $user = SELF::sanitize();
      $isValid = SELF::validate($user);

      if($isValid){
        // $user['password'] = md5($user['password']);
        $query_string = "INSERT INTO users(name, username, email, password) VALUES( ? , ?, ?, ? )";
        $statement = $mysqli->prepare($query_string);
        $statement->bind_param("ssss", $user['name'], $user['username'], $user['email'], $user['password']);

        if($statement->execute() == true){
          return true;
        }
        return $mysqli->error;
      }

      return $isValid;
    }

    static function signIn(){
      global $mysqli;

      $user = SELF::sanitize();
      $isValid = SELF::validate($user);

      if($isValid === true){
        $query_string = "SELECT * FROM users WHERE username=? AND password=?";
        $statement = $mysqli->prepare($query_string);
        $statement->bind_param("ss", $user['name'], $user['password']);

        $result = $statement->execute();

        if($result->num_rows > 0){
          return true;
        }
        else{
          echo "a user with a matching username and password could not be found";
        }
      }

      return $isValid;
    }

    private function createUsersTable(){
      global $mysqli;

      $query_string = "
        CREATE TABLE IF NOT EXISTS users (
          id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
          name VARCHAR(30),
          username VARCHAR(30) NOT NULL,
          email VARCHAR(50) NOT NULL,
          password VARCHAR(100) NOT NULL,
          reg_date TIMESTAMP,
          role VARCHAR(10)
        )";


      if($mysqli->query($query_string) == true) 
        echo "users table created successfully";
      else 
        echo "an error occurred : " . $mysqli->error;
    }
    
    static function getUsers(){
      global $mysqli;

      if(SELF::isAdmin()){
        $query_string = "SELECT * FROM users";
        $result = $mysqli->query($query_string);

        if($result->num_rows > 0)
          return $result->fetch_all(MYSQLI_ASSOC);
        else
          return "an error occurred: " . $mysqli->error;
      }

      return "access denied - You do not have permission to perform this action";
    }

    static function deleteUser(){
      global $mysqli;

      if(SELF::isAdmin()){
        $query_string = "DELETE FROM users WHERE username=?";
        $statement = $mysqli->prepare($query_string);
        $statement->bind_param("s", $_SESSION['username']);

        if($statement->execute() == true)
          return true;
        else
          return "an error occurred: " . $mysqli->error;
      }

      return "access denied - You do not have permission to perform this action";
    }

    static function isAdmin(){
      global $mysqli;

      $username = isset($_SESSION['username']) ? $_SESSION['username'] : 'unknown';
      $role = 'admin';

      $query_string = "SELECT role FROM users WHERE username=? AND role=?";
      $statement = $mysqli->prepare($query_string);
      $statement->bind_param("ss", $username, $role);
      $result = $statement->execute();

      if($result->num_rows > 0)
        return true;
      else
        return "an error occurred: " . $mysqli->error;
    }
  }
?>