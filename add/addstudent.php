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
    $no_of_student=$_POST["no_of_student"];
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
                ADD STUDENT
            </h3>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-sm-offset-9 col-sm-1">
                <a href="../home.php">HOME</a>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-offset-3 col-sm-6" style="overflow:auto; height:450px;">
            <form action="add_student.php" method="get" class="form-inline">
            <input type="hidden" name="no_of_student" value="<?php echo($no_of_student); ?>" />
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>USN</th>
                            <th>NAME</th>
                            <th>SEM</th>
                            <th>SECTION</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            for($i=1;$i<=$no_of_student;$i++)
                            {
                        ?>
                            <tr>
                                <td><?php echo("<input type='text' name='usn$i' value='' class='form-control' placeholder='USN' required>"); ?></td>
                                <td><?php echo("<input type='text' name='name$i' value='' class='form-control' placeholder='NAME' required>"); ?></td>
                                <td><?php echo("<div class='form-group'>
                                                <select name='sem$i' class='form-control'>
                                                    <option value='3'>3</option>
                                                    <option value='4'>4</option>
                                                    <option value='5'>5</option>
                                                    <option value='6'>6</option>
                                                    <option value='7'>7</option>
                                                    <option value='8'>8</option>
                                                </select>
                                                </div>"); ?>
                                </td>
                                <td><?php echo("<div class='form-group'>
                                                <select name='section$i' class='form-control'>
                                                    <option value='A'>A</option>
                                                    <option value='B'>B</option>
                                                </select>
                                                </div>"); ?>
                                </td>
                            </tr>
                        <?php
                            }
                        ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="4" class="text-center">
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