<!DOCTYPE html>
<html>
<head>

 	<meta charset="utf-8">
 	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title>LogIN Page:PIYblogGER - a blog for real MEN</title>
  
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
  <link rel="stylesheet" type="text/css" href="../css/piyUser.css">

<?php
  //call for classes &function
  require 'phpfile/classHeader.php';

  //if user already logrdIn take back him to userPage;
  
  session_start();
  if(!empty($_SESSION['userName']))
    header("location:user/");

  if(!empty($_SESSION["admin"]))
    header("location:../ST3/admin/");

if(!empty($_POST["username"]) && !empty($_POST["password"]))
{
  $login = new LOGIN();
  $login->seprate($_POST["username"],$_POST["password"]);
  
  if(!empty($_SESSION['userName']))
      header("location:user/");

}



//the php code for the signup of the user will come here.
  if(!empty($_POST['Newname']) && !empty($_POST['Newpassword']))
  {
    $blogger = new blogger();
    $blogger->createBlogger($_POST['Newname'],$_POST['Newpassword']);
  }
   
?>


<script language="javascript" type="text/javascript">
  function validate(){
    var username = document.forms["myform"]["username"].value;
    var password = document.forms["myform"]["password"].value;
    if(username == "" || password == ""){
      alert("both fields are required");
      return false;
    }
  }

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

       <?php  } ?>   
  
}


</script>

</head>
<body>


<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
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
        <li><a href="signup.php"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
      </ul>   
    </div>
  </div>
</nav>





<div class="container" id="login" style="margin-top:5% ;padding:5% 25% 2% 25%; " >
	<h3 class="text text-danger"><?php 
        if(!empty($_SESSION['noUser'])){
            echo $_SESSION['noUser'];
             $_SESSION['noUser'] = "";
        }
   ?>
  </h3>
   <form class = "form-signin" name ="myform" onsubmit="return validate()" action="login.php" method="post">
     <h2 class="form-sign-heading">please Log in </h2>
     <label for="inuser" class="sr-only">Username</label>
     <input type="text" class="form-control" name="username" id="inuser" placeholder="Username" required autofocus><br>
     <label for="password" class="sr-only">Password</label>
     <input type="password" class="form-control" name="password" id="password" placeholder="Password" required ><br>

     <input class="btn btn-lg btn-primary btn-block" type="submit" name="submit" value="Login">
     <br>
    
   </form>
   <p>
    <a   style="text-decoration: none;"  href="signup.php">New here? Click here to signup</a>
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