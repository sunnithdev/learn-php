<!docktype html>
<html>
    <body>
        <?php
            if($_SERVER["REQUEST_METHOD"]=="POST")
            {
                define("INITIALIZING_DATABASE",1);
                require_once("db_conn.php");
                
                $dbc->query("drop database if exists mobileStore");
                $dbc->query("create database mobileStore");
                
                $dbc->query("use mobileStore");
                $dbc->query("create table mobile (
                    mobileId mediumint(8) unsigned not null auto_increment,
                    mobileName varchar(100) not null,
                    mobileDescription TEXT not null,
                    quantityAvailable INT not null,
                    price DECIMAL(10,2) not null,
                    operationSystem VARCHAR(50) NOT NULL,
                    productAddedBy VARCHAR(100) NOT NUll DEFAULT 'Sunnith_Kumar_Chinthapally',
                    PRIMARY KEY(mobileId)
                ) Engine=InnoDB auto_increment=1 default CHARSET=utf8mb4");
                echo "<h3>Database Initializes</h3>";
            }
        ?>
        <form method="POST">
            <input type="submit" value="Initialize database">
        </form>
    
    </body>
</html>







