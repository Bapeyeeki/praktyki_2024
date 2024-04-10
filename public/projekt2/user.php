<?php
require_once 'database.php';

class User {
    private $conn;

    public function __construct() {
        $db = new Database();
        $this->conn = $db->getConnection();
    }

    public function register($username, $password) {
        $stmt = $this->conn->prepare("INSERT INTO users (login, password) VALUES (:username, :password)");
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $password);
        return $stmt->execute();
    }

    public function isUsernameTaken($username) {
        $stmt = $this->conn->prepare("SELECT id FROM users WHERE login = :username");
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result !== false;
    }

    public function login($username, $password) {
        $stmt = $this->conn->prepare("SELECT id, login, password FROM users WHERE login = :username");
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['password'])) {
            return $user['id'];
        } else {
            return false;
        }
    }

    public function addClient($user_id, $client_name, $client_surname, $client_address) {
        $stmt = $this->conn->prepare("INSERT INTO clients (user_id, name, surname, address) VALUES (:user_id, :name, :surname, :address)");
        $stmt->bindParam(':user_id', $user_id);
        $stmt->bindParam(':name', $client_name);
        $stmt->bindParam(':surname', $client_surname);
        $stmt->bindParam(':address', $client_address);
        return $stmt->execute();
    }

    public function addCompany($user_id, $company_name, $company_address) {
        $stmt = $this->conn->prepare("INSERT INTO companies (user_id, name, address) VALUES (:user_id, :name, :address)");
        $stmt->bindParam(':user_id', $user_id);
        $stmt->bindParam(':name', $company_name);
        $stmt->bindParam(':address', $company_address);
        return $stmt->execute();
    }

    public function getClients($user_id) {
        $stmt = $this->conn->prepare("SELECT id,name, surname FROM clients WHERE user_id = :user_id");
        $stmt->bindParam(':user_id', $user_id);
        if (!$stmt->execute()) {
            print_r($stmt->errorInfo());
            return null;
        }
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function getCompanies($user_id) {
        $stmt = $this->conn->prepare("SELECT id,name FROM companies WHERE user_id = :user_id");
        $stmt->bindParam(':user_id', $user_id);
        if (!$stmt->execute()) {
            print_r($stmt->errorInfo());
            return null;
        }
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getClientById($user_id, $client_id) {
        $stmt = $this->conn->prepare("SELECT id, name, surname, address FROM clients WHERE user_id = :user_id AND id = :client_id");
        $stmt->bindParam(':user_id', $user_id);
        $stmt->bindParam(':client_id', $client_id);
        if (!$stmt->execute()) {
            print_r($stmt->errorInfo());
            return null;
        }
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getCompanyById($user_id, $company_id) {
        $stmt = $this->conn->prepare("SELECT id, name, address FROM companies WHERE id = :company_id AND user_id = :user_id");
        $stmt->bindParam(':company_id', $company_id);
        $stmt->bindParam(':user_id', $user_id);
        if (!$stmt->execute()) {
            print_r($stmt->errorInfo());
            return null;
        }
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function updateClient($user_id, $client_id, $new_name, $new_surname, $new_address) {
        $stmt = $this->conn->prepare("UPDATE clients SET name = :new_name, surname = :new_surname, address = :new_address WHERE id = :client_id AND user_id = :user_id");
        $stmt->bindParam(':new_name', $new_name);
        $stmt->bindParam(':new_surname', $new_surname);
        $stmt->bindParam(':new_address', $new_address);
        $stmt->bindParam(':client_id', $client_id);
        $stmt->bindParam(':user_id', $user_id);
        return $stmt->execute();
    }

    public function updateCompany($user_id, $company_id, $new_name, $new_address) {
        $stmt = $this->conn->prepare("UPDATE companies SET name = :name, address = :address WHERE id = :company_id AND user_id = :user_id");
        $stmt->bindParam(':name', $new_name);
        $stmt->bindParam(':address', $new_address);
        $stmt->bindParam(':company_id', $company_id);
        $stmt->bindParam(':user_id', $user_id);
        return $stmt->execute();
    }

    public function deleteClient($user_id, $client_id) {
        $stmt = $this->conn->prepare("DELETE FROM clients WHERE id = :client_id AND user_id = :user_id");
        $stmt->bindParam(':client_id', $client_id);
        $stmt->bindParam(':user_id', $user_id);
        return $stmt->execute();
    }

    public function deleteCompany($user_id, $company_id) {
        $stmt = $this->conn->prepare("DELETE FROM companies WHERE id = :company_id AND user_id = :user_id");
        $stmt->bindParam(':company_id', $company_id);
        $stmt->bindParam(':user_id', $user_id);
        return $stmt->execute();
    }
}