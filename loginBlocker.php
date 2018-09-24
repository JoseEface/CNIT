<?php

include_once "Controller\Acesso\LoginDefinitions.class.php";

if(session_status() == PHP_SESSION_NONE)
    session_start();

if(!isset($_SESSION[\Controller\Acesso\LoginDefinitions::SESSION_LOGIN_VAR]))
    header("Location: login.php");
    
?>