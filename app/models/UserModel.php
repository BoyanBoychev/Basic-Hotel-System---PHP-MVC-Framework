<?php

class UserModel
{
    protected $pdo;

    public function __construct()
    {
        try {
            $this->pdo = new PDO('mysql:host=localhost;dbname=hotel', 'root', '');
            echo "Database connection successful!<br>";  // Debug output
        } catch (PDOException $e) {
            die('Database connection failed: ' . $e->getMessage());
        }
    }


    //Create new user with hashed password
    public function createUser($email, $password)
    {
        $stmt = $this->pdo->prepare("INSERT INTO users (email, password) VALUES (:email, :password)");
        return $stmt->execute(['email' => $email, 'password' => $password]);
    }

    //Check if user already exist
    public function emailExists($email)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE email =:email");
        $stmt->execute(['email' => $email]);
        return $stmt->fetch() !== false;
    }

    //Find user by email for login
    public function findUserByEmail($email)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE email = :email");
        $stmt->execute(['email' => $email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
