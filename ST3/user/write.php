<!doctype html>
<html>
<head>
	<meta charset="utf-8">
 	<meta name="viewport" content="width=device-width, initial-scale=1">
 	<title>PIYblogGER - a blog for real MEN</title>
  
		<link rel="stylesheet" type="text/css" href="../../css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="../../css/piyUser.css">

<script type="text/javascript">
	function validate3(){
		var v1 = document.forms["WriteForm"]["title"].value;
		var v2 = document.forms["WriteForm"]["category"].value;
		var v3 = document.forms["WriteForm"]["img"].value;
		var v4 = document.forms["WriteForm"]["desc"].value;
		if(v1 == "" || v2=="" || v3 =="" || v4 == "" )
		{
			alert("Every fields are required");
			return false;
		}

	}

</script>

</head>
<?php
	//get the details of the user for filling up the database.
	
	
	session_start();
	//redirect away if a session is not active
	if(empty($_SESSION['userName']))
		header("location:../index.php");
	
	require '../phpfile/classHeader.php';
	$blogger = new blogger();

	//getting the details of the currently logged in user 
	$blogger->getDetails($_SESSION['userName']);

?>
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
        <li><a href="../../ST3/"><span class="glyphicon glyphicon-home"></span> Home</a></li>
        <li><a href="#">News</a></li>
        <li><a href="../contact.php">Contact</a></li>
         <li><a href="../about_us.php">About Us</a></li> 
      </ul>
      <ul class="nav navbar-nav navbar-right">
      	<li><a href="../user/"><span class="glyphicon glyphicon-arrow-left"></span> Back</a></li>
        <li><a  href="../logout.php"> <span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
      </ul>
    </div>
  </div>
</nav>

<div class="jumbotron">
  <div class="container">
    <h1><small>What's on your mind </small><?php echo  $_SESSION["userName"];?> <small>?</small> </h1>
  </div>
</div>



<div class="container">
<form name="WriteForm" method="post" onsubmit="return validate3()" action="save.php" enctype="multipart/form-data">
<table class="table table-default mytable">
<tr>
	<td ><span>Title : </span></td>
	<td ><input type="text" name="title"  autofocus required></td>
</tr>
<tr>
	<td ><span>Category :</span></td>
	<td > <input type="text" name="category" required ></td>
</tr>
<tr>
	<td ><span>Image:</span></td>
	<td > <input type="file" name="img" required></td>
</tr>


<tr><td><span>Description :</span></td></tr>
</table>
<textarea id="textarea"  name='desc' rows="5" cols="90%" required ></textarea><br><br>

<input type = "reset"  class="btn btn-success btn-lg" value="Reset">	
<input type = "submit" class="btn btn-primary btn-lg" name="submit" value="Submit">

</form>
</div>

	<script src="../../js/jquery-3.1.0.min.js"></script>
	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> 
<!--
	<script type="text/javascript" scr="../../js/bootstrap.min.js"></script>

-->
</body>
<div class="container-fluid  pi-footer" >

  <footer class="footer">
   <p> <small>Copyright &copy; PIYblogGER 2016</small></p>
 </footer>
 
</div>

</html>