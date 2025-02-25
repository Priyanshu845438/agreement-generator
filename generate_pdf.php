<?php
require_once('vendor/autoload.php');
require 'db_config.php'; // Ensure database connection is included

// Prevent unwanted output before PDF generation
ob_start();
error_reporting(0);

// Check if ID is passed
if (!isset($_GET['id']) || empty($_GET['id'])) {
    die("Invalid Agreement ID.");
}

$id = intval($_GET['id']);

// Fetch agreement details from database
$sql = "SELECT * FROM agreements WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$agreement = $result->fetch_assoc();

if (!$agreement) {
    die("Agreement not found.");
}

// Include TCPDF
require_once('vendor/tecnickcom/tcpdf/tcpdf.php');

// Create PDF instance
$pdf = new TCPDF();
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Operator Agreement');
$pdf->SetTitle('Operator Agreement');
$pdf->SetMargins(15, 15, 15);
$pdf->SetAutoPageBreak(TRUE, 15);
$pdf->AddPage();
$pdf->SetFont('helvetica', '', 12);

// Agreement content
$html = <<<EOD

<h2 style="text-align: center; font-size: 22px; color: #00004d;">OPERATOR AND OWNER AGREEMENT</h2>
<p>This agreement is made on <strong>{$agreement['submission_date']}</strong> at <strong>{$agreement['place']}</strong> between the following parties:</p>

<h3>1. Owner's Information:</h3>
<ul>
    <li><strong>Name:</strong> {$agreement['owner_name']}</li>
    <li><strong>Company Name:</strong> {$agreement['company_name']}</li>
    <li><strong>Company GST No / CIN No / Aadhar No:</strong> {$agreement['company_gst_cin_aadhar']}</li>
    <li><strong>Address:</strong> {$agreement['owner_address']}</li>
    <li><strong>Mobile Number:</strong> {$agreement['owner_mobile']}</li>
</ul>

<h3>2. Operator's Information:</h3>
<ul>
    <li><strong>Name:</strong> {$agreement['operator_name']}</li>
    <li><strong>Father's Name:</strong> {$agreement['operator_father_name']}</li>
    <li><strong>Permanent Address:</strong> {$agreement['operator_address']}</li>
    <li><strong>Mobile Number:</strong> {$agreement['operator_mobile']}</li>
    <li><strong>Driving License Number:</strong> {$agreement['operator_license']}</li>
    <li><strong>OESF ID NO:</strong> {$agreement['oesf_id']}</li>
</ul>

<h3>3. Job Details:</h3>
<ul>
    <li><strong>Type of Machine:</strong> {$agreement['machine_type']}</li>
    <li><strong>Work Location:</strong> {$agreement['work_location']}</li>
    <li><strong>Type of Work:</strong> {$agreement['work_type']}</li>
    <li><strong>Daily/Monthly Working Hours:</strong> {$agreement['working_hours']}</li>
</ul>

<h3>4. Salary and Payment Terms:</h3>
<ul>
    <li><strong>Salary:</strong> Rs{$agreement['salary']}</li>
    <li><strong>Payment Mode:</strong> {$agreement['payment_mode']}</li>
    <li><strong>Payment Date:</strong> {$agreement['payment_date']}</li>
</ul>

<h3>5. Other Benefits:</h3>
<ul>
    <li><strong>PF:</strong> {$agreement['pf']}</li>
    <li><strong>Insurance Facility:</strong> {$agreement['insurance']}</li>
    <li><strong>Food & Accommodation:</strong> {$agreement['food_accommodation']}</li>
    <li><strong>Weekly Off:</strong> {$agreement['weekly_off']}</li>
</ul>

<h3>6. Terms and Conditions:</h3>
<ul>
    <li>The operator must be present on time for work.</li>
    <li>Any damages will be handled as per company policy.</li>
    <li>Any disputes will be resolved as per Indian labor laws.</li>
</ul>

EOD;

// Write first part of the content
$pdf->writeHTML($html, true, false, true, false, '');

// **Force a page break before Point 7**
$pdf->AddPage();

// Second part of the agreement (7th point)
$html_page_2 = <<<EOD
<h3>7. Agreement Duration:</h3>
<p>This agreement will be valid from <strong>{$agreement['agreement_from']}</strong> to <strong>{$agreement['agreement_to']}</strong>.</p>

<p><strong>Owner's Signature:</strong> ________________</p>
<p><strong>Operator's Signature:</strong> ________________</p>
EOD;

// Write second part of the content
$pdf->writeHTML($html_page_2, true, false, true, false, '');

// Clear any output before sending PDF
ob_end_clean();

$pdf->Output('Operator_Agreement_'.$agreement['id'].'.pdf', 'D'); // Download as PDF

exit;
