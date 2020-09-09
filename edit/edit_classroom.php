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
    $classcode=$_GET['roomnumber'];
    $classcapacity=$_GET['capacity'];
    $classpriority=$_GET['priority'];
    
    $query="update class set room_no='$classcode',room_capacity='$classcapacity',priority='$classpriority' where room_no='$id';";
    $result=mysqli_query($db_connection,$query);
    if($result)
    {
        ?>
        <script>
            alert("<?php echo("Updated successfully\\nRoom number : $classcode\\nCapacity : $classcapacity\\nPriority : $classpriority"); ?>");
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