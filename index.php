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
        /* General Styling */
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 20px;
            background: linear-gradient(135deg, #f4f4f4, #dfe9f3);
            color: #333;
        }

        /* Headings */
        h2 {
            text-align: center;
            color: #273272;
            font-size: 28px;
            font-weight: bold;
            margin-bottom: 20px;
        }

        h3 {
            color: #007bff;
            font-size: 20px;
            margin-top: 20px;
            border-bottom: 2px solid #007bff;
            padding-bottom: 5px;
        }

        /* Form Styling */
        form {
            max-width: 600px;
            width: 100%;
            background: white;
            padding: 25px;
            margin: auto;
            border-radius: 12px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        /* Input Fields */
        input, select {
            width: 100%;
            padding: 10px;
            margin: 8px 0;
            border: 1px solid #ccc;
            border-radius: 6px;
            font-size: 16px;
            outline: none;
            transition: all 0.3s ease-in-out;
        }

        input:focus, select:focus {
            border-color: #007bff;
            box-shadow: 0 0 8px rgba(0, 123, 255, 0.3);
        }

        /* File Upload Styling */
        input[type="file"] {
            padding: 6px;
            background: #fff;
        }

        /* Button */
        button {
            width: 100%;
            padding: 12px;
            margin-top: 15px;
            background: #273272;
            color: white;
            font-size: 18px;
            font-weight: bold;
            cursor: pointer;
            border: none;
            border-radius: 25px;
            transition: 0.3s ease-in-out;
        }

        button:hover {
            background: #e70a0a;
            box-shadow: 0 4px 10px rgba(231, 10, 10, 0.3);
        }

        /* Checkbox Styling */
        .checkbox-label {
            display: flex;
            align-items: center;
            font-size: 16px;
            cursor: pointer;
            margin-top: 5px;
        }

        .styled-checkbox {
            width: 18px;
            height: 18px;
            margin-right: 10px;
        }

        /* Responsive Design */
        @media (max-width: 1024px) {
            form {
                max-width: 70%;
            }
        }

        @media (max-width: 768px) {
            form {
                max-width: 80%;
            }

            h2 {
                font-size: 24px;
            }

            h3 {
                font-size: 18px;
            }

            input, select, button {
                font-size: 14px;
                padding: 10px;
            }
        }

        @media (max-width: 480px) {
            form {
                max-width: 90%;
                padding: 15px;
            }

            h2 {
                font-size: 22px;
            }

            h3 {
                font-size: 16px;
            }

            input, select, button {
                font-size: 14px;
                padding: 8px;
            }
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
