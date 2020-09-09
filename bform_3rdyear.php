<?php 
	session_start();
	if(isset($_SESSION["user_name"]))
	{
?>

<?php
    $db_connection=mysqli_connect("localhost: 3306","root","root","invigilation_system");
?>
<!DOCTYPE html>
<html>
<head>

    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script src="js/jquery-3.0.0.min.js"></script>
    <script src="js/bootstrap.min.js"></script>

</head>
<?php
    $select_each_room_query=mysqli_query($db_connection,"select * from class order by priority;");
    $count=0;
    $each_room_name=array();
    $total=1;
    while($select_each_room=mysqli_fetch_array($select_each_room_query))
    {
        $each_room_name[$count]=$select_each_room[0];
        $count++;
    }
    $n=$count;
    for($c=0;$c<$n;$c++)
    {
?>
        <body>
            <P style="page-break-before: always">
            <header>
                <div class="header">
                    <div class="row">
                        <div class="col-sm-2">
                            <img src="images/MIT_LOGO.jpg" height="95" width="95" style="margin-top:18px; margin-left:80px;" class="img-circle">
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
                            <img src="images/ISE_LOGO.jpg" height="80" width="110" style="margin-top:18px; margin-left:5px;" class="img-circle">
                        </div>
                    </div>
                </div>
            </header>

            <div class="row">
                <div class="col-sm-8">
                    <h4>SUBJECT : </h4>
                    <h4>ROOM NO. : <?php echo("$each_room_name[$c]"); ?></h4>
                </div>
                <div class="col-sm-4">
                    <?php
                        $sem_query=mysqli_query($db_connection,"select sem from student where sem in (5,6) group by sem;");
                        $sem=mysqli_fetch_array($sem_query);
                    ?>
                    <h4>INTERNAL ASSESSMENT B FORM</h4>
                    <h4>SEM : <?php echo("$sem[0]"); ?></h4>
                </div>
            </div>
            <div class="row">	
                <div class="col-sm-12">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th rowspan="3">sl no.</th>
                            <th rowspan="3" class="text-center">USN</th>
                            <th rowspan="3" class="text-center">NAME</th>
                            <th colspan="3" class="text-center">1st Internals</th>
                            <th colspan="3" class="text-center">2nd Internals</th>
                            <th colspan="3" class="text-center">3rd Internals</th>
                        </tr>
                        <tr>
                            <th colspan="3">DATE:</th>
                            <th colspan="3">DATE:</th>
                            <th colspan="3">DATE:</th>
                        </tr>
                        <tr>
                            <th>Booklet No.</th>
                            <th>Additional Sheet No.</th>
                            <th>Signature</th>
                            <th>Booklet No.</th>
                            <th>Additional Sheet No.</th>
                            <th>Signature</th>
                            <th>Booklet No.</th>
                            <th>Additional Sheet No.</th>
                            <th>Signature</th>
                        </tr>
                    <?php
                        $select_each_room_3rdsem_students_query=mysqli_query($db_connection,"select usn,s_name from student where sem in (5,6) and room_no in ('$each_room_name[$c]') order by usn;");
                        $i=1;
                        while($select_each_room_3rdsem_students=mysqli_fetch_array($select_each_room_3rdsem_students_query))
                        {
                    ?>
                            <tr>
                                <th><?php echo("$i"); $i++; ?></th>
                                <th><?php echo("$select_each_room_3rdsem_students[0]"); ?></th>
                                <th><?php echo("$select_each_room_3rdsem_students[1]"); ?></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                            </tr>
                    <?php
                        }
                    ?>
                        <tr>
                            <th colspan="3">Total no of students present</th>
                            <th colspan="3"></th>
                            <th colspan="3"></th>
                            <th colspan="3"></th>
                        </tr>
                        <tr>
                            <th colspan="3">Total no of students present</th>
                            <th colspan="3"></th>
                            <th colspan="3"></th>
                            <th colspan="3"></th>
                        </tr>
                        <tr>
                            <th colspan="3">Invigilator's Name and Signature</th>
                            <th colspan="3"></th>
                            <th colspan="3"></th>
                            <th colspan="3"></th>
                        </tr>
                    </table>
                </div>
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