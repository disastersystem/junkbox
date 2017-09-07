<?php
class USER {
    private $db;
    private $errors = [];

    function __construct($DB_con) {
      $this->db = $DB_con;
    }

    public function register($uname, $upass) {

        //$this->check_unique_name($uname);

        if ( !(empty($uname)) || !(empty($upass)) ) {
            if ( strlen(trim($uname)) <= 5 || strlen(trim($upass)) <= 5 ) {
                $this->errors[] = "Username and password must be atleast 6 characters long.<br>";
                return false;
            }
        } else {
            $this->errors[] = "You need to type a username and password.<br>";
            return false;
        }

        try {
            $new_password = password_hash($upass, PASSWORD_DEFAULT);

            $stmt = $this->db->prepare("INSERT INTO users(username, password) VALUES(:uname, :upass)");

            $stmt->bindparam(":uname", $uname);
            $stmt->bindparam(":upass", $new_password);
            if ( $stmt->execute() ) {
                $this->login($uname, $upass);
                return true;
            } else {
                return false;
            }
        }
        catch(PDOException $e) {
            $this->errors[] = "The username is already taken.<br>";
            return false;
        }
    }

    public function login($uname, $upass) {
       try {
          $stmt = $this->db->prepare("SELECT * FROM users WHERE username=:uname LIMIT 1");
          $stmt->execute(array(':uname' => $uname));
          $userRow = $stmt->fetch(PDO::FETCH_ASSOC);
          if($stmt->rowCount() > 0) {
             if(password_verify($upass, $userRow['password'])) {
                $_SESSION['user_session'] = $userRow['username'];
                $_SESSION['profile_img'] = $userRow['profile_img'];
                return true;
             } else {
                $this->errors[] = "Wrong username or password.<br>";
                return false;
             }
         } else {
             $this->errors[] = "Wrong username or password.<br>";
         }
       }
       catch(PDOException $e) {
           return false;
       }
   }

    public function is_loggedin() {
        if(isset($_SESSION['user_session'])) {
            return true;
        } else {
            return false;
        }
    }

   public function logout() {
        session_destroy();
        unset($_SESSION['user_session']);
        return true;
   }

   public function check_unique_name($uname) {
       try {
          $stmt = $DB_con->prepare("SELECT username FROM users WHERE username=:uname");
          $stmt->execute(array(':uname' => $uname));
          $row = $stmt->fetch(PDO::FETCH_ASSOC);

          if($row['username'] == $uname) {
             $this->errors[] = "Sorry, the username is already taken!<br>";
             return false;
          }

          return true;
      }
      catch(PDOException $e) {
        return false;
      }
   }

   public function get_errors() {
       return $this->errors;
   }

}

?>
