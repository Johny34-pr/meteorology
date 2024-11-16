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
    // function select_all_order($tableName, $fields, $field = "id", $order = "ASC", $limit = null)
    // {
    //     $this->db_connect();
    //     $field_value = "SELECT {$fields} FROM {$tableName} ORDER BY {$field} {$order}";
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
        if ($this->result && $this->result->num_rows > 0) {
            while ($row = $this->result->fetch_assoc()) {
                $this->dataSet[] = $row;
            }
        }
        $this->sqlQuery->close();
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
    function update_operator($operators)
    {
        $this->db_connect();

        foreach ($operators as $operator) {

            $updateFields = $operator['updateFields'];
            $conditionName = $operator['name'];
            $conditionRegTime = $operator['reg_time'];

            // Készítse elő az `UPDATE` utasításhoz szükséges mezőket
            $setValues = "";
            $types = "";
            $bindParams = [];
            $i = 0;

            foreach ($updateFields as $key => $value) {
                if ($i > 0) {
                    $setValues .= ", ";
                }
                $setValues .= "$key = ?";
                $types .= is_string($value) ? "s" : (is_int($value) ? "i" : "d"); // String, Integer vagy Double
                $bindParams[] = $value;
                $i++;
            }

            // Az elsődleges kulcs feltételei (name és reg_time)
            $query = "UPDATE operators SET $setValues WHERE name = ? AND reg_time = ?";
            $this->sqlQuery = $this->connection->prepare($query);

            // Hozzáadjuk a `name` és `reg_time` mezők értékeit
            $types .= "ss"; // Mindkettő string
            $bindParams[] = $conditionName;
            $bindParams[] = $conditionRegTime;

            // Bind paraméterek biztonságosan
            $this->sqlQuery->bind_param($types, ...$bindParams);

            if (!$this->sqlQuery->execute()) {
                $this->sqlQuery->close();
                $this->db_disconnect();
            }

            $this->sqlQuery->close();
        }

        $this->db_disconnect();
        return true;
    }

    function delete_where($tableName, $field, $value)
    {
        $this->db_connect();
        $this->sqlQuery = $this->connection->prepare("DELETE FROM {$tableName} WHERE {$field} = {$value};");
        return $this->sqlQuery->execute();
        $this->result = $this->sqlQuery->get_result();
        $this->sqlQuery->close();
        $this->db_disconnect();
    }
    function delete_operator($dataset)
    {
        $this->db_connect();

        $whereClause = [];
        $values = [];

        // WHERE feltételek létrehozása a kapott dataset alapján
        foreach ($dataset as $condition) {

            $field = $condition['field'];
            $value = $condition['value'];

            $whereClause[] = "{$field} = ?";
            $values[] = $value;
        }

        // WHERE feltétel összeállítása
        $whereSql = implode(" AND ", $whereClause);
        $sql = "DELETE FROM operators WHERE {$whereSql}";

        // SQL utasítás előkészítése
        $this->sqlQuery = $this->connection->prepare($sql);

        // Bind paraméterek beállítása
        $types = str_repeat("s", count($values)); // Minden érték stringként kerül kezelésre
        $this->sqlQuery->bind_param($types, ...$values);

        // SQL utasítás végrehajtása
        $result = $this->sqlQuery->execute();
        $this->sqlQuery->close();

        $this->db_disconnect();

        return $result;
    }
    function delete_measurement($dataset)
    {
        $this->db_connect();

        // WHERE feltételek és értékek létrehozása
        $whereClause = [];
        $values = [];

        foreach ($dataset as $condition) {

            $field = $condition['field'];
            $value = $condition['value'];

            // Feltételek hozzárendelése a megfelelő mezőkhöz
            switch ($field) {
                case 'operator':
                    $whereClause[] = "o.name LIKE ?";
                    break;
                case 'instrument':
                    $whereClause[] = "i.name LIKE ?";
                    break;
                case 'timestamp':
                    $whereClause[] = "m.timestamp = ?";
                    break;
                default:
                    throw new InvalidArgumentException("Unknown field: $field");
            }

            $values[] = $value;
        }

        // WHERE feltétel SQL szöveg
        $whereSql = implode(" AND ", $whereClause);

        // Teljes SQL lekérdezés összeállítása
        $this->sqlQuery = file_get_contents($_SERVER["DOCUMENT_ROOT"] . "/core/sql/del_measure.sql");

        $this->sqlQuery = str_replace("{whereSql}", $whereSql, $this->sqlQuery);

        // SQL előkészítése
        $this->sqlQuery = $this->connection->prepare($this->sqlQuery);

        // Bind paraméterek beállítása
        $types = str_repeat("s", count($values)); // Minden értéket stringként kezelünk
        $this->sqlQuery->bind_param($types, ...$values);

        // SQL végrehajtása
        $result = $this->sqlQuery->execute();
        $this->sqlQuery->close();

        $this->db_disconnect();

        return $result;
    }

    function select_operators($field = "operator_id", $order = "ASC", $limit = null)
    {
        $this->db_connect();

        $this->sqlQuery = file_get_contents($_SERVER["DOCUMENT_ROOT"] . "/core/sql/operators.sql");

        $sqlParams = array(
            "{field}" => $field,
            "{order}" => $order
        );

        foreach ($sqlParams as $placeholder => $value) {
            $this->sqlQuery = str_replace($placeholder, $value, $this->sqlQuery);
        }

        if ($limit != null) {
            $this->sqlQuery = $this->connection->prepare($this->sqlQuery . " LIMIT {$limit};");
        } else {
            $this->sqlQuery = $this->connection->prepare($this->sqlQuery . ";");
        }

        $this->sqlQuery->execute();
        $this->result = $this->sqlQuery->get_result();
        $this->sqlQuery->close();
        if ($this->result->num_rows > 0) {
            $i = 0;
            while ($row = $this->result->fetch_assoc()) {
                $this->dataSet[$i] = $row;
                $i++;
            }
        }
        $this->db_disconnect();
        return $this->dataSet;
    }
    function select_stations()
    {
        $this->db_connect();

        $this->sqlQuery = $this->connection->prepare(file_get_contents($_SERVER["DOCUMENT_ROOT"] . "/core/sql/stations.sql"));

        $this->sqlQuery->execute();
        $this->result = $this->sqlQuery->get_result();
        $this->sqlQuery->close();
        if ($this->result->num_rows > 0) {
            $i = 0;
            while ($row = $this->result->fetch_assoc()) {
                $this->dataSet[$i] = $row;
                $i++;
            }
        }
        $this->db_disconnect();
        return $this->dataSet;
    }
    function listInstruments()
    {
        $this->db_connect();

        $this->sqlQuery = $this->connection->prepare(file_get_contents($_SERVER["DOCUMENT_ROOT"] . "/core/sql/instruments.sql"));

        $this->sqlQuery->execute();
        $this->result = $this->sqlQuery->get_result();
        $this->sqlQuery->close();
        if ($this->result->num_rows > 0) {
            $i = 0;
            while ($row = $this->result->fetch_assoc()) {
                $this->dataSet[$i] = $row;
                $i++;
            }
        }
        $this->db_disconnect();
        return $this->dataSet;
    }
    function select_measurements()
    {
        $this->db_connect();

        $this->sqlQuery = $this->connection->prepare(file_get_contents($_SERVER["DOCUMENT_ROOT"] . "/core/sql/measurements.sql"));

        $this->sqlQuery->execute();
        $this->result = $this->sqlQuery->get_result();
        $this->sqlQuery->close();
        if ($this->result->num_rows > 0) {
            $i = 0;
            while ($row = $this->result->fetch_assoc()) {
                $this->dataSet[$i] = $row;
                $i++;
            }
        }
        $this->db_disconnect();
        return $this->dataSet;
    }
}
