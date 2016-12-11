<?php
include('../databaseconn.php');

// remove all session variables
session_unset();

// destroy the session
session_destroy();
?>