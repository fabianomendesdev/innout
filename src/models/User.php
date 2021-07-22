<?php
require_once(realpath(MODEL_PATH . '/Model.php'));

class User extends Model { 
    protected static $tableName = 'users';
    protected static $columns = ['id','name','password','email','start_data','end_date','is_admin'];

    function __construct($arr){
        parent:: __construct($arr);
    }
}