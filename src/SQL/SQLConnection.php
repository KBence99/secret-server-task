<?php 

    /**
     * Connects to the SQL server
     */

    function SQLConnect(){
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "secrets";
    
        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        return $conn;
    }

    /**
     * Closes connection to the SQL server
     */

    function SQLCloseConnection(mysqli $conn){
        $conn->close();
    }
?>