<?php

header('Content-Type: text/html; charset=UTF-8');

use Shuchkin\SimpleXLSX;

ini_set('error_reporting', E_ALL);
ini_set('display_errors', true);

$file = __DIR__.'/../src/SimpleXLSX.php';

if (!file_exists($file)) {
    die('File not found: '.$file);
}

require_once $file;

echo '<h1>Read several sheets</h1>';

try {
    $xlsx = SimpleXLSX::parse('countries_and_population.xlsx');

    echo '<pre>'.print_r($xlsx->sheetNames(), true).'</pre>';

    echo '<table cellpadding="10">
	<tr><td valign="top">';

    // output worksheet 1 (index = 0)

    $sheet = $xlsx->sheet(0);
    $dim = $sheet->dimension();
    $num_cols = $dim[0];
    $num_rows = $dim[1];

    echo '<h2>'.$xlsx->sheetName(0).'</h2>';
    echo '<table border=1>';
    foreach ($sheet->rows() as $r) {
        echo '<tr>';
        for ($i = 0; $i < $num_cols; $i ++) {
            echo '<td>' . htmlspecialchars(( ! empty($r[ $i ]) ? $r[ $i ] : '&nbsp;')) . '</td>';
        }
        echo '</tr>';
    }
    echo '</table>';

    echo '</td><td valign="top">';

    // output worsheet 2 (index = 1)

    $sheet = $xlsx->sheet(1);
    $dim = $sheet->dimension();
    $num_cols = $dim[0];
    $num_rows = $dim[1];

    echo '<h2>'.$xlsx->sheetName(1).'</h2>';
    echo '<table border=1>';
    foreach ($sheet->rows() as $r) {
        echo '<tr>';
        for ($i = 0; $i < $num_cols; $i ++) {
            echo '<td>' . htmlspecialchars(( ! empty($r[ $i ]) ? $r[ $i ] : '&nbsp;')) . '</td>';
        }
        echo '</tr>';
    }
    echo '</table>';

    echo '</td></tr></table>';

} catch (Exception $e) {
    echo $e->getMessage();
}

