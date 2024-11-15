<?php

include "sqlConfig.php";

class MySql extends db_config
{
    public $dataSet;
    private $connection, $sqlQuery, $result;

    function __construct()
    {
        parent::__construct();
    }
    private function db_connect()
    {
        $this->connection = new mysqli($this->serverName, $this->userName, $this->password, $this->dbName);
        $this->dataSet = null;
        if ($this->connection->connect_error) {
            die("Adatbázis kapcsolat létrehozása sikertelen: " . $this->connection->connect_error);
        }
        return $this->connection;
    }
    private function db_disconnect()
    {
        $this->connection = NULL;
        $this->sqlQuery = NULL;
        $this->result;
    }
    // function select_all($tableName, $field = "id", $order = "ASC")
    // {
    //     $this->db_connect();
    //     $this->sqlQuery = $this->connection->prepare("SELECT * FROM {$tableName} ORDER BY {$field} {$order};");
    //     $this->sqlQuery->execute();
    //     $this->result = $this->sqlQuery->get_result();
    //     $this->sqlQuery->close();
    //     if ($this->result->num_rows > 0) {
    //         $i = 0;
    //         while ($row = $this->result->fetch_assoc()) {
    //             $this->dataSet[$i] = $row;
    //             $i++;
    //         }
    //     }
    //     $this->db_disconnect();
    //     return $this->dataSet;
    // }
    // function select_all_where($dbName, $tableName, $condition, $value, $fields = "*", $field = "id", $order = "ASC")
    // {
    //     $this->db_connect();
    //     $this->sqlQuery = $this->connection->prepare("SELECT {$fields} FROM {$dbName}.{$tableName} WHERE {$condition} = ? ORDER BY $field $order;");
    //     $this->sqlQuery->bind_param('s', $value);
    //     $this->sqlQuery->execute();
    //     $this->result = $this->sqlQuery->get_result();
    //     $this->sqlQuery->close();
    //     if ($this->result->num_rows > 0) {
    //         $i = 0;
    //         while ($row = $this->result->fetch_assoc()) {
    //             $this->dataSet[$i] = $row;
    //             $i++;
    //         }
    //     }
    //     $this->db_disconnect();
    //     return $this->dataSet;
    // }
    // function select_all_order($dbName, $tableName, $fields, $field = "id", $order = "ASC", $limit = null)
    // {
    //     $this->db_connect();
    //     $field_value = "SELECT {$fields} FROM {$dbName}.{$tableName} ORDER BY {$field} {$order}";
    //     if ($limit != null) {
    //         $this->sqlQuery = $this->connection->prepare($field_value . " LIMIT {$limit};");
    //     } else {
    //         $this->sqlQuery = $this->connection->prepare($field_value . ";");
    //     }

    //     $this->sqlQuery->execute();
    //     $this->result = $this->sqlQuery->get_result();
    //     $this->sqlQuery->close();
    //     if ($this->result->num_rows > 0) {
    //         $i = 0;
    //         while ($row = $this->result->fetch_assoc()) {
    //             $this->dataSet[$i] = $row;
    //             $i++;
    //         }
    //     }
    //     $this->db_disconnect();
    //     return $this->dataSet;
    // }
    function select_where($tableName, $condition, $value, $fields = "*")
    {
        $this->db_connect();
        $this->sqlQuery = $this->connection->prepare("SELECT {$fields} FROM {$tableName} WHERE BINARY {$condition} = ?;");
        $this->sqlQuery->bind_param('s', $value);
        $this->sqlQuery->execute();
        $this->result = $this->sqlQuery->get_result();
        $this->sqlQuery->close();
        if ($this->result->num_rows > 0) {
            $this->dataSet = $this->result->fetch_assoc();
        }
        $this->db_disconnect();
        return $this->dataSet;
    }
    function insert_into($tableName, $data)
    {
        $this->db_connect();

        $fields = implode(", ", array_keys($data));
        $values = str_repeat("?, ", count($data) - 1) . "?";

        $types = '';
        $bindParams = array();
        foreach ($data as $key => $value) {
            if (is_int($value)) {
                $types .= 'i';
            } else {
                $types .= 's';
            }
            $bindParams[] = &$data[$key];
        }

        $statement = $this->connection->prepare("INSERT INTO {$tableName} ($fields) VALUES ($values);");
        if (!$statement) {
            return false;
        }

        $bindParams = array();
        $bindParams[] = &$types;
        foreach ($data as $key => $value) {
            $bindParams[] = &$data[$key];
        }

        call_user_func_array(array($statement, 'bind_param'), $bindParams);

        $result = $statement->execute();
        $statement->close();

        $this->db_disconnect();
        return $result;
    }
    // function update_where($dbName, $tableName, $data, $conditionField, $conditionValue)
    // {
    //     $this->db_connect();

    //     $setValues = "";
    //     $types = "";
    //     $bindParams = array();
    //     $i = 0;
    //     foreach ($data as $key => $value) {
    //         if ($i > 0) {
    //             $setValues .= ", ";
    //         }
    //         $setValues .= "$key = ?";
    //         if (is_string($value)) {
    //             $types .= "s";
    //         } else if (is_int($value)) {
    //             $types .= "i";
    //         }
    //         $bindParams[] = &$data[$key];
    //         $i++;
    //     }

    //     $statement = $this->connection->prepare("UPDATE {$dbName}.{$tableName} SET {$setValues} WHERE {$conditionField} = ?");

    //     if (!$statement) {
    //         return false;
    //     }

    //     if (is_string($conditionValue)) {
    //         $types .= "s";
    //     } else if (is_int($conditionValue)) {
    //         $types .= "i";
    //     }
    //     $bindParams[] = &$conditionValue;
    //     $bindParams = array_merge(array($types), $bindParams);
    //     call_user_func_array(array($statement, 'bind_param'), $bindParams);

    //     $result = $statement->execute();
    //     $statement->close();

    //     $this->db_disconnect();
    //     return $result;
    // }
    // function delete_where($dbName, $tableName, $field, $value)
    // {
    //     $this->db_connect();
    //     $this->sqlQuery = $this->connection->prepare("DELETE FROM {$dbName}.{$tableName} WHERE {$field} = {$value};");
    //     return $this->sqlQuery->execute();
    //     $this->result = $this->sqlQuery->get_result();
    //     $this->sqlQuery->close();
    //     $this->db_disconnect();
    // }
    // function delete_where_and($dbName, $tableName, $dataset)
    // {
    //     $this->db_connect();

    //     $whereClause = [];
    //     $values = [];

    //     foreach ($dataset as $field => $value) {
    //         $whereClause[] = "{$field} = ?";
    //         $values[] = $value;
    //     }

    //     $whereSql = implode(" AND ", $whereClause);
    //     $query = "DELETE FROM {$dbName}.{$tableName} WHERE {$whereSql}";

    //     $this->sqlQuery = $this->connection->prepare($query);

    //     $types = str_repeat("i", count($values));
    //     $this->sqlQuery->bind_param($types, ...$values);

    //     $result = $this->sqlQuery->execute();
    //     $this->sqlQuery->close();
    //     $this->db_disconnect();

    //     return $result;
    // }
}
