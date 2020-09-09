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
    $no_of_faculty=$_GET['no_of_faculty'];
    $fid=array();
    $facultyname=array();
    $f2year=array();
    $f3year=array();
    $f4year=array();
    
    $fid[0]=0;
    $facultyname[0]=0;
    $f2year[0]=0;
    $f3year[0]=0;
    $f4year[0]=0;
    
    for($i=1;$i<=$no_of_faculty;$i++)
    {
        $fid_read="facultyid$i";
        $fname_read="name$i";
        $f2year_read="2ndyearsubject$i";
        $f3year_read="3rdyearsubject$i";
        $f4year_read="4thyearsubject$i";

        $fid[$i]=$_GET[$fid_read];
        $facultyname[$i]=$_GET[$fname_read];
        $f2year[$i]=$_GET[$f2year_read];
        $f3year[$i]=$_GET[$f3year_read];
        $f4year[$i]=$_GET[$f4year_read];

    }
    for($i=1;$i<=$no_of_faculty;$i++)
    {
        $query="insert into faculty(fid,fname) values('$fid[$i]','$facultyname[$i]');";
        $result=mysqli_query($db_connection,$query);
        $query1="insert into subject_faculty(fid,subject_code) values('$fid[$i]','$f2year[$i]'),('$fid[$i]','$f3year[$i]'),('$fid[$i]','$f4year[$i]');";
        $result1=mysqli_query($db_connection,$query1);
        if($result and $result1)
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