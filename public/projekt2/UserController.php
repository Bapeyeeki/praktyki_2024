<?php
require_once 'User.php';

class UserController {
    private $userModel;

    public function __construct($conn) {
        $this->userModel = new User($conn);
    }

    public function registerUser($username, $password) {
        if ($this->userModel->isUsernameTaken($username)) {
            return "Użytkownik o tej nazwie już istnieje.";
        } else {
            $password_hash = password_hash($password, PASSWORD_DEFAULT);
            if ($this->userModel->register($username, $password_hash)) {
                return "Rejestracja udana. Możesz się zalogować.";
            } else {
                return "Błąd podczas rejestracji.";
            }
        }
    }


    public function addClient($client_name, $client_surname, $client_address) {
        if(isset($_SESSION['user_id'])) {
            $user_id = $_SESSION['user_id'];
            return $this->userModel->addClient($user_id, $client_name, $client_surname, $client_address);
        } else {
            return "Błąd: użytkownik niezalogowany.";
        }
    }

    public function addCompany($company_name, $company_address) {
        if(isset($_SESSION['user_id'])) {
            $user_id = $_SESSION['user_id'];
            return $this->userModel->addCompany($user_id, $company_name, $company_address);
        } else {
            return "Błąd: użytkownik niezalogowany.";
        }
    }

    public function getClients($user_id) {
        return $this->userModel->getClients($user_id);
    }

    public function getCompanies($user_id) {
        return $this->userModel->getCompanies($user_id);
    }

    public function updateClient($user_id, $client_id, $new_name, $new_surname, $new_address) {
        return $this->userModel->updateClient($user_id, $client_id, $new_name, $new_surname, $new_address);
    }

    public function updateCompany($user_id, $company_id, $new_name, $new_address) {
        return $this->userModel->updateCompany($user_id, $company_id, $new_name, $new_address);
    }

    public function getClientById($user_id, $client_id) {
        return $this->userModel->getClientById($user_id, $client_id);
    }

    public function getCompanyById($user_id, $company_id) {
        return $this->userModel->getCompanyById($user_id, $company_id);
    }

    public function deleteClient($user_id, $client_id) {
        return $this->userModel->deleteClient($user_id, $client_id);
    }

    public function deleteCompany($user_id, $company_id) {
        return $this->userModel->deleteCompany($user_id, $company_id);
    }

}
?>