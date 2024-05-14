<!DOCTYPE html>
<html>
<head>
    <title>PHP Information</title>
</head>
<body>
    <h1>PHP Information</h1>
    <?php
        // Display PHP version
        echo "PHP Version: " . PHP_VERSION . "<br>";

        // Display server software and version
        echo "Server Software: " . $_SERVER['SERVER_SOFTWARE'] . "<br>";

        // Display server name
        echo "Server Name: " . $_SERVER['SERVER_NAME'] . "<br>";

        // Display document root
        echo "Document Root: " . $_SERVER['DOCUMENT_ROOT'] . "<br>";

        // Display PHP operating system
        echo "Operating System: " . PHP_OS . "<br>";
    ?>
</body>
</html>
