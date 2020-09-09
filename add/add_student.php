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
    $no_of_student=$_GET['no_of_student'];
    $usn=array();
    $studentname=array();
    $studentsem=array();
    $studentsection=array();
    $usn[0]=0;
    $studentname[0]=0;
    $studentsem[0]=0;
    $studentsection[0]=0;
    
    for($i=1;$i<=$no_of_student;$i++)
    {
        $usn_read="usn$i";
        $sdtname_read="name$i";
        $sdtsem_read="sem$i";
        $sdtsection_read="section$i";
        
        $usn[$i]=$_GET[$usn_read];
        $studentname[$i]=$_GET[$sdtname_read];
        $studentsem[$i]=$_GET[$sdtsem_read];
        $studentsection[$i]=$_GET[$sdtsection_read];
        
    }
    for($i=1;$i<=$no_of_student;$i++)
    {
        $query="insert into student(usn,s_name,sem,section) values('$usn[$i]','$studentname[$i]','$studentsem[$i]','$studentsection[$i]');";
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