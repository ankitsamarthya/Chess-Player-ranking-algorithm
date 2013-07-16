

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

if(isset($_POST['upload']))
{
    $fname = $_FILES["file"]["name"];
     $ftype = $_FILES["file"]["type"];
   
    $ftemp = $_FILES["file"]["tmp_name"];
    $ferror = $_FILES["file"]["error"];
  
  
    $flocation = "images/".$fname;
    $temploc = "http://vitfacemash.net16.net/images/".$fname;
   
       
        move_uploaded_file($ftemp, $flocation);
         $fresult = mysql_query("INSERT INTO rank (id, evalue, rvalue, location, vote) VALUES ('$fname', 0, 2000, '$temploc', 0)", $connection);
    if(!$fresult){
        die("Database query failed: " . mysql_error());
    }
    else {
       
        echo "File Uploaded Successfully.";
      
    }
    
        
}

?>
      
<form action="upload.php" method="post" enctype="multipart/form-data">
            
           
            <h4>File Url:</h4><input type="file" name="file" />
            <br/><br/>
           
            <input type="submit" name="upload" value="Upload"  />
            <br/><br/>
          </form>
<?php
mysql_close($connection);

?>



