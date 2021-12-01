
<?php
// Check existence of id parameter before processing further
if(isset($_GET["tenant_id"]) && !empty(trim($_GET["tenant_id"]))){
    // Include config file
    require_once "config.php";
    $id =  isset($_GET['tenant_id']) ? $_GET['tenant_id'] : '';

    // Prepare a select statement
    $sql = "SELECT * FROM tenants WHERE id = $id";

    $result = $mysqli->query($sql);
    if ($result = $mysqli->query($sql)) {
        while ($row = $result->fetch_assoc()) {
            $name =  $row['name']; 
       
        }
    } else {
        echo '0 Results. Please create one';
    }

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
            width: 100%;
            margin: 0 auto;
        }
        table tr td:last-child{
            width: 120px;
        }
    </style>
</head>

<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <h1 class="mt-5 mb-3">Utility of 
                        
                <?php 
                
                echo    $name;
                ?>
                </h1>
                    <!-- <div class="form-group">
                        <label>Name</label>
                        <p><b><?php echo $row["name"]; ?></b></p>
                    </div>
                    <div class="form-group">
                        <label>Address</label>
                        <p><b><?php echo $row["address"]; ?></b></p>
                    </div>
                    <div class="form-group">
                        <label>Salary</label>
                        <p><b><?php echo $row["salary"]; ?></b></p>
                    </div>
                    <p><a href="index.php" class="btn btn-primary">Back</a></p> -->
                    <?php



                    // Check existence of id parameter before processing further
                    if (isset($_GET["tenant_id"]) && !empty(trim($_GET["tenant_id"]))) {
                        // Include config file
                        require_once "config.php";

                        // Prepare a select statement
                        $sql = "SELECT * FROM utils WHERE tenant_id = ?";

                        if ($stmt = $mysqli->prepare($sql)) {
                            // Bind variables to the prepared statement as parameters
                            $stmt->bind_param("i", $param_id);

                            // Set parameters
                            $param_id = trim($_GET["tenant_id"]);

                            // Attempt to execute the prepared statement
                            if ($stmt->execute()) {
                                $result = $stmt->get_result();

                                if ($result->num_rows > 0) {
                                    echo '<table class="table table-bordered table-striped">';
                                    echo "<thead>";
                                    echo "<tr>";
                                    echo "<th>#</th>";

                                    echo "<th>Water</th>";
                                    echo "<th>Electricity</th>";
                                    echo "<th>Internet</th>";
                                    echo "<th>Breakage</th>";
                                    echo "<th>Security</th>";
                                    echo "<th>Ammenity</th>";
                                    echo "</tr>";
                                    echo "</thead>";
                                    echo "<tbody>";
                                    while ($row = $result->fetch_array()) {
                                        echo "<tr>";
                                        // Retrieve individual field value
                                        echo "<td>" . $id = $row["id"] . "</td>";
                                        echo "<td>" . $water = $row["water"] . "</td>";
                                        echo "<td>" . $electricity = $row["electricity"] . "</td>";
                                        echo "<td>" . $internet = $row["internet"] . "</td>";
                                        echo "<td>" . $breakage = $row["breakage"] . "</td>";
                                        echo "<td>" . $security = $row["security"] . "</td>";
                                        echo "<td>" . $ammenity = $row["ammenity"] . "</td>";
                                        // echo "<td>";
                                        //     echo '<a href="updateUtil.php?id='. $row['id'] .'" class="mr-3" title="View Record" data-toggle="tooltip"><span class="fa fa-eye"></span></a>';
                                        //     echo '<a href="updateUtil.php?id='. $row['id'] .'" class="mr-3" title="Update Record" data-toggle="tooltip"><span class="fa fa-pencil"></span></a>';
                                        //     echo '<a href="deleteUtil.php?id='. $row['id'] .'" title="Delete Record" data-toggle="tooltip"><span class="fa fa-trash"></span></a>';
                                        // echo "</td>";
                                        echo "</tr>";
                                    }
                                    echo "</tbody>";
                                    echo "</table>";
                                    // Free result set
                                    $result->free();
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
                            header("location: error.php");
                            exit();
                        }
                    }



                    ?>
                </div>
            </div>
        </div>
    </div>
</body>

</html>