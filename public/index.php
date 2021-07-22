<?php 
require_once(dirname(__FILE__, 2). '/src/config/config.php');
require_once(dirname(__FILE__, 2). '/src/models/User.php');

$user = new User(['name' => 'Lucas', 'email' => 'lucas@cod3r.com.br']);
// echo $user->getSelect('id,name');

echo User::getResultSetFromSelect(['id' => 1], 'name, email');
echo '<br>';
echo User::getResultSetFromSelect(['name' => 'Chaves', 'email' => 'chaves@cod3r.com.br']);

