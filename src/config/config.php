<?php
date_default_timezone_set('America/Recife');
setlocale(LC_TIME, 'pt-BR', 'pt_BR.utf-8', 'portuguese');

// Pastas 

define('MODEL_PATH', realpath(dirname(__FILE__) . '/../models'));

require_once(realpath(dirname(__FILE__) . '/database.php'));
