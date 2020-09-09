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
if($method=='GET')
{
    $db_connection=mysqli_connect("localhost: 3306","root","root","invigilation_system");
    $id=$_GET['id'];
    $usn=$_GET['usn'];
    $studentname=$_GET['name'];
    $studentsem=$_GET['sem'];
    $studentsection=$_GET['section'];
    $query="update student set usn='$usn',s_name='$studentname',sem='$studentsem',section='$studentsection' where usn='$id';";
    $result=mysqli_query($db_connection,$query);
    if($result)
    {
        ?>
        <script>
            alert("<?php echo("Updated successfully\\nUSN : $usn\\nName : $studentname\\nSem : $studentsem\\nSection : $studentsection"); ?>");
        </script>
    <?php
    }
    else
    {
        $error=mysqli_error($db_connection);
    ?>

        <script>
            alert("<?php echo($error); ?>");
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