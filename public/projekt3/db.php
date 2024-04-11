<?php
class Database {
    private $servername = "mysql";
    private $username = "v.je";
    private $password = "v.je";
    private $dbname = "praktyki";
    private $conn;

    // Metoda do uzyskiwania połączenia z bazą danych
    public function __construct() {
        try {
            $this->conn = new PDO("mysql:host=$this->servername;dbname=$this->dbname", $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }

    public function getConnection() {
        return $this->conn;
    }

    public function createTask($task, $status) {
        $sql = "INSERT INTO tasks (task, status) VALUES (:task, :status)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':task', $task);
        $stmt->bindParam(':status', $status);
        return $stmt->execute();
    }

    public function deleteTask($id) {
        $sql = "DELETE FROM tasks WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

    public function changeStatus($id) {
        $sql = "UPDATE tasks SET status = 'done' WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

    public function getRecords(string $search, string $sort_by) {
        $sql = "SELECT * FROM tasks";
    
        if(!empty($search)) {
            $sql .= " WHERE task LIKE :search";
        }
    
        if($sort_by === 'status') {
            $sql .= " ORDER BY status ASC"; // Zmiana na odpowiednią kolumnę statusu zadania
        } elseif ($sort_by === 'task') {
            $sql .= " ORDER BY task ASC";
        }
    
        // Create prepared statement
        $stmt = $this->conn->prepare($sql);
    
        if (!empty($search)) {
            // Bind parameters 
            $stmt->bindValue(':search', "%$search%", PDO::PARAM_STR);
        }
    
        // Execute 
        $stmt->execute();
    
        $records = []; // Tablica na rekordy
    
        while ($row = $stmt->fetch()) {
            if(empty($search) || strpos($row['task'], $search) !== false) {
                $status = ($row['status'] == 0) ? 'Nie zrobione' : 'Skończone';
    
                // Dodajemy rekord do tablicy
                $records[] = [
                    'id' => $row['id'],
                    'task' => $row['task'],
                    'status' => $status,
                    'delete_link' => "list.php?delete={$row['id']}",
                    'done_link' => "list.php?done={$row['id']}"
                ];
            }
        }
    
        return $records;
    }
}