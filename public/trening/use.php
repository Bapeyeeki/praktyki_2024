<?php

require_once 'QueryBuilder.php';


$qb = new QueryBuilder();

$qb->table('users');


$selectQuery = $qb->select(['id', 'name', 'email'])
    ->where('id', '>', 10)
    ->orderBy('name')
    ->buildSelect();

echo "SELECT query: $selectQuery";

$updateQuery = $qb->update($updateData)
    ->where('id','=',5)
    ->buildUpdate();

echo "UPDATE query: $updateData";
