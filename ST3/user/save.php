<?php
session_start();
	if(empty($_SESSION['userName']))
		header("location:../index.php");
		
		require '../phpfile/classHeader.php';

		if(!empty($_FILES['img']['tmp_name']))
		{	
			if(getimagesize($_FILES['img']['tmp_name']) == FALSE )
			{
				echo " please select image";
			}
			else{
			$img = addslashes($_FILES['img']['tmp_name']);
				$img = file_get_contents($img);
				$img = base64_encode($img);
				
				$blogger = new blogger();
	$blogger->getDetails($_SESSION['userName']);
	//calling function of blog class to save data.
	$blog = new blog();
	$blog->writeBlog($blogger->getBloggerId(),$_SESSION["userName"],$_POST['title'], $_POST['desc'],$_POST['category'],$img);

			}
		}
	 header("location:../user/");

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
