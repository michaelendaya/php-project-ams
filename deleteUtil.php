<?php
// Process delete operation after confirmation
if(isset($_GET["tenant_id"]) && !empty(trim($_GET["tenant_id"]))){
    $tenant_id =  isset($_GET['tenant_id']) ? $_GET['tenant_id'] : '';
}


if (isset($_POST["id"]) && !empty($_POST["id"])) {
    // Include config file
    require_once "config.php";
    $tenant_id = $_POST["tenant_id"];
    // Prepare a delete statement
    $sql = "DELETE FROM utils WHERE id = ?";

    if ($stmt = $mysqli->prepare($sql)) {
        // Bind variables to the prepared statement as parameters
        $stmt->bind_param("i", $param_id);

        // Set parameters
        $param_id = trim($_POST["id"]);

        // Attempt to execute the prepared statement
        if ($stmt->execute()) {
            // Records deleted successfully. Redirect to landing page
            header("location: tenantUtils.php?tenant_id=$tenant_id");
           
            exit();
        } else {
            echo "Oops! Something went wrong. Please try again later.";
        }
    }

    // Close statement
    $stmt->close();

    // Close connection
    $mysqli->close();
} else {
    // Check existence of id parameter
    if (empty(trim($_GET["id"]))) {
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
    <title>Delete Record</title>
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
                    <h2 class="mt-5 mb-3">Delete Utility</h2>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="alert alert-danger">
                            <input type="hidden" name="id" value="<?php echo trim($_GET["id"]); ?>" />
                            <p>Are you sure you want to delete this tenant utility record?</p>
                            <p>
                                <input type="submit" value="Yes" class="btn btn-danger">
                                <input type="hidden" name="tenant_id" value="<?php echo $tenant_id; ?>" />
                                <?php 
                            echo '<a href="tenantUtils.php?tenant_id=' . $tenant_id. '" class="btn btn-secondary ml-2">No</a>'
                            ?>
                            </p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>