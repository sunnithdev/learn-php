<?php
$errors = [];

function validateEmpty($value, $fieldName) {
    global $errors;
    if (empty($value)) {
        $errors[] = "Please provide your $fieldName";
    }
}

function validateSpecialChars($value, $fieldName) {
    global $errors;
    if (!preg_match('/^[a-zA-Z0-9\s]+$/', $value)) {
        $errors[] = "$fieldName should not contain special characters";
    }
}

function validateEmail($value, $fieldName) {
    global $errors;
    if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid $fieldName format";
    }
}

function validateCellNumber($value, $fieldName) {
    global $errors;
    if (!preg_match('/^[0-9]{10}$/', $value)) {
        $errors[] = "Invalid $fieldName format";
    }
}

function validateAge($dob) {
    global $errors;
    $dobTimestamp = strtotime($dob);
    $eighteenYearsAgo = strtotime('-18 years');
    if ($dobTimestamp > $eighteenYearsAgo) {
        $errors[] = "You must be 18 years or older to join";
    }
}

function sanitizeInput($input) {
    return htmlspecialchars($input, ENT_QUOTES, 'UTF-8');
}

function displayErrors() {
    global $errors;
    if (!empty($errors)) {
        echo '<div class="error-message">';
        foreach ($errors as $error) {
            echo $error . '<br>';
        }
        echo '</div>';
    }
}

function isSelected($value, $expectedValue) {
    return (isset($_POST[$value]) && $_POST[$value] == $expectedValue) ? 'selected' : '';
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate First Name
    $firstName = sanitizeInput($_POST["first_name"]);
    validateEmpty($firstName, "First Name");
    validateSpecialChars($firstName, "First Name");

    // Validate Last Name
    $lastName = sanitizeInput($_POST["last_name"]);
    validateEmpty($lastName, "Last Name");
    validateSpecialChars($lastName, "Last Name");

    // Validate Date of Birth
    $dob = sanitizeInput($_POST["dob"]);
    validateEmpty($dob, "Date of Birth");
    validateAge($dob);

    // Validate Gender
    $gender = sanitizeInput($_POST["gender"]);
    validateEmpty($gender, "Gender");

    // Validate Email
    $email = sanitizeInput($_POST["email"]);
    validateEmpty($email, "Email");
    validateEmail($email, "Email");

    // Validate Cell Number
    $cellNumber = sanitizeInput($_POST["cell_number"]);
    validateEmpty($cellNumber, "Cell Number");
    validateCellNumber($cellNumber, "Cell Number");

    // Validate Fitness Goal
    $fitnessGoal = sanitizeInput($_POST["fitness_goal"]);
    validateEmpty($fitnessGoal, "Fitness Goal");

    // Validate Batch
    $batch = sanitizeInput($_POST["batch"]);
    validateSpecialChars($batch, "Batch");

    // If there are no errors, redirect to success page
    if (empty($errors)) {
        header("Location: success.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gym FitZone</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            align-items: center;
            height: 100vh;
        }

        h1 {
            text-align: center;
            background-color: #2ecc71;
            color: #fff;
        }

        h2 {
            text-align: center;
            color: #333;
        }

        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 500px;
            margin: 0 auto;
        }

        label {
            display: block;
            margin-bottom: 8px;
        }

        input,
        select,
        button {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 16px;
        }

        button {
            background-color: #2ecc71;
            border: solid #27ae60;
            color: white;
            cursor: pointer;
        }

        button:hover {
            background-color: #27ae60;
        }

        .error-message {
            color: red;
            margin-left: 90px;
        }
    </style>
</head>
<body>
    <h1>Gym FitZone</h1>
    <h2>Embark on Your Fitness Journey with FitZone!</h2>

    <?php displayErrors(); ?>

    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <label for="first_name">Your First Name:</label>
        <input name="first_name" value="<?= isset($_POST['first_name']) ? sanitizeInput($_POST['first_name']) : ''; ?>">

        <label for="last_name">Your Last Name:</label>
        <input name="last_name" value="<?= isset($_POST['last_name']) ? sanitizeInput($_POST['last_name']) : ''; ?>">

        <label for="dob">Your Date of Birth:</label>
        <input type="date" name="dob" value="<?= isset($_POST['dob']) ? sanitizeInput($_POST['dob']) : ''; ?>">

        <label for="gender">Your Gender:</label>
        <select name="gender">
            <option value="male" <?= isSelected('gender', 'male'); ?>>Male</option>
            <option value="female" <?= isSelected('gender', 'female'); ?>>Female</option>
        </select>

        <label for="email">Your Email:</label>
        <input name="email" value="<?= isset($_POST['email']) ? sanitizeInput($_POST['email']) : ''; ?>">

        <label for="cell_number">Your Cell Number:</label>
        <input name="cell_number" value="<?= isset($_POST['cell_number']) ? sanitizeInput($_POST['cell_number']) : ''; ?>">

        <label for="fitness_goal">Your Fitness Goal:</label>
        <select name="fitness_goal">
            <option value="muscle_build" <?= isSelected('fitness_goal', 'muscle_build'); ?>>Muscle Building</option>
            <option value="endurance" <?= isSelected('fitness_goal', 'endurance'); ?>>Endurance Development</option>
            <option value="flexibility_yoga" <?= isSelected('fitness_goal', 'flexibility_yoga'); ?>>Flexibility Yoga</option>
        </select>

        <label for="batch">Your Preferred Batch:</label>
        <input name="batch" value="<?= isset($_POST['batch']) ? sanitizeInput($_POST['batch']) : ''; ?>">

        <button type="submit">Get Fit!</button>
    </form>
</body>
</html>
