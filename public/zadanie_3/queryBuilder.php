<?php

class QueryBuilder {
    protected $table;
    protected $fields = [];
    protected $conditions = [];
    protected $orderBy;
    protected $updateData = [];
    
    public function table($table) {
        $this->table = $table;
        return $this;
    }
    
    public function select($fields = ['*']) {
        $this->fields = $fields;
        return $this;
    }
    
    public function where(string $column, $operator, $value) {
        $this->conditions[] = "$column $operator '$value'";
        return $this;
    }
    
    public function orderBy($column, $direction = 'ASC') {
        $this->orderBy = "$column $direction";
        return $this;
    }
    
    public function update(array $data) {
        $this->updateData = $data;
        return $this;
    }
    
    public function buildSelect() {
        $query = "SELECT " . implode(', ', $this->fields) . " FROM $this->table";
        
        if (!empty($this->conditions)) {
            $query .= " WHERE " . implode(' AND ', $this->conditions);
        }
        
        if (!empty($this->orderBy)) {
            $query .= " ORDER BY $this->orderBy";
        }
        
        return $query;
    }
    
    public function buildUpdate() {
        $query = "UPDATE $this->table SET ";
        
        $updates = [];
        foreach ($this->updateData as $column => $value) {
            $updates[] = "$column = '$value'";
        }
        
        $query .= implode(', ', $updates);
        
        if (!empty($this->conditions)) {
            $query .= " WHERE " . implode(' AND ', $this->conditions);
        }
        
        return $query;
    }
}

