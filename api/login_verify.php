<?php
include 'database.php';

if (!empty($_POST["login"])) {
    session_start();
    $username = filter_var($_POST["username"], FILTER_SANITIZE_STRING);
    $password = filter_var($_POST["password"], FILTER_SANITIZE_STRING);

    // update schema of the database that you want to query.
    $schema = "";
    // update name of the database table where username and passwords are stored.
    $dataSource = "";
    // query to fetch username and password.
    $usersQuery = "";
    // execute query
    //$usersResult = @pg_query($dbconn, $usersQuery);
    
    // if result for the given username and password is returned then return true otherwise return false.

    // for now setting verified to true by default
    $verified = true;
    // if (!$usersResult) {
    //     $verified = false;
    // } else {
    //     $count=0;
    //     $passwords = array();
    //     if ($data = pg_fetch_object($usersResult)) {
    //         $passwords = json_decode($data->PASSWORDS);
    //         foreach ($passwords as $hash) {
    //             if (md5($password) == $hash) {
    //                 $verified = true;
    //                 break;
    //             }
    //         }
    //     }
    // }
    @pg_close($dbconn);
    if ($verified) {
        $_SESSION["sessionId"] = $username;
        header("Location: ../index.php");
    } else {
        $_SESSION["errorMessage"] = "Authentication Failed";
        header("Location: ../login.php");
    }
    exit();

}

?>