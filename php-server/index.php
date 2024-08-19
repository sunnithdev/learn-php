<!DOCKTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Mobile Store</title>
        
        <style>
            body {
                font-family: Arial, sans-serif;
                margin:0;
                padding:0;
                background-color: #f8f9fa;
                display: flex;
                justify-content: center;
                align-items: center;
                height: 100vh;
            }
            
            .container {
                background-color: #fff;
                border-radius: 10px;
                padding: 40px;
                box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
                text-align: center;
            }
            
            h1 {
                color: #333;
                margin-bottom: 20px;
            }
            
            .btn {
                 display: inline-block;
                padding: 15px 30px;
                background-color: #007bff;
                color: #fff;
                text-decoration: none;
                border-radius: 5px;
                transition: background-color 0.3s ease;
                margin: 10px;
                font-size: 18px;
                border: none;
                cursor: pointer;
            }
            
            .btn:hover {
                background-color: #0056b3;
            }
            
        </style>
    </head>
    <body>
        <div class="container">
            <h1>Welcome to Mobile Store admin portal</h1>
            <a href="list.php" class="btn">View Mobiles</a>
            <a href="insert.php" class="btn">Add mobile</a>
        </div>
    </body>
</html>

