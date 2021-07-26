<?php

function requireValidSession() {
    if(!isset( $_SESSION['user'])){
        header('Location: login.php');
        exit();
    }
}