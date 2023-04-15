<?php
// Include config file
require_once "../../includes/db.php";

// Define variables and initialize with empty values
$machine_id = $location = "";
$machine_id_err = $location_err = "";

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate machine id
    // TODO: regular expression for a pattern of machine id
    $input_machine_id = trim($_POST["machine_id"]);
    if (empty($input_machine_id)) {
        $machine_id_err = "Please enter machine id.";
        // } elseif (!filter_var($input_machine_id, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => "/^[a-zA-Z\s].*[a-zA-Z\s]+$/")))) {
        $machine_id_err = "Please enter a valid machine id.";
    } else {
        $machine_id = $input_machine_id;
    }

    // Validate location
    $input_location = trim($_POST["location"]);
    if (empty($input_location)) {
        $location_err = "Please enter a location.";
    } else {
        $location = strtoupper($input_location);
    }

    // Check input errors before inserting in database
    if (empty($machine_id_err) && empty($location_err)) {
        // Prepare an insert statement
        $sql = "INSERT INTO machine (machine_id, location) VALUES (?, ?)";

        if ($stmt = mysqli_prepare($link, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ss", $param_machine_id, $param_location);

            // Set parameters
            $param_machine_id = $machine_id;
            $param_location = $location;

            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                // Records created successfully. Redirect to registered machines page
                header("location: registered-machines.php");
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
    <title>Create Machine</title>
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
                    <h2 class="mt-5">Add Machine</h2>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="form-group">
                            <label>Machine ID</label>
                            <input type="text" placeholder="eg. MCH-345" name="machine_id" class="form-control <?php echo (!empty($machine_id_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $machine_id; ?>">
                            <span class="invalid-feedback"><?php echo $machine_id_err; ?></span>
                        </div>
                        <div class="form-group">
                            <label>Location</label>
                            <input name="location" class="form-control <?php echo (!empty($location_err)) ? 'is-invalid' : ''; ?>"><?php echo $location; ?>
                            <span class="invalid-feedback"><?php echo $location_err; ?></span>
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