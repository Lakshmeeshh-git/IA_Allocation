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
    $no_of_class=$_GET['no_of_classroom'];
    $classcode=array();
    $classcapacity=array();
    $classpriority=array();
    
    $classcode[0]=0;
    $classcapacity[0]=0;
    $classpriority[0]=0;
    
    for($i=1;$i<=$no_of_class;$i++)
    {
        $classcode_read="roomnumber$i";
        $classcapacity_read="capacity$i";
        $classpriority_read="priority$i";
    
        $classcode[$i]=$_GET[$classcode_read];
        $classcapacity[$i]=$_GET[$classcapacity_read];
        $classpriority[$i]=$_GET[$classpriority_read];
        
    }
    for($i=1;$i<=$no_of_class;$i++)
    {
        $query="insert into class(room_no,room_capacity,priority) values('$classcode[$i]','$classcapacity[$i]','$classpriority[$i]');";
        $result=mysqli_query($db_connection,$query);
        if($result)
        {
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