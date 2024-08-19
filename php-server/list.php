
<?php
    include 'db_conn.php';
    
    $query="select * from mobile";
    $results=@mysqli_query($dbc,$query);
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Mobile Store - Mobile List</title>
        <style>
       /* General Styles */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f8f9fa;
        }

        .container {
            max-width: 1000px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            color: #333;
            margin-bottom: 20px;
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

        /* Table Styles */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: #007bff;
            color: #fff;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #ddd;
        }

        /* Action Button Styles */
        .action-links a {
            display: inline-block;
            padding: 8px 12px;
            background-color: #007bff;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s ease;
            margin-right: 5px;
        }

        .action-links a:hover {
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
        
        <div class="container">
            <h2>Mobile List</h2>
            <table>
                <tr>
                    <th>Mobile ID</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Quantity Available</th>
                    <th>Price</th>
                    <th>Operating System</th>
                    <th>Action</th>
                </tr>
                <?php
                    while ($row = $results->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row['mobileId']."</td>";
                        echo "<td>" . $row['mobileName']."</td>";
                        echo "<td>" . $row['mobileDescription']."</td>";
                        echo "<td>" . $row['quantityAvailable']."</td>";
                        echo "<td>" . $row['price']."</td>";
                        echo "<td>" . $row['operationSystem']."</td>";
                        echo "<td>";
                        echo "<a style='color:black;' href='edit.php?mobileId=" . $row['mobileId'] . "'>Edit</a> |";
                        echo "<a style='color:black;' href='delete.php?mobileId=" . $row['mobileId'] . "'>Delete</a>";
                        echo "</td>";
                        echo "</tr>";
                    }
                ?>
            </table>
            
        </div>
    </body>
</html>








