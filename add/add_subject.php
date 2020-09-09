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
    $no_of_subject=$_GET['no_of_subject'];
    $subjectcode=array();
    $subjectname=array();
    $subjectsem=array();
    $subjectcode[0]=0;
    $subjectname[0]=0;
    $subjectsem[0]=0;
    
    for($i=1;$i<=$no_of_subject;$i++)
    {
        $subcode="subjectcode$i";
        $subname="subjectname$i";
        $subsem="sem$i";
        $subjectcode[$i]=$_GET[$subcode];
        $subjectname[$i]=$_GET[$subname];
        $subjectsem[$i]=$_GET[$subsem];
        
    }
    for($i=1;$i<=$no_of_subject;$i++)
    {
        $query="insert into subject(subject_code,subject_name,sem) values('$subjectcode[$i]','$subjectname[$i]','$subjectsem[$i]');";
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