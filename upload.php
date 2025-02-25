<?php
include 'db_config.php'; // Ensure database connection is included

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $uploadDir = "uploads/";

    // Ensure folders exist
    if (!is_dir($uploadDir . "owners")) {
        mkdir($uploadDir . "owners", 0777, true);
    }
    if (!is_dir($uploadDir . "operators")) {
        mkdir($uploadDir . "operators", 0777, true);
    }

    // Handle Owner Document Upload
    if (!empty($_FILES["owner_document"]["name"])) {
        $ownerFileName = basename($_FILES["owner_document"]["name"]);
        $ownerFilePath = $uploadDir . "owners/" . time() . "_" . $ownerFileName; // Unique filename

        if (move_uploaded_file($_FILES["owner_document"]["tmp_name"], $ownerFilePath)) {
            $ownerDocPath = $ownerFilePath;
        } else {
            die("Error uploading owner document.");
        }
    } else {
        $ownerDocPath = "";
    }

    // Handle Operator Document Upload
    if (!empty($_FILES["operator_document"]["name"])) {
        $operatorFileName = basename($_FILES["operator_document"]["name"]);
        $operatorFilePath = $uploadDir . "operators/" . time() . "_" . $operatorFileName;

        if (move_uploaded_file($_FILES["operator_document"]["tmp_name"], $operatorFilePath)) {
            $operatorDocPath = $operatorFilePath;
        } else {
            die("Error uploading operator document.");
        }
    } else {
        $operatorDocPath = "";
    }

    // Insert into database
    $sql = "INSERT INTO agreements (owner_document, operator_document) VALUES ('$ownerDocPath', '$operatorDocPath')";
    
    if ($conn->query($sql) === TRUE) {
        echo "Documents uploaded successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>
