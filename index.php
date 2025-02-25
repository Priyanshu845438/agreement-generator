<?php include 'db_config.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Operator Agreement Form</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <style>
        body {
    font-family: Arial, sans-serif;
    margin: 20px;
    padding: 20px;
    background-color: #f4f4f4;
}

h2 {
    font-family: 'Times New Roman', Times, serif;
    text-align: center;
    color: #273272;
    font-weight: 800;
}

h3 {
    text-align: center;
    color: #333;
}

form {
    width: 50%;
    margin: auto;
    background: white;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

input, select, button {
    width: 100%;
    padding: 10px;
    margin: 10px 0;
    border: 1px solid #ccc;
    border-radius: 5px;
}

button {
    background: #273272;
    color: white;
    font-size: 16px;
    cursor: pointer;
    border-radius: 15px;
}

button:hover {
    background: #e70a0a;
}

a {
    color: #007bff;
    text-decoration: none;
}

a:hover {
    text-decoration: underline;
}

.checkbox-label {
        font-size: 16px;
        font-weight: bold;
        color: #333;
        display: flex;
        align-items: center;
        margin-bottom: 10px;
        cursor: pointer;
    }

    /* Style the checkboxes */
    .styled-checkbox {
        appearance: none;
        width: 20px;
        height: 20px;
        border: 2px solid #007BFF;
        border-radius: 4px;
        margin-right: 10px;
        cursor: pointer;
        position: relative;
    }

    /* Checkbox checked state */
    .styled-checkbox:checked {
        background-color: #007BFF;
        border-color: #007BFF;
    }

    /* Checkbox checked - add tick mark */
    .styled-checkbox:checked::after {
        content: '✔';
        color: white;
        font-size: 14px;
        font-weight: bold;
        position: absolute;
        left: 4px;
        top: 1px;
    }

    </style>
</head>
<body>
    <h2>OPERATOR AND OWNER AGREEMENT FORM</h2>
    <form action="submit.php" method="POST" enctype="multipart/form-data">
        
        <h3>Owner's Information:</h3>
        Agreement Place: <input type="text" name="place" required><br>
        Name: <input type="text" name="owner_name" required><br>
        Company Name: <input type="text" name="company_name" required><br>
        GST/CIN/Aadhar: <input type="text" name="company_gst_cin_aadhar" required><br>
        Address: <input type="text" name="owner_address" required><br>
        Mobile: <input type="text" name="owner_mobile" required><br>
        Documents Upload: <input type="file" name="owner_documents" required><br>

        <h3>Operator's Information:</h3>
        Name: <input type="text" name="operator_name" required><br>
        Father's Name: <input type="text" name="operator_father_name" required><br>
        Address: <input type="text" name="operator_address" required><br>
        Mobile: <input type="text" name="operator_mobile" required><br>
        License Number: <input type="text" name="operator_license" required><br>
        Documents Upload: <input type="file" name="operator_documents" required><br>
        OESF ID: <input type="text" name="oesf_id"><br>

        <h3>Job Details:</h3>
        Machine Type: <input type="text" name="machine_type"><br>
        Work Location: <input type="text" name="work_location"><br>
        Work Type: <input type="text" name="work_type"><br>
        Working Hours: <input type="text" name="working_hours"><br>

        <h3>Salary and Payment:</h3>
        Salary: <input type="text" name="salary"><br>
        Payment Mode: 
        <select name="payment_mode">
            <option value="Bank">Bank</option>
            <option value="Cash">Cash</option>
        </select><br>
        Payment Date: <input type="date" name="payment_date"><br>

        <h3>Other Benefits:</h3><br>
        <label class="checkbox-label">
        <input type="checkbox" name="pf" value="Yes" class="styled-checkbox"> PF
        </label>
        <label class="checkbox-label">
            <input type="checkbox" name="insurance" value="Yes" class="styled-checkbox"> Insurance
        </label>
        <label class="checkbox-label">
            <input type="checkbox" name="food_accommodation" value="Yes" class="styled-checkbox"> Food & Accommodation
        </label>
        Weekly Off: <input type="text" name="weekly_off" required><br>

        <h3>Agreement Duration:</h3>
        From: <input type="date" name="agreement_from" required><br>
        To: <input type="date" name="agreement_to" required><br>

        <h3>Signatures:</h3>
        Owner's Signature: <input type="text" name="owner_signature"><br>
        Operator's Signature: <input type="text" name="operator_signature"><br><br>

        <button type="submit">Submit</button>
    </form>
</body>
</html>
