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
    $no_of_classroom=$_POST["no_of_classroom"];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add class room</title>
    
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
                ADD CLASS ROOM
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
            <form action="add_classroom.php" method="get">
                <input type="hidden" name="no_of_classroom" value="<?php echo($no_of_classroom); ?>" />
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>ROOM NUMBER</th>
                            <th>CAPACITY</th>
                            <th>PRIORITY</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            for($i=1;$i<=$no_of_classroom;$i++)
                            {
                        ?>
                            <tr>
                                <td><?php echo("<input type='text' name='roomnumber$i' value='' class='form-control' placeholder='ROOM NUMBER' required>"); ?></td>
                                <td><?php echo("<input type='number' name='capacity$i' value='' class='form-control' placeholder='CAPACITY' required>"); ?></td>
                                <td><?php echo("<input type='number' name='priority$i' value='' class='form-control' placeholder='PRIORITY' required>"); ?></td>
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