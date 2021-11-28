<?php

class DBConnection
{
    private $connection;

    public function __construct($host, $dbname, $username = 'root', $password = null)
    {
        try {
            $this->connection = new PDO("mysql:host={$host};dbname={$dbname}", $username, $password);
        }
        catch (PDOException $e){
            die('Connection failed: '.$e->getMessage());
        }
    }

    public function Query($query)
    {
        return $this->connection->query($query)->fetchAll(PDO::FETCH_ASSOC);
    }

    public function GetColumns($table, $columns)
    {
        $arg = implode(', ', $columns);
        $query = "SELECT $arg FROM $table";
        return $this->Query($query);
    }

    public function GetRow($table, $column, $value)
    {
        $query = "SELECT * FROM $table WHERE $column = $value";
        return $this->Query($query);
    }
}
