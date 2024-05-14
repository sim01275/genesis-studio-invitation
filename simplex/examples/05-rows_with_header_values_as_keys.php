<?php

declare(strict_types=1);

use Shuchkin\SimpleXLSX;

ini_set('error_reporting', E_ALL);
ini_set('display_errors', true);

require_once __DIR__.'/../src/SimpleXLSX.php';

function parseXlsxFile(string $filePath): array
{
    /** @var SimpleXLSX $xlsx */
    if (!$xlsx = SimpleXLSX::parse_file($filePath)) {
        throw new \RuntimeException('Unable to parse XLSX file.');
    }

    $rows = [];
    $headerValues = [];

    foreach ($xlsx->rows() as $k => $r) {
        if ($k === 0) {
            $headerValues = $r;
            continue;
        }

        if (empty($r)) {
            continue;
        }

        try {
            $rows[] = array_combine($headerValues, $r);
        } catch (\Exception $e) {
            // Handle the case where the number of columns in a row is different from the header row
            continue;
        }
    }

    return $rows;
}

$filePath = 'books.xlsx';

try {
    $rows = parseXlsxFile($filePath);
    print_r($rows);
} catch (\Exception $e) {
    echo 'An error occurred: '.$e->getMessage();
}
