<?php 
	session_start();
	if(isset($_SESSION["user_name"]))
	{
?>

<?php
    $db_connection=mysqli_connect("localhost: 3306","root","root","invigilation_system");
    $query=mysqli_query($db_connection,"delete from student where sem in (3,4);");
    if($query==1)
    {
?>
        <!DOCTYPE html>
        <html>
        <head>
            
            <script>
                alert("deletion successfull");
            </script>
        </head>
        <body>
            
        </body>
        </html>

<?php    
    }
    mysqli_close($db_connection);
?>
<script>
    window.location.href="home.php";
</script>

<?php
}
else{
	header("Location: login.php");
}
?>