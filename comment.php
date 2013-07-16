<?php ob_start(); ?>

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
<?php ob_start();

      $comm1 = strip_tags($_POST['comment']);
      $processUser = posix_getpwuid(posix_geteuid());
      $uname = $processUser['name'];
      //$uname = get_current_user();
      $comm = htmlspecialchars($comm1);
        if((isset($comm))||(!empty($comm)))
        {
             $comment = mysql_query("INSERT INTO comment (comment, user) VALUES ('$comm','$uname')", $connection);
             if(!$comment){
        die("Database query failed: " . mysql_error());
    }
 header("Location: index.php");
 exit;}

?>
<?php
mysql_close($connection);
?>
