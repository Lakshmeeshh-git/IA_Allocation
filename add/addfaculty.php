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
    $no_of_faculty=$_POST["no_of_faculty"];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Student</title>
    
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
                ADD FACULTY
            </h3>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-sm-offset-10 col-sm-1">
                <a href="../home.php">HOME</a>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-offset-2 col-sm-8" style="overflow:auto; height:450px;">
            <form action="add_faculty.php" method="get" class="form-inline">
                <input type="hidden" name="no_of_faculty" value="<?php echo($no_of_faculty); ?>" />
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
                            for($i=1;$i<=$no_of_faculty;$i++)
                            {
                        ?>
                            <tr>
                                <td><?php echo("<input type='text' name='facultyid$i' value='' class='form-control' placeholder='FACULTY ID' required>"); ?></td>
                                <td><?php echo("<input type='text' name='name$i' value='' class='form-control' placeholder='NAME' required>"); ?></td>
                                <td><?php 
                                        echo("<div class='form-group'>");
                                        echo("<select name='2ndyearsubject$i' class='form-control'>");
                                        $subject_query=mysqli_query($db_connection,"select subject_code,subject_name from subject where sem in (3,4);");
                                        echo("<option value='-'>null</option>");
                                        while($subject=mysqli_fetch_array($subject_query))
                                        {
                                            echo("<option value='$subject[0]'>$subject[1]</option>");
                                        }
                                        echo("</select>");
                                        echo("</div>"); 
                                    ?>
                                </td>
                                <td><?php 
                                        echo("<div class='form-group'>");
                                        echo("<select name='3rdyearsubject$i' class='form-control'>");
                                        $subject_query=mysqli_query($db_connection,"select subject_code,subject_name from subject where sem in (5,6);");
                                        echo("<option value='-'>null</option>");
                                        while($subject=mysqli_fetch_array($subject_query))
                                        {
                                            echo("<option value='$subject[0]'>$subject[1]</option>");
                                        }       
                                        echo("</select>");
                                        echo("</div>"); 
                                    ?>
                                </td>
                                <td><?php 
                                        echo("<div class='form-group'>");
                                        echo("<select name='4thyearsubject$i' class='form-control'>");
                                        $subject_query=mysqli_query($db_connection,"select subject_code,subject_name from subject where sem in (7,8);");
                                        echo("<option value='-'>null</option>");
                                        while($subject=mysqli_fetch_array($subject_query))
                                        {
                                            echo("<option value='$subject[0]'>$subject[1]</option>");
                                        }       
                                        echo("</select>");
                                        echo("</div>"); 
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
                                <input type="reset" value="CLEAR" class="btn btn-primary">
                                <input type="submit" value="ADD" class="btn btn-primary">
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
    header('Location: http://localhost/Invigilation_System/home.php');
}
?>

<?php
}
else{
	header("Location: login.php");
}
?>