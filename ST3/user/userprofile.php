<!DOCTYPE html>
<html>
<head>
 	<meta charset="utf-8">
 	<meta name="viewport" content="width=device-width, initial-scale=1">
  <title>PIYblogGER - a blog for real MEN</title>
  
	
<link rel="stylesheet" type="text/css" href="../../css/bootstrap.css">
<link rel="stylesheet" type="text/css" href="../../css/piyUser.css">
<?php
	session_start();
	if(empty($_SESSION["userName"]))
		header("location:../index.php");

	require '../phpfile/classHeader.php';
	$blogger = new blogger();

	//getting details of blogger
	$blogger->getDetails($_SESSION["userName"]);
  
    $conn  = new connect();
    //$ins = 'update '

    $que = 'select * from userProfile where bloggerId = "' .$blogger->getBloggerId(). '"';
    $result = $conn->exeQuery($que);
    $row = $result->fetch_assoc();
    //echo $row['about'];
  //echo"<h1>" .$blogger->getBloggerId(). "</h1>";
?>
<?php   
if(!empty($_POST['name'])){
  // echo $_POST['name'];
    $que = 'UPDATE userProfile set Name = "' .$_POST['name']. '" where bloggerId = "' .$blogger->getBloggerId(). '"';
    $conn->exeQuery($que);

}
if(!empty($_POST['addr'])){
    //echo $_POST['addr'];
    $que = 'UPDATE userProfile set address = "' .$_POST['addr']. '" where bloggerId = "' .$blogger->getBloggerId(). '"';
    $conn->exeQuery($que);

}
if(!empty($_POST['contact'])){
    //echo $_POST['contact'];
    $que = 'UPDATE userProfile set contact = "' .$_POST['contact']. '" where bloggerId = "' .$blogger->getBloggerId(). '"';
    $conn->exeQuery($que);

}
if(!empty($_POST['gender'])){
  //  echo $_POST['gender'];
    $que = 'UPDATE userProfile set gender = "' .$_POST['gender']. '" where bloggerId = "' .$blogger->getBloggerId(). '"';
    $conn->exeQuery($que);

}
if(!empty($_POST['about'])){
    //echo $_POST['about'];
    $que = 'UPDATE userProfile set about = "' .$_POST['about']. '" where bloggerId = "' .$blogger->getBloggerId(). '"';
    $conn->exeQuery($que);

}
if(!empty($_FILES['photo']['tmp_name'])){

    if(getimagesize($_FILES['photo']['tmp_name']) == FALSE )
      {
        echo " please select image";
      }
      else{
        $img = addslashes($_FILES['photo']['tmp_name']);
        $img = file_get_contents($img);
        $img = base64_encode($img);
        //echo $name;
        $que = 'UPDATE userProfile set photo = "' .$img. '" where bloggerId = "' .$blogger->getBloggerId(). '"';
    $conn->exeQuery($que);
        
      }
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
      <ul class="nav navbar-nav navbar-right">

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
        <li><a href="index.php"><span class="glyphicon glyphicon-arrow-left"></span> Back</a></li>
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

 
<div class="container">
    <div class="row">
       <div class="col-lg-7 col-lg-offset-1 col-md-7 col-md-offset-1">  
              
              <table class="table table-default mytable">
                <tr>
                <form name="Name" action="userprofile.php" method="post"> 
                
                  <td><span>Name</span></td>
                  <td><input type="text" class="form-control" placeholder="Name" value="<?php if(!empty($row['Name'])) echo $row['Name'];  ?>"  name="name" required data-validation-required-message="Please enter your name."></td>
                  <td><button type="submit" class="btn btn-info">update</button></td>
                 
                  </form>
                </tr>
              </table>

              <table class="table table-default mytable">
                <tr>
                <form class="form-control" name="Photo" action="userprofile.php" method="post" enctype="multipart/form-data">
                
                
                  <td><span>Photo</span></td>
                  <td><input type="file"  placeholder="photo"  name="photo" required data-validation-required-message="Please enter your photo."></td>
                  <td><button type="submit" class="btn btn-info">update</button></td>
                </form>
                </tr>
              </table>


               <table class="table table-default mytable">
                <tr>
                <form name="Addr" action="userprofile.php" method="post">
                   
                  <td><span>Address</span></td>
                  <td><input type="text" class="form-control" placeholder="Address"  name="addr" required data-validation-required-message="Please enter your address." value="<?php if (!empty($row['address'])) echo $row['address']; ?>"></td>
                  <td><button type="submit" class="btn btn-info">update</button></td>
                  
                  </form>
                </tr>
              </table>


                  <table class="table table-default mytable">
                <tr>
                <form name="Contact" action="userprofile.php" method="post">
                  
                  <td><span>Contact</span></td>
                  <td><input type="text" class="form-control" placeholder="Contact link"  name="contact" required data-validation-required-message="Please enter your info" value="<?php  if (!empty($row['contact']))echo $row['contact']; ?>"></td>
                  <td><button type="submit" class="btn btn-info">update</button></td>
                  


                  </form>
                </tr>
              </table>
              
                    <table class="table table-default mytable">
                <tr>
                <form name="Gender" action="userprofile.php" method="post">
                   
                  <td><span>Gender</span></td>
                  <td><input type="text" class="form-control" placeholder="Gender"  name="gender" required data-validation-required-message="Please enter your info" value="<?php if (!empty($row['gender']))
                            echo $row['gender']; ?>"></td>
                  <td><button type="submit" class="btn btn-info">update</button></td>
                  
                  </form>
                </tr>
              </table>
              
                <table class="table table-default mytable">
                <tr>
                <form name="About" action="userprofile.php" method="post">
                  
                  <td><span>About</span></td>
                  <td><textarea rows="3" class="form-control" placeholder="Something about You"  name="about" required data-validation-required-message="Please enter your info"><?php if (!empty($row['about'])) echo $row['about']; ?></textarea></td>
                  <td><button type="submit" class="btn btn-info">update</button></td>
                  
                  </form>
                </tr>
              </table>

         
     </div>   <!--  clomn 1 over  -->

     <div class="col-lg-4 col-md-4 abtAuthor " >
    <?php 
        $que = 'select * from userProfile where bloggerId = "' .$blogger->getBloggerId(). '"';
        $profile = $conn->exeQuery($que);
        if(!empty($profile)){
          $res = $profile->fetch_assoc();
            
        ?>
    <div class="col-lg-5 col-lg-offset-4 col-md-5 col-md-offset-4">

    <img class="img-circle img-center img-responsive" src="data:image;base64,<?php echo $res['photo']; ?>"  alt="..." >
      
    <h2 style="padding-left:20px"><?php echo $res['userName']; ?></h2>
    </div>
    <div class="col-lg-8 col-lg-offset-4 col-md-8 col-md-offset-4">
    <h4><?php if(!empty($res['Name'])) echo $res['Name']; ?></h4>
    <h3><?php if($res['address']) echo '<span class="glyphicon glyphicon-map-marker"></span>'.$res['address']; ?></h3>
    <h3><?php if(!empty($res['about'])) echo '<small><span class="glyphicon glyphicon-bookmark"></span> </small>'.$res['about']; ?></h3>
    <h4><a href=""><?php if(!empty($res['contact'])) echo '<span class="glyphicon glyphicon-link"></span> '.$res['contact']; ?></a></h4>
    </div>



        <?php  } ?>
    
    

    </div>  <!-- 2nd col ends.-->

  
  </div>  <!-- End of row-->
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