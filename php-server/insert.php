<?php
    include 'db_conn.php';
    
    $mobileName = $description = $quantityAvailable = $price = $os = "";
    $mobileName_err = $description_err = $quantityAvailable_err = $price_err = $os_err = "";

    if($_SERVER["REQUEST_METHOD"] == "POST") {
        
        // Validate MobileName
        if(empty(trim($_POST["mobileName"]))){
            $mobileName_err = "Please enter a mobile name.";
        } else  {
            $mobileName = trim($_POST["mobileName"]);
        }
        
        // Validate description
        if(empty(trim($_POST["description"]))){
            $description_err = "Please enter a description.";
        } else  {
            $description = trim($_POST["description"]);
        }
        
        // Validate quantity available
        if(empty(trim($_POST["quantityAvailable"]))){
            $quantityAvailable_err = "Please enter a quantity available.";
        } else  {
            $quantityAvailable = trim($_POST["quantityAvailable"]);
        }
        
        // Validate price
        if(empty(trim($_POST["price"]))){
            $price_err = "Please enter a price.";
        } else  {
            $price = trim($_POST["price"]);
        }
        
        // Validate operating system
        if(empty(trim($_POST["os"]))){
            $os_err = "Please enter a operating system.";
        } else  {
            $os = trim($_POST["os"]);
        }
        
        if(empty($mobileName_err) && empty($description_err) && empty($quantityAvailable_err) && empty($price_err) && empty($os_err)) {
            
           $sql = "INSERT INTO mobile (mobileName, mobileDescription, quantityAvailable, price, operationSystem) VALUES (?, ?, ?, ?, ?)";
            
            if($stmt = mysqli_prepare($dbc,$sql)) {
                mysqli_stmt_bind_param($stmt, "sssss", $mobileName, $description, $quantityAvailable, $price, $os);
                
                $result = mysqli_stmt_execute($stmt); 
                
                if($result)
                {
                    header("Location: list.php");
                    exit();
                } else {
                    echo "<br>sometihing went wrong. Please try again.";
                        mysqli_err($dbc);
                }
            }
        }
    }
    ?>
    
    <!DOCTYPE html>
    <html>
        <head>
            <title>
                Insert Mobile
            </title>
            
            <style>
                /* General Styles */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f8f9fa;
        }

        /* Navigation Styles */
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

        /* Form Styles */
        .container {
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            color: #333;
            margin-bottom: 20px;
            text-align: center;
        }

        form {
            width: 80%;
            margin: 0 auto;
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
            
            <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="list.php">View Mobiles</a></li>
                <li><a href="insert.php">Add Mobile</a></li>
            </ul>
            </nav>
            
            <h1>Add new Mobile</h1>
            
            <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
            
            <div>
                <label for="mobileName">Mobile Name:</label>
                <input type="text" id="mobileName" name="mobileName" value="<?php echo $mobileName; ?>">
                <span style="color: red;"><?php echo $mobileName_err;?></span>
            </div>
            
            <div>
                <label for="description">Description:</label>
                <input type="text" id="description" name="description" value="<?php echo $description; ?>">
                <span style="color: red;"><?php echo $description_err;?></span>
            </div>
            
            <div>
                <label for="quantityAvailable">Quantity Available:</label>
                <input type="text" id="quantityAvailable" name="quantityAvailable" value="<?php echo $quantityAvailable; ?>">
                <span style="color: red;"><?php echo $quantityAvailable_err;?></span>
            </div>
            
            <div>
                <label for="price">Price:</label>
                <input type="text" id="price" name="price" value="<?php echo $price; ?>">
                <span style="color: red;"><?php echo $price_err;?></span>
            </div>
            
            <div>
                <label for="os">Operating system:</label>
                <input type="text" id="os" name="os" value="<?php echo $os; ?>">
                <span style="color: red;"><?php echo $os_err;?></span>
            </div>
            
            <div>
                <button type="submit" name="submit">Insert</button>
            </div>
            
            </form>
        </body>
    </html>






