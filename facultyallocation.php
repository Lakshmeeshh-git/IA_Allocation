<?php 
	session_start();
	if(isset($_SESSION["user_name"]))
	{
?>

<?php
$method=$_SERVER['REQUEST_METHOD'];
if($method=='POST')
{
    $db_connection=mysqli_connect("localhost: 3306","root","root","invigilation_system");
    $select_each_room_query=mysqli_query($db_connection,"select * from class order by priority desc;");
    $count=0;
    $each_room_name=array();
    while($select_each_room=mysqli_fetch_array($select_each_room_query))
    {
        $each_room_name[$count]=$select_each_room[0];
        $count++;
    }
    $no_of_class=$count;
    $year2subject=$_POST['2ndyearsubject'];
    $year3subject=$_POST['3rdyearsubject'];
    $year4subject=$_POST['4thyearsubject'];
    
    $faculty_count_query=mysqli_query($db_connection,"select count(*) from faculty;");
    $faculty_count=mysqli_fetch_array($faculty_count_query);
    $faculty_count=$faculty_count[0];
    $index=0;
    $faculty=array();
    for($i=1;$i<=$faculty_count;$i++)
    {
        $faculty_name="faculty$i";
        if(isset($_POST[$faculty_name]))
        {
            $faculty_name="faculty$i";
            $faculty[$index]=$_POST[$faculty_name];
            $index++;
        }
    }
    $allfaculty="";
    for($i=0;$i<$index-1;$i++)
    {
        $allfaculty=$allfaculty."'".$faculty[$i]."',";
    }
    $allfaculty=$allfaculty."'$faculty[$i]'";
    if($index>=$no_of_class)
    {

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>faculty allocation</title>

    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script src="js/jquery-3.0.0.min.js"></script>
    <script src="js/bootstrap.min.js"></script>

</head>

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
<br/>
    <div class="row">
        <div class="col-sm-offset-4 col-sm-4">
            <h4>Subject1:<?php echo($year2subject); ?></h4>
            <h4>Subject2:<?php echo($year3subject); ?></h4>
            <h4>Subject3:<?php echo($year4subject); ?></h4>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-offset-4 col-sm-4">
            <table class="table table-bordered table-striped">
            <?php
            $d=0;
            $subject_faculty_query=mysqli_query($db_connection,"select fname from faculty where fname not in (select fname from faculty f,subject_faculty sf, subject s where sf.subject_code=s.subject_code and f.fid=sf.fid and s.subject_name in ('$year2subject','$year3subject','$year4subject')) and fname in ($allfaculty);");
            while($subject_faculty=mysqli_fetch_array($subject_faculty_query))
            {
                if($d<$count)
                {
            ?>  
                <tr>
                    <td><?php echo($subject_faculty[0]); ?></th>
                    <th class="text-center"><?php echo("$each_room_name[$d]"); ?></th>
                </tr> 
                    
            <?php
                    $d++;
                }
            }
            ?>
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

</html>
<?php
    }
    else
    {
?>
        <script>
            alert("No sufficient faculties, select more faculties");
            window.location.href="./IS.php";
        </script>        
<?php
    }
    mysqli_close($db_connection);
}
?>

<?php
}
else{
	header("Location: login.php");
}
?>