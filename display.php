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

if(isset($_GET['cid']) && isset($_GET['del'])){
	$vid = $_GET['cid'];
	$check4 = mysql_query("DELETE FROM comment WHERE `cid`={$vid}", $connection);
	        if(!$check4){
	                        die("Database query failed: " . mysql_error());
	                    }
	
}
elseif(isset($_GET['cid'])){
	$vid = $_GET['cid'];
	$check4 = mysql_query("UPDATE comment SET `verified`=1 WHERE `cid`={$vid}", $connection);
	        if(!$check4){
	                        die("Database query failed: " . mysql_error());
	                    }
}


?>

<?php
  $check4 = mysql_query("SELECT * FROM comment WHERE `verified`=0 ORDER BY cid DESC", $connection);
        if(!$check4){
                        die("Database query failed: " . mysql_error());
                    }
while($every4 = mysql_fetch_array($check4))
            {
               ?>
 
              	<?php $comm2 = $every4['comment']; 
					$id = $every4['cid'];
					?> 
        

 
<p><a href="display.php?cid=<?php echo $id ?>"><?php echo $comm2; ?></a> <font color="red"><a href="display.php?cid=<?php echo $id ?>&del=1">DELETE</a></font></p>

<?php } ?>

<?php
mysql_close($connection);
?>
