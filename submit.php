<?php
include 'db_config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $place = $_POST['place'];
    $owner_name = $_POST['owner_name'];
    $company_name = $_POST['company_name'];
    $company_gst_cin_aadhar = $_POST['company_gst_cin_aadhar'];
    $owner_address = $_POST['owner_address'];
    $owner_mobile = $_POST['owner_mobile'];

    // File Upload Function
    function uploadFile($file, $uploadDir = 'uploads/')
    {
        $allowedTypes = ['jpg', 'jpeg', 'png', 'pdf'];
        $fileName = basename($file["name"]);
        $targetPath = $uploadDir . $fileName;
        $fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

        if (in_array($fileExt, $allowedTypes)) {
            if (move_uploaded_file($file["tmp_name"], $targetPath)) {
                return $targetPath;
            }
        }
        return false;
    }

    $owner_documents = uploadFile($_FILES["owner_documents"]);
    $operator_documents = uploadFile($_FILES["operator_documents"]);

    $operator_name = $_POST['operator_name'];
    $operator_father_name = $_POST['operator_father_name'];
    $operator_address = $_POST['operator_address'];
    $operator_mobile = $_POST['operator_mobile'];
    $operator_license = $_POST['operator_license'];
    $oesf_id = $_POST['oesf_id'];
    $machine_type = $_POST['machine_type'];
    $work_location = $_POST['work_location'];
    $work_type = $_POST['work_type'];
    $working_hours = $_POST['working_hours'];
    $salary = $_POST['salary'];
    $payment_mode = $_POST['payment_mode'];
    $payment_date = $_POST['payment_date'];
    $pf = isset($_POST['pf']) ? 'Yes' : 'No';
    $insurance = isset($_POST['insurance']) ? 'Yes' : 'No';
    $food_accommodation = isset($_POST['food_accommodation']) ? 'Yes' : 'No';
    $weekly_off = $_POST['weekly_off'];
    $agreement_from = $_POST['agreement_from'];
    $agreement_to = $_POST['agreement_to'];
    $owner_signature = $_POST['owner_signature'];
    $operator_signature = $_POST['operator_signature'];

    // Secure Insert Query using Prepared Statement
    $query = "INSERT INTO agreements 
        (place, owner_name, company_name, company_gst_cin_aadhar, owner_address, owner_mobile, owner_documents, 
        operator_name, operator_father_name, operator_address, operator_mobile, operator_license, operator_documents, 
        oesf_id, machine_type, work_location, work_type, working_hours, salary, payment_mode, payment_date, 
        pf, insurance, food_accommodation, weekly_off, agreement_from, agreement_to, owner_signature, operator_signature, submission_date) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())";

    $stmt = $conn->prepare($query);
    $stmt->bind_param(
        "sssssssssssssssssssssssssssss",
        $place, $owner_name, $company_name, $company_gst_cin_aadhar, $owner_address, $owner_mobile, $owner_documents,
        $operator_name, $operator_father_name, $operator_address, $operator_mobile, $operator_license, $operator_documents,
        $oesf_id, $machine_type, $work_location, $work_type, $working_hours, $salary, $payment_mode, $payment_date,
        $pf, $insurance, $food_accommodation, $weekly_off, $agreement_from, $agreement_to, $owner_signature, $operator_signature
    );

    echo '<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agreement Submission</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5 text-center">
';

    if ($stmt->execute()) {
        $last_id = $conn->insert_id;
        echo '<div class="alert alert-success">Agreement submitted successfully!</div>';
        echo '<a href="download_agreement.php?id=' . $last_id . '" class="btn btn-primary mt-3">Download Agreement</a>';

        echo '<div class="row mt-4">';

        if ($owner_documents) {
            $owner_ext = pathinfo($owner_documents, PATHINFO_EXTENSION);
            echo '<div class="col-md-6">
                    <h5>Owner\'s Document:</h5>';
            if ($owner_ext === 'pdf') {
                echo '<a href="' . $owner_documents . '" class="btn btn-info" download>Download PDF</a>';
            } else {
                echo '<img src="' . $owner_documents . '" class="img-fluid rounded mt-2" style="max-width: 250px;" alt="Owner Document">
                      <br><a href="' . $owner_documents . '" class="btn btn-success mt-2" download>Download Image</a>';
            }
            echo '</div>';
        }

        if ($operator_documents) {
            $operator_ext = pathinfo($operator_documents, PATHINFO_EXTENSION);
            echo '<div class="col-md-6">
                    <h5>Operator\'s Document:</h5>';
            if ($operator_ext === 'pdf') {
                echo '<a href="' . $operator_documents . '" class="btn btn-info" download>Download PDF</a>';
            } else {
                echo '<img src="' . $operator_documents . '" class="img-fluid rounded mt-2" style="max-width: 250px;" alt="Operator Document">
                      <br><a href="' . $operator_documents . '" class="btn btn-success mt-2" download>Download Image</a>';
            }
            echo '</div>';
        }

        echo '</div>'; // Close row
    } else {
        echo '<div class="alert alert-danger">Error: ' . $stmt->error . '</div>';
    }

    echo '
    </div> 
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>';

    $stmt->close();
    $conn->close();
}
?>
