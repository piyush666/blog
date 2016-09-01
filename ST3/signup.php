<!DOCTYPE html>
<html>
<head>

 	<meta charset="utf-8">
 	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title>SignUp Page:PIYblogGER - a blog for real MEN</title>
  
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
  <link rel="stylesheet" type="text/css" href="../css/piyUser.css">

<?php
  //call for classes &function
  require 'phpfile/classHeader.php';

  //if user already loggedIn take back him to userPage;
  
  session_start();
  if(!empty($_SESSION['userName']))
    header("location:user/");

  if(!empty($_SESSION["admin"]))
    header("location:../ST3/admin/");


//the php code for the signup of the user will come here.
  if(!empty($_POST['Newname']) && !empty($_POST['Newpassword']))
  {
    $blogger = new blogger();
    $blogger->createBlogger($_POST['Newname'],$_POST['Newpassword']);
  }
  
?>


<script language="javascript" type="text/javascript">
  
   function validate2(){
    var username = document.forms["myformS"]["Newname"].value;
    var password = document.forms["myformS"]["Newpassword"].value;
    var repassword = document.forms["myformS"]["re-password"].value;
    if(username == "" || password == "" || repassword == "")
    {
     alert("Every fields are required");
     return false; 
    }
    if(password != repassword){
      //alert("Check the password and retry again!");
      
      document.getElementById('passError').innerHTML = "Dosn't match !";
      return false;
    }
    else
      document.getElementById('passError').innerHTML = "";


    return userCheck();

  }
  function passCheck()
  { 
    var password = document.forms["myformS"]["Newpassword"].value;
    var repassword = document.forms["myformS"]["re-password"].value;
    if(password != repassword){
      //alert("Check the password and retry again!");
      
      document.getElementById('passError').innerHTML = "Dosn't match !";
      return false;
    }
    else
      document.getElementById('passError').innerHTML = "";    
 
  }


  function  userCheck()
 {
     var userName = document.forms["myformS"]["Newname"].value;
      //var userName = document.getElementById('Newname').value;
   
    <?php
      
          $conn = new connect();
          $que = 'SELECT * from users';
          $result = $conn->exeQuery($que);
         


          while($row = $result->fetch_assoc()) {
   ?>  
               if(userName == "<?php echo $row['userName'];  ?>"){
             //   alert("user already there ,chose another name ");
                     document.getElementById('nameError').innerHTML = 'Username already exists, try another!';
                      return false;          

                 }
                 else
                  document.getElementById('nameError').innerHTML = '';

       <?php  }     ?>   
  
}

</script>




</head>
<body>


<nav class="navbar navbar-fixed-top navbar-default" role="navigation">
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
        <li><a href="index.php"><span class="glyphicon glyphicon-home"></span> Home</a></li>
        <li><a href="#">News</a></li>
        <li><a href="contact.php">Contact</a></li>
        <li><a href="about_us.php">About Us</a></li>
      </ul>
        <ul class="nav navbar-nav navbar-right" style="margin-right:2px;">
        <li><a href="index.php"><span class="glyphicon glyphicon-arrow-left"></span> Back</a></li>
        <li><a href="login.php"><span class="glyphicon glyphicon-user"></span> Log In</a></li>
      </ul>   
    </div>
  </div>
</nav>


<div class="container" id="signup" style="margin-top:5% ;padding:5% 25% 2% 25%;border: 0px solid " >
   <form class = "form-signin" name ="myformS" onsubmit="return validate2()" action="login.php" method="post">
     <h2 >sign up here </h2>
     <label for="inuser" class="sr-only">Username</label>
     <input type="text" class="form-control" name="Newname" id="newuser" placeholder="Username" required autofocus >
          <p class="text text-danger" id="nameError"></p><br>
     <label for="password" class="sr-only">Password</label>
     <input type="password" class="form-control" name="Newpassword" id="Newpassword" placeholder="Password" required  onfocus  =" userCheck()" ><br>
     <label for="re-password" class="sr-only">Confirm Password</label>
     <input type="password" class="form-control" name="re-password" id="re-password" required placeholder="Re-Password" >
     <p class="text text-danger" id="passError"    ></p>
     <br>
     <input class="btn btn-lg btn-primary btn-block" type="submit" name="submit" value="SignUp Now" onfocus = "passCheck()">
     <br>
     
   </form>
   <p>
    <a style="text-decoration: none;" href="login.php">Already a member? Click here to LogIn</a>
   </p>
</div>



<!--	<script type="text/javascript" scr="../js/bootstrap.min.js"></script>  -->
	<script src="../js/jquery-3.1.0.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> 

</body>
<div class="container-fluid  pi-footer" >

  <footer class="footer">
   <p> <small>Copyright &copy; PIYblogGER 2016</small></p>
 </footer>
 
</div>

</html>