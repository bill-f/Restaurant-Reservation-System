<?php



//post schedule

if(isset($_POST['schedule'])){
    
    
require 'dbh.inc.php';
            

 $date= $_POST['date'];
 $opentime = $_POST['opentime'];
 $closetime = $_POST['closetime'];
 
    
    if(empty($date) || empty($opentime) || empty($closetime)) {
        header("Location: ../schedule.php?error5=emptyfields");
        exit();
    }
 
    else{

     $sql = "SELECT date FROM schedule WHERE date=?";
       $stmt = mysqli_stmt_init($conn);
       if(!mysqli_stmt_prepare($stmt, $sql)){
           header("Location: ../schedule.php?error5=sqlerror1");
           exit();
       }
       else {
           mysqli_stmt_bind_param($stmt, "s", $date);     //elenxos an uparxei idi grammeni i hmerominia!
           mysqli_stmt_execute($stmt);
           mysqli_stmt_store_result($stmt);
           $resultCheck = mysqli_stmt_num_rows($stmt);
             if($resultCheck != 0){
                 
               $sql = "UPDATE schedule SET open_time=?, close_time=? WHERE date=?";

               $stmt = mysqli_stmt_init($conn);
                 if(!mysqli_stmt_prepare($stmt, $sql)){
                    header("Location: ../schedule.php?error5=sqlerror1");
                    exit();
                }
                                           
                    mysqli_stmt_bind_param($stmt, "sss", $opentime, $closetime, $date);
                    mysqli_stmt_execute($stmt);
                    header("Location: ../schedule.php?schedule=success");
                    exit();
           }
       
           else{
            $sql = "INSERT INTO schedule(date, open_time, close_time) VALUES(?, ?, ?)";
            $stmt = mysqli_stmt_init($conn);
                 if(!mysqli_stmt_prepare($stmt, $sql)){
                    header("Location: ../schedule.php?error5=sqlerror1");
                    exit();
                }
                                           
                    mysqli_stmt_bind_param($stmt, "sss", $date, $opentime, $closetime);
                    mysqli_stmt_execute($stmt);
                    header("Location: ../schedule.php?schedule=success");
                    exit();
           }
       }
    }
   //kleinw to connection
   mysqli_stmt_close($stmt);
   mysqli_close($conn);
}




