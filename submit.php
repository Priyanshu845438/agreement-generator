<?php
include 'db_config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $place = $_POST['place'];
    $owner_name = $_POST['owner_name'];
    $company_name = $_POST['company_name'];
    $company_gst_cin_aadhar = $_POST['company_gst_cin_aadhar'];
    $owner_address = $_POST['owner_address'];
    $owner_mobile = $_POST['owner_mobile'];

    // Upload Owner's Document
    $owner_documents = 'uploads/' . basename($_FILES["owner_documents"]["name"]);
    move_uploaded_file($_FILES["owner_documents"]["tmp_name"], $owner_documents);

    $operator_name = $_POST['operator_name'];
    $operator_father_name = $_POST['operator_father_name'];
    $operator_address = $_POST['operator_address'];
    $operator_mobile = $_POST['operator_mobile'];
    $operator_license = $_POST['operator_license'];

    // Upload Operator's Document
    $operator_documents = 'uploads/' . basename($_FILES["operator_documents"]["name"]);
    move_uploaded_file($_FILES["operator_documents"]["tmp_name"], $operator_documents);

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

    $query = "INSERT INTO agreements (place, owner_name, company_name, company_gst_cin_aadhar, owner_address, owner_mobile, owner_documents, operator_name, operator_father_name, operator_address, operator_mobile, operator_license, operator_documents, oesf_id, machine_type, work_location, work_type, working_hours, salary, payment_mode, payment_date, pf, insurance, food_accommodation, weekly_off, agreement_from, agreement_to, owner_signature, operator_signature, submission_date)
              VALUES ('$place', '$owner_name', '$company_name', '$company_gst_cin_aadhar', '$owner_address', '$owner_mobile', '$owner_documents', '$operator_name', '$operator_father_name', '$operator_address', '$operator_mobile', '$operator_license', '$operator_documents', '$oesf_id', '$machine_type', '$work_location', '$work_type', '$working_hours', '$salary', '$payment_mode', '$payment_date', '$pf', '$insurance', '$food_accommodation', '$weekly_off', '$agreement_from', '$agreement_to', '$owner_signature', '$operator_signature', NOW())";

    echo "<style>
        .container {
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            background-color: #f9f9f9;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
            font-family: Arial, sans-serif;
        }
        .message {
            padding: 15px;
            font-size: 18px;
            color: green;
            font-weight: bold;
            background-color: #e6ffed;
            border-radius: 5px;
            display: inline-block;
            margin-bottom: 20px;
        }
        .button {
            padding: 12px 18px;
            background-color: #007BFF;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
            text-decoration: none;
            display: inline-block;
            margin-top: 10px;
        }
        .button.green {
            background-color: #28A745;
        }
        .button:hover {
            opacity: 0.9;
        }
        .documents {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 20px;
            margin-top: 20px;
            flex-wrap: wrap;
        }
        .document-box {
            text-align: center;
        }
        img {
            width: 250px;
            height: auto;
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 5px;
            margin-top: 10px;
        }
    </style>";

    if ($conn->query($query) === TRUE) {
        $last_id = $conn->insert_id; // Get the last inserted ID
        echo "<div class='container'>";
        echo "<p class='message'>Agreement submitted successfully!</p>";
        echo "<a href='download_agreement.php?id=$last_id' target='_blank' class='button'>Download Agreement</a>";
        echo "<div class='documents'>";

        // Display Owner's Document
        if (file_exists($owner_documents)) {
            $owner_ext = strtolower(pathinfo($owner_documents, PATHINFO_EXTENSION));
            echo "<div class='document-box'>";
            echo "<p><strong>Owner's Document:</strong></p>";
            if ($owner_ext === 'pdf') {
                echo "<a href='$owner_documents' download class='button'>Download PDF</a>";
            } elseif (in_array($owner_ext, ['jpg', 'jpeg', 'png'])) {
                echo "<img src='$owner_documents' alt='Owner Document'>";
                echo "<br><a href='$owner_documents' download class='button green'>Download Image</a>";
            }
            echo "</div>";
        }

        // Display Operator's Document
        if (file_exists($operator_documents)) {
            $operator_ext = strtolower(pathinfo($operator_documents, PATHINFO_EXTENSION));
            echo "<div class='document-box'>";
            echo "<p><strong>Operator's Document:</strong></p>";
            if ($operator_ext === 'pdf') {
                echo "<a href='$operator_documents' download class='button'>Download PDF</a>";
            } elseif (in_array($operator_ext, ['jpg', 'jpeg', 'png'])) {
                echo "<img src='$operator_documents' alt='Operator Document'>";
                echo "<br><a href='$operator_documents' download class='button green'>Download Image</a>";
            }
            echo "</div>";
        }

        echo "</div>"; // Close documents div
        echo "</div>"; // Close container div
    } else {
        echo "Error: " . $query . "<br>" . $conn->error;
        }
}
?>