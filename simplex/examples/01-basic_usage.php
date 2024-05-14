<?php

use Shuchkin\SimpleXLSX;

// Enable error reporting and display errors
error_reporting(E_ALL);
ini_set('display_errors', true);

// Include the SimpleXLSX library
require_once __DIR__.'/../src/SimpleXLSX.php';

// Set the filename of the XLSX file to parse
$file = 'books.xlsx';

// Parse the XLSX file
if ($xlsx = SimpleXLSX::parse($file)) {
    // Display the rows of the parsed XLSX file
    echo '<h1>Parse ' . basename($file) . '</h1><pre>';
    print_r($xlsx->rows());
    echo '</pre>';
} else {
    // Display an error message if the XLSX file could not be parsed
    echo '<h1>Error parsing ' . basename($file) . '</h1><pre>';
    echo SimpleXLSX::parseError();
    echo '</pre>';
}

