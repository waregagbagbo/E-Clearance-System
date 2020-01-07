<?php

// connect to the database
include('connect-db.php');

// confirm that the 'id' variable has been set and the Department ID has been passed

if (isset($_GET['id']) && is_numeric($_GET['id'])){
    // get the 'id'  and the 'dept' variable from the URL
    $id = $_GET['id'];
    $dept = $_GET['dept'];

    // update the clearance status in the DATABASE
    if ($stmt = $mysqli->prepare("UPDATE clearance SET $dept='CLEARED' WHERE id= ? LIMIT 1")){
        $stmt->bind_param("i",$id);
        $stmt->execute();
        $stmt->close();
    }

    // IF  UPDATE FAILS 
    else {
        echo "ERROR: could not prepare SQL statement.";
    }

    $mysqli->close();
    // redirect user after delete is successful
    header("Location:dept_index.php");
}
else
// if the 'id' variable isn't set, redirect the user
{
    header("Location: dept_view.php");
}



// if(isset($_GET['email']) && !empty($_GET['email']) AND isset($_GET['eventid']) && !empty($_GET['eventid'])){
//     ////do whatever here
//     }

?>


