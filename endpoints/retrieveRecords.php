<?php
    require "../functions/dbConnection.php";
    // Our db will only
   //  respond if the post request comes with a userID.
    // Return a query
    if(isset($_POST['userID']) && isset($_POST['thisUser'])){
        $dbConn = getConnection();

        $sql = "SELECT * FROM userData WHERE userId=" . $_POST['userID'];
        $stmt = $dbConn -> prepare($sql);
        $stmt -> execute();
        $result = $stmt -> fetchAll();

        echo json_encode($result);
    }
    // aggregate function to get average of catches
    else if(isset($_POST['userID']) && isset($_POST['thisUserAverage'])){
        $dbConn = getConnection();
        $sql = "SELECT AVG(weight) AS avg FROM userData WHERE userId=" . $_POST['userID'];
        $stmt = $dbConn -> prepare($sql);
        $stmt -> execute();
        $result = $stmt -> fetchAll();

        echo json_encode($result);
    }
    // JOIN username table and posts for main page
    else if(isset($_POST['userID']) && isset($_POST['mainPage'])){
        $dbConn = getConnection();
        $sql = "SELECT * FROM userData p JOIN instaUsers q WHERE p.userID=q.userID";
        $stmt = $dbConn -> prepare($sql);
        $stmt -> execute();
        $result = $stmt -> fetchAll();

        echo json_encode($result);
      }
    else if(isset($_POST['userID'])){
        // TODO: 
        // join here with userData to get user name
        $dbConn = getConnection();
        $sql = "SELECT * FROM userData p JOIN instaUsers q WHERE NOT p.userId=" . $_POST['userID'] . " AND p.userId=q.userId";
        $stmt = $dbConn -> prepare($sql);
        $stmt -> execute();
        $result = $stmt -> fetchAll();
        echo json_encode($result);
    } else{
        echo "404. Page not found.";
    }

?>
