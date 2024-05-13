<?php
require_once("simplex/src/SimpleXLSX.php");

// Function to save form data to an Excel file
function saveFormDataToExcel($filename, $formdata)
{
    var_dump(file_exists("simplex/src/SimpleXLSX.php"));
    var_dump(class_exists("SimpleXLSX"));

    $xlsx = new SimpleXLSX($filename);
    $sheet = $xlsx->sheetNames('Table1')[0];
    $xlsx->addRow($sheet, [$formdata['Name'], $formdata['Email'], $formdata['Phone'], $formdata['Message']]);
    $xlsx->save($filename);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $email = $_POST["mail"];
    $phone = $_POST["téléphone"];
    $message = $_POST["message"];

    $formData = [
        'Name' => $name,
        'Email' => $email,
        'Phone' => $phone,
        'Message' => $message
    ];

    $filename = 'Invit_Genesis.xlsx'; // modify this to the desired filename
    saveFormDataToExcel($filename, $formData);
}
?>