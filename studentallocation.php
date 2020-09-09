<?php 
	session_start();
	if(isset($_SESSION["user_name"]))
	{
?>

<?php
    $db_connection=mysqli_connect("localhost: 3306","root","root","invigilation_system");

    $total_no_of_student_query=mysqli_query($db_connection,"select sum(room_capacity) from class");
    $total_capacity_query=mysqli_query($db_connection,"select count(usn) from student");
    $total_capacity=mysqli_fetch_array($total_no_of_student_query);
    $total_no_of_student=mysqli_fetch_array($total_capacity_query);
    $total_no_of_student=$total_no_of_student[0];
    if($total_capacity[0]>=$total_no_of_student)
    {
        $select_each_room_query=mysqli_query($db_connection,"select * from class order by priority;");
        $count=0;
        $each_room_name=array();
        $total=1;
        while($select_each_room=mysqli_fetch_array($select_each_room_query))
        {
            $each_room_name[$count]=$select_each_room[0];
            $count++;
        }
        $n=$count;
        $num=0;
        $sem_3=mysqli_query($db_connection,"select usn from student where sem in (3,4) order by usn;");
        $sem_5=mysqli_query($db_connection,"select usn from student where sem in (5,6) order by usn;");
        $sem_7=mysqli_query($db_connection,"select usn from student where sem in (7,8) order by usn;");
        $sem_3=mysqli_fetch_array($sem_3);
        $sem_5=mysqli_fetch_array($sem_5);
        $sem_7=mysqli_fetch_array($sem_7);
        $first_3=$sem_3=$sem_3[0];
        $first_5=$sem_5=$sem_5[0];
        $first_7=$sem_7=$sem_7[0];
        $count=0;
        $room_full_flag=array();
        for($c=0;$c<$n;$c++)
        {
            $room_full_flag[$c]=0;
        }
        $allocated=mysqli_query($db_connection,"select count(room_no) from student;");
        $allocated=mysqli_fetch_array($allocated);
        $allocated=$allocated[0];
        //echo($allocated."  and  ".$total_no_of_student);
        while($total<$total_capacity[0] && $allocated<$total_no_of_student)
        {
            for($num=0;$num<$n && $allocated<$total_no_of_student;$num++)
            {
                $room=mysqli_query($db_connection,"select room_capacity from class where room_no in ('$each_room_name[$num]');");
                $room_capacity=mysqli_fetch_array($room);
                $each_sem_student_capacity=(int)($room_capacity[0]/3);
                $sem_3q=mysqli_query($db_connection,"select usn from student where (sem in (3,4) and usn>'$sem_3') or (usn='$first_3') order by usn limit $each_sem_student_capacity;");
                while(($sem_3rd=mysqli_fetch_array($sem_3q)) && $room_full_flag[$num]<$room_capacity[0] && $allocated<$total_no_of_student)
                {   
                    mysqli_query($db_connection,"update student set room_no='$each_room_name[$num]' where usn='$sem_3rd[0]';");
                    $count++;
                    $total++;
                    $room_full_flag[$num]++;
                    $first_3=null;
                    $sem_3=$sem_3rd[0];
                    $allocated=mysqli_query($db_connection,"select count(room_no) from student;");
                    $allocated=mysqli_fetch_array($allocated);
                    $allocated=$allocated[0];
                }
                $allocated=mysqli_query($db_connection,"select count(room_no) from student;");
                $allocated=mysqli_fetch_array($allocated);
                $allocated=$allocated[0];
            }
            $count=1;
            for($num=0;$num<$n && $allocated<$total_no_of_student;$num++)
            {
                $room=mysqli_query($db_connection,"select room_capacity from class where room_no in ('$each_room_name[$num]');");
                $room_capacity=mysqli_fetch_array($room);
                $each_sem_student_capacity=(int)($room_capacity[0]/3);
                $sem_5q=mysqli_query($db_connection,"select usn from student where (sem in (5,6) and usn>'$sem_5') or (usn='$first_5') order by usn limit $each_sem_student_capacity;");
                while(($sem_5th=mysqli_fetch_array($sem_5q)) && $room_full_flag[$num]<$room_capacity[0] && $allocated<$total_no_of_student)
                {
                    mysqli_query($db_connection,"update student set room_no='$each_room_name[$num]' where usn='$sem_5th[0]';");
                    $count++;
                    $total++;
                    $room_full_flag[$num]++;
                    $first_5=null;
                    $sem_5=$sem_5th[0];
                    $allocated=mysqli_query($db_connection,"select count(room_no) from student;");
                    $allocated=mysqli_fetch_array($allocated);
                    $allocated=$allocated[0];
                }
                $allocated=mysqli_query($db_connection,"select count(room_no) from student;");
                $allocated=mysqli_fetch_array($allocated);
                $allocated=$allocated[0];
            }
            $count=1;
            for($num=0;$num<$n && $allocated<$total_no_of_student;$num++)
            {
                $room=mysqli_query($db_connection,"select room_capacity from class where room_no in ('$each_room_name[$num]');");
                $room_capacity=mysqli_fetch_array($room);
                $each_sem_student_capacity=(int)($room_capacity[0]/3);
                $sem_7q=mysqli_query($db_connection,"select usn from student where (sem in (7,8) and usn>'$sem_7') or (usn='$first_7') order by usn limit $each_sem_student_capacity;");
                while(($sem_7th=mysqli_fetch_array($sem_7q)) && $room_full_flag[$num]<$room_capacity[0] && $allocated<$total_no_of_student)
                {
                    mysqli_query($db_connection,"update student set room_no='$each_room_name[$num]' where usn='$sem_7th[0]';");
                    $count++;
                    $total++;
                    $room_full_flag[$num]++;
                    $first_7=null;
                    $sem_7=$sem_7th[0];
                    $allocated=mysqli_query($db_connection,"select count(room_no) from student;");
                    $allocated=mysqli_fetch_array($allocated);
                    $allocated=$allocated[0];
                }
                $allocated=mysqli_query($db_connection,"select count(room_no) from student;");
                $allocated=mysqli_fetch_array($allocated);
                $allocated=$allocated[0];
            }
            $allocated=mysqli_query($db_connection,"select count(room_no) from student;");
            $allocated=mysqli_fetch_array($allocated);
            $allocated=$allocated[0];
        }
    }
    mysqli_close($db_connection);
    header('Location: http://localhost/Invigilation_System/studentlist.php');
?>

<?php
}
else{
	header("Location: login.php");
}
?>