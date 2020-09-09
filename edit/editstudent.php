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
    <title>Update Student</title>
    
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
                UPDATE STUDENT
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
            <form action="edit_student.php" method="get" class="form-inline">
            <input type="hidden" name="id" value="<?php echo($id); ?>" />
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
                            $value_query=mysqli_query($db_connection,"select * from student where usn='$id';");
                            while($value=mysqli_fetch_array($value_query))
                            {
                        ?>
                            <tr>
                                <td><?php echo("<input type='text' name='usn' value='$value[0]' class='form-control' placeholder='USN' required>"); ?></td>
                                <td><?php echo("<input type='text' name='name' value='$value[1]' class='form-control' placeholder='NAME' required>"); ?></td>
                                <td><?php echo("<div class='form-group'>
                                                <select name='sem' class='form-control'>");
                                                switch ($value[2]) {
                                                    case '3':
                                                        echo("<option value='3' selected>3</option>
                                                        <option value='4'>4</option>
                                                        <option value='5'>5</option>
                                                        <option value='6'>6</option>
                                                        <option value='7'>7</option>
                                                        <option value='8'>8</option>");
                                                        break;
                                                    case '4':
                                                        echo("<option value='3'>3</option>
                                                        <option value='4' selected>4</option>
                                                        <option value='5'>5</option>
                                                        <option value='6'>6</option>
                                                        <option value='7'>7</option>
                                                        <option value='8'>8</option>");
                                                        break;
                                                    case '5':
                                                        echo("<option value='3'>3</option>
                                                        <option value='4'>4</option>
                                                        <option value='5' selected>5</option>
                                                        <option value='6'>6</option>
                                                        <option value='7'>7</option>
                                                        <option value='8'>8</option>");
                                                        break;
                                                    case '6':
                                                        echo("<option value='3'>3</option>
                                                        <option value='4'>4</option>
                                                        <option value='5'>5</option>
                                                        <option value='6' selected>6</option>
                                                        <option value='7'>7</option>
                                                        <option value='8'>8</option>");
                                                        break;
                                                    case '7':
                                                        echo("<option value='3'>3</option>
                                                        <option value='4'>4</option>
                                                        <option value='5'>5</option>
                                                        <option value='6'>6</option>
                                                        <option value='7' selected>7</option>
                                                        <option value='8'>8</option>");
                                                        break;
                                                    case '8':
                                                        echo("<option value='3'>3</option>
                                                        <option value='4'>4</option>
                                                        <option value='5'>5</option>
                                                        <option value='6'>6</option>
                                                        <option value='7'>7</option>
                                                        <option value='8' selected>8</option>");
                                                    break;
                                                
                                                }
                                          echo("</select>
                                                </div>"); ?>
                                </td>
                                <td><?php echo("<div class='form-group'>
                                                <select name='section' class='form-control'>");
                                                    switch ($value[3]) {
                                                        case 'A':
                                                        echo("<option value='A' selected>A</option>
                                                        <option value='B'>B</option>");
                                                            break;
                                                        
                                                        case 'B':
                                                        echo("<option value='A'>A</option>
                                                        <option value='B' selected>B</option>");
                                                            break;
                                                        default:
                                                            echo("<option value='A' selected>A</option>
                                                            <option value='B'>B</option>");
                                                    }
                                          echo("</select>
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