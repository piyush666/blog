
<?php
   require '../phpfile/classHeader.php';
	session_start();
	if(empty($_SESSION["admin"]))
		header("location:../index.php");
	else
	{
		//require '../phpfile/classHeader.php';
		$conn = new connect();
		if(!empty($_POST['uId']) && !empty($_POST['activity']))
		{
			//echo $_POST['uId'];
			//echo $_POST['activity'];
			if($_POST['activity']=='N')
			 {$endDate = date("Y-m-d");
			$endDate = "'".$endDate."'";}
			else 
				$endDate = "NULL";
			$que = "update blogger_info set isActive = '".$_POST['activity']."' , endDate = ".$endDate." where bloggerId = ".$_POST['uId'];
			$conn->exeQuery($que);
		}

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
      	<li><a href="messages.php"><span class="glyphicon glyphicon-envelope"></span> messages</a></li>
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
	<th>Blogger Id</th>
	<th>Blogger Name</th>
	<th>Password</th>
	<th>Created On</th>
	<th>Activity</th>
	<th>Last Update</th>
	<th>End Date</th>
	<th>Change Activity</th>
	<th>Info</th>
	</tr>
	</thead>
		<tbody>
		<?php
			$que = "SELECT * from blogger_info";
			$result = $conn->exeQuery($que);
			$blogger = new blogger();
			while($row = $result->fetch_assoc())
			{
				echo "<tr>";
				//$blogger->showDetailsAsTable($row["userName"]);
				$blogger->getDetails($row["userName"]);
				echo '<td>' .$row['bloggerId']. '</td>';
				echo '<td>'.$row["userName"].'</td>'; 
				echo '<td>' .$row["password"]. '</td>';
				echo '<td>' .$row["createdDate"]. '</td>';
				echo '<td>';
				if ($row["isActive"] == 'Y')
					echo "Active";
				else echo "Not Active". '</td>' ;
				echo '<td>' .$row["updateDate"]. '</td>' ;
				if($row["endDate"] && $row["endDate"] != "0000-00-00")
					echo '<td>' .$row["endDate"]. '</td>' ;
				else
					echo '<td></td>' ;

				//This section is used to create the activate/ deactivate form 
				echo "<td><form method='post' action='index.php'>
					  <input type = 'hidden' name ='uId' value =".$blogger->getBloggerId().">";
				
				//it will swap the value.if active then it for deasctive 
				if($blogger->isActive() == 1)
					echo "<button name='activity' class='btn btn-warning' type= 'submit' value = 'N'><span class='glyphicon glyphicon-remove'></span> Deactivate</button>";
				if($blogger->isActive() == 0)
					echo "<button name='activity' class='btn btn-success' type= 'submit' value = 'Y'><span class='glyphicon glyphicon-ok'></span> Activate </button>";
				echo "</form></td>";

				echo'<td><form method="post" action="showUser.php">
				<input type="hidden" name="bloggerId" value="'.$blogger->getBloggerId().'">';
				echo '<button class="btn btn-info" type="submit"><span class="glyphicon glyphicon-eye-open"></span> show</button></form></td>';


			} 
		?>
	</tr>
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