<?php 
	session_start();
	if(isset($_SESSION["user_name"]))
	{
?>

<?php
    $db_connection=mysqli_connect("localhost: 3306","root","root","invigilation_system");
?>

<!doctype html>
<html>
<head>

    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script src="js/jquery-3.0.0.min.js"></script>
    <script src="js/bootstrap.min.js"></script>


    <style>

        .header
        {
        background-color:#FFFFFF;
        }

    </style>
</head>

<body>

<script type="text/javascript">
window.onload = function(){
    studentRedirectToEdit=function(id)
    {
        window.location.href="edit/editstudent.php?id="+id;

    }
    studentRedirectToDelete=function(id)
    {
        result=confirm("Are you sure?");
        if(result==true)
        {
            window.location.href="delete/deletestudent.php?id="+id;
        }

    }
    facultyRedirectToEdit=function(id)
    {
        window.location.href="edit/editfaculty.php?id="+id;

    }
    facultyRedirectToDelete=function(id)
    {
        result=confirm("Are you sure?");
        if(result==true)
        {
            window.location.href="delete/deletefaculty.php?id="+id;
        }

    }
    subjectRedirectToEdit=function(id)
    {
        window.location.href="edit/editsubject.php?id="+id;

    }
    subjectRedirectToDelete=function(id)
    {
        result=confirm("Are you sure?");
        if(result==true)
        {
            window.location.href="delete/deletesubject.php?id="+id;
        }

    }
    classRedirectToEdit=function(id)
    {
        window.location.href="edit/editclassroom.php?id="+id;

    }
    classRedirectToDelete=function(id)
    {
        result=confirm("Are you sure?");
        if(result==true)
        {
            window.location.href="delete/deleteclass.php?id="+id;
        }

    }
    
    redirectToPromote=function()
    {
        result=confirm("Are you sure?");
        if(result==true)
        {
            window.location.href="promote.php";
        }

    }
    redirectToDrop2year=function()
    {
        result=confirm("Are you sure?");
        if(result==true)
        {
            window.location.href="drop_2ndyear.php";
        }

    }
    redirectToDrop3year=function()
    {
        result=confirm("Are you sure?");
        if(result==true)
        {
            window.location.href="drop_3rdyear.php";
        }

    }
    redirectToDrop4year=function()
    {
        result=confirm("Are you sure?");
        if(result==true)
        {
            window.location.href="drop_4thyear.php";
        }

    }
    redirectToDeallocate=function()
    {
        result=confirm("Are you sure?");
        if(result==true)
        {
            window.location.href="deallocate.php";
        }

    }
    
}
   
        
</script>
    <header>
        <div class="header">
            <div class="text-center">
                <h2 style="font-family: 'Times New Roman', Times, serif; color:#337ab7;">
                INVIGILATION SYSTEM
                </h2>
            </div>
            <div class="container">
                <div class="col-sm-offset-11 col-sm-1">
                    <a href="logout.php" class="text-right">logout</a>
                </div>
            </div>
        </div>
    </header>

    <div class="container">
        <div class="row">
            <div class="col-lg-offset-2 col-lg-8">
                <ul class="nav nav-pills nav-justified">
                <?php
                    $method=$_SERVER['REQUEST_METHOD'];
                    if($method=='POST')
                    {
                ?>
                        <li><a href="#Home" data-toggle="tab">Home</a></li>
                        <li class="active"><a href="#Student" data-toggle="tab">Student</a></li>
                <?php
                    }
                    else
                    {
                ?>
                        <li class="active"><a href="#Home" data-toggle="tab">Home</a></li>
                        <li><a href="#Student" data-toggle="tab">Student</a></li>
                <?php
                    }
                ?>
                    <li><a href="#Faculty" data-toggle="tab">Faculty</a></li>
                    <li><a href="#Subject" data-toggle="tab">Subject</a></li>
                    <li><a href="#Class" data-toggle="tab">Class</a></li>
                    <li><a href="#Add" data-toggle="tab">Add</a></li>
                    <li><a href="#More" data-toggle="tab">More</a></li>
                </ul>
            </div>
        </div>
        <div class="tab-content">
            <!-- HOME -->
            <?php
                $method=$_SERVER['REQUEST_METHOD'];
                if($method=='POST')
                {
            ?>
            <div class="tab-pane" id="Home">
            <?php
                }
                else
                {
            ?>
            <div class="tab-pane active" id="Home">
            <?php
                }
            ?>
            
            <br/>
            <?php
                $student_count_query=mysqli_query($db_connection,"select count(usn) from student;");
                $student_count=mysqli_fetch_array($student_count_query);
                $student_count=$student_count[0];
                $capacity_count_query=mysqli_query($db_connection,"select sum(room_capacity) from class;");
                $capacity_count=mysqli_fetch_array($capacity_count_query);
                $capacity_count=$capacity_count[0];
                $faculty_count_query=mysqli_query($db_connection,"select count(fid) from faculty;");
                $faculty_count=mysqli_fetch_array($faculty_count_query);
                $faculty_count=$faculty_count[0];
                $classroom_count_query=mysqli_query($db_connection,"select count(room_no) from class;");
                $classroom_count=mysqli_fetch_array($classroom_count_query);
                $classroom_count=$classroom_count[0];
                $allocated_query=mysqli_query($db_connection,"select count(room_no) from student;");
                $allocated=mysqli_fetch_array($allocated_query);
                $allocated=$allocated[0];
                
            ?>
                <div class="row">
                    <div class="col-sm-offset-4 col-sm-4">
                        <div class="panel-group" id="parent">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <a href="#studentallocation" data-toggle="collapse" data-parent="parent">
                                        STUDENT ALLOCATION
                                    </a>
                                </div>
                                <div class="panel-collapse collapse" id="studentallocation">
                                    <div class="panel-body">
                                    <?php
                                        if($student_count==0)
                                        {
                                        ?>
                                            <h5 style="color:red;">Insert Students</h5>
                                        <?php
                                        }
                                        else if($student_count>$capacity_count)
                                        {
                                        ?>
                                            <h5 style="color:red;">Insufficient class capacity insert more class rooms</h5>
                                        <?php
                                        }
                                        else
                                        {
                                    ?>
                                        <a href="studentallocation.php" class="btn btn-primary btn-md btn-block">
                                            PRINT 
                                        </a>
                                    <?php
                                        }
                                    ?>
                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <a href="#bform" data-toggle="collapse" data-parent="parent">
                                        B-FORM
                                    </a>
                                </div>
                                <div class="panel-collapse collapse" id="bform">
                                    <div class="panel-body">
                                    <?php
                                        if($student_count==0)
                                        {
                                        ?>
                                            <h5 style="color:red;">Insert Students</h5>
                                        <?php
                                        }
                                        else if($student_count>$capacity_count)
                                        {
                                        ?>
                                            <h5 style="color:red;">Insufficient class capacity insert more class rooms</h5>
                                        <?php
                                        }
                                        else if($student_count!=$allocated)
                                        {
                                        ?>
                                            <h5 style="color:red;">Allocate students</h5>
                                        <?php
                                        }
                                        else
                                        {
                                    ?>
                                        <table class="table table-bordered table-striped">
                                            <tr>
                                                <th>
                                                    B FORM 2nd YEAR
                                                </th>
                                                <th>
                                                    <a href="bform_2ndyear.php" class="btn btn-primary btn-md btn-block">
                                                        PRINT 
                                                    </a>
                                                </th>
                                            </tr>
                                            <tr>
                                                <th>
                                                    B FORM 3rd YEAR
                                                </th>
                                                <th>
                                                    <a href="bform_3rdyear.php" class="btn btn-primary btn-md btn-block">
                                                        PRINT 
                                                    </a>
                                                </th>
                                            </tr>
                                            <tr>
                                                <th>
                                                    B FORM 4th YEAR
                                                </th>
                                                <th>
                                                    <a href="bform_4thyear.php" class="btn btn-primary btn-md btn-block">
                                                        PRINT 
                                                    </a>
                                                </th>
                                            </tr>
                                        </table>
                                    <?php
                                        }
                                    ?>
                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <a href="#facultyallocation" data-toggle="collapse" data-parent="parent">
                                        ALLOCATE FACULTIES FOR INVIGILATION
                                    </a>
                                </div>
                                <div class="panel-collapse collapse" id="facultyallocation">
                                    <div class="panel-body" style="overflow:auto; height:340px;">
                                    <?php
                                        if($faculty_count==0)
                                        {
                                        ?>
                                            <h5 style="color:red;">Insert Faculties</h5>
                                        <?php
                                        }
                                        else if($faculty_count<$classroom_count)
                                        {
                                        ?>
                                            <h5 style="color:red;">Insufficient faculties insert more faculties</h5>
                                        <?php
                                        }
                                        else
                                        {
                                    ?>
                                        <form action="facultyallocation.php" method="post">
                                            <?php 
                                                echo("<div class='form-group'>");
                                                echo("<select name='2ndyearsubject' class='form-control'>");
                                                $subject_query=mysqli_query($db_connection,"select subject_name from subject where sem in (3,4);");
                                                echo("<option value=''>--select 2nd year subject--</option>");
                                                echo("<option value=''>null</option>");
                                                while($subject=mysqli_fetch_array($subject_query))
                                                {
                                                    echo("<option value='$subject[0]'>$subject[0]</option>");
                                                }
                                                echo("</select>");
                                                echo("</div>"); 
                                            ?>
                                            <?php 
                                                echo("<div class='form-group'>");
                                                echo("<select name='3rdyearsubject' class='form-control'>");
                                                $subject_query=mysqli_query($db_connection,"select subject_name from subject where sem in (5,6);");
                                                echo("<option value=''>--select 3rd year subject--</option>");
                                                echo("<option value=''>null</option>");
                                                while($subject=mysqli_fetch_array($subject_query))
                                                {
                                                    echo("<option value='$subject[0]'>$subject[0]</option>");
                                                }       
                                                echo("</select>");
                                                echo("</div>"); 
                                            ?>
                                            <?php 
                                                echo("<div class='form-group'>");
                                                echo("<select name='4thyearsubject' class='form-control'>");
                                                $subject_query=mysqli_query($db_connection,"select subject_name from subject where sem in (7,8);");
                                                echo("<option value=''>--select 4th year subject--</option>");
                                                echo("<option value=''>null</option>");
                                                while($subject=mysqli_fetch_array($subject_query))
                                                {
                                                    echo("<option value='$subject[0]'>$subject[0]</option>");
                                                }       
                                                echo("</select>");
                                                echo("</div>"); 
                                            ?>
                                            <table class="table table-bordered table-striped">
                                                <tr>
                                                    <th colspan="2">
                                                        Select present Faculties
                                                    </th>    
                                                </tr>
                                            <?php
                                                $fname_query=mysqli_query($db_connection,"select fname from faculty;");
                                                $cnt=1;
                                                while($fname=mysqli_fetch_array($fname_query))
                                                {
                                            ?>
                                                <tr>
                                                    <th>
                                                        <?php echo($fname[0]); ?>
                                                    </th>
                                                    <td>
                                                        <input type="checkbox" value="<?php echo($fname[0]); ?>" name="<?php echo("faculty$cnt"); ?>" checked/>
                                                    </td>
                                                </tr>
                                            <?php
                                                $cnt++;
                                                }
                                            ?>
                                            </table>
                                            <center>
                                                <input type="submit" class="form-group btn btn-primary" value="submit" name="setit" />
                                             </center>
                                        </form>
                                        <?php
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div><!-- end of pannel -->
                        
                    </div>
                </div>

            </div>

            <!-- STUDENT -->
            <?php
                $method=$_SERVER['REQUEST_METHOD'];
                if($method=='POST')
                {
            ?>
            <div class="tab-pane active" id="Student">
            <?php
                }
                else
                {
            ?>
            <div class="tab-pane" id="Student">
            <?php
                }
            ?>
                <br/>
                <div class="row">
                    <div class="col-lg-offset-4 col-lg-4">
                        <ul class="nav nav-pills nav-justified">
                        <?php
                            $method=$_SERVER['REQUEST_METHOD'];
                            if($method!='POST')
                            {
                        ?>
                            <li class="active"><a href="#2ndyear" data-toggle="tab">2nd year</a></li>
                        <?php
                            }
                            else
                            {
                        ?>
                            <li><a href="#2ndyear" data-toggle="tab">2nd year</a></li>
                        <?php
                            }
                        ?>
                            <li><a href="#3rdyear" data-toggle="tab">3rd year</a></li>
                            <li><a href="#4thyear" data-toggle="tab">4th year</a></li>
                        </ul>
                    </div>
                </div>
                <br/>
                <div class="row">
                    <div class="col-lg-offset-4 col-lg-4">
                        <form action="home.php" method="post">
                            <div class="input-group">
                                <input type="text" name="s_search" value="" placeholder="Search By USN/Name" class="form-control" required>
                                <div class="input-group-btn">
                                    <button type="submit" class="btn btn-primary btn-md">
                                        <span class="glyphicon glyphicon-search"></span> 
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <br/>
                <div class="tab-content">
                <!-- 2ND YEAR -->
                <?php
                    $method=$_SERVER['REQUEST_METHOD'];
                    if($method!='POST')
                    {
                ?>
                    <div class="tab-pane active" id="2ndyear">
                <?php
                    }
                    else
                    {
                ?>
                    <div class="tab-pane" id="2ndyear">                  
                <?php
                    }
                ?>
                        <?php
                            $query="select usn,s_name,section from student where sem in (3,4) order by section,s_name;";
                            $query_result=mysqli_query($db_connection,$query);
                            if(mysqli_num_rows($query_result)>=1)
                            {
                        ?>
                                <div class="row">	
                                    <div class="col-sm-offset-2 col-sm-8" style="overflow:auto; height:380px;">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>USN</th>
                                                    <th>NAME</th>
                                                    <th>SECTION</th>
                                                    <th>EDIT</th>
                                                    <th>DELETE</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                    while($row=mysqli_fetch_array($query_result))
                                                    {
                                                ?>
                                                    <tr>
                                                        <!-- <form action="../contact1/login.php" method="get"> -->
                                                            <td><?php echo("<input type='text' name='s_search' value='$row[0]' id='$row[0]' style='border:0px;' readonly>"); ?></td>
                                                            <td><?php echo("$row[1]"); ?></td>
                                                            <td><?php echo("$row[2]"); ?></td>
                                                            <td><button class="btn btn-primary btn-block" onclick="studentRedirectToEdit('<?php echo($row[0]);?>')" ><span class="glyphicon glyphicon-pencil"></span></button></td>
                                                            <td><button class="btn btn-primary btn-block" onclick="studentRedirectToDelete('<?php echo($row[0]);?>')" ><span class="glyphicon glyphicon-trash"></span></button></td>
                                                        <!-- </form> -->
                                                    </tr>
                                                <?php  
                                                    }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                        <?php
                            }
                            else
                            {
                        ?>
                        <div class="row">    
                            <div class="well col-sm-offset-4 col-sm-4 text-center" style="color:red;">
                            <h4>
                                No Records Found
                            </h4>
                            </div>
                        </div>
                        <?php
                            }
                        ?>
                    </div>
                    <!-- 3RD YEAR -->
                    <div class="tab-pane" id="3rdyear">
                        <?php
                            $query="select usn,s_name,section from student where sem in (5,6) order by section,s_name;";
                            $query_result=mysqli_query($db_connection,$query);
                            if(mysqli_num_rows($query_result)>=1)
                            {
                        ?>
                                <div class="row">	
                                    <div class="col-sm-offset-2 col-sm-8" style="overflow:auto; height:380px;">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>USN</th>
                                                    <th>NAME</th>
                                                    <th>SECTION</th>
                                                    <th>EDIT</th>
                                                    <th>DELETE</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                    while($row=mysqli_fetch_array($query_result))
                                                    {
                                                ?>
                                                    <tr>
                                                        <td><?php echo("<input type='text' name='s_search' value='$row[0]' style='border:0px;' readonly>"); ?></td>
                                                        <td><?php echo("$row[1]"); ?></td>
                                                        <td><?php echo("$row[2]"); ?></td>
                                                        <td><button class="btn btn-primary btn-block" onclick="studentRedirectToEdit('<?php echo($row[0]);?>')" ><span class="glyphicon glyphicon-pencil"></span></button></td>
                                                        <td><button class="btn btn-primary btn-block" onclick="studentRedirectToDelete('<?php echo($row[0]);?>')" ><span class="glyphicon glyphicon-trash"></span></button></td>
                                                    </tr>
                                                <?php  
                                                    }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                        <?php
                            }
                            else
                            {
                        ?>
                        <div class="row">    
                            <div class="well col-sm-offset-4 col-sm-4 text-center" style="color:red;">
                            <h4>
                                No Records Found
                            </h4>
                            </div>
                        </div>
                        <?php
                            }
                        ?>
                    </div>
                    <!-- 4TH YEAR -->
                    <div class="tab-pane" id="4thyear">
                        <?php
                            $query="select usn,s_name,section from student where sem in (7,8) order by section,s_name;";
                            $query_result=mysqli_query($db_connection,$query);
                            if(mysqli_num_rows($query_result)>=1)
                            {
                        ?>
                                <div class="row">	
                                    <div class="col-sm-offset-2 col-sm-8" style="overflow:auto; height:380px;">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>USN</th>
                                                    <th>NAME</th>
                                                    <th>SECTION</th>
                                                    <th>EDIT</th>
                                                    <th>DELETE</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                    while($row=mysqli_fetch_array($query_result))
                                                    {
                                                ?>
                                                    <tr>
                                                        <td><?php echo("<input type='text' name='s_search' value='$row[0]' style='border:0px;' readonly>"); ?></td>
                                                        <td><?php echo("$row[1]"); ?></td>
                                                        <td><?php echo("$row[2]"); ?></td>
                                                        <td><button class="btn btn-primary btn-block" onclick="studentRedirectToEdit('<?php echo($row[0]);?>')" ><span class="glyphicon glyphicon-pencil"></span></button></td>
                                                        <td><button class="btn btn-primary btn-block" onclick="studentRedirectToDelete('<?php echo($row[0]);?>')" ><span class="glyphicon glyphicon-trash"></span></button></td>
                                                    </tr>
                                                <?php  
                                                    }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                        <?php
                            }
                            else
                            {
                        ?>
                        <div class="row">    
                            <div class="well col-sm-offset-4 col-sm-4 text-center" style="color:red;">
                            <h4>
                                No Records Found
                            </h4>
                            </div>
                        </div>
                        <?php
                            }
                        ?>
                    </div>
                    
                    <?php
                        $method=$_SERVER['REQUEST_METHOD'];
                        if($method=='POST')
                        {
                            $key=$_POST['s_search'];
                    ?>

                    <!-- SEARCH -->
                
                    <div class="tab-pane active" id="Search">
                        <?php
                            $query="select usn,s_name,section from student where usn like '$key' or s_name like '%$key%';";
                            $query_result=mysqli_query($db_connection,$query);
                            if(mysqli_num_rows($query_result)>=1)
                            {
                        ?>
                                <div class="row">	
                                    <div class="col-sm-offset-2 col-sm-8" style="overflow:auto; height:380px;">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>USN</th>
                                                    <th>NAME</th>
                                                    <th>SECTION</th>
                                                    <th>EDIT</th>
                                                    <th>DELETE</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                    while($row=mysqli_fetch_array($query_result))
                                                    {
                                                ?>
                                                    <tr>
                                                        <td><?php echo("<input type='text' name='s_search' value='$row[0]' style='border:0px;' readonly>"); ?></td>
                                                        <td><?php echo("$row[1]"); ?></td>
                                                        <td><?php echo("$row[2]"); ?></td>
                                                        <td><button class="btn btn-primary btn-block" onclick="studentRedirectToEdit('<?php echo($row[0]);?>')" ><span class="glyphicon glyphicon-pencil"></span></button></td>
                                                        <td><button class="btn btn-primary btn-block" onclick="studentRedirectToDelete('<?php echo($row[0]);?>')" ><span class="glyphicon glyphicon-trash"></span></button></td>
                                                    </tr>
                                                <?php  
                                                    }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                        <?php
                            }
                            else
                            {
                        ?>
                        <div class="row">    
                            <div class="well col-sm-offset-4 col-sm-4 text-center" style="color:red;">
                            <h4>
                                No Records Found
                            </h4>
                            </div>
                        </div>
                        <?php
                            }
                            ?>
                    </div>
                            <?php
                        }//end of if(method post) block
                        ?>
                    <!-- end of tab pane -->
                </div>
                
            </div>

            <!-- FACULTY -->
            <div class="tab-pane" id="Faculty">
                <br/>
                <?php
                    $query="select fid,fname from faculty;";
                    $query_result=mysqli_query($db_connection,$query);
                    if(mysqli_num_rows($query_result)>=1)
                    {
                ?>
                        <div class="row">	
                            <div class="col-sm-offset-2 col-sm-8" style="overflow:auto; height:400px;">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>FID</th>
                                            <th>NAME</th>
                                            <th>2ND YEAR SUBJECT</th>
                                            <th>3RD YESR SUBJECT</th>
                                            <th>4TH YEAR SUBJECT</th>
                                            <th>EDIT</th>
                                            <th>DELETE</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            while($row=mysqli_fetch_array($query_result))
                                            {
                                        ?>
                                            <tr>
                                                <td><?php echo("<input type='text' name='f_edit' value='$row[0]' style='border:0px;' readonly>"); ?></td>
                                                <td><?php echo("$row[1]"); ?></td>
                                                <td><?php 
                                                    $sub=mysqli_query($db_connection,"select subject_name from subject s,faculty f,subject_faculty sf where sf.subject_code=s.subject_code and f.fid=sf.fid and f.fid='$row[0]' and sem in (3,4);");
                                                    $sub=mysqli_fetch_array($sub);
                                                    echo($sub[0]);
                                                ?></td>
                                                <td><?php 
                                                    $sub=mysqli_query($db_connection,"select subject_name from subject s,faculty f,subject_faculty sf where sf.subject_code=s.subject_code and f.fid=sf.fid and f.fid='$row[0]' and sem in (5,6);");
                                                    $sub=mysqli_fetch_array($sub);
                                                    echo($sub[0]);
                                                ?></td>
                                                <td><?php 
                                                    $sub=mysqli_query($db_connection,"select subject_name from subject s,faculty f,subject_faculty sf where sf.subject_code=s.subject_code and f.fid=sf.fid and f.fid='$row[0]' and sem in (7,8);");
                                                    $sub=mysqli_fetch_array($sub);
                                                    echo($sub[0]);
                                                ?></td>
                                                <td><button class="btn btn-primary btn-block" onclick="facultyRedirectToEdit('<?php echo($row[0]);?>')" ><span class="glyphicon glyphicon-pencil"></span></button></td>
                                                <td><button class="btn btn-primary btn-block" onclick="facultyRedirectToDelete('<?php echo($row[0]);?>')" ><span class="glyphicon glyphicon-trash"></span></button></td>
                                            </tr>
                                        <?php  
                                            }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                <?php
                    }
                    else
                    {
                ?>
                <div class="row">    
                    <div class="well col-sm-offset-4 col-sm-4 text-center" style="color:red;">
                    <h4>
                        No Records Found
                    </h4>
                    </div>
                </div>
                <?php
                    }
                ?>
            </div>
            <!-- SUBJECT -->
            <div class="tab-pane" id="Subject">
                <br/>
                <?php
                    $query="select * from subject where subject_code!='-' order by sem,subject_code;";
                    $query_result=mysqli_query($db_connection,$query);
                    if(mysqli_num_rows($query_result)>=1)
                    {
                ?>
                        <div class="row">	
                            <div class="col-sm-offset-2 col-sm-8" style="overflow:auto; height:400px;">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>SUBJECT CODE</th>
                                            <th>SUBJECT NAME</th>
                                            <th>SEM</th>
                                            <th>EDIT</th>
                                            <th>DELETE</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            while($row=mysqli_fetch_array($query_result))
                                            {
                                        ?>
                                            <tr>
                                                <td><?php echo("<input type='text' name='s_search' value='$row[0]' style='border:0px;' readonly>"); ?></td>
                                                <td><?php echo("$row[1]"); ?></td>
                                                <td><?php echo("$row[2]"); ?></td>
                                                <td><button class="btn btn-primary btn-block" onclick="subjectRedirectToEdit('<?php echo($row[0]);?>')" ><span class="glyphicon glyphicon-pencil"></span></button></td>
                                                <td><button class="btn btn-primary btn-block" onclick="subjectRedirectToDelete('<?php echo($row[0]);?>')" ><span class="glyphicon glyphicon-trash"></span></button></td>
                                            </tr>
                                        <?php  
                                            }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                <?php
                    }
                    else
                    {
                ?>
                <div class="row">    
                    <div class="well col-sm-offset-4 col-sm-4 text-center" style="color:red;">
                    <h4>
                        No Records Found
                    </h4>
                    </div>
                </div>
                <?php
                    }
                ?>
            </div>

            <!-- CLASS -->
            <div class="tab-pane" id="Class">
                <br/>
                <?php
                    $query="select room_no,room_capacity,priority from class order by priority;";
                    $query_result=mysqli_query($db_connection,$query);
                    if(mysqli_num_rows($query_result)>=1)
                    {
                ?>
                        <div class="row">
                            <div class="col-sm-offset-2 col-sm-8" style="overflow:auto; height:400px;">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>CLASS NUMBER</th>
                                            <th>CAPACITY</th>
                                            <th>PRIORITY</th>
                                            <th>EDIT</th>
                                            <th>DELETE</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            while($row=mysqli_fetch_array($query_result))
                                            {
                                        ?>
                                            <tr>
                                                <td><?php echo("<input type='text' name='s_search' value='$row[0]' style='border:0px;' readonly>"); ?></td>
                                                <td><?php echo("$row[1]"); ?></td>
                                                <td><?php echo("$row[2]"); ?></td>
                                                <td><button class="btn btn-primary btn-block" onclick="classRedirectToEdit('<?php echo($row[0]);?>')" ><span class="glyphicon glyphicon-pencil"></span></button></td>
                                                <td><button class="btn btn-primary btn-block" onclick="classRedirectToDelete('<?php echo($row[0]);?>')" ><span class="glyphicon glyphicon-trash"></span></button></td>
                                            </tr>
                                        <?php  
                                            }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                <?php
                    }
                    else
                    {
                ?>
                <div class="row">    
                    <div class="well col-sm-offset-4 col-sm-4 text-center" style="color:red;">
                    <h4>
                        No Records Found
                    </h4>
                    </div>
                </div>
                <?php
                    }
                ?>
            </div>

            <!-- ADD -->
            <div class="tab-pane" id="Add">
            <br/>
                <div class="row">
                    <div class="col-sm-offset-3 col-sm-6">
                        <table class="table table-bordered table-striped">
                            <tr>
                                <th>
                                    ADD
                                </th>
                                <th>
                                    NUMBER OF RECORDS TO ADD
                                </th>
                                <th>
                                    SUBMIT
                                </th>
                            </tr>
                            <tr>
                                <td>
                                    ADD STUDENT
                                </td>
                                <form action="add/addstudent.php" method="post">
                                    <td><input type="number" name="no_of_student" value="" placeholder="Enter The No of Students to Add" class="form-control" min="1" max="50" required></td>
                                    <td><button class="btn btn-primary" type="submit">ADD</button></td>
                                </form>
                            </tr>
                            <tr>
                                <td>
                                    ADD FACULTY
                                </td>
                                <form action="add/addfaculty.php" method="post">
                                    <td><input type="number" name="no_of_faculty" value="" placeholder="Enter The No of Faculties to Add" class="form-control" min="1" max="50" required></td>
                                    <td><button class="btn btn-primary" type="submit">ADD</button></td>
                                </form>
                            </tr>
                            <tr>
                                <td>
                                    ADD SUBJECT
                                </td>
                                <form action="add/addsubject.php" method="post">
                                    <td><input type="number" name="no_of_subject" value="" placeholder="Enter The No of Subjects to Add" class="form-control" min="1" max="50" required></td>
                                    <td><button class="btn btn-primary" type="submit">ADD</button></td>
                                </form>
                            </tr>
                            <tr>
                                <td>
                                    ADD CLASS ROOM
                                </td>
                                <form action="add/addclassroom.php" method="post">
                                    <td><input type="number" name="no_of_classroom" value="" placeholder="Enter The No of class rooms to Add" class="form-control" min="1" max="50" required></td>
                                    <td><button class="btn btn-primary" type="submit">ADD</button></td>
                                </form>
                            </tr>
                            
                        </table>
                       
                    </div>
                </div>
            </div>
            <!-- MORE -->
            <div class="tab-pane" id="More">
            <br/>
                <div class="row">
                    <div class="col-sm-offset-4 col-sm-4">
                        <div class="panel-group" id="parent">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <a href="#promote" data-toggle="collapse" data-parent="parent">
                                        PROMOTE STUDENTS
                                    </a>
                                </div>
                                <div class="panel-collapse collapse" id="promote">
                                    <div class="panel-body">
                                    <?php
                                        if($student_count==0)
                                        {
                                        ?>
                                            <h5 style="color:red;">Insert Students</h5>
                                        <?php
                                        }
                                        else
                                        {
                                    ?>
                                        <h4>All Students are promoted to next semester, and 8th sem students will be droped</h4>
                                        <button href="promote.php" class="btn btn-primary btn-md btn-block" onclick="redirectToPromote()">
                                            PROMOTE
                                        </button>
                                    <?php
                                        }
                                    ?>
                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <a href="#delete_in_bulk" data-toggle="collapse" data-parent="parent">
                                        DELETE IN MASS
                                    </a>
                                </div>
                                <div class="panel-collapse collapse" id="delete_in_bulk">
                                    <div class="panel-body">
                                    <?php
                                        if($student_count==0)
                                        {
                                        ?>
                                            <h5 style="color:red;">Insert Students</h5>
                                        <?php
                                        }
                                        else
                                        {
                                    ?>
                                        <table class="table table-bordered table-striped">
                                            <tr>
                                                <th>
                                                    DROP ALL 2nd YEAR STUDENTS
                                                </th>
                                                <th>
                                                    <button href="drop_2ndyear.php" class="btn btn-primary btn-md btn-block" onclick="redirectToDrop2year()">
                                                        DROP 
                                                    </button>
                                                </th>
                                            </tr>
                                            <tr>
                                                <th>
                                                    DROP ALL 3rd YEAR STUDENTS
                                                </th>
                                                <th>
                                                    <button href="drop_3rdyear.php" class="btn btn-primary btn-md btn-block" onclick="redirectToDrop3year()">
                                                        DROP 
                                                    </button>
                                                </th>
                                            </tr>
                                            <tr>
                                                <th>
                                                    DROP ALL 4th YEAR STUDENTS
                                                </th>
                                                <th>
                                                    <button href="drop_4thyear.php" class="btn btn-primary btn-md btn-block" onclick="redirectToDrop4year()">
                                                        DROP 
                                                    </button>
                                                </th>
                                            </tr>
                                        </table>
                                    <?php
                                        }
                                    ?>
                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <a href="#deallocate" data-toggle="collapse" data-parent="parent">
                                        DEALLOCATE STUDENTS
                                    </a>
                                </div>
                                <div class="panel-collapse collapse" id="deallocate">
                                    <div class="panel-body" >
                                    <?php
                                        if($student_count==0)
                                        {
                                        ?>
                                            <h5 style="color:red;">Insert Students</h5>
                                        <?php
                                        }
                                        else
                                        {
                                        ?>
                                            <h4>All the students will be deallocates</h4>
                                            <button href="deallocate.php" class="btn btn-primary btn-md btn-block" onclick="redirectToDeallocate()">
                                                DEALLOCATE
                                            </button>
                                        <?php
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div><!-- end of pannel -->

                    </div>
                </div>
            </div>

        <!-- end of tab pane -->
    	</div>
    </div>
 
</body>
</html>
<?php
mysqli_close($db_connection);
?>

<?php
}
else{
	header("Location: login.php");
}
?>
