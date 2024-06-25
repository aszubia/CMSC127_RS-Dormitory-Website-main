<?php

    # Database Connection Here...
    $hname = 'localhost';
    $uname = 'root';
    $pass = '';
    $db = 'dormdb';

    $conn = mysqli_connect($hname, $uname, $pass, $db);

    if(!$conn){
        die("Cannot connect to the Database".mysqli_connect_error());
    }

    # Function to insert data into the database
    function filteration($data){
        foreach($data as $key => $value){
            $data[$key] = trim($value);
            $data[$key] = stripcslashes($value);
            $data[$key] = htmlspecialchars($value);
            $data[$key] = strip_tags($value);
        }
        return $data;
    }

    # Function to insert data into the database
    function select($sql,$values,$datatypes)
    {
        $conn = $GLOBALS['conn'];
        if($stmt = mysqli_prepare($conn, $sql)){
            mysqli_stmt_bind_param($stmt, $datatypes, ...$values);
            if(mysqli_stmt_execute($stmt)){
                $res = mysqli_stmt_get_result($stmt);
                mysqli_stmt_close($stmt);
                return $res;
            }
            else{
                mysqli_stmt_close($stmt);
                die("Query cannot be executed - Select");
            } 
        }
        else{
            die("Query cannot be prepared - Select");
        } 
        
    }
