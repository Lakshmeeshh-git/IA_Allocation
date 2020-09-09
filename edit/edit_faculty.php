<?php 
	session_start();
	if(isset($_SESSION["user_name"]))
	{
?>

<!DOCTYPE html>
<html>
<head>
    
</head>
<body>
<?php
$method=$_SERVER['REQUEST_METHOD'];
if($method=='POST')
{
    $db_connection=mysqli_connect("localhost: 3306","root","root","invigilation_system");
    $id=$_POST['id'];
    $fid=$_POST['facultyid'];
    $facultyname=$_POST['name'];
    $f2year=$_POST['2ndyearsubject'];
    $f3year=$_POST['3rdyearsubject'];
    $f4year=$_POST['4thyearsubject'];

    $query1=mysqli_query($db_connection,"delete from subject_faculty where fid='$id';");

    $query="update faculty set fid='$fid',fname='$facultyname' where fid='$id';";
    $result=mysqli_query($db_connection,$query);
    $result1=mysqli_query($db_connection,"insert into subject_faculty(fid,subject_code) values('$fid','$f2year'),('$fid','$f3year'),('$fid','$f4year');");
    if($result==1)
    {
    ?>
        <script>
            alert("<?php echo("Updated successfully\\nid : $fid\\nname : $facultyname\\nSubject1 : $f2year\\nSubject2 : $f3year\\nSubject3 : $f4year"); ?>");
        </script>
    <?php
    }
    else
    {
        $error=mysqli_error($db_connection);
    ?>

        <script>
            alert("<?php echo("ERROR : $error"); ?>");
        </script>
    <?php
    }
    mysqli_close($db_connection);
}
?>
</body>
</html>
<script>
    window.location.href="../home.php";
</script>

<?php
}
else{
	header("Location: login.php");
}
?>