<?php 
	session_start();
	if(isset($_SESSION["user_name"]))
	{
?>

<?php
    $db_connection=mysqli_connect("localhost: 3306","root","root","invigilation_system");
    $select_each_room_query=mysqli_query($db_connection,"select * from class order by priority desc;");
    $count=0;
    $each_room_name=array();
    while($select_each_room=mysqli_fetch_array($select_each_room_query))
    {
        $each_room_name[$count]=$select_each_room[0];
        $count++;
    }
    $n=$count;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>studentallocation1</title>

    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script src="js/jquery-3.0.0.min.js"></script>
    <script src="js/bootstrap.min.js"></script>

</head>
<?php
    for($c=3;$c<=7;$c+=2)
    {
?>
    <body>
        <P style="page-break-before: always">
        <header>
            <div class="header">
                <div class="row">
                    <div class="col-sm-2">
                        <img src="images/MIT_LOGO.jpg" height="70" width="70" style="margin-top:18px; margin-left:80px;" class="img-circle">
                    </div>
                    <div class="col-sm-8">
                        <center>
                        <h2 style="font-family: 'Times New Roman', Times, serif; color:#337ab7;">
                            MAHARAJA INSTITUTE OF TECHNOLOGY
                        </h2>
                        <h4 style="font-family: 'Tangerine', serif; color:#337ab7;">
                            DEPARTMENT OF INFORMATION SCIENCE AND ENGINEERING
                        </h4>
                        </center>
                    </div>
                    <div class="col-sm-2">
                        <img src="images/ISE_LOGO.jpg" height="65" width="90" style="margin-top:18px; margin-left:5px;" class="img-circle">
                    </div>
                </div>
            </div>
        </header>

        <div class="row">
            <div class="col-sm-offset-4 col-sm-4 text-center">
                <?php
                    $c2=$c+1;
                    $sem_query=mysqli_query($db_connection,"select sem from student where sem in ($c,$c2) group by sem;");
                    $sem=mysqli_fetch_array($sem_query);
                ?>
                <h4>SEM : <?php echo("$sem[0]"); ?></h4>
            </div>
        </div>
        <div class="row">
            <?php
            for($d=0;$d<$n;$d++)
            {
            ?>
                <div class="col-sm-4 col-lg-4">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th colspan="2" class="text-center">ROOM NO :<?php echo("$each_room_name[$d]"); ?></th>
                        </tr>
                        <tr>
                            <th class="text-center">USN</th>
                            <th class="text-center">NAME</th>
                        </tr>
                    <?php
                        $select_each_room_3rdsem_students_query=mysqli_query($db_connection,"select usn,s_name from student where sem in ($c,$c2) and room_no in ('$each_room_name[$d]') order by usn;");
                        $i=1;
                        while($select_each_room_3rdsem_students=mysqli_fetch_array($select_each_room_3rdsem_students_query))
                        {
                    ?>
                            <tr>
                                <th><?php echo("$select_each_room_3rdsem_students[0]"); ?></th>
                                <th><?php echo("$select_each_room_3rdsem_students[1]"); ?></th>
                            </tr>
                    <?php
                        }
                    ?> 
                    </table>
                </div>
            <?php
            }
            ?>
        </div>
        <br/>
        <br/>
        <br/>
        <div class="row">
            <div class="col-sm-offset-1 col-sm-3">
                <h4>IA COORDINATOR</h4>
            </div>
            <div class="col-sm-offset-6 col-sm-2">
                <h4>HOD</h4>
            </div>
        </div>
    </body>
<?php
    }
?>

</html>
<?php
    mysqli_close($db_connection);
?>

<?php
}
else{
	header("Location: login.php");
}
?>