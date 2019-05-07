<?php
require "header.php";
?>

    
    <!-- end of nav bar -->

<br><br>
<div class="container">
    <h3 class="text-center"><br>New Reservation<br></h3>   
    <div class="row">
        <div class="col-md-6 offset-md-3">   
 
        
        
        
    
<?php
if(isset($_SESSION['user_id'])){
    echo '<p class="text-white bg-dark text-center">Welcome '. $_SESSION['username'] .', Create your reservation here!</p>';
      
  //error handling:
    
    if(isset($_GET['error3'])){
        if($_GET['error3'] == "emptyfields") {   //douleuei bazw ta errors apo ta headers.. prp na bgalw to requiered
            echo '<h5 class="bg-danger text-center">Fill all fields, Please try again!</h5>';
        }
        else if($_GET['error3'] == "invalidfname") {   
            echo '<h5 class="bg-danger text-center">Invalid First Name, Please try again!</h5>';
        }
        else if($_GET['error3'] == "invalidlname") {   
            echo '<h5 class="bg-danger text-center">Invalid Last Name, Please try again!</h5>';
        }
        else if($_GET['error3'] == "invalidtele") {   
            echo '<h5 class="bg-danger text-center">Invalid Telephone, Pleast try again!</h5>';
        }
        else if($_GET['error3'] == "invalidcomment") {   
            echo '<h5 class="bg-danger text-center">Invalid Comment, Pleast try again!</h5>';
        }
        else if($_GET['error3'] == "invalidguests") {   
            echo '<h5 class="bg-danger text-center">Invalid Guests, Pleast try again!</h5>';
        }
        else if($_GET['error3'] == "full") {   
            echo '<h5 class="bg-danger text-center">Reservations are full this date and timezone, Please try again!</h5>';
        }
    }
        if(isset($_GET['reservation'])) {   
           if($_GET['reservation'] == "success"){ 
            echo '<h5 class="bg-success text-center">Your reservation was successfull!</h5>';
        }
        }
        echo'<br>';



    

    
    
     //reservation form  
    echo '  
        
    <div class="signup-form">
        <form action="includes/reservation.inc.php" method="post">
            <div class="form-group">
            <label>First Name</label>
                <input type="text" class="form-control" name="fname" placeholder="First Name" required="required">
                <small class="form-text text-muted">First name must be 2-20 characters long</small>
            </div>
            <div class="form-group">
            <label>Last Name</label>
                <input type="text" class="form-control" name="lname" placeholder="Last Name" required="required">
                <small class="form-text text-muted">Last name must be 2-20 characters long</small>
            </div>   
            <div class="form-group">
            <label>Enter Date</label>
        	<input type="date" class="form-control" name="date" placeholder="Date" required="required">
            </div>
            <div class="form-group">
		<label>Enter Time Zone</label>
		<select class="form-control" name="time">
		<option>12:00 - 16:00</option>
		<option>16:00 - 20:00</option>
		<option>20:00 - 00:00</option>
		</select>
            </div>
            <div class="form-group">
            <label>Enter number of Guests</label>
        	<input type="number" class="form-control" min="1" name="num_guests" placeholder="Guests" required="required">
                <small class="form-text text-muted">Minimum value is 1</small>
            </div>
            <div class="form-group">
            <label for="guests">Enter your Telephone Number</label>
                <input type="telephone" class="form-control" name="tele" placeholder="Telephone" required="required">
                <small class="form-text text-muted">Telephone must be 6-20 characters long</small>
            </div>
            <div class="form-group">
            <label>Enter extra Comments</label>
                <textarea class="form-control" name="comments" placeholder="Comments" rows="3"></textarea>
                <small class="form-text text-muted">Comments must be less than 200 characters</small>
            </div>        
            <div class="form-group">
		<label class="checkbox-inline"><input type="checkbox" required="required"> I accept the <a href="#">Terms of Use</a> &amp; <a href="#">Privacy Policy</a></label>
            </div>
            <div class="form-group">
            <button type="submit" name="reserv-submit" class="btn btn-dark btn-lg btn-block">Submit Reservation</button>
            </div>
        </form>
        <br><br>
    </div>
    ';  
    }

    else {
        echo '	<p class="text-center text-danger"><br>You are currently not logged in!<br></p>
       <p class="text-center">In order to make a reservation you have to create an account!<br><br><p>';  
        
    }
    ?>

             
        </div>
    </div>
</div>
<br><br>


<?php
require "footer.php";
?>