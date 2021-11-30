<?php
// Include config file
require_once "config.php";

// Define variables and initialize with empty values
$water = $electricity = $internet = $breakage = $security =  $ammenity = 0;
$tenant_id = "";
$tenant_id_err = "";

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Validate tenant_id
    $input_tenant_id = trim($_POST["tenant_id"]);
    if (empty($input_tenant_id)) {
        $tenant_id_err = "Please enter the contact number.";
    } else {
        $tenant_id = $input_tenant_id;
    }

    // Check input errors before inserting in database
    if (
        empty($tenant_id_err)
    ) {
        // Prepare an insert statement
        $sql = "INSERT INTO utils (tenant_id,water,electricity,internet,breakage,security,ammenity) VALUES (?, ?, ?,?,?,?,?)";

        if ($stmt = $mysqli->prepare($sql)) {
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param("idddddd",$param_tenant_id , $param_water, ,$param_electricity, $param_internet, $param_breakage, $param_security, $param_ammenity);

            // Set parameters
            $param_tenant_id = $tenant_id;
            $param_water = $water;
            $param_electricity = $electricity;
            $param_internet = $internet;
            $param_breakage = $breakage;
            $param_security = $security;
            $param_ammenity = $ammenity;

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