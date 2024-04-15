<?php
class Database {
    private $servername = "mysql";
    private $username = "v.je";
    private $password = "v.je";
    private $dbname = "praktyki";
    private $conn;

    // Metoda łącząca z bazą danych
    public function connect() {
        $this->conn = null;

        try {
            $this->conn = new PDO("mysql:host=$this->servername;dbname=$this->dbname", $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }

        return $this->conn;
    }

    // Metoda pobierająca wszystkie notatki
    public function getNotes() {
        $query = 'SELECT * FROM notes';

        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt;
    }

    // Metoda dodająca nową notatkę
    public function addNote($title, $content) {
        $query = 'INSERT INTO notes (title, content) VALUES (:title, :content)';

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':content', $content);

        if($stmt->execute()) {
            return true;
        }

        printf("Błąd: %s.\n", $stmt->error);

        return false;
    }

    // Metoda pobierająca notatkę po ID
    public function getNoteById($id) {
        $query = 'SELECT * FROM notes WHERE id = :id';

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Metoda edytująca istniejącą notatkę
    public function editNote($id, $title, $content) {
        $query = 'UPDATE notes SET title = :title, content = :content WHERE id = :id';

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':content', $content);

        if($stmt->execute()) {
            return true;
        }

        printf("Błąd: %s.\n", $stmt->error);

        return false;
    }

    // Metoda usuwająca istniejącą notatkę
    public function deleteNote($id) {
        $query = 'DELETE FROM notes WHERE id = :id';

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);

        if($stmt->execute()) {
            return true;
        }

        printf("Błąd: %s.\n", $stmt->error);

        return false;
    }
}