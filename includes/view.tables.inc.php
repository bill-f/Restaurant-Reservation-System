<?php


if(isset($_SESSION['user_id'])){
    
    require 'includes/dbh.inc.php';

    
    $user = $_SESSION['user_id'];
    $role = $_SESSION['role'];
     

    
    //view reserved tables per date and time-zone
    
    if($role==2){
        
    $sql = "SELECT SUM(num_tables), rdate, time_zone FROM reservation GROUP BY rdate, time_zone";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        
        echo
        '   <div class="container">
            <div class="row">
            <div class="col-sm text-center">
            <p class="text-white bg-dark text-center">Reserved tables per date and time-zone</p><br>
            <table class="table table-hover table-bordered table-responsive-sm text-center">
                <thead>
                    <tr>
                        <th scope="col">Date</th>
                        <th scope="col">Time-Zone</th>
                        <th scope="col">Reserved Tables</th>
                    </tr>
                </thead> ';
        while($row = $result->fetch_assoc()) {
        echo"
                <tbody>
                    <tr>
                      <th scope='row'>".$row["rdate"]."</th>
                      <td>".$row["time_zone"]."</td>
                      <td>".$row["SUM(num_tables)"]."</td>
                    </tr>
              </tbody>";
            
        }
    
        
        echo "</table>";
    
       }
    
    else {    echo "<p class='text-center'>List is empty!<p>"; }    
        
       echo'</div>'; 
        
      
       
    //view total tables per date that have been submited from set tables  
       
    $sql = "SELECT * FROM tables ORDER BY t_date";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        
        echo'  
         <div class="col-sm text-center">
         <p class="text-white bg-dark text-center">Total tables per date</p>
         <label>Default total tables is 20</label><br>
        ';
        
        echo
        '
            <table class="table table-hover table-bordered table-responsive-sm text-center">
                <thead>
                    <tr>
                        <th scope="col">Date</th>
                        <th scope="col">Total Tables</th>
                        <th class="table-danger" scope="col"></th>
                    </tr>
                </thead> ';
        while($row = $result->fetch_assoc()) {
        echo"
                <tbody>
                    <tr>
                    <form action='includes/delete.php' method='POST'>
                    <input name='tables_id' type='hidden' value=".$row["tables_id"].">
                      <th scope='row'>".$row["t_date"]."</th>
                      <td>".$row["t_tables"]."</td>
                      <td class='table-danger'><button type='submit' name='delete-table' class='btn btn-danger btn-sm'>Delete</button></td>
                          </form>
                    </tr>
              </tbody>";
            
        }   
        echo "</table>";
    
    
    }
    else {    echo "<p class='text-center'>List is empty!<p>"; }
    
   
    
    echo '</div></div></div>';
    }  

    
    
    
    

mysqli_close($conn);
}
