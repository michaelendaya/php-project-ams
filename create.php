<?php
// Include config file
require_once "config.php";

// Define variables and initialize with empty values
$name = $address = $salary = $contact = $resident =  $rate = $occupation =  "";
$name_err = $address_err = $contact_err = $res_err = $rate_err = $occupation_err = "";

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
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
        // Prepare an insert statement
        $sql = "INSERT INTO tenants (name,contact,address,occupation,rate,residentAmt) VALUES (?, ?, ?,?,?,?)";

        if ($stmt = $mysqli->prepare($sql)) {
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param("ssssss", $param_name, $param_contact, $param_address, $param_occupation, $param_rate, $param_resident);

            // Set parameters
            $param_name = $name;
            $param_contact = $contact;
            $param_address = $address;
            $param_occupation = $occupation;
            $param_rate = $rate;
            $param_resident = $resident;

            // Attempt to execute the prepared statement
            if ($stmt->execute()) {
                // Records created successfully. Redirect to landing page
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
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Create Record</title>
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
                    <h2 class="mt-5">Add Tenant</h2>
                    <p>Please fill this form and submit to add tenant record to the database.</p>
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


                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="tenant.php" class="btn btn-secondary ml-2">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>