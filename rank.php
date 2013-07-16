<?php
session_start();
ob_start();
include 'server.php';
$connection = mysql_connect("$HOST","$USER","$PASS");
    if(!$connection){
        die("Database connection failed: " . mysql_error());
    }
    
    $db_select = mysql_select_db("$DATABASE", $connection);
    if(!$db_select){
        die("Database selection failed: " . mysql_error());
    }
    
    $wwin=1;
    $wlose=0;
    $k = 50;
    
    $winid=$_GET['win'];
    $loseid=$_GET['lose'];
    
    $result = mysql_query("SELECT * FROM rank WHERE id={$winid}", $connection);
    if(!$result){
        die("Database query failed: " . mysql_error());
    }
    
    if(mysql_num_rows($result)!=0)
    {
        $row = mysql_fetch_array($result);
        $rwin = $row['rvalue'];
        $vote = $row['vote'] + 1;
    
        
    }
 $result1 = mysql_query("SELECT * FROM rank WHERE id={$loseid}", $connection);
    if(!$result1){
        die("Database query failed: " . mysql_error());
    }
    
    if(mysql_num_rows($result1)!=0)
    {
        $row1 = mysql_fetch_array($result1);
        $rlose = $row1['rvalue'];
        
    }
   
    $ewin = 1/(1+pow(10,($rlose-$rwin)/400));
    
    $elose = 1/(1+pow(10,($rwin-$rlose)/400));
    
    $rwinnew = $rwin + $k*($wwin-$ewin);
    $rlosenew = $rlose + $k*($wlose-$elose);
    
    $result2 = mysql_query("UPDATE rank SET  evalue=$ewin, rvalue =  $rwinnew, vote = $vote WHERE id={$winid}", $connection);
    if(!$result2){
        die("Database query failed: " . mysql_error());
    }
    
    $result3 = mysql_query("UPDATE rank SET  evalue=$elose, rvalue =  $rlosenew WHERE id={$loseid}", $connection);
    if(!$result3){
        die("Database query failed: " . mysql_error());
    }
header("Location: index.php");

?>