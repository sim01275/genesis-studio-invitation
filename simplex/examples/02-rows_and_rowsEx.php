<?php

use Shuchkin\SimpleXLSX;

ini_set('error_reporting', E_ALL);
ini_set('display_errors', true);

$filePath = __DIR__.'/../src/SimpleXLSX.php';

if (!file_exists($filePath) || !is_readable($filePath)) {
    die('SimpleXLSX.php file not found or not readable.');
}

require_once $filePath;

echo '<h1>rows() and rowsEx()</h1>';

if ($xlsx = SimpleXLSX::parse('books.xlsx')) {
    echo '<h2>$xlsx->rows()</h2>';
    echo '<pre>';
    print_r($xlsx->rows());
    echo '</pre>';

    echo '<h2>$xlsx->rowsEx()</h2>';
    echo '<pre>';
    print_r($xlsx->rowsEx());
    echo '</pre>';
} else {
    echo '<p>Error: ' . htmlspecialchars(SimpleXLSX::parseError()) . '</p>';
}
