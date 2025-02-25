<?php
include 'db_config.php';
$sql = "SELECT * FROM agreements";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Submitted Agreements</title>
    <link rel="stylesheet" href="agreements.css">
</head>
<body>
    <h2>Submitted Agreements</h2>
    <table border="1">
        <tr>
            <th>Submition Date & Time</th>
            <th>Agreement Place</th>
            <th>Owner Name</th>
            <th>Company Name</th>
            <th>Operator Name</th>
            <th>OESF ID</th>
            <th>Operator's Contact Details</th>
            <th>Download Agreement</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()) { ?>
        <tr>
            <td><?= $row["submission_date"]; ?></td>
            <td><?= $row["place"]; ?></td>
            <td><?= $row["owner_name"]; ?></td>
            <td><?= $row["company_name"]; ?></td>
            <td><?= $row["operator_name"]; ?></td>
            <td><?= $row["oesf_id"]; ?></td>
            <td><?=$row["operator_mobile"]; ?></td>
            <td>
                <a href="generate_pdf.php?id=<?= urlencode($row["id"]); ?>" target="_blank">Download Agreement</a>
            </td>

        </tr>
        <?php } ?>
    </table>
</body>
</html>
