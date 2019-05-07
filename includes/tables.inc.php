<?php

//post tables

if(isset($_POST['tables'])){
    
    
require 'dbh.inc.php';
            

 $date= $_POST['date_tables'];
 $tables = $_POST['num_tables'];
        
 
 
    if(empty($date) || empty($tables)) {
        header("Location: ../tables.php?error4=emptyfields");
        exit();
    }
 
    else{
 

     $sql = "SELECT t_date FROM tables WHERE t_date=?";
       $stmt = mysqli_stmt_init($conn);
       if(!mysqli_stmt_prepare($stmt, $sql)){
           header("Location: ../tables.php?error4=sqlerror1");
           exit();
       }
       else {
           mysqli_stmt_bind_param($stmt, "s", $date);     //elenxos an uparxei idi grammeni i hmerominia!
           mysqli_stmt_execute($stmt);
           mysqli_stmt_store_result($stmt);
           $resultCheck = mysqli_stmt_num_rows($stmt);
             if($resultCheck != 0){
                 
               $sql = "UPDATE tables SET t_tables=? WHERE t_date=?";

               $stmt = mysqli_stmt_init($conn);
                 if(!mysqli_stmt_prepare($stmt, $sql)){
                    header("Location: ../tables.php?error4=sqlerror1");
                    exit();
                }
                                           
                    mysqli_stmt_bind_param($stmt, "ss", $tables, $date);
                    mysqli_stmt_execute($stmt);
                    header("Location: ../tables.php?tables=success");
                    exit();
           }
       
           else{
            $sql = "INSERT INTO tables(t_date, t_tables) VALUES(?, ?)";
            $stmt = mysqli_stmt_init($conn);
                 if(!mysqli_stmt_prepare($stmt, $sql)){
                    header("Location: ../tables.php?error4=sqlerror1");
                    exit();
                }
                                           
                    mysqli_stmt_bind_param($stmt, "ss", $date, $tables);
                    mysqli_stmt_execute($stmt);
                    header("Location: ../tables.php?tables=success");
                    exit();
           }
       }
    }
   //kleinw to connection
   mysqli_stmt_close($stmt);
   mysqli_close($conn);
}