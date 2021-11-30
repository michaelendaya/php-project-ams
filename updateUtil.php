<?php
// Include config file
require_once "config.php";

// Define variables and initialize with empty values
$water = $electricity = $internet = $breakage = $security =  $ammenity = 0;
$water_err = $electricity_err = $internet_err = $breakage_err = $security_err =  $ammenity_err = "";

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
            $stmt->bind_param("ddddddi", $param_water, ,$param_electricity, $param_internet, $param_breakage, $param_security, $param_ammenity, $param_id);

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
                header("location: tenant.php"); //CHANGE THIS ========================================================================
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
}
?>