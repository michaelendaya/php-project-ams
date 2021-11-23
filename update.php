<?php
// Include config file
require_once "config.php";

// Define variables and initialize with empty values
$name = $address = $salary = $contact = $resident =  $rate = $occupation =  "";
$name_err = $address_err = $contact_err = $res_err = $rate_err = $occupation_err = "";

// Processing form data when form is submitted
if (isset($_POST["id"]) && !empty($_POST["id"])) {
    // Get hidden input value
    $id = $_POST["id"];

    // Validate name
    $input_name = trim($_POST["name"]);
    if (empty($input_name)) {
        $name_err = "Please enter a name.";
    } elseif (!filter_var($input_name, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => "/^[a-zA-Z\s]+$/")))) {
        $name_err = "Please enter a valid name.";
    } else {
        $name = $input_name;
    }

    // Validate address
    $input_address = trim($_POST["address"]);
    if (empty($input_address)) {
        $address_err = "Please enter an address.";
    } else {
        $address = $input_address;
    }

    $input_address = trim($_POST["address"]);
    if (empty($input_address)) {
        $address_err = "Please enter an address.";
    } else {
        $address = $input_address;
    }


    // Validate Contact
    $input_contact = trim($_POST["contact"]);
    if (empty($input_contact)) {
        $contact_err = "Please enter the contact number.";
    } else {
        $contact = $input_contact;
    }


    // Validate resident
    $input_resident = trim($_POST["residents"]);
    if (empty($input_resident)) {
        $res_err = "Please enter a positive integer value.";
    } elseif (!ctype_digit($input_resident)) {
        $res_err = "Please enter a positive integer value.";
    } else {
        $resident = $input_resident;
    }


    // Validate Occupation
    $input_occupation = trim($_POST["occupation"]);
    if (empty($input_occupation)) {
        $occupation_err = "Please enter the occupation";
    } else {
        $occupation = $input_occupation;
    }


    // Validate rate
    $input_rate = trim($_POST["rate"]);
    if (empty($input_rate)) {
        $rate_err = "Please enter the contact number.";
    } elseif (!ctype_digit($input_rate)) {
        $rate_err = "Please enter a positive integer value.";
    } else {
        $rate = $input_rate;
    }


    // Check input errors before inserting in database
    if (
        empty($name_err) && empty($address_err) && empty($contact_err) &&
        empty($res_err) && empty($rate_err)
        && empty($occupation_err)
    ) {
        // Prepare an update statement
        $sql = "UPDATE tenants SET name=?,contact=?, address=?,occupation=?, rate=?,residentAmt=? WHERE id=?";

        if ($stmt = $mysqli->prepare($sql)) {
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param("ssssssi", $param_name, $param_contact, $param_address, $param_occupation, $param_rate, $param_resident, $param_id);


            // Set parameters
            $param_name = $name;
            $param_contact = $contact;
            $param_address = $address;
            $param_occupation = $occupation;
            $param_rate = $rate;
            $param_resident = $resident;
            $param_id = $id;
            
            // Attempt to execute the prepared statement
            if ($stmt->execute()) {
                // Records updated successfully. Redirect to landing page
                header("location: tenant.php");
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
        $sql = "SELECT * FROM tenants WHERE id = ?";
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
                    $name = $row["name"];
                    $address = $row["address"];
                    $contact = $row["contact"];
                    $resident = $row["residentAmt"];
                    $occupation = $row["occupation"];
                    $rate = $row["rate"];
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
                    <h2 class="mt-5">Update Record</h2>
                    <p>Please edit the input values and submit to update the employee record.</p>
                    <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">
                        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" name="name" class="form-control <?php echo (!empty($name_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $name; ?>">
                                <span class="invalid-feedback"><?php echo $name_err; ?></span>
                            </div>
                            <div class="form-group">
                                <label>Address</label>
                                <textarea name="address" class="form-control <?php echo (!empty($address_err)) ? 'is-invalid' : ''; ?>"><?php echo $address; ?></textarea>
                                <span class="invalid-feedback"><?php echo $address_err; ?></span>
                            </div>
                            <div class="form-group">
                                <label>Contact Number</label>
                                <input type="text" name="contact" class="form-control <?php echo (!empty($contact_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $contact; ?>">
                                <span class="invalid-feedback"><?php echo $contact_err; ?></span>
                            </div>
                            <div class="form-group">
                                <label>Resident Amount</label>
                                <input type="text" name="residents" class="form-control <?php echo (!empty($res_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $resident; ?>">
                                <span class="invalid-feedback"><?php echo $res_err; ?></span>
                            </div>
                            <div class="form-group">
                                <label>Occupation</label>
                                <input type="text" name="occupation" class="form-control <?php echo (!empty($occupation_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $occupation; ?>">
                                <span class="invalid-feedback"><?php echo $occupation_err; ?></span>
                            </div>
                            <div class="form-group">
                                <label>Rate</label>
                                <input type="text" name="rate" class="form-control <?php echo (!empty($rate_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $rate; ?>">
                                <span class="invalid-feedback"><?php echo $rate_err; ?></span>
                            </div>
                            <input type="hidden" name="id" value="<?php echo $id; ?>" />
                            <input type="submit" class="btn btn-primary" value="Submit">
                            <a href="tenant.php" class="btn btn-secondary ml-2">Cancel</a>
                        </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>