<?php

use Shuchkin\SimpleXLSX;

ini_set('error_reporting', E_ALL);
ini_set('display_errors', true);

require_once __DIR__.'/../src/SimpleXLSX.php';

function isValidXlsx($filename) {
    $pathinfo = pathinfo($filename);
    return $pathinfo['extension'] === 'xlsx';
}

function getMaxRows() {
    return 50;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check for nonce
    if (!isset($_POST['nonce']) || !wp_verify_nonce($_POST['nonce'], 'xlsx_to_html')) {
        die('Invalid security token');
    }

    // Check for file
    if (!isset($_FILES['file']) || !is_uploaded_file($_FILES['file']['tmp_name'])) {
        die('No file uploaded');
    }

    // Check for file type
    if (!isValidXlsx($_FILES['file']['name'])) {
        die('Invalid file type. Please upload a .xlsx file.');
    }

    // Parse the XLSX file
    try {
        $xlsx = SimpleXLSX::parse($_FILES['file']['tmp_name']);
    } catch (Exception $e) {
        echo 'Error parsing XLSX: ' . $e->getMessage();
        exit;
    }

    // Display the parsed data
    echo '<h1>XLSX to HTML</h1>';
    echo '<h2>Parsing Result</h2>';
    echo '<table border="1" cellpadding="3" style="border-collapse: collapse; overflow-x: auto;">';

    $dim = $xlsx->dimension();
    $cols = $dim[0];

    $max_rows = getMaxRows();
    $row_count = 0;

    foreach ($xlsx->readRows() as $k => $r) {
        if ($row_count >= $max_rows) {
            break;
        }
        echo '<tr>';
        for ($i = 0; $i < $cols; $i ++) {
            echo '<td>' . ( isset($r[ $i ]) ? $r[ $i ] : '&nbsp;' ) . '</td>';
        }
        echo '</tr>';
        $row_count++;
    }
    echo '</table>';
}
?>

<h2>Upload form</h2>
<form method="post" enctype="multipart/form-data">
    <input type="hidden" name="nonce" value="<?php echo wp_create_nonce('xlsx_to_html'); ?>">
    *.XLSX <input type="file" name="file" />&nbsp;&nbsp;<input type="submit" value="Parse" />
</form>
