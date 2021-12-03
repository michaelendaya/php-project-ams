<?php

$tenant_id = '';
$id = '';
if(isset($_GET["tenant_id"]) && !empty(trim($_GET["tenant_id"]))){
    $tenant_id =  isset($_GET['tenant_id']) ? $_GET['tenant_id'] : '';
}
// Check existence of id parameter before processing further
if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
    // Include config file
    require_once "config.php";
    $id =  isset($_GET['id']) ? $_GET['id'] : '';
    // Prepare a select statement
    $sql = "SELECT * FROM utils WHERE id = ?";
    
    if($stmt = $mysqli->prepare($sql)){
        // Bind variables to the prepared statement as parameters
        $stmt->bind_param("i", $param_id);
        
        // Set parameters
        $param_id = trim($_GET["id"]);

        // Attempt to execute the prepared statement
        if($stmt->execute()){
            $result = $stmt->get_result();
            
            if($result->num_rows == 1){
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
            } else{
                // URL doesn't contain valid id parameter. Redirect to error page
                header("location: error.php");
                exit();
            }
            
        } else{
            echo "Oops! Something went wrong. Please try again later.";
        }
    }
     
    // Close statement
    $stmt->close();
    
    // Close connection
    $mysqli->close();
} else{
    // URL doesn't contain id parameter. Redirect to error page
    header("location: error.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Record</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .wrapper{
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
                <h1 class="mt-5 mb-3">Utility #
                        
                        <?php 
                        
                        echo    $id;
                        ?> </h1>
                    <div class="form-group">
                        <label>Water</label>
                        <p><b><?php echo $row["water"]; ?></b></p>
                    </div>
                    <div class="form-group">
                        <label>Electricity</label>
                        <p><b><?php echo $row["electricity"]; ?></b></p>
                    </div>
                    <div class="form-group">
                        <label>Internet</label>
                        <p><b><?php echo $row["internet"]; ?></b></p>
                    </div>
                    <div class="form-group">
                        <label>Breakage</label>
                        <p><b><?php echo $row["breakage"]; ?></b></p>
                    </div>
                    <div class="form-group">
                        <label>Security</label>
                        <p><b><?php echo $row["security"]; ?></b></p>
                    </div>
                    <div class="form-group">
                        <label>Ammenity</label>
                        <p><b><?php echo $row["ammenity"]; ?></b></p>
                    </div>
                   
                    <?php 
                            echo '<a href="tenantUtils.php?tenant_id=' . $tenant_id. '" class="btn btn-primary">Back</a>'
                            ?>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>