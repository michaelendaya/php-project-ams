<?php
// Include config file
require_once "config.php";

// Define variables and initialize with empty values
$water = $electricity = $internet = $breakage = $security =  $ammenity = 0;
$water_err = $electricity_err = $internet_err = $breakage_err = $security_err =  $ammenity_err = "";

if(isset($_GET["tenant_id"]) && !empty(trim($_GET["tenant_id"]))){
    $tenant_id =  isset($_GET['tenant_id']) ? $_GET['tenant_id'] : '';

}

// Processing form data when form is submitted
if (isset($_POST["id"]) && !empty($_POST["id"])) {
    // Get hidden input value
    $id = $_POST["id"];

    // Validate water
    $input_water = trim($_POST["water"]);
    if (empty($input_water)) {
        $water_err = "Please enter water bill.";
    } elseif (!ctype_digit($input_water)) {
        $water_err = "Please enter a positive integer value.";
    } else {
        $water = $input_water;
    }

    // Validate electricity
    $input_electricity = trim($_POST["electricity"]);
    if (empty($input_electricity)) {
        $electricity_err = "Please enter electricity bill.";
    } elseif (!ctype_digit($input_electricity)) {
        $electricity_err = "Please enter a positive integer value.";
    } else {
        $electricity = $input_electricity;
    }

    // Validate internet
    $input_internet = trim($_POST["internet"]);
    if (empty($input_internet)) {
        $internet_err = "Please enter internet bill.";
    } elseif (!ctype_digit($input_internet)) {
        $internet_err = "Please enter a positive integer value.";
    } else {
        $internet = $input_internet;
    }

    // Validate breakage
    $input_breakage = trim($_POST["breakage"]);
    if (empty($input_breakage)) {
        $breakage_err = "Please enter breakage bill.";
    } elseif (!ctype_digit($input_breakage)) {
        $breakage_err = "Please enter a positive integer value.";
    } else {
        $breakage = $input_breakage;
    }

    // Validate security
    $input_security = trim($_POST["security"]);
    if (empty($input_security)) {
        $security_err = "Please enter security bill.";
    } elseif (!ctype_digit($input_security)) {
        $security_err = "Please enter a positive integer value.";
    } else {
        $security = $input_security;
    }

    // Validate ammenity
    $input_ammenity = trim($_POST["ammenity"]);
    if (empty($input_ammenity)) {
        $ammenity_err = "Please enter ammenity bill.";
    } elseif (!ctype_digit($input_ammenity)) {
        $ammenity_err = "Please enter a positive integer value.";
    } else {
        $ammenity = $input_ammenity;
    }

    // Check input errors before inserting in database
    if (
        empty($water_err) && empty($electricity_err) && empty($internet_err) && empty($breakage_err) && empty($security_err) && empty($ammenity_err)
    ) {
        // Prepare an update statement
        $sql = "UPDATE utils SET water=?,electricity=?, internet=?,breakage=?, security=?,ammenity=? WHERE id=?";

        if ($stmt = $mysqli->prepare($sql)) {
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param("ddddddi", $param_water ,$param_electricity, $param_internet, $param_breakage, $param_security, $param_ammenity, $param_id);

            // Set parameters
            $param_water = $water;
            $param_electricity = $electricity;
            $param_internet = $internet;
            $param_breakage = $breakage;
            $param_security = $security;
            $param_ammenity = $ammenity;
            $param_id = $id;

            // Attempt to execute the prepared statement
            if ($stmt->execute()) {
                // Records created successfully. Redirect to landing page
                header("location: tenantUtils.php?tenant_id=" . $tenant_id ); //CHANGE THIS ========================================================================
                exit();
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }
        }

        // Close statement
        $stmt->close();
    }

    // Close connection
    $mysqli->close();
} else {
    // Check existence of id parameter before processing further
    if (isset($_GET["id"]) && !empty(trim($_GET["id"]))) {
        // Get URL parameter
        $id =  trim($_GET["id"]);

        // Prepare a select statement
        $sql = "SELECT * FROM utils WHERE id = ?";
        if ($stmt = $mysqli->prepare($sql)) {
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param("i", $param_id);

            // Set parameters
            $param_id = $id;

            // Attempt to execute the prepared statement
            if ($stmt->execute()) {
                $result = $stmt->get_result();

                if ($result->num_rows == 1) {
                    /* Fetch result row as an associative array. Since the result set
                    contains only one row, we don't need to use while loop */
                    $row = $result->fetch_array(MYSQLI_ASSOC);

                    // Retrieve individual field value
                    $water = $row["water"];
                    $electricity = $row["electricity"];
                    $internet = $row["internet"];
                    $breakage = $row["breakage"];
                    $security = $row["security"];
                    $ammenity = $row["ammenity"];
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
        $stmt->close();

        // Close connection
        $mysqli->close();
    } else {
        // URL doesn't contain id parameter. Redirect to error page
        echo 'abc';
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
                    <h2 class="mt-5">Update Utility</h2>
                    <p>Please edit the input values and submit to update the Utility record.</p>
                    <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">
                        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                            <div class="form-group">
                                <label>Water</label>
                                <input type="number" name="water" step="any" class="form-control <?php echo (!empty($water_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $water; ?>">
                                <span class="invalid-feedback"><?php echo $water_err; ?></span>
                            </div>
                            <div class="form-group">
                                <label>Electricity</label>
                                <input type="number" name="electricity" step="any" class="form-control <?php echo (!empty($electricity_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $electricity; ?>">
                                <span class="invalid-feedback"><?php echo $electricity_err; ?></span>
                            </div>
                            <div class="form-group">
                                <label>Internet</label>
                                <input type="number" name="internet" step="any" class="form-control <?php echo (!empty($internet_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $internet; ?>">
                                <span class="invalid-feedback"><?php echo $internet_err; ?></span>
                            </div>
                            <div class="form-group">
                                <label>Breakage</label>
                                <input type="number" name="breakage" step="any" class="form-control <?php echo (!empty($breakage_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $breakage; ?>">
                                <span class="invalid-feedback"><?php echo $breakage_err; ?></span>
                            </div>
                            <div class="form-group">
                                <label>Security</label>
                                <input type="number" name="security" step="any" class="form-control <?php echo (!empty($security_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $security; ?>">
                                <span class="invalid-feedback"><?php echo $security_err; ?></span>
                            </div>
                            <div class="form-group">
                                <label>Ammenity</label>
                                <input type="number" name="ammenity" step="any" class="form-control <?php echo (!empty($ammenity_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $ammenity; ?>">
                                <span class="invalid-feedback"><?php echo $ammenity_err; ?></span>
                            </div>
                          
                            <input type="hidden" name="id" value="<?php echo $id; ?>" />
                            <input type="submit" class="btn btn-primary" value="Submit">
                            <?php 
                            echo '<a href="tenantUtils.php?tenant_id=' . $tenant_id. '" class="btn btn-secondary ml-2">Cancel</a>'
                            ?>
                            
                        </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>