<?php

class DBConnection
{
    private PDO $connection;

    private function ConvertColumnsArray($columns) : array
    {
        $result = array();
        foreach ($columns as $column) {
            foreach ($column as $parameter) {
                $result[] = $parameter;
            }
        }
        return $result;
    }

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
        $arg = $columns;
        if(gettype($columns) == "array") {
            $arg = implode(', ', $columns);
        }
        $query = "SELECT $arg FROM $table";
        return $this->Query($query);
    }

    public function GetColumnsArray($table, $columns) : array
    {
        return $this->ConvertColumnsArray($this->GetColumns($table, $columns));
    }

    public function GetRow($table, $column, $value)
    {
        $query = "SELECT * FROM $table WHERE $column = $value";
        return $this->Query($query);
    }
}
