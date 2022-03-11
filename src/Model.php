<?php

namespace Src;

require_once DOCUMENT_ROOT . "/config/dbconfig.php";


use Mysqli;

class Model
{
    public $table = '';
    public $query = '';

    public function __construct()
    {
        $db = new Mysqli(HOST, USER, PASSWORD, DATABASE);

        if ($db->connect_error) {
            die('Error: ' . $db->connect_error);
        }

        $this->db = $db;

        return $this;
    }

    public function insert($columnValues)
    {
        if (is_array($columnValues) && !empty($columnValues)) {
            $this->query = "INSERT INTO `$this->table`";

            $this->query .= ' (`' . implode('`, `', array_keys($columnValues)) . '`)';
            $this->query .= " VALUES ('" . implode("', '", $columnValues) . "')";
        }

        return $this;
    }

    public function update($columnValues, $id)
    {
        if (is_array($columnValues) && !empty($columnValues)) {
            $this->query = "UPDATE `$this->table` SET ";
            
            $numItems = count($columnValues);
            $i = 0;
            foreach($columnValues as $key => $value) {
              if ($i === $numItems - 1) {
                $i++;
                $this->query .= "`$key` = '$value' ";
              } else {
                $i++;
                $this->query .= "`$key` = '$value', ";
              }
            }

            $this->query .= " WHERE `id` = $id";
        }

        return $this;
    }

    public function delete($recordId)
    {
        if (isset($recordId) && $recordId > 0)
        {
            $this->query = "DELETE FROM `$this->table` WHERE `id` = $recordId";
        }

        return $this;
    }

    public function select($columns, $id = false)
    {
        if (is_array($columns) && !empty($columns)) {
            $this->query = "SELECT `$columns[0]`";
            if (count($columns) > 1) {
                for ($i = 1; $i < count($columns); $i++) {
                    $this->query .= ',`' . $columns[$i] . '`';
                }
            }

            $sqlWhere = '';
            if ($id) {
                $sqlWhere = " WHERE `id` = $id";
            }

            $this->query .= " FROM `$this->table` $sqlWhere";
        }

        return $this;
    }

    // public function from()
    // {
    //     if (is_string($this->table) && strlen($this->table) > 0) {
    //         $this->query .= " FROM `$this->table`";
    //     }

    //     return $this;
    // }

    public function run()
    {
        if ($this->db->query($this->query)) {
            return true;
        } 

        $this->db->close();

        return false;
    }

    // it is used with select method
    public function get()
    {
        if ($result = $this->db->query($this->query)) {
            $resultFinal = [];

            while (($row = $result->fetch_assoc()) != null) {
                $resultFinal[] = $row;
            }

            return $resultFinal;
        } 

        $this->db->close();

        return false;
    }
}