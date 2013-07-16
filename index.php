<?php session_start(); ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
    <title>Movie Mash</title>
    <link rel="stylesheet" type="text/css" href="style.css" />
</head>

<body>

<div align=center><img src="images/banner1.jpg" alt="VIT Facemasher" width=50% />
    
</div>
<h2>Vote For The Best Of Two</h2>
<br/>
<br/>
<?php
include 'server.php';
$flag = 0;
$connection = mysql_connect("$HOST","$USER","$PASS");
    if(!$connection){
        die("Database connection failed: " . mysql_error());
    }
    
    $db_select = mysql_select_db("$DATABASE", $connection);
    if(!$db_select){
        die("Database selection failed: " . mysql_error());
    }
    $check7 = mysql_query("SELECT * FROM rank", $connection);
                if(!$check7){
                                die("Database query failed: " . mysql_error());
                            }
                            
    $maxnum = mysql_num_rows($check7);
    
    do{
    $random1 = rand(1,$maxnum);
    $random2 = rand(1,$maxnum);
    }while(($random1==$random2)||((isset($_SESSION['repeat'][$random1][$random2]))&&(isset($_SESSION['repeat'][$random2][$random1]))));
    
    $_SESSION['repeat'][$random1][$random2]=1;
    $_SESSION['repeat'][$random2][$random1]=1;



?>

                                      
                                      
                                      
                                      
<a href="rank.php?win=<?php echo $random1; ?>&lose=<?php echo $random2; ?>"><img class=face src="images/<?php echo $random1; ?>.jpg"/></a>

<a href="rank.php?win=<?php echo $random2; ?>&lose=<?php echo $random1; ?>"><img class=face1 src="images/<?php echo $random2; ?>.jpg"/></a>

<br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>

<?php
if(isset($_POST['full']))
{
    $limit = 50;
    $num = "Full List";
}
else
{
    $limit = 10;
    $num = "Top Ten";
}
$totvote = 0;
   $check21 = mysql_query("SELECT * FROM rank", $connection);
                if(!$check21){
                                die("Database query failed: " . mysql_error());
                            }
   
                             while($every21 = mysql_fetch_array($check21))
                    {
                        $totvote=$totvote+$every21['vote'];
                        
                        }
?>
<form action="index.php" method="post">
<center><input type="submit" value="Skip" width="10%"/>
</center></form><br/>

<?php
echo "<h3><i>Total Clicks : {$totvote}</i></h3>";                        
echo "<h2>{$num}</h2>";
$rank=0;
$check2 = mysql_query("SELECT * FROM rank ORDER BY rvalue DESC LIMIT $limit", $connection);
                if(!$check2){
                                die("Database query failed: " . mysql_error());
                            }
   
                             while($every2 = mysql_fetch_array($check2))
                    {if($flag==0){
                        $max=$every2['rvalue'];
                        $flag=1;
                        }
                        
                        $name = $every2['id'];
                    $rank = $rank +1;
                    $rvalue = $every2['rvalue'];
                    $rate = ($rvalue/$max)*10;
                    
                    
                 
                            ?>

<div class="img">
 <a target="_blank" href="images/<?php echo $name; ?>.jpg"><img src="images/<?php echo $name; ?>.jpg" width="90" height="120" /></a>
 <div class="desc">Rank : <?php echo $rank; ?><br/>
 Rating : <?php echo round($rate,2); ?></div>
</div>

<?php } ?>

<div style="clear:both;"></div>
<form action="index.php" method="post">
    <div align = center><input type="submit" name="full" value="Full Rank List" />
    </div>
</form>

        <form action="comment.php" method="post" >
    
<div align=center>
    
    <br/>
    <textarea name="comment" rows="5" cols="75"></textarea>            <br/>
            <input type="submit" name="comment1" value="Comment" /></div>
            <br/>
            
        </form>
   <center>  <p><i> <u>Only Verified Comments will be displayed below:</u></i></p></center>
        <?php
          $check4 = mysql_query("SELECT * FROM comment WHERE `verified`=1 ORDER BY cid DESC", $connection);
                if(!$check4){
                                die("Database query failed: " . mysql_error());
                            }
        while($every4 = mysql_fetch_array($check4))
                    {
                        $user = $every4['user'];
                        $comm2 = $every4['comment'];
                
                       
        ?>
     <center>
	  
        <p><?php echo $comm2; ?></p></center>
        
        <?php } ?>

</body>
</html>
<div style="display:none">