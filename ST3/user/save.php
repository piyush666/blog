<?php
session_start();
	if(empty($_SESSION['userName']))
		header("location:../index.php");
		
		require '../phpfile/classHeader.php';

		if(!empty($_FILES['img']['tmp_name']))
		{	echo " imm in if state <br>";
			if(getimagesize($_FILES['img']['tmp_name']) == FALSE )
			{
				echo " please select image";
			}
			else{
			$img = addslashes($_FILES['img']['tmp_name']);
				$img = file_get_contents($img);
				$img = base64_encode($img);
				echo $img;

				$blogger = new blogger();
	$blogger->getDetails($_SESSION['userName']);
	//calling function of blog class to save data.
	echo "<br> till here";
	$blog = new blog();
	$blog->writeBlog($blogger->getBloggerId(),$_SESSION["userName"],$_POST['title'], $_POST['desc'],$_POST['category'],$img);
	//echo "<br>" .$_POST['title'];
	 //echo "<br>" . $_POST['desc'];
		//echo "<br>" .$_POST['category'];
			}
		}
/*
		//for confirmation that img is saved in database,retrive that img!
	$conn = new connect();		
	$que = 'select * from blog_detail';
	$result = $conn->exeQuery($que);
	while($row = $result->fetch_assoc())
	{
		echo '<img class="img-responsive" width="90%" src="data:image;base64,' .$row['img']. '"> <br>' ; 
	}

*/

	// header("location:../user/");

?>


<!-- To save  all the information into the database -->
<?php 
	/*
	session_start();
	if(empty($_SESSION['userName']))
		header("location:../index.php");
		
		require '../phpfile/classHeader.php';
		//upload this img file into server
		if(!empty($_FILES['img']['tmp_name'])){

			//now change the name of image every time because diff user may upload same img 
			//uniqid func wiil give unique id at time  and explode for extension;
		$file_temp = $_FILES['img']['tmp_name'];
		$file_name = $_FILES['img']['name'];
		$ext = end(explode(".", $file_name));
		$new_name = uniqid()."." .$ext;
		move_uploaded_file($file_temp,"../images/".$new_name);
		}
		//echo '<img src="../images/' .$new_name . '" width="1000" height="1000" >';



	$blogger = new blogger();
	$blogger->getDetails($_SESSION['userName']);
	//calling function of blog class to save data.
	$blog = new blog();
	$blog->writeBlog($blogger->getBloggerId(),$_SESSION["userName"], $_POST['title'], $_POST['desc'] , $_POST['category'] ,     'images/'.$new_name );
	header("location:../user/");
	*/
?>
