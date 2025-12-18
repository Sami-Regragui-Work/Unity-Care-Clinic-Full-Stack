<?php

$h = 'localhost';
$un = 'frogsam';
$p = '@Sr181202#Localhost'; // I was thinking to encrypt this one, but the methods seems to need their own documentation, later then
$db = 'UCCV1';

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT); //automatic error show, and exception throwing

try {
    $dbLink = new mysqli($h, $un, $p, $db);
    // ech/o 'Connection succeeded<br>';
} catch (mysqli_sql_exception $err) {
    die('Connection failed due to the following exception: ' . $err->getMessage());
}

// "b" <=> blob (binary data for files... etc)
