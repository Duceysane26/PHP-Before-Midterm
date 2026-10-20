<?php
session_start();

$errors = [];
$values = $_POST ?? [];

$fields = [
    "student_name" => "Student name",
    "pob" => "Place of birth",
    "dob" => "Date of birth",
    "address" => "Address",
    "gender" => "Gender",
    "telephone" => "Student telephone",
    "email" => "Email",
    "parent_name" => "Parent name",
    "parent_telephone" => "Parent telephone",
    "relationship" => "Relationship",
    "student_id" => "Student ID",
    "faculty" => "Faculty",
    "department" => "Department",
    "class" => "Class",
    "registration_date" => "Registration date"
];

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    foreach ($fields as $key => $label) {
        if (!isset($_POST[$key]) || trim($_POST[$key]) === "") {
            $errors[$key] = "$label is required.";
        }
    }

    $studentName = trim($_POST["student_name"] ?? "");
    if ($studentName !== "" && !preg_match("/^[\p{L} ]+$/u", $studentName)) {
        $errors["student_name"] = "Student name must contain only letters and spaces.";
    }

    $parentName = trim($_POST["parent_name"] ?? "");
    if ($parentName !== "" && !preg_match("/^[\p{L} ]+$/u", $parentName)) {
        $errors["parent_name"] = "Parent name must contain only letters and spaces.";
    }

    $email = trim($_POST["email"] ?? "");
    if ($email !== "" && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors["email"] = "Please enter a valid email address.";
    }

    if (!isset($_FILES["image"]) || $_FILES["image"]["error"] === UPLOAD_ERR_NO_FILE) {
        $errors["image"] = "Please upload a student image.";
    } elseif ($_FILES["image"]["error"] !== UPLOAD_ERR_OK) {
        $errors["image"] = "There was a problem uploading the image.";
    } else {
        $allowedTypes = [
            "image/jpeg" => "jpg",
            "image/png" => "png",
            "image/gif" => "gif",
            "image/pdf" => "pdf"
        ];
        $tmpPath = $_FILES["image"]["tmp_name"];
        $mimeType = mime_content_type($tmpPath);

        if (!array_key_exists($mimeType, $allowedTypes)) {
            $errors["image"] = "Image must be JPG, JPEG, PNG, or GIF.";
        } elseif ($_FILES["image"]["size"] > 3 * 1024 * 1024) {
            $errors["image"] = "Image size must be 3 MB or less.";
        }
    }

    if (empty($errors)) {
        $uploadDir = __DIR__ . "/uploads/";
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }

        $extension = $allowedTypes[$mimeType];
        $imageName = uniqid("student_", true) . "." . $extension;
        $destination = $uploadDir . $imageName;

        if (move_uploaded_file($_FILES["image"]["tmp_name"], $destination)) {
            $studentData = [];
            foreach ($fields as $key => $label) {
                $studentData[$label] = trim($_POST[$key]);
            }
            $studentData["Student image"] = "uploads/" . $imageName;

            $_SESSION["student_data"] = $studentData;
            header("Location: display.php");
            exit;
        } else {
            $errors["image"] = "Could not save the uploaded image. Check folder permissions.";
        }
    }
}

function oldValue($key, $values)
{
    return htmlspecialchars($values[$key] ?? "", ENT_QUOTES, "UTF-8");
}
function showError($key, $errors)
{
    if (isset($errors[$key])) {
        echo '<div class="text-danger small mt-1">' . htmlspecialchars($errors[$key], ENT_QUOTES, "UTF-8") . '</div>';
    }
}
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Student Registration Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        :root {
            --brand: #2457d6;
            --brand-dark: #173b9b;
            --page-bg: #f3f6fc;
            --line: #e4eaf5;
        }

        body {
            min-height: 100vh;
            background: radial-gradient(circle at top left, #e5edff 0, transparent 36%),
                linear-gradient(135deg, #f7f9fe 0%, var(--page-bg) 100%);
            color: #202b3c;
        }

        .form-card {
            max-width: 1000px;
            margin: 38px auto;
            border: 1px solid rgba(226, 233, 245, .9);
            border-radius: 22px;
            overflow: hidden;
            background: #fff;
            box-shadow: 0 20px 55px rgba(28, 55, 110, .12) !important;
        }

        .form-card .card-header {
            border: 0;
            background: linear-gradient(120deg, #2457d6, #3979f6) !important;
            padding: 32px 20px !important;
        }

        .form-card .card-header h2 {
            font-weight: 750;
            letter-spacing: -.5px;
        }

        .form-card .card-header p {
            color: rgba(255, 255, 255, .82);
        }

        .section-title {
            display: flex;
            align-items: center;
            gap: 12px;
            color: var(--brand-dark);
            font-size: 1.12rem;
            font-weight: 750;
            border-bottom: 1px solid var(--line);
            padding: 0 0 12px;
            margin: 30px 0 20px;
        }

        .section-title::before {
            content: "";
            width: 5px;
            height: 25px;
            flex: 0 0 5px;
            border-radius: 6px;
            background: linear-gradient(180deg, blue, white);
        }


        .form-label {
            color: #344054;
            font-weight: 650;
            margin-bottom: 7px;
        }

        .form-control,
        .form-select {
            min-height: 45px;
            border-color: #d8e0ed;
            border-radius: 10px;
            padding: 10px 13px;
            background-color: #fbfcff;
            transition: border-color .2s ease, box-shadow .2s ease, background-color .2s ease;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: #6793ff;
            background-color: #fff;
            box-shadow: 0 0 0 .22rem rgba(36, 87, 214, .12);
        }

        input[type="file"].form-control {
            padding: 7px 10px;
        }

        .form-text {
            color: #758198;
        }

        .alert-danger {
            border: 1px solid #f5c5ca;
            border-radius: 12px;
            box-shadow: 0 5px 18px rgba(180, 35, 24, .05);
        }

        .text-danger.small {
            font-weight: 500;
        }

        .btn {
            border-radius: 10px;
            font-weight: 650;
            padding: 11px 19px;
            transition: transform .15s ease, box-shadow .15s ease;
        }

        .btn-primary {
            border-color: white;
            background: linear-gradient(120deg, blue);
            box-shadow: 0 6px 14px rgba(36, 87, 214, .18);
        }

        .btn-primary:hover {
            border-color: white;
            background: linear-gradient(120deg,white,blue);
            transform: translateY(-1px);
        }

        .btn-outline-secondary {
            border-color: #d4dbe7;
            color: #475467;
        }

        @media (max-width: 576px) {
            .form-card {
                margin: 18px auto;
                border-radius: 16px;
            }

            .form-card .card-body {
                padding: 22px !important;
            }

            .form-card .card-header {
                padding: 25px 16px !important;
            }

            .form-card .card-header h2 {
                font-size: 1.55rem;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="card shadow form-card">
            <div class="card-header bg-primary text-white text-center py-4">
                <h2 class="mb-1">Student Registration</h2>
                <p class="mb-0">Enter all required information</p>
            </div>
            <div class="card-body p-4 p-md-5">
                <?php if (!empty($errors)): ?>
                    <div class="alert alert-danger">
                        <strong>Please correct the following:</strong>
                        <ul class="mb-0 mt-2">
                            <?php foreach ($errors as $message): ?>
                                <li><?= htmlspecialchars($message, ENT_QUOTES, "UTF-8") ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endif; ?>

                <form method="POST" action="index.php" enctype="multipart/form-data" novalidate>
                    <h4 class="section-title">1. Personal Information</h4>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="student_name" class="form-label">Full Name *</label>
                            <input class="form-control" id="student_name" name="student_name"
                                value="<?= oldValue('student_name', $values) ?>" required>
                            <?php showError("student_name", $errors); ?>
                        </div>
                        <div class="col-md-6">
                            <label for="pob" class="form-label">Place of Birth (POB) *</label>
                            <input class="form-control" id="pob" name="pob" value="<?= oldValue('pob', $values) ?>"
                                required>
                            <?php showError("pob", $errors); ?>
                        </div>
                        <div class="col-md-6">
                            <label for="dob" class="form-label">Date of Birth (DOB) *</label>
                            <input type="date" class="form-control" id="dob" name="dob"
                                value="<?= oldValue('dob', $values) ?>" required>
                            <?php showError("dob", $errors); ?>
                        </div>
                        <div class="col-md-6">
                            <label for="address" class="form-label">Address *</label>
                            <input class="form-control" id="address" name="address"
                                value="<?= oldValue('address', $values) ?>" required>
                            <?php showError("address", $errors); ?>
                        </div>
                        <div class="col-md-6">
                            <label for="gender" class="form-label">Gender *</label>
                            <select class="form-select" id="gender" name="gender" required>
                                <option value="">Choose gender</option>
                                <option value="Male" <?= oldValue('gender', $values) === 'Male' ? 'selected' : '' ?>>Male
                                </option>
                                <option value="Female" <?= oldValue('gender', $values) === 'Female' ? 'selected' : '' ?>>
                                    Female</option>
                            </select>
                            <?php showError("gender", $errors); ?>
                        </div>
                        <div class="col-md-6">
                            <label for="telephone" class="form-label">Telephone *</label>
                            <input type="tel" class="form-control" id="telephone" name="telephone"
                                value="<?= oldValue('telephone', $values) ?>" required>
                            <?php showError("telephone", $errors); ?>
                        </div>
                        <div class="col-md-6">
                            <label for="email" class="form-label">Email *</label>
                            <input type="email" class="form-control" id="email" name="email"
                                value="<?= oldValue('email', $values) ?>" required>
                            <?php showError("email", $errors); ?>
                        </div>
                        <div class="col-md-6">
                            <label for="image" class="form-label">Student Image (JPG, PNG, GIF) *</label>
                            <input type="file" class="form-control" id="image" name="image"
                                accept=".jpg,.jpeg,.png,.gif,image/jpeg,image/png,image/gif" required>
                            <?php showError("image", $errors); ?>
                            <div class="form-text">Maximum file size: 3 MB.</div>
                        </div>
                    </div>

                    <h4 class="section-title">2. Parent Information</h4>
                    <div class="row g-3">
                        <div class="col-md-4">
                            <label for="parent_name" class="form-label">Parent/Guardian Name *</label>
                            <input class="form-control" id="parent_name" name="parent_name"
                                value="<?= oldValue('parent_name', $values) ?>" required>
                            <?php showError("parent_name", $errors); ?>
                        </div>
                        <div class="col-md-4">
                            <label for="parent_telephone" class="form-label">Parent Telephone *</label>
                            <input type="tel" class="form-control" id="parent_telephone" name="parent_telephone"
                                value="<?= oldValue('parent_telephone', $values) ?>" required>
                            <?php showError("parent_telephone", $errors); ?>
                        </div>
                        <div class="col-md-4">
                            <label for="relationship" class="form-label">Relationship *</label>
                            <select class="form-select" id="relationship" name="relationship" required>
                                <option value="">Choose relationship</option>
                                <?php foreach (["Father", "Mother", "Guardian", "Other"] as $rel): ?>
                                    <option value="<?= $rel ?>" <?= oldValue('relationship', $values) === $rel ? 'selected' : '' ?>><?= $rel ?></option>
                                <?php endforeach; ?>
                            </select>
                            <?php showError("relationship", $errors); ?>
                        </div>
                    </div>

                    <h4 class="section-title">3. Academic Information</h4>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="student_id" class="form-label">Student ID *</label>
                            <input class="form-control" id="student_id" name="student_id"
                                value="<?= oldValue('student_id', $values) ?>" required>
                            <?php showError("student_id", $errors); ?>
                        </div>
                        <div class="col-md-6">
                            <label for="faculty" class="form-label">Faculty *</label>
                            <input class="form-control" id="faculty" name="faculty"
                                value="<?= oldValue('faculty', $values) ?>" required>
                            <?php showError("faculty", $errors); ?>
                        </div>
                        <div class="col-md-6">
                            <label for="department" class="form-label">Department *</label>
                            <input class="form-control" id="department" name="department"
                                value="<?= oldValue('department', $values) ?>" required>
                            <?php showError("department", $errors); ?>
                        </div>
                        <div class="col-md-6">
                            <label for="class" class="form-label">Class *</label>
                            <input class="form-control" id="class" name="class"
                                value="<?= oldValue('class', $values) ?>" required>
                            <?php showError("class", $errors); ?>
                        </div>
                        <div class="col-md-6">
                            <label for="registration_date" class="form-label">Registration Date *</label>
                            <input type="date" class="form-control" id="registration_date" name="registration_date"
                                value="<?= oldValue('registration_date', $values) ?>" required>
                            <?php showError("registration_date", $errors); ?>
                        </div>
                    </div>

                    <div class="d-flex gap-2 mt-4">
                        <button type="submit" class="btn btn-primary btn-lg">Register Student</button>
                        <button type="reset" class="btn btn-outline-secondary btn-lg">Clear Form</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const firstError = document.querySelector(".is-invalid");
            const errorMessages = document.querySelector(".alert-danger");
            if (errorMessages) {
                const text = errorMessages.innerText;
                const ids = ["student_name", "pob", "dob", "address", "gender", "telephone", "email", "image", "parent_name", "parent_telephone", "relationship", "student_id", "faculty", "department", "class", "registration_date"];
                for (const id of ids) {
                    const el = document.getElementById(id);
                    if (el && text.toLowerCase().includes(el.labels?.[0]?.innerText.replace("*", "").trim().toLowerCase())) {
                        el.focus();
                        el.scrollIntoView({ behavior: "smooth", block: "center" });
                        break;
                    }
                }
            }
        });
    </script>
</body>

</html>