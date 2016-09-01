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
  <script src="../../js/jquery-3.1.0.min.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> 

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
        <li><a href="contact.php">Contact</a></li>
        <li><a href="#" >About Us</a></li> 
      </ul>
      <ul class="nav navbar-nav navbar-right" style="margin-right:2px;">
        
        <?php
          session_start();
        if(isset($_SESSION['userName'])){
        
        ?><li><a href="index.php"><span class="glyphicon glyphicon-arrow-left"></span> Back</a></li>
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
    <h1 >About Us</h1>
    <h2><small>It's Nice to Meet You!</small></h2>
  </div>
  
</div>


 <!-- Page Content -->
    <div class="container abtUS">

        <!-- Introduction Row -->
        <div class="row">
            <div class="col-lg-12">
                <center>  
                <p><h3 style="font-family:'Open Sans', 'Helvetica Neue', Helvetica, Arial, sans-serif;">
                <strong class="p3">PIYblogGER</strong> .it's nothing but simple blog site .Which is created by Piyush gohil on august,2016  for college assignment purpose. and it's only limited about learn how to make blog site even if you know very little about php ,html,css ,etc. and nothing else here.So why do here Go else.</h3>  </p>
            </center>
            </div>
        </div>

        <!-- Team Members Row -->
        <div class="row">
            <div class="col-lg-12">
                <h2 >Our Team</h2>
            </div>
            <div class="col-lg-4 col-sm-6 text-center">
                <img class="img-circle img-responsive img-center" src="me.png" alt="">
                <h3>Piyush Gohil
                    <small>Owner of PIYblogGER</small>
                </h3>
                <p>It's his idea to make this website for you! because of him you can see this site </p>
            </div>
            <div class="col-lg-4 col-sm-6 text-center">
                <img class="img-circle img-responsive img-center" src="me.png" alt="">
                <h3>piyush gohil
                    <small>Web Designer</small>
                </h3>
                <p>He is the only designer,Editor,creator,software engineer  of this site!</p>
            </div>

              <div class="col-lg-4 col-sm-6 text-center">
                <img class="img-circle img-responsive img-center" src="me.png" alt="">
                <h3>piyush gohil
                    <small>Web Designer</small>
                </h3>
                <p>He is the only designer,Editor,creator,software engineer  of this site!</p>
            </div>

        </div>

        <hr>
   </div>
    <!-- /.container -->

</body>
<!-- Footer -->

<div class="container-fluid  pi-footer" >

  <footer class="footer">
   <p> <small>Copyright &copy; PIYblogGER 2016</small></p>
 </footer>
 
</div>

</html>