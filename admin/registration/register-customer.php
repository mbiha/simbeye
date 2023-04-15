<?php
// Include config file
require_once "../../includes/db.php";

// Define variables and initialize with empty values
$first_name = $last_name = $card_number = $card_amount = $card_state = "";
$first_name_err = $last_name_err = $card_number_err = $card_amount_err = $card_state_err = "";

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate first name
    $input_first_name = trim($_POST["first_name"]);
    if (empty($input_first_name)) {
        $first_name_err = "Please enter first name.";
    } elseif (!filter_var($input_first_name, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => "/^[a-zA-Z\s]+$/")))) {
        $first_name_err = "Please enter a valid first name.";
    } else {
        $first_name = $input_first_name;
    }

    // Validate last name
    $input_last_name = trim($_POST["last_name"]);
    if (empty($input_last_name)) {
        $last_name_err = "Please enter last name.";
    } elseif (!filter_var($input_last_name, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => "/^[a-zA-Z\s]+$/")))) {
        $last_name_err = "Please enter a valid last name.";
    } else {
        $last_name = $input_last_name;
    }

    // Validate card number
    $input_card_number = trim($_POST["card_number"]);
    if (empty($input_card_number)) {
        $card_number_err = "Please enter card number.";
        // TODO: check if the numbers are of required count Eg. 10
    } elseif (!ctype_digit($input_card_number)) {
        $card_number_err = "Please enter a valid value.";
    } else {
        $card_number = $input_card_number;
    }

    // Validate card amount
    $input_card_amount = trim($_POST["card_amount"]);
    if (empty($input_card_amount)) {
        $card_amount_err = "Please enter card amount.";
    } elseif (!ctype_digit($input_card_amount)) {
        $card_amount_err = "Please enter a valid amount.";
    } else {
        $card_amount = $input_card_amount;
    }

    // Validate card state
    $input_card_state = $_POST["card_state"];
    if (!isset($input_card_state)) {
        $card_state_err = "Please choose a card state.";
        echo $card_state_err;
    } else {
        $card_state = $input_card_state;
    }

    // Check input errors before inserting in database
    if (empty($first_name_err) && empty($last_name_err) && empty($card_number_err) && empty($card_state_err)) {
        // Prepare an insert statement
        $sql = "INSERT INTO customer (first_name, last_name, card_number, card_amount, card_state) VALUES (?, ?, ?, ?, ?)";

        if ($stmt = mysqli_prepare($link, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sssss", $param_first_name, $param_last_name, $param_card_number, $param_card_amount, $param_card_state);

            // Set parameters
            $param_first_name = $first_name;
            $param_last_name = $last_name;
            $param_card_number = $card_number;
            $param_card_amount = $card_amount;
            $param_card_state = $card_state;

            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                // Records created successfully. Redirect to registered customer page
                header("location: registered-customers.php");
                exit();
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }
        }

        // Close statement
        mysqli_stmt_close($stmt);
    }

    // Close connection
    mysqli_close($link);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Create Customer</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .wrapper {
            width: 600px;
            margin: 0 auto;
        }
    </style>
</head>
<nav class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0">
    <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="../index.php">Group 01</a>
    <!-- <input class="form-control form-control-dark w-100" type="text" placeholder="Search" aria-label="Search" /> -->
    <ul class="navbar-nav px-3">
        <li class="nav-item text-nowrap">
            <a class="nav-link" href="#">Sign out</a>
        </li>
    </ul>
</nav>

<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="mt-5">Add Customer</h2>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="form-group">
                            <label>First Name</label>
                            <input type="text" name="first_name" class="form-control <?php echo (!empty($first_name_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $first_name; ?>">
                            <span class="invalid-feedback"><?php echo $first_name_err; ?></span>
                        </div>
                        <div class="form-group">
                            <label>Last Name</label>
                            <input type="text" name="last_name" class="form-control <?php echo (!empty($last_name_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $last_name; ?>">
                            <span class="invalid-feedback"><?php echo $last_name_err; ?></span>
                        </div>
                        <div class="form-group">
                            <label>Card Number</label>
                            <input type="text" name="card_number" class="form-control <?php echo (!empty($card_number_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $card_number; ?>">
                            <span class="invalid-feedback"><?php echo $card_number_err; ?></span>
                        </div>
                        <div class="form-group">
                            <label>Card Amount</label>
                            <input type="text" name="card_amount" class="form-control <?php echo (!empty($card_amount_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $card_amount; ?>">
                            <span class="invalid-feedback"><?php echo $card_amount_err; ?></span>
                        </div>
                        <div class="form-group">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="card_state" value="Enabled" id="enable" checked>
                                <label class="form-check-label" for="enable">
                                    Enable Card
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="card_state" value="Disabled" id="disable">
                                <label class="form-check-label" for="disable">
                                    Disable Card
                                </label>
                            </div>
                        </div>
                        <input type="submit" class="btn btn-primary" value="Register">
                        <a href="../index.php" class="btn btn-secondary ml-2">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>