<?php

class Database {
    private $host = 'localhost';
    private $db_name = 'users';
    private $username = 'root';
    private $password = '';
    private $conn;

    public function getConnection() {
        $this->conn = null;

        try {
            $this->conn = new PDO("mysql:host={$this->host};dbname={$this->db_name}", $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->conn->exec("set names utf8");
        } catch (PDOException $exception) {
            echo "Connection error: " . $exception->getMessage();
        }

        return $this->conn;
    }
}

class User {
    private $db;
    private $table_name = 'user_data';

    public $id;
    public $username;
    public $password;
    public $email;
    public $phone;
    public $first_name;
    public $last_name;
    public $pet_name;

    public function __construct($db) {
        $this->db = $db;
    }

    public function register() {
        $query = "INSERT INTO {$this->table_name} 
                  SET username=:username, password=:password, email=:email, phone=:phone, 
                      first_name=:first_name, last_name=:last_name, pet_name=:pet_name";
    
        $stmt = $this->db->prepare($query);
    
        $this->sanitizeInput();
    
        // Хешируем пароль перед сохранением в базу данных
        $hashed_password = password_hash($this->password, PASSWORD_BCRYPT);
    
        $stmt->bindParam(':username', $this->username);
        $stmt->bindParam(':password', $hashed_password); // Используем хешированный пароль
        $stmt->bindParam(':email', $this->email);
        $stmt->bindParam(':phone', $this->phone);
        $stmt->bindParam(':first_name', $this->first_name);
        $stmt->bindParam(':last_name', $this->last_name);
        $stmt->bindParam(':pet_name', $this->pet_name);
    
        if ($stmt->execute()) {
            return true;
        }
    
        return false;
    }
    

    public function login() {
        $query = "SELECT id, username, password 
                  FROM {$this->table_name} 
                  WHERE username = :username";

        $stmt = $this->db->prepare($query);

        $this->sanitizeInput();

        $stmt->bindParam(':username', $this->username);

        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row && password_verify($this->password, $row['password'])) {
            $this->id = $row['id'];
            return true;
        }

        return false;
    }

    private function sanitizeInput() {
        $this->username = htmlspecialchars(strip_tags($this->username));
        $this->password = htmlspecialchars(strip_tags($this->password));
        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->phone = htmlspecialchars(strip_tags($this->phone));
        $this->first_name = htmlspecialchars(strip_tags($this->first_name));
        $this->last_name = htmlspecialchars(strip_tags($this->last_name));
        $this->pet_name = htmlspecialchars(strip_tags($this->pet_name));
    }

    public function getUserByUsername() {
        $query = "SELECT * FROM {$this->table_name} WHERE username = :username";
        $stmt = $this->db->prepare($query);
    
        $this->sanitizeInput();
    
        $stmt->bindParam(':username', $this->username);
    
        $stmt->execute();
    
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
        if ($row) {
            $this->id = $row['id'];
            $this->username = $row['username'];
            $this->email = $row['email'];
            $this->phone = $row['phone'];
            $this->first_name = $row['first_name'];
            $this->last_name = $row['last_name'];
            $this->pet_name = $row['pet_name'];
    
            return true;
        }
    
        return false;
    }
}

?>
