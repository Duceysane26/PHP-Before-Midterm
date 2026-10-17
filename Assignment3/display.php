<?php
session_start();

if (!isset($_SESSION["student_data"])) {
    header("Location: index.php");
    exit;
}

$data = $_SESSION["student_data"];
$imagePath = $data["Student image"];
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Registered Student Information</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background: #f2f5f9; }
        .result-card { max-width: 950px; margin: 40px auto; border: 0; border-radius: 16px; overflow: hidden; }
        .student-photo { width: 115px; height: 115px; object-fit: cover; border-radius: 12px; }
        th { width: 34%; background: #f3f6fa !important; }
    </style>
</head>
<body>
<div class="container">
    <div class="card shadow result-card">
        <div class="card-header bg-success text-white text-center py-4">
            <h2 class="mb-1">Registration Successful</h2>
            <p class="mb-0">Student information submitted successfully</p>
        </div>
        <div class="card-body p-4 p-md-5">
            <div class="text-center mb-4">
                <img class="student-photo" src="<?= htmlspecialchars($imagePath, ENT_QUOTES, "UTF-8") ?>" alt="Student image">
            </div>
            <div class="table-responsive">
                <table class="table table-bordered table-striped align-middle">
                    <thead class="table-primary">
                        <tr><th>Information</th><th>Submitted Details</th></tr>
                    </thead>
                    <tbody>
                    <?php foreach ($data as $label => $value): ?>
                        <?php if ($label !== "Student image"): ?>
                            <tr>
                                <th><?= htmlspecialchars($label, ENT_QUOTES, "UTF-8") ?></th>
                                <td><?= nl2br(htmlspecialchars($value, ENT_QUOTES, "UTF-8")) ?></td>
                            </tr>
                        <?php endif; ?>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <div class="d-flex gap-2 flex-wrap mt-4">
                <a href="index.php" class="btn btn-primary">Register Another Student</a>
                <a href="index.php?new=1" class="btn btn-outline-secondary">Back to Form</a>
            </div>
        </div>
    </div>
</div>
</body>
</html>
