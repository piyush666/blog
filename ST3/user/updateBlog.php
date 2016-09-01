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
				//echo $img;

				$blogger = new blogger();
	$blogger->getDetails($_SESSION['userName']);
	//calling function of blog class to save data.
			$blog = new blog();
		$blog->updateBlog($_POST['UpId'],$_POST['title'],$_POST['desc'],$_POST['category'],$img);
		//echo "i think its done! ";

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
	header("location:../user/");

?>



<!-- To save  all the information into the database Using Old method of save path of that image in DB-->

<?php 
	/*		
	session_start();
	if(empty($_SESSION['userName']))
		header("location:../index.php");
		
		require '../phpfile/classHeader.php';
	*/	
	/*$blogger = new blogger();
	$blogger->getDetails($_SESSION['userName']);
	*/
	/*
		$conn = new connect();
		//upload this img file into server
		if(!empty($_FILES['img']['tmp_name']))
		{
			$file_temp = $_FILES['img']['tmp_name'];
			$file_name = $_FILES['img']['name'];
			//now change the name of image every time because diff user may upload same img 
			//uniqid func wiil give unique id at time  and explode for extension;  
			$ext = end(explode(".", $file_name));
			$new_name = uniqid()."." .$ext;
			move_uploaded_file($file_temp,"../images/".$new_name);

			
			//  echo '<img src="../images/' .$new_name . '" width="1000" height="1000" >';
				$blog = new blog();
		$blog->updateBlog($_POST['UpId'],$_POST['title'],$_POST['desc'],$_POST['category'],'images/'.$new_name);
		//echo "i think its done! ";

	header("location:index.php");
	}
	*/

/*           this without function call 

			$imQue = 'update blog_detail set blogImage ="images/' .$new_name. '" where blogId = "' .$_POST['UpId']. '"';
			$conn->exeQuery($imQue);
		
		$que = 'update blog_master set blogTitle = "' .$_POST['title']. '" ,blogDesc ="' .$_POST['desc']. '", blogCategory = "' .$_POST['category']. '" ,updateDate="' .date("Y-m-d").'" where blogId="' .$_POST['UpId']. '"';
		$conn->exeQuery($que);

		
		$blog = new blog();
	$blog->writeBlog($blogger->getBloggerId(),$_SESSION["userName"], $_POST['title'], $_POST['desc'] , $_POST['category'] ,     'images/'.$new_name );
*/
		
	
	
?>