<?php 
	session_start();
	if(isset($_SESSION["user_name"]))
	{
?>

<?php
$method=$_SERVER['REQUEST_METHOD'];
if($method=='GET')
{
    $db_connection=mysqli_connect("localhost: 3306","root","root","invigilation_system");
    $id=$_GET["id"];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Faculty</title>
    
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script src="js/jquery-3.0.0.min.js"></script>
    <script src="js/bootstrap.min.js"></script>

</head>
<body>
    <header>
        <div class="header">
            <div class="text-center">
                <h2 style="font-family: 'Times New Roman',Georgia, serif; color:#337ab7;">
                INVIGILATION SYSTEM
                </h2>
            </div>
        </div>
    </header>
    <div class="row">
        <div class="text-center">
            <h3 style="font-family: 'Times New Roman',Georgia, serif; color:#337ab7;">
                UPDATE FACULTY
            </h3>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-sm-offset-11 col-sm-1">
                <a href="../home.php">HOME</a>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-offset-1 col-sm-10" style="overflow:auto; height:450px;">
            <form action="edit_faculty.php" method="post" class="form-inline">
                <input type="hidden" name="id" value="<?php echo($id); ?>" />
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>FACULTY ID</th>
                            <th>NAME</th>
                            <th>2ND YEAR SUBJECT</th>
                            <th>3RD YEAR SUBJECT</th>
                            <th>4TH YEAR SUBJECT</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $value_query=mysqli_query($db_connection,"select * from faculty where fid='$id';");
                            while($value=mysqli_fetch_array($value_query))
                            {
                        ?>
                            <tr>
                                <td><?php echo("<input type='text' name='facultyid' value='$value[0]' class='form-control' placeholder='FACULTY ID' required>"); ?></td>
                                <td><?php echo("<input type='text' name='name' value='$value[1]' class='form-control' placeholder='NAME' required>"); ?></td>
                                <td><?php 
                                        echo("<select name='2ndyearsubject' class='form-control'>");
                                        $sub=mysqli_query($db_connection,"select s.subject_code from subject s,faculty f,subject_faculty sf where sf.subject_code=s.subject_code and f.fid=sf.fid and f.fid='$value[0]' and sem in (3,4);");
                                        $sub=mysqli_fetch_array($sub);
                                        $subject_query=mysqli_query($db_connection,"select subject_code,subject_name from subject where sem in (3,4);");
                                        echo("<option value='-'>null</option>");
                                        while($subject=mysqli_fetch_array($subject_query))
                                        {
                                            if($sub[0]==$subject[0])
                                            {
                                                echo("<option value='$subject[0]' selected>$subject[1]</option>");
                                            }
                                            else
                                            {
                                                echo("<option value='$subject[0]'>$subject[1]</option>");
                                            }
                                        }
                                        echo("</select>");
                                    ?>
                                </td>
                                <td><?php 
                                        echo("<select name='3rdyearsubject' class='form-control'>");
                                        $sub=mysqli_query($db_connection,"select s.subject_code from subject s,faculty f,subject_faculty sf where sf.subject_code=s.subject_code and f.fid=sf.fid and f.fid='$value[0]' and sem in (5,6);");
                                        $sub=mysqli_fetch_array($sub);
                                        $subject_query=mysqli_query($db_connection,"select subject_code,subject_name from subject where sem in (5,6);");
                                        echo("<option value='-'>null</option>");
                                        while($subject=mysqli_fetch_array($subject_query))
                                        {
                                            if($sub[0]==$subject[0])
                                            {
                                                echo("<option value='$subject[0]' selected>$subject[1]</option>");
                                            }
                                            else
                                            {
                                                echo("<option value='$subject[0]'>$subject[1]</option>");
                                            }
                                        }       
                                        echo("</select>");
                                    ?>
                                </td>
                                <td><?php 
                                        echo("<select name='4thyearsubject' class='form-control'>");
                                        $sub=mysqli_query($db_connection,"select s.subject_code from subject s,faculty f,subject_faculty sf where sf.subject_code=s.subject_code and f.fid=sf.fid and f.fid='$value[0]' and sem in (7,8);");
                                        $sub=mysqli_fetch_array($sub);
                                        $subject_query=mysqli_query($db_connection,"select subject_code,subject_name from subject where sem in (7,8);");
                                        echo("<option value='-'>null</option>");
                                        while($subject=mysqli_fetch_array($subject_query))
                                        {
                                            if($sub[0]==$subject[0])
                                            {
                                                echo("<option value='$subject[0]' selected>$subject[1]</option>");
                                            }
                                            else
                                            {
                                                echo("<option value='$subject[0]'>$subject[1]</option>");
                                            }
                                        }       
                                        echo("</select>");
                                    ?>
                                </td>
                            </tr>
                        <?php
                            }
                        ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="5" class="text-center">
                                <input type="submit" value="UPDATE" class="btn btn-primary">
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </form>
        </div>
    </div>
</body>
</html>
<?php
    mysqli_close($db_connection);
}
else
{
    header('Location: http://localhost/DBMS_mini_project/IS.php');
}
?>

<?php
}
else{
	header("Location: login.php");
}
?>
