<?php
class Account {

    private $con;
    private $errorArray = array();
    // creating an empty array so we can push all the errors (if any)

    // making constructor so that the code would run when the instance of account class is created
    // con is getting value from the register.php so no need to include the file
    public function __construct($con) {
        $this->con = $con; // in this we are initialising private $con; as con variable which is called from register.php
    }

    public function updateDetails($fn,$ln,$em, $un){
      $this->validateFirstName($fn);
      $this->validateLastName($ln);
      $this->validateNewEmail($em,$un);

        if(empty($this->errorArray)){
          $query = $this->con->prepare("UPDATE users SET firstName=:fn,lastName=:ln,email=:em
                                        WHERE username=:un");
          $query->bindValue(":fn", $fn);
          $query->bindValue(":ln", $ln);
          $query->bindValue(":em", $em);
          $query->bindValue(":un", $un);

          return $query->execute();
        }
        return false;
      }

    public function register($fn, $ln, $un, $em, $em2, $pw, $pw2) {
        $this->validateFirstName($fn);
        $this->validateLastName($ln);
        $this->validateUsername($un);
        $this->validateEmails($em, $em2);
        $this->validatePasswords($pw, $pw2);

        if(empty($this->errorArray)) {
            return $this->insertUserDetails($fn, $ln, $un, $em, $pw);
        }

        return false;
    }

    public function login($un, $pw) {


        $query = $this->con->prepare("SELECT * FROM users WHERE username=:un AND password=:pw");
        // using bindValue helps in prevent SQL injection as
        // people inject values into queries
        $query->bindValue(":un", $un);
        $query->bindValue(":pw", $pw);

        $query->execute();

        // counting the number of rows returned from the query
        if($query->rowCount() == 1) {
            return true;
        }

        array_push($this->errorArray, Constants::$loginFailed);
        return false;
    }

    private function insertUserDetails($fn, $ln, $un, $em, $pw) {

        $pw = hash("sha512", $pw);
        // SHA512 functions are no longer considered secure. The most secure current hash functions are BCRYPT, SCRYPT, and Argon2.

        $query = $this->con->prepare("INSERT INTO users (firstName, lastName, username, email, password)
                                        VALUES (:fn, :ln, :un, :em, :pw)");
        $query->bindValue(":fn", $fn);
        $query->bindValue(":ln", $ln);
        $query->bindValue(":un", $un);
        $query->bindValue(":em", $em);
        $query->bindValue(":pw", $pw);

        return $query->execute();
    }

    // checking First Name, length < 2 or > 25 display error
    private function validateFirstName($fn) {
        if(strlen($fn) <= 2 || strlen($fn) > 25) {
            array_push($this->errorArray, Constants::$firstNameCharacters);
        }
    }

    // checking Last Name, length < 2 or > 25 display error
    private function validateLastName($ln) {
        if(strlen($ln) < 2 || strlen($ln) > 25) {
            array_push($this->errorArray, Constants::$lastNameCharacters);
        }
    }

    private function validateUsername($un) {
        if(strlen($un) < 2 || strlen($un) > 25) {
            array_push($this->errorArray, Constants::$usernameCharacters);
            return;
        }

        $query = $this->con->prepare("SELECT * FROM users WHERE username=:un");
        $query->bindValue(":un", $un); // using bindValue to bind the variable's value

        $query->execute();

        if($query->rowCount() != 0) {
            array_push($this->errorArray, Constants::$usernameTaken);
        }
    }

    private function validateEmails($em, $em2) {
        if($em != $em2) {
            array_push($this->errorArray, Constants::$emailsDontMatch);
            return;
        }

        if(!filter_var($em, FILTER_VALIDATE_EMAIL)) {
            array_push($this->errorArray, Constants::$emailInvalid);
            return;
        }

        $query = $this->con->prepare("SELECT * FROM users WHERE email=:em");
        $query->bindValue(":em", $em);

        $query->execute();

        if($query->rowCount() != 0) {
            array_push($this->errorArray, Constants::$emailTaken);
        }
    }

    private function validateNewEmail($em, $un) {


        if(!filter_var($em, FILTER_VALIDATE_EMAIL)) {
            array_push($this->errorArray, Constants::$emailInvalid);
            return;
        }

        $query = $this->con->prepare("SELECT * FROM users WHERE email=:em AND username!=:un");
        $query->bindValue(":em", $em);
        $query->bindValue(":un", $un);

        $query->execute();

        if($query->rowCount() != 0) {
            array_push($this->errorArray, Constants::$emailTaken);
        }
    }

    private function validatePasswords($pw, $pw2) {
        if($pw != $pw2) {
            array_push($this->errorArray, Constants::$passwordsDontMatch);
            return;
        }

        if(strlen($pw) < 5 || strlen($pw) > 25) {
            array_push($this->errorArray, Constants::$passwordLength);
        }
    }

    public function getError($error) {
        // if any error is present in errorArray render it as html code
        if(in_array($error, $this->errorArray)) {
            // returning the error in a span htmlelement
            return "<span class='errorMessage'>$error</span>";
        }
    }
    public function getFirstError(){
          if(!empty($this->errorArray)){
            return $this->errorArray[0];
          }
    }
    public function updatePassword($oldPw, $pw, $pw2, $un){
        $this->validateOldPassword($oldPw, $un);
        $this->validatePasswords($pw,$pw2);
        if(empty($this->errorArray)){
          $query = $this->con->prepare("UPDATE users SET password=:pw
                                        WHERE username=:un");
          $pw = hash("sha512",$pw);

          $query->bindValue(":pw", $pw);
          $query->bindValue(":un", $un);

          return $query->execute();
        }
        return false;
      }

    public function validateOldPassword($oldPw, $un){
      $pw = hash("sha512",$oldPw);
      $query = $this->con->prepare("SELECT * FROM users WHERE username = :un AND password= :pw");
      $query->bindValue(":un", $un);
      $query->bindValue(":pw",$pw);

      $query->execute();
      if($query->rowCount() == 0){
          array_push($this->errorArray, Constants::$passwordIncorrect);
      }
    }
}
?>
