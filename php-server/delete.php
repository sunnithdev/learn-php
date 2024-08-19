<?php
    include 'db_conn.php';
    
    if(isset($_GET['mobileId'])) {
        $mobileId = mysqli_real_escape_string($dbc, $_GET['mobileId']);
        
        $sql = "DELETE FROM mobile WHERE mobileId = ?";
        
        if($stmt = mysqli_prepare($dbc, $sql)) {
            mysqli_stmt_bind_param($stmt, 'i', $mobileId);
            
            if(mysqli_stmt_execute($stmt)){
               echo "<!DOCTYPE html>
                      <html>
                      <head>
                          <title>Mobile Deleted</title>
                          <style>
                              body {
                                  font-family: Arial, sans-serif;
                                  margin: 0;
                                  padding: 0;
                                  background-color: #f8f9fa;
                                  text-align: center;
                              }
                              h1 {
                                  color: #333;
                                  margin-top: 100px;
                              }
                              button {
                                  padding: 10px 20px;
                                  background-color: #007bff;
                                  color: #fff;
                                  border: none;
                                  border-radius: 5px;
                                  cursor: pointer;
                                  transition: background-color 0.3s ease;
                              }
                              button:hover {
                                  background-color: #0056b3;
                              }
                          </style>
                      </head>
                      <body>
                          <h1>Mobile Deleted</h1>
                          <a href='list.php'><button>Back to Mobile List</button></a>
                      </body>
                      </html>";
                exit();
            } else {
                echo "error";
            }
        }
        
        mysqli_stmt_close($stmt);
        
    } else {
        header("location: list.php");
    }
    
    mysqli_close($dbc);
    
?>











