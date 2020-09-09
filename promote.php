<?php 
	session_start();
	if(isset($_SESSION["user_name"]))
	{
?>

<?php
    $db_connection=mysqli_connect("localhost: 3306","root","root","invigilation_system");
    
    $query2=mysqli_query($db_connection,"delete from student where sem=8;");
    $query=mysqli_query($db_connection,"update student set sem=sem+1;");
    
    if($query==1)
    {
?>
        <!DOCTYPE html>
        <html>
        <head>
            
            <script>
                alert("Promotion successfull");
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