<!-- this page shows,all messages sent by viewers
-->
<?php
   require '../phpfile/classHeader.php';
	session_start();
	if(empty($_SESSION["admin"]))
		header("location:../index.php");
	else
	{
		$conn = new connect();

	}

?>

<!DOCTYPE html>
<html>
<head>
	<title>AdminPage : PIYblogGER - a blog for real MEN
   </title>
	<meta charset="utf-8">
 	<meta name="viewport" content="width=device-width, initial-scale=1">

<link rel="stylesheet" type="text/css" href="../../css/bootstrap.css">
<link rel="stylesheet" type="text/css" href="../../css/piyUser.css">
  <script src="../../js/jquery-3.1.0.min.js"></script>
  <!-- <script scr="../../js/bootstrap.min.js"></script>
  -->
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
        <li><a href="../../ST3/"><span class="glyphicon glyphicon-home"></span> Home</a></li>
        <li><a href="#">News</a></li>
         
        <li><a href="../about_us.php">About Us</a></li> 
      </ul>
      <ul class="nav navbar-nav navbar-right" style="margin-right:2px;">
      <li><a href="../admin/"><span class="glyphicon glyphicon-arrow-left"></span> Back</a></li>
      	
      	<li><a  href="../logout.php"> <span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
      </ul>
    </div>
  </div>
</nav>


  <div class="jumbotron">
  <div class="container">
    <h1><small>Welcome </small><?php echo  $_SESSION["admin"];?> </h1>
  </div>
</div>
	<div class="container">
	<div class="table table-responsive" >
	<table class="table table-hover" style="background-color:#F7F9F9;width:100%;">
	
	<thead>
	<tr>
	<th>Date</th>
	<th>Name</th>
	<th>Email</th>
	<th>Phone</th>
	<th>Message</th>
	
	</tr>
	</thead>
		<tbody>
		<?php
			$que = "SELECT * from contactAdmin order by contactId desc";
			$result = $conn->exeQuery($que);
			if($result){
			while($row = $result->fetch_assoc())
			{	echo "<tr>";
				echo "<td>".$row["msgDate"]."</td>";
				echo "<td>".$row["name"]."</td>";
				echo "<td>".$row["email"]."</td>";
				echo "<td>".$row["phone"]."</td>";
				echo "<td>".$row["message"]."</td>";
				echo "</tr>";						

			} 
		}
		else 
		{
			echo "<tr><td>There is no message for You!</td></tr>";
		}	
		?>
	
	</tbody>
	</table>
	</div>
</div>

    <script src="../../js/jquery-3.1.0.min.js"></script>
	<script type="text/javascript" scr="../../js/bootstrap.min.js"></script>
</body>
<div class="container-fluid  pi-footer" >

  <footer class="footer">
   <p> <small>Copyright &copy; PIYblogGER 2016</small></p>
 </footer>
 
</div>
</html>