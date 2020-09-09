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
    $subjectcode=$_GET['subjectcode'];
    $subjectname=$_GET['subjectname'];
    $subjectsem=$_GET['sem'];

    $query="update subject set subject_code='$subjectcode',subject_name='$subjectname',sem='$subjectsem' where subject_code='$id';";
    $result=mysqli_query($db_connection,$query);
    if($result)
    {
        ?>
        <script>
            alert("<?php echo("Updated successfully\\nsubject code : $subjectcode\\nsubject name : $subjectname\\nsem : $subjectsem"); ?>");
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