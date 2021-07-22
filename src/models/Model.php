<?php

class Model {
    protected static $tableName = '';
    protected static $columns = [];
    protected $values = [];

    function __construct($arr){
        $this->loadFromArray($arr);
    }

    public function loadFromArray($arr){
        if(isset($arr)){
            foreach($arr as $key => $value){
                $this->$key = $value;
            }
        }
    }

    public function __get($key){
        return $this->values[$key];
    }

    public function __set($key, $value){
        $this->values[$key] = $value;
    }

    public static function getResultSetFromSelect($filters = [],$columns = '*') {
        $sql = "SELECT $columns FROM ". static::$tableName. static::getFilters($filters);
        $result = Database::getResultFromQuery($sql);
        if($result->num_rows === 0){
            return null;
        }else{
            return $result;
        }
    }

    private static function getFilters($filters) {
        $sql = '';  
        if(count($filters) > 0){
            $sql .= " WHERE";
            foreach($filters as $key => $value){
                $value = static::getFormatedValue($value);
                $sql .= " $key = $value";
                if($key !== array_key_last($filters)){
                    $sql .= " and";
                }
            }
        }
        return $sql;
    }

    private static function getFormatedValue($value){
        if(is_null($value)){
            return "null";
        }else if (is_string($value)){
            return "'$value'";
        }else {
            return $value;
        }
    }
}
