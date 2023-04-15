<?php
// Include config file
require_once "../../includes/db.php";

// Define variables and initialize with empty values
$first_name = $last_name = $card_number = $card_amount = $card_state = "";
$first_name_err = $last_name_err = $card_number_err = $card_amount_err = $card_state_err = "";

// Processing form data when form is submitted
if (isset($_POST["id"]) && !empty($_POST["id"])) {
    // Get hidden input value
    $id = $_POST["id"];

    // Validate first name
    $input_first_name = trim($_POST["first_name"]);
    if (empty($input_first_name)) {
        $first_name_err = "Please enter a first name.";
    } elseif (!filter_var($input_first_name, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => "/^[a-zA-Z\s]+$/")))) {
        $first_name_err = "Please enter a valid first name.";
    } else {
        $first_name = $input_first_name;
    }

    // Validate last name
    $input_last_name = trim($_POST["last_name"]);
    if (empty($input_last_name)) {
        $first_name_err = "Please enter a last name.";
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
        // Prepare an update statement
        $sql = "UPDATE customer SET first_name=?, last_name=?, card_number=?, card_amount=?, card_state=? WHERE id=?";

        if ($stmt = mysqli_prepare($link, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sssssi", $param_first_name, $param_last_name, $param_card_number, $param_card_amount, $param_card_state, $param_id);

            // Set parameters
            $param_first_name = $first_name;
            $param_last_name = $last_name;
            $param_card_number = $card_number;
            $param_card_amount = $card_amount;
            $param_card_state = $card_state;
            $param_id = $id;

            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                // Records updated successfully. Redirect to customers page
                header("location: ../registration/registered-customers.php");
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
} else {
    // Check existence of id parameter before processing further
    if (isset($_GET["id"]) && !empty(trim($_GET["id"]))) {
        // Get URL parameter
        $id =  trim($_GET["id"]);

        // Prepare a select statement
        $sql = "SELECT * FROM customer WHERE id = ?";
        if ($stmt = mysqli_prepare($link, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "i", $param_id);

            // Set parameters
            $param_id = $id;

            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                $result = mysqli_stmt_get_result($stmt);

                if (mysqli_num_rows($result) == 1) {
                    /* Fetch result row as an associative array. Since the result set
                    contains only one row, we don't need to use while loop */
                    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

                    // Retrieve individual field value
                    $first_name = $row["first_name"];
                    $last_name = $row["last_name"];
                    $card_number = $row["card_number"];
                    $card_amount = $row["card_amount"];
                    $card_state = $row["card_state"];
                } else {
                    // URL doesn't contain valid id. Redirect to error page
                    header("location: error.php");
                    exit();
                }
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }
        }

        // Close statement
        mysqli_stmt_close($stmt);

        // Close connection
        mysqli_close($link);
    } else {
        // URL doesn't contain id parameter. Redirect to error page
        header("location: error.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Update Record</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .wrapper {
            width: 600px;
            margin: 0 auto;
        }
    </style>
</head>

<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="mt-5">Update Customer</h2>
                    <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">
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
                        <input type="hidden" name="id" value="<?php echo $id; ?>" />
                        <input type="submit" class="btn btn-primary" value="Update">
                        <a href="../registration/registered-customers.php" class="btn btn-secondary ml-2">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>