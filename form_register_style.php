<?php

$success = false;
$errMsg = "";
$nameErr = "";
$emailErr = "";

if (isset($_POST["submit"])) {

    $success = true;

    if (empty($_POST["fullname"])) {
        $success = false;
        $nameErr = "* Please fill fullname field!";
    }

    if (empty($_POST["email"])) {
        $success = false;
        $emailErr = "* Please fill email field!";
    }

    if (!$success) {
        $errMsg = "Please fill all required fields.";
    }

    if ($success) {
        echo '<div class="container mt-4">
        <div class="row justify-content-center"><div class="col-md-8 col-lg-7">
                <div class="alert alert-success">
                    <h4 class="alert-heading">Student Information</h4>
                    <hr>';

        echo "Fullname: " . htmlspecialchars($_POST["fullname"]) . "<br>";
        echo "Email: " . htmlspecialchars($_POST["email"]) . "<br>";
        echo "Place of Birth: " . htmlspecialchars($_POST["pob"] ?? "") . "<br>";

        if (!empty($_POST["gender"])) {
            echo "Gender: " . htmlspecialchars($_POST["gender"]) . "<br>";
        }

        echo "Faculty: " . htmlspecialchars($_POST["faculty"] ?? "") . "<br>";

        echo "Languages: ";
        if (isset($_POST["languages"])) {
            echo htmlspecialchars(implode(", ", $_POST["languages"]));
        }

        echo "<br>";
        echo "Comment: " . htmlspecialchars($_POST["comment"] ?? "") . "<br>";

        echo '  </div>
              </div> </div>
              </div>';
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Job Application</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

    <div class="container py-5">

        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-7">

                <div class="card shadow">

                    <div class="card-header bg-primary text-white text-center py-3">
                        <h2 class="mb-0">Job Application Form</h2>
                    </div>

                    <div class="card-body">

                        <?php if (!empty($errMsg)) { ?>
                            <div class="alert alert-danger">
                                <?php echo htmlspecialchars($errMsg); ?>
                            </div>
                        <?php } ?>

                        <form method="post" action="">

                            <fieldset>
                                <legend class="text-primary mb-3">
                                    Personal Information
                                </legend>

                                <!-- Fullname -->
                                <div class="mb-3">
                                    <label for="fullname" class="form-label">
                                        Fullname <span class="text-danger">*</span>
                                    </label>

                                    <input type="text" class="form-control" id="fullname" name="fullname"
                                        placeholder="Enter your fullname" value="<?php
                                        if (!$success && isset($_POST["fullname"])) {
                                            echo htmlspecialchars($_POST["fullname"]);
                                        }
                                        ?>">

                                    <div class="text-danger small">
                                        <?php echo htmlspecialchars($nameErr); ?>
                                    </div>
                                </div>

                                <!-- Email -->
                                <div class="mb-3">
                                    <label for="email" class="form-label">
                                        Email <span class="text-danger">*</span>
                                    </label>

                                    <input type="email" class="form-control" id="email" name="email"
                                        placeholder="Enter your email" value="<?php
                                        if (!$success && isset($_POST["email"])) {
                                            echo htmlspecialchars($_POST["email"]);
                                        }
                                        ?>">

                                    <div class="text-danger small">
                                        <?php echo htmlspecialchars($emailErr); ?>
                                    </div>
                                </div>

                                <!-- Place of Birth -->
                                <div class="mb-3">
                                    <label for="pob" class="form-label">
                                        Place of Birth
                                    </label>

                                    <input type="text" class="form-control" id="pob" name="pob"
                                        placeholder="Enter your place of birth" value="<?php
                                        if (!$success && isset($_POST["pob"])) {
                                            echo htmlspecialchars($_POST["pob"]);
                                        }
                                        ?>">
                                </div>

                                <!-- Gender -->
                                <div class="mb-3">
                                    <label class="form-label d-block">Gender</label>

                                    <div class="form-check form-check-inline">
                                        <input type="radio" class="form-check-input" id="male" name="gender"
                                            value="male" <?php
                                            if (
                                                !$success && isset($_POST["gender"])
                                                && $_POST["gender"] == "male"
                                            ) {
                                                echo "checked";
                                            }
                                            ?>>
                                        <label for="male" class="form-check-label">
                                            Male
                                        </label>
                                    </div>

                                    <div class="form-check form-check-inline">
                                        <input type="radio" class="form-check-input" id="female" name="gender"
                                            value="female" <?php
                                            if (
                                                !$success && isset($_POST["gender"])
                                                && $_POST["gender"] == "female"
                                            ) {
                                                echo "checked";
                                            }
                                            ?>>
                                        <label for="female" class="form-check-label">
                                            Female
                                        </label>
                                    </div>
                                </div>


                                <!-- Position -->
                                <div class="mb-3">
                                    <label for="position" class="form-label">
                                        Positions
                                    </label>

                                    <select class="form-select" name="position" id="position">
                                        <option value="web_developer" <?php
                                        if (
                                            !$success && isset($_POST["position"])
                                            && $_POST["position"] == "web_developer"
                                        ) {
                                            echo "selected";
                                        }
                                        ?>>
    Web Developer
                                        </option>

                                        <option value="software_engineer" <?php
                                        if (
                                            !$success && isset($_POST["position"])
                                            && $_POST["position"] == "software_engineer"
                                        ) {
                                            echo "selected";
                                        }
                                        ?>>
    Software Engineer
                                        </option>

                                        <option value="accountant" <?php
                                        if (
                                            !$success && isset($_POST["position"])
                                            && $_POST["position"] == "accountant"
                                        ) {
                                            echo "selected";
                                        }
                                        ?>>
    Accountant
                                        </option>

                                        <option value="hr_manager" <?php
                                        if (
                                            !$success && isset($_POST["position"])
                                            && $_POST["position"] == "hr_manager"
                                        ) {
                                            echo "selected";
                                        }
                                        ?>>
            HR Manager
                                        </option>

                                        <option value="marketing_officer" <?php
                                        if (
                                            !$success && isset($_POST["position"])
                                            && $_POST["position"] == "marketing_officer"
                                        ) {
                                            echo "selected";
                                        }
                                        ?>>
    Marketing Officer
                                        </option>

                                        <option value="customer_service" <?php
                                        if (
                                            !$success && isset($_POST["position"])
                                            && $_POST["position"] == "customer_service"
                                        ) {
                                            echo "selected";
                                        }
                                        ?>>
    Customer Service Representative
                                        </option>
                                    </select>
                                </div>


                                <!-- Skills -->
                                <div class="mb-3">
                                    <label class="form-label d-block">Skills</label>

                                    <?php
                                    $skills = [
                                        "Communication",
                                        "Teamwork",
                                        "Problem Solving",
                                        "Programming",
                                        "Leadership",
                                        "Time Management"
                                    ];

                                    foreach ($skills as $skill) {
                                        $checked = (
                                            !$success
                                            && isset($_POST["skills"])
                                            && in_array($skill, $_POST["skills"])
                                        ) ? "checked" : "";
                                        ?>

                                        <div class="form-check form-check-inline">
                                            <input type="checkbox" class="form-check-input" name="skills[]"
                                                id="<?php echo strtolower(str_replace(' ', '_', $skill)); ?>"
                                                value="<?php echo $skill; ?>" <?php echo $checked; ?>>

                                            <label class="form-check-label"
                                                for="<?php echo strtolower(str_replace(' ', '_', $skill)); ?>">
                                                <?php echo $skill; ?>
                                            </label>
                                        </div>

                                    <?php } ?>
                                </div>


                                <!-- Comment -->
                                <div class="mb-4">
                                    <label for="comment" class="form-label">
                                        Comment
                                    </label>

                                    <textarea class="form-control" name="comment" id="comment" rows="4"
                                        placeholder="Write your comment here..."><?php
                                        if (!$success && isset($_POST["comment"])) {
                                            echo htmlspecialchars($_POST["comment"]);
                                        }
                                        ?></textarea>
                                </div>

                                <!-- CV Upload -->
                                <div class="mb-3">
                                    <label for="cv" class="form-label">Upload CV (PDF only)</label>
                                    <input type="file" class="form-control" name="cv" id="cv"
                                        accept=".pdf,application/pdf" required>
                                </div>

                                <!-- Certificate Upload -->
                                <div class="mb-3">
                                    <label for="certificate" class="form-label">
                                        Upload Certificate
                                    </label>
                                    <input type="file" class="form-control" name="certificate" id="certificate"
                                        accept=".pdf,.jpg,.jpeg,.png,application/pdf,image/jpeg,image/png" required>
                                </div>


                                <!-- Buttons -->
                                <div class="d-flex gap-2">
                                    <button type="submit" name="submit" class="btn btn-primary">
                                        Register
                                    </button>

                                    <button type="reset" class="btn btn-outline-secondary">
                                        Clear
                                    </button>
                                </div>



                            </fieldset>

                        </form>

                    </div>

                    <div class="card-footer text-center text-muted">
                        Student Registration System
                    </div>

                </div>

            </div>
        </div>

    </div>

</body>

</html>