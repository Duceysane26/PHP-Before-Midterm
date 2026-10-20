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
        body {
            min-height: 100vh;
            background: radial-gradient(circle at top right, #dff8ed 0, transparent 34%),
                linear-gradient(135deg, #f7f9fe 0%, #f1f5fb 100%);
            color: #202b3c;
        }

        .result-card {
            max-width: 950px;
            margin: 40px auto;
            border: 1px solid #e4eaf5;
            border-radius: 22px;
            overflow: hidden;
            background: #fff;
            box-shadow: 0 20px 55px rgba(28, 55, 110, .12) !important;
        }

        .result-card .card-header {
            border: 0;
            background: linear-gradient(120deg, #087f5b, #20a879) !important;
            padding: 30px 20px !important;
        }

        .result-card .card-header h2 {
            font-weight: 750;
            letter-spacing: -.4px;
        }

        .result-card .card-header p {
            color: rgba(255, 255, 255, .84);
        }

        .student-photo {
            width: 125px;
            height: 125px;
            object-fit: cover;
            border: 5px solid #fff;
            border-radius: 20px;
            box-shadow: 0 8px 25px rgba(16, 24, 40, .15);
        }

        .table {
            border-color: #e1e8f2;
            margin-bottom: 0;
        }

        .table thead th {
            color: #173b9b;
            background: #eaf0ff !important;
            font-weight: 750;
            padding: 14px 16px;
        }

        .table tbody th {
            width: 34%;
            color: #344054;
            background: #f7f9fd !important;
            font-weight: 650;
        }

        .table td,
        .table tbody th {
            padding: 13px 16px;
        }

        .table-striped>tbody>tr:nth-of-type(odd)>* {
            --bs-table-bg-type: #fcfdff;
        }

        .btn {
            border-radius: 10px;
            font-weight: 650;
            padding: 10px 17px;
        }

        .btn-primary {
            border-color: #2457d6;
            background: linear-gradient(120deg, #2457d6, #3979f6);
        }

        .btn-primary:hover {
            background: #173b9b;
            border-color: #173b9b;
        }

        @media (max-width: 576px) {
            .result-card {
                margin: 18px auto;
                border-radius: 16px;
            }

            .result-card .card-body {
                padding: 22px !important;
            }

            .table td,
            .table tbody th {
                padding: 10px;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="card shadow result-card">
            <div class="card-header bg-success text-white text-center py-4">
                <h2 class="mb-1">Diiwaangelinta waa lagu guuleeystay</h2>
                <p class="mb-0">Xogta ardayga si guul leh ayaa loo gudbiyay</p>
            </div>
            <div class="card-body p-4 p-md-5">
                <div class="text-center mb-4">
                    <img class="student-photo" src="<?= htmlspecialchars($imagePath, ENT_QUOTES, "UTF-8") ?>"
                        alt="Student image">
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered table-striped align-middle">
                        <thead class="table-primary">
                            <tr>
                                <th>Information</th>
                                <th>Submitted Details</th>
                            </tr>
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