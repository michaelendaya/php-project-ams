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
            $stmt->bind_param("idddddd",$param_tenant_id , $param_water, $param_electricity, $param_internet, $param_breakage, $param_security, $param_ammenity);

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
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Create Utilities</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .wrapper {
            width: 100%;
            margin: 0 auto;
        }
    </style>
</head>

<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="mt-5">Add Utility</h2>
                    <p>Please fill this form and submit to add Utility record of the specified tenant to the database.</p>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                         <div class="form-group">
                            <label>Contact Number</label>
                            <input type="number" name="tenant_id" class="form-control <?php echo (!empty($tenant_id_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $tenant_id; ?>">
                            <span class="invalid-feedback"><?php echo $tenant_id_err; ?></span>
                        </div>
                        <div class="form-group">
                            <label>Water</label>
                            <input type="number" name="water" class="form-control" step="any" ?>
                        </div>
                        <div class="form-group">
                            <label>Electricity</label>
                            <input type="number" name="electricity" class="form-control" step="any" ">
                        </div>
                        <div class="form-group">
                            <label>Internet</label>
                            <input type="number" name="internet" class="form-control" step="any">
                        </div>
                        <div class="form-group">
                            <label>Breakage</label>
                            <input type="number" name="breakage" class="form-control" step="any">
                        </div>
                        <div class="form-group">
                            <label>Security</label>
                            <input type="number" name="security" class="form-control" step="any">
                        </div>
                        <div class="form-group">
                            <label>Ammenity</label>
                            <input type="number" name="ammenity" class="form-control" step="any">
                        </div>
                       
                      

                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="tenant.php" class="btn btn-secondary ml-2">Cancel</a>
                      
                       
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>