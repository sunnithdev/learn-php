<?php
    include 'db_conn.php';
    
    // Check if mobileId parameter is provided in the URL
    if (isset($_GET["mobileId"]) && !empty(trim($_GET["mobileId"]))) {
        $mobileId = trim($_GET["mobileId"]);
        
        $mobileName = $description = $quantityAvailable = $price = $os = "";
        $mobileName_err = $description_err = $quantityAvailable_err = $price_err = $os_err = "";
        
        // Check if form is submitted
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Validate mobileName
            if (empty(trim($_POST["mobileName"]))) {
                $mobileName_err = "Please enter a mobile name.";
            } else {
                $mobileName = trim($_POST["mobileName"]);
            }

            // Validate description
            if (empty(trim($_POST["description"]))) {
                $description_err = "Please enter a description.";
            } else {
                $description = trim($_POST["description"]);
            }

            // Validate quantity available
            if (empty(trim($_POST["quantityAvailable"]))) {
                $quantityAvailable_err = "Please enter a quantity available.";
            } else {
                $quantityAvailable = trim($_POST["quantityAvailable"]);
            }

            // Validate price
            if (empty(trim($_POST["price"]))) {
                $price_err = "Please enter a price.";
            } else {
                $price = trim($_POST["price"]);
            }

            // Validate operating system
            if (empty(trim($_POST["os"]))) {
                $os_err = "Please enter an operating system.";
            } else {
                $os = trim($_POST["os"]);
            }
        
            // Check if there are no validation errors
            if (empty($mobileName_err) && empty($description_err) && empty($quantityAvailable_err) && empty($price_err) && empty($os_err)) {
                // Prepare and execute SQL statement for update
                $sql = "UPDATE mobile SET mobileName=?, mobileDescription=?, quantityAvailable=?, price=?, operationSystem=? WHERE mobileId=?";
                
                if ($stmt = $dbc->prepare($sql)) {
                    // Bind parameters to the prepared statement
                    $stmt->bind_param("sssssi", $mobileName, $description, $quantityAvailable, $price, $os, $mobileId);

                    // Attempt to execute the prepared statement
                    if ($stmt->execute()) {
                        // Redirect to index.php after successful update
                        header("Location: index.php");
                        exit();
                    } else {
                        echo "Something went wrong";
                    }

                    // Close statement
                    $stmt->close();
                }
            }
        }

        // Fetch mobile record based on mobileId
        $sql = "SELECT * FROM mobile WHERE mobileId = ?";
        if ($stmt = $dbc->prepare($sql)) {
            $stmt->bind_param("i", $mobileId);
            
            if ($stmt->execute()) {
                $result = $stmt->get_result();
                
                if ($result->num_rows == 1) {
                    $row = $result->fetch_array(MYSQLI_ASSOC);
                    
                    $mobileName = $row["mobileName"];
                    $description = $row["mobileDescription"];
                    $quantityAvailable = $row["quantityAvailable"];
                    $price = $row["price"];
                    $os = $row["operationSystem"];
                } else {
                    header("location: index.php");
                    exit();
                }
            } else {
                echo "Something went wrong.";
            }
            
            $stmt->close();
        }
    } else {
        exit();
    }
?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit Mobile</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f8f9fa;
        }

        h1 {
            text-align: center;
        }

        nav {
            background-color: #007bff;
            padding: 10px 0;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        ul {
            list-style: none;
            margin: 0;
            padding: 0;
            text-align: center;
        }

        li {
            display: inline-block;
            margin-right: 20px;
        }

        li:last-child {
            margin-right: 0;
        }

        a {
            text-decoration: none;
            color: #fff;
            font-size: 18px;
            padding: 10px 15px;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        a:hover {
            background-color: #0056b3;
        }

        form {
            max-width: 400px;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        input[type="text"] {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        span.error {
            color: red;
        }

        button[type="submit"] {
            background-color: #007bff;
            color: #fff;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    
    <h1>Edit Mobile</h1>
    
    <nav>
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="list.php">View Mobiles</a></li>
            <li><a href="insert.php">Add Mobile</a></li>
        </ul>
    </nav>
    
    <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'] . "?mobileId=" . $mobileId); ?>">
        <input type="hidden" name="mobileId" value="<?php echo $mobileId; ?>">
        <div>
            <label for="mobileName">Mobile Name:</label>
            <input type="text" id="mobileName" name="mobileName" value="<?php echo $mobileName; ?>">
            <span style="color: red;"><?php echo $mobileName_err; ?></span>
        </div>
        <div>
            <label for="description">Description:</label>
            <input type="text" id="description" name="description" value="<?php echo $description; ?>">
            <span style="color: red;"><?php echo $description_err; ?></span>
        </div>
        <div>
            <label for="quantityAvailable">Quantity Available:</label>
            <input type="text" id="quantityAvailable" name="quantityAvailable" value="<?php echo $quantityAvailable; ?>">
            <span style="color: red;"><?php echo $quantityAvailable_err; ?></span>
        </div>
        <div>
            <label for="price">Price:</label>
            <input type="text" id="price" name="price" value="<?php echo $price; ?>">
            <span style="color: red;"><?php echo $price_err; ?></span>
        </div>
        <div>
            <label for="os">Operating system:</label>
            <input type="text" id="os" name="os" value="<?php echo $os; ?>">
            <span style="color: red;"><?php echo $os_err; ?></span>
        </div>
        <div>
            <button type="submit" name="submit">Update</button>
        </div>
    </form>
</body>
</html>


