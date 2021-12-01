<?php
// Check existence of id parameter before processing further
if(isset($_GET["tenant_id"]) && !empty(trim($_GET["tenant_id"]))){
    // Include config file
    require_once "config.php";
    
    // Prepare a select statement
    $sql = "SELECT * FROM utils WHERE tenant_id = ?";
    
    if($stmt = $mysqli->prepare($sql)){
        // Bind variables to the prepared statement as parameters
        $stmt->bind_param("i", $param_id);
        
        // Set parameters
        $param_id = trim($_GET["tenant_id"]);

        // Attempt to execute the prepared statement
        if($stmt->execute()){
            $result = $stmt->get_result();
            
            if($result->num_rows > 0){
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
            while($row = $result->fetch_array()){
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
}
