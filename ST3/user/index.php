<!DOCTYPE html>
<html>
<head>
 	<meta charset="utf-8">
 	<meta name="viewport" content="width=device-width, initial-scale=1">
  <title>PIYblogGER - a blog for real MEN</title>
  
	
<link rel="stylesheet" type="text/css" href="../../css/bootstrap.css">
<link rel="stylesheet" type="text/css" href="../../css/piyUser.css">
<script type="text/javascript">
  function confirmDel(){
    var a;
    var r = confirm("Are You Sure You want to permanently delete this Blog ?");
    if(r == true){
      return true;
    } 
    else
      return false;
  }
</script>

<?php
	session_start();
	if(empty($_SESSION["userName"]))
		header("location:../index.php");

	require '../phpfile/classHeader.php';
	$blogger = new blogger();

	//getting details of blogger
	$blogger->getDetails($_SESSION["userName"]);
  
  //echo"<h1>" .$blogger->getBloggerId(). "</h1>";

   if(!empty($_POST['DelblogId']) && !empty($_POST['DelbloggerId'])){
    $blog = new blog();
    $blog->deleteBlog($_POST['DelblogId'],$_POST['DelbloggerId']);
    header("location:index.php");
    
    //echo $_POST['DelblogId'];
    //echo $_POST['DelbloggerId'];
    
    }


?>


</head>
<body>
<body>
	<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle = "collapse" data-target="#nvbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span> 
      </button>
      <a class="navbar-brand" href="../../ST3/">PIYblogGERr</a>
    </div>
    <div class="collapse navbar-collapse" id="nvbar">
      <ul class="nav navbar-nav">
        <li><a href="../index.php"><span class="glyphicon glyphicon-home"></span> Home</a></li>
        <li><a href="#">News</a></li>
        <li><a href="../contact.php">Contact</a></li> 
      <li><a href="../about_us.php">About Us</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right" style="margin-right:2px;" >
        <li><a  href="userprofile.php">Profile</a></li>
      	<?php
	if (!($blogger->isActive())){
		/*if user is deactiveted by Admin*/
		echo '<li><a class="btn disabled" href="#"><span class="glyphicon glyphicon-pencil"></span> can not Write</a></li>';
	}
	else
	{
		echo '<li><a href="write.php"><span class="glyphicon glyphicon-pencil"></span> wanna Write?</a></li>';	
	}

	?>
        <li><a  href="../logout.php"> <span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
      </ul>
    </div>
  </div>
</nav>
  
  <div class="jumbotron">
  <div class="container">
    <h1><small>Welcome </small><?php echo  $_SESSION["userName"];?> </h1>
  </div>
</div>

  <!-- it'll shows all blogs written by the users   -->
  	
  <div class="container">
   <div class="row">
      <div class="col-lg-8 col-lg-offset-1 col-md-10 col-md-offset-1">  
        <div class="post-preview" >
  	
    <?php
  		$conn = new connect();
  		$que = 'select * from blog_master where blogAuthor = "' .$_SESSION["userName"].'" order by blogId desc';
  		$blogs = $conn->exeQuery($que);

  		if(empty($blogs)) echo "<p>You have not written any blogs yet.</p>";
  		else
  			while($row = $blogs->fetch_assoc())
  			{
          $imgQue = 'select * from blog_detail where blogId="' .$row['blogId'].'"';
          $imgRes = $conn->exeQuery($imgQue);
          $img = $imgRes->fetch_assoc();
  	?>

      
      <h2 class="post-title"> <?php echo $row['blogTitle']; ?></h2>      
      <img class="img-responsive"    src="data:image;base64,<?php echo $img['blogImage']; ?>" alt="..." style=" border-radius: 5px;">
      <h3 class= "post-subtitle"> Category : <?php echo $row['blogCategory']; ?></h3>
      <h3 class="post-blog" > <?php echo $row['blogDesc']; ?></h3> 
      <div clss="row">
      <div class="col-lg-1 col-md-1  col-xs-1">
      <form action="editBlog.php" method="post">
      <input type="hidden" name="editblogId" value="<?php echo $row['blogId']; ?>" >
      <button type="submit" class="btn btn-info"><span class="glyphicon glyphicon-pencil"></span> Edit</button> 
      </form>
      </div>
      <div class="col-lg-1 col-xs-offset-1  col-md-1 col-md-offset-1 col-xs-1">
      <form action="index.php" onsubmit="return confirmDel()" method="post">
        <?php
            echo '<input type="hidden" name="DelbloggerId" value="'.$blogger->getBloggerId().'">';
            echo '<input type="hidden" name="DelblogId" value="' .$row['blogId']. '">';

        ?>  
        <button type ="submit" class="btn btn-danger " ><span class="glyphicon glyphicon-trash"></span> delete</button>
        </form>
      </div>
      </div>
      <br>
      
      <hr>
      <?php } ?>

        </div>
      </div>
 </div>
</div>

	
  	<script src="../../js/jquery-3.1.0.min.js"></script>
<!--	<script type="text/javascript" scr="../../js/bootstrap.min.js"></script>
	-->
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> 


</body>
<div class="container-fluid  pi-footer" >

  <footer class="footer">
   <p> <small>Copyright &copy; PIYblogGER 2016</small></p>
 </footer>
 
</div>

</html>