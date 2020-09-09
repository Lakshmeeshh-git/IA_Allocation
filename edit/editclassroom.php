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
    <title>Update Classroom</title>
    
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
                UPDATE CLASS ROOM
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
            <form action="edit_classroom.php" method="get">
                <input type="hidden" name="id" value="<?php echo($id); ?>" />
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
                            $value_query=mysqli_query($db_connection,"select * from class where room_no='$id';");
                            while($value=mysqli_fetch_array($value_query))
                            {
                        ?>
                            <tr>
                                <td><?php echo("<input type='text' name='roomnumber' value='$value[0]' class='form-control' placeholder='ROOM NUMBER' required>"); ?></td>
                                <td><?php echo("<input type='number' name='capacity' value='$value[1]' class='form-control' placeholder='CAPACITY' required>"); ?></td>
                                <td><?php echo("<input type='number' name='priority' value='$value[2]' class='form-control' placeholder='PRIORITY' required>"); ?></td>
                            </tr>
                        <?php
                            }
                        ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="5" class="text-center"><input type="submit" value="UPDATE" class="btn btn-primary"></td>
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