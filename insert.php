<?php ob_start();

include 'server.php';
    $connection = mysql_connect("$HOST","$USER","$PASS");
    if(!$connection){
        die("Database connection failed: " . mysql_error());
    }
    
    $db_select = mysql_select_db("$DATABASE", $connection);
    if(!$db_select){
        die("Database selection failed: " . mysql_error());
    }
?>
<?php

if(isset($_POST['comment2']))
{
    $insert = $_POST['comment3'];
    $username = "Admin";
  
    
   
       
        
         $fresult = mysql_query("INSERT INTO comment (user, comment) VALUES ('$username','$insert')", $connection);
    if(!$fresult){
        die("Database query failed: " . mysql_error());
    }
    else {
       
        echo "Comment inserted Successfully.";
      
    }
    
        
}

?>
      
<form action="insert.php" method="post">
            
           
            <h4>Comment:</h4><textarea name="comment3" rows="5" cols="75"></textarea>            <br/>
            <input type="submit" name="comment2" value="Comment" />
            <br/><br/>
           
           
          </form>
<?php
mysql_close($connection);

?>