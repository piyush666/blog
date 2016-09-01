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
        <li><a href="contact.php">Contact</a></li> 
        <li><a href="about_us.php">About Us</a></li> 
      </ul>
      <ul class="nav navbar-nav navbar-right" style="margin-right:2px;">
      <?php
          session_start();
        if(isset($_SESSION['userName'])){
        
        ?>
          <li><a href="login.php"><span class="glyphicon glyphicon-user"></span> Your Home</a></li>
          <li><a  href="logout.php"> <span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
            <?php  }
            elseif (isset($_SESSION['admin'])){

             ?>
             <li><a href="login.php"><span class="glyphicon glyphicon-user"></span> Your Home</a></li>
             <li><a  href="logout.php"> <span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
             <?php } else{   ?>
         <li><a href="signup.php"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
        <li><a href="login.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
          <?php } ?>
      </ul>
    </div>
  </div>
</nav>


<div class="jumbotron">
  <div class="container">
 
  <h1> Future of Blog </h1>
        <p>welcome to the site,where revolution of blogs begins.</p>
        <p><a class="btn btn-primary btn-lg "  href="about_us.php" role="button" style="color:white;">Learn more &raquo;</a></p>
  </div>
</div>

<div class="container">
    <div class="row">
       <div class="col-lg-8 col-lg-offset-1 col-md-10 col-md-offset-1">  
          <div class="post-preview">    
              
              <?php
                require 'phpfile/classHeader.php';
                $today = date('Y-m-d');
                $today = date_create($today);

                $conn = new connect();
                $que = 'select * from blog_master order by blogId desc ' ;
                $blogs = $conn->exeQuery($que);
                if(empty($blogs)) 
                  echo "<h2>There is no blog for you!</h2>";
                else
                  while($row = $blogs->fetch_assoc())
                  { 
                    
                    $getDate=date_create($row['createdDate']);
                    $diff = date_diff($getDate,$today);
                  if($diff->format("%R%a")<100)    // it will give all blogs which are created before 100 days
                    {
                    
                    $imgQue = 'select * from blog_detail where blogId="' .$row['blogId'].'"';
                    $imgRes = $conn->exeQuery($imgQue);
                    $img = $imgRes->fetch_assoc();
              
              ?>
                
      
      <!--  change in url so we can get DATA using GET method without any form or session  -->
      <a href="title_wise.php?title=<?php echo $row['blogTitle'];?>&bloggerName=<?php echo $row['blogAuthor']; ?>">
      <h2 class="post-title"><?php echo $row['blogTitle']; ?></h2>
      <h3 class="post-subtitle"> In <?php echo $row['blogCategory']; ?></h3>
      </a>
      <!--
      <h3 class="post"><?php echo $row['blogDesc']; ?></h3>
      -->
      <p class="post-meta">by <a href="blogger_page.php?uId=<?php echo $row['bloggerId']; ?>&uName=<?php echo $row['blogAuthor']; ?>"><?php echo $row['blogAuthor']; ?></a> on <small ><?php echo $row['createdDate']; ?></small></p> 

      <hr>

      <?php } } ?>
        
      </div>  <!-- post-preview over  -->

        
     </div>   <!--  clomn 1 over  -->
  
  </div>
</div>

</body>

<div class="container-fluid  pi-footer" >

  <footer class="footer">
   <p> <small>Copyright &copy; PIYblogGER 2016</small></p>
 </footer>
 
</div>


</html>