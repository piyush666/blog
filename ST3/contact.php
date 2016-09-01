<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" charset="" ontent="width=device-width, initial-scale=1">

  <title>PIYblogGER - a blog for real MEN</title>
  <link rel="stylesheet" type="text/css" href="../css/bootstrap.css"> 
  <link rel="stylesheet" type="text/css" href="../css/piyUser.css"> 
  
  <script src="../js/jquery-3.1.0.min.js"></script>
  <!-- <script scr="../js/bootstrap.min.js"></script>
  -->
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> 

<style type="text/css">

  .form-group  input,
  .form-group textarea{
    z-index: 1;
  position: relative;
  padding-right: 0;
  padding-left: 0;
  border: none;
  border-radius: 0;
  font-size: 1.5em;
  background: none;
  box-shadow: none !important;
  resize: none;
   } 
</style>

</head>
<body>
  <nav class="navbar navbar-default navbar-fixed-top" role="navigation" >
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle = "collapse" data-target="#nvbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span> 
      </button>
      <a class="navbar-brand" href="../ST3/">PIYblogGER</a>
    </div>
    <div class="collapse navbar-collapse" id="nvbar">
      <ul class="nav navbar-nav">
        <li><a href="../ST3/"><span class="glyphicon glyphicon-home"></span> Home</a></li>
        <li><a href="#">News</a></li>
        <li><a href="#">Products</a></li> 
        <li><a href="about_us.php">About Us</a></li> 
      </ul>
      <ul class="nav navbar-nav navbar-right" style="margin-right:2px;">
      <?php
          session_start();
        if(isset($_SESSION['userName'])){
        
        ?>
          <li><a href="index.php"><span class="glyphicon glyphicon-arrow-left"></span> Back</a></li>
          <li><a href="login.php"><span class="glyphicon glyphicon-user"></span> Your Home</a></li>
          <li><a  href="logout.php"> <span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
            <?php  }
            elseif (isset($_SESSION['admin'])){

             ?>
             <li><a href="index.php"><span class="glyphicon glyphicon-arrow-left"></span> Back</a></li>
             <li><a href="login.php"><span class="glyphicon glyphicon-user"></span> Your Home</a></li>
             <li><a  href="logout.php"> <span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
             <?php } else{   ?>
              <li><a href="index.php"><span class="glyphicon glyphicon-arrow-left"></span> Back</a></li>
         <li><a href="signup.php"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
        <li><a href="login.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
          <?php } ?>
      </ul>
    </div>
  </div>
</nav>


<div class="jumbotron">
  <div class="container">
 
  <h1> Be In Touch </h1>
        <p><small>Any Query?ask us.we have answers(maybe)</small></p>
        
  </div>
</div>

<?php
    if (!empty($_POST['name'])&&!empty($_POST['email'])&&!empty($_POST['phone'])&&!empty($_POST['message']))
    {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $message = $_POST['message'];

        require 'phpfile/classHeader.php';
        
        $conn = new connect();
        /* create new table for contact to admin*/
        $que = 'create table if not exists contactAdmin(contactId int primary key auto_increment,name varchar(50),email varchar(100),phone varchar(15),message text,msgDate date)';
        $conn->exeQuery($que);

        $ins = 'insert into contactAdmin (name ,email,phone,message,msgDate) values("' .$name. '","' .$email. '","' .$phone. '","'    .$message. '","' .date("Y-m-d").'")';
        $conn->exeQuery($ins);
?>





<div class="container">
<?php  echo '<h3 class="text text-success">Your message succesfully send to admin!</h3>';
    } ?>

    <div class="row">
       <div class="col-lg-11 col-lg-offset-1 col-md-10 col-md-offset-1">  
          
          <form  action="contact.php" method="post">
              <div class="row">      
                <div class="form-group ">
                  <label class="sr-only">Name</label>
                            <input type="text" class="form-control" placeholder="Name"  name="name" required data-validation-required-message="Please enter your name.">
                            <p class="help-block text-danger"></p> 
                </div>
              </div>

              <div class="row">      
                <div class="form-group  ">
                  <label class="sr-only" >Email Adress</label>
                            <input type="email" class="form-control" placeholder="Email Address"  name="email" required data-validation-required-message="Please enter your email address.">
                            <p class="help-block text-danger"></p> 
                </div>
              </div>

              <div class="row">      
                <div class="form-group  ">
                  <label class="sr-only">Phone Number</label>
                            <input type="tel" class="form-control" placeholder="Phone Number"  name="phone" required data-validation-required-message="Please enter your Phone Number.">
                            <p class="help-block text-danger"></p> 
                </div>
              </div>
              <div class="row">      
                <div class="form-group ">
                  <label class="sr-only">Message</label>
                            <textarea rows="3" class="form-control" placeholder="Message"  name="message" required data-validation-required-message="Please enter your name."></textarea>
                            <p class="help-block text-danger"></p> 
                </div>
              </div>
              <div class="row">
                <div class="form-group  ">
                  <button type="submit" class="btn btn-info btn-lg">Send</button>
                </div>
              </div>



          </form>     
     </div>   <!--  clomn 1 over  -->
  
  </div>  <!-- End of row-->
</div>
<hr>


</body>
<div class="container-fluid  pi-footer" >

  <footer class="footer">
   <p> <small>Copyright &copy; PIYblogGER 2016</small></p>
 </footer>
 
</div>
</html>