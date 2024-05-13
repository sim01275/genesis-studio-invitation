<?php
require_once 'simplexlsx.class.php';

// Function to save form data to an Excel file
function saveFormDataToExcel($filename, $data)
{
    $xlsx = SimpleXLSX::parse($Invit_Genesis);
    $sheet = $xlsx->sheetNames()[0];
    $xlsx->addRow($sheet, [$data['Name'], $data['Email'], $data['Phone'], $data['Message']]);
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

    $filename = 'form_data.xlsx'; // modify this to the desired filename
    saveFormDataToExcel($filename, $formData);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Save Form Data to Excel</title>
</head>
<body>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required><br>

        <label for="mail">Email:</label>
        <input type="email" id="mail" name="mail" required><br>

        <label for="téléphone">Phone:</label>
        <input type="tel" id="téléphone" name="téléphone" required><br>

        <label for="message">Message:</label>
        <textarea id="message" name="message" rows="4" cols="50" required></textarea><br>

        <input type="submit" value="Submit">
    </form>
</body>
</html>