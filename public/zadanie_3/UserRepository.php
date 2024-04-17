<?php

require_once 'QueryBuilder.php';
//require_once 'Database.php'; 

class UserRepository {
    protected $db;
    protected $qb;
    
    public function __construct(Database $db) { // Wstrzykujemy obiekt Database do konstruktora
        $this->db = $db->getConnection(); // Pobieramy połączenie z obiektu Database
        $this->qb = new QueryBuilder();
    }
    
    public function findUsersBySurname($surname) {
        $query = $this->qb->table('clients')
                    ->select(['user_id', 'name', 'surname', 'address'])
                    ->where('surname', '=', $surname)
                    ->buildSelect();
        
        $statement = $this->db->query($query);
        $users = $statement->fetchAll(PDO::FETCH_ASSOC);
        
        return $users;
    }
    
    public function getUserById($userId) {
        $query = $this->qb->table('clients')
                    ->select(['user_id', 'name', 'surname', 'address'])
                    ->where('user_id', '=', $userId)
                    ->buildSelect();
        
        $statement = $this->db->query($query);
        $user = $statement->fetch(PDO::FETCH_ASSOC);
        
        return $user;
    }

    public function updateUser($userId, $data) {
        $query = $this->qb->table('clients') 
                    ->update($data)
                    ->where('user_id', '=', $userId)
                    ->buildUpdate();
        
        $this->db->exec($query);
    }
}
