<?php
require 'database.php';

class blogger
{
	private $bloggerId;
	private $userName;
	private $password;
	private $createdDate;
	private $isActive;
	private $updatedOn;
	private $endDate;

	public function __construct()
	{
		//this will create table if not exist .
		$create = "create table if not exists blogger_info(bloggerId int primary key auto_increment, userName varchar(50), password varchar(25), createdDate date,isActive char(1) , updateDate date ,endDate date)";
		
		$user = "create table if not exists users(userName varchar(50),password varchar(25),type char(1))";
		$profile = "create table if not exists userProfile(profileId int primary key auto_increment,bloggerId int unique references blogger_info(bloggerId) , userName varchar(50) , Name varchar(50) , about text, address varchar(200) ,contact varchar(200) , gender varchar(20) , photo longblob)";
		$conn = new connect();
		$conn->exeQuery($create);
		$conn->exeQuery($user);
		$conn->exeQuery($profile);
	}

	private function checkUser ($userName)
	{
		//check to see if same usename is exists or not
		$que = 'select userName from blogger_info where userName = "' .$userName. '"';
		$conn = new connect();
		$result = $conn->exeQuery($que);
		return $result;
		
	}
	private function checkUserPass ($userName,$password)
	{
		//check to see if same usename is exists or not
		$que = 'select userName from blogger_info where userName = "' .$userName. '" and password = "' .$password.'"';
		$conn = new connect();
		$result = $conn->exeQuery($que);
		return $result;
	}
	

	public function getDetails($userName)
	{
		$conn = new connect();
		$que = 'SELECT * from blogger_info WHERE userName ="'.$userName.'"';
		$result = $conn->exeQuery($que);
		if ($result){
		$details = $result->fetch_assoc();
		$this->bloggerId = $details["bloggerId"];
		$this->userName = $details["userName"];
		$this->password = $details["password"];
		$this->createdDate = $details["createdDate"];
		$this->isActive = $details["isActive"];
		$this->updatedOn = $details["updateDate"];
		$this->endDate = $details["endDate"];
		}
	}

	public function createBlogger($userName,$password)
	{
		$conn = new connect();
		if(empty($this->checkUser($userName)))
		{
			echo "The User name is already exists,plz try with another Name";
		}
		else //
		{
			$que = 'INSERT INTO blogger_info(userName,password,createdDate,updateDate,endDate) VALUES ("' .$userName. '","' .$password. '","' .date("Y-m-d"). '","' .date("Y-m-d"). '",NULL)';
			$conn->exeQuery($que);


			//create user table for LOGIN purpose ,to check whether admin or user  
			$user ='INSERT INTO users (userName,password,type) VALUES("'.$userName. '","'.$password. '","U")';
			$conn->exeQuery($user);
			//echo "Account successfully created! login Now!";


			// for user profile
			$this->getDetails($userName);
			$profile = 'INSERT INTO userProfile(bloggerId,userName) VALUES("' .$this->bloggerId. '","' .$userName. '")';
			$conn->exeQuery($profile);
		}
	}
	public function login ($userName , $password)
	{
		if(mysqli_num_rows($this->checkUserPass($userName,$password)))
		{
			session_start();
			$this->getDetails($userName);
			$_SESSION["userName"] = $userName;
			echo "successfully loged IN"; 
		}
		else
		{
			echo " account does not exists!";
		}
	}

	public function logout()
	{
		session_destroy();
	}

	public function isActive()
	{
		if($this->isActive == 'Y') return 1;
		if($this->isActive == 'N') return 0;

	}

	public function getBloggerId()
	{
		return $this->bloggerId;

	}
	



}




class blog
{
	private $blogId ;
	private $bloggerId;
	private $blogActivity;
	public $blogTitle;
	public $blogDesc;
	public $blogCategory;
	public $blogAuthor;
	public $createdOn;
	public $updateDate;
	public $img;

	public function __construct()
	{
		//if table is not exist then it'll create
		$que = "create table if not exists blog_master (blogId int primary key auto_increment,bloggerId int unique references blogger_info(bloggerId) ,blogAuthor char(50) ,blogTitle text, blogDesc longtext ,blogCategory text,createdDate date,updateDate date default NULL,blogActivity char(1) default 'A')";
		$createImage = "create table if not exists blog_detail (blogDetailId int primary key auto_increment,blogId int unique references blog_master(blogId) ,blogImage longblob)";

		$conn = new connect();
		$conn->exeQuery($que);
		$conn->exeQuery($createImage);

	}

	public function writeBlog($bloggerId,$blogAuthor,$blogTitle,$blogDesc,$blogCategory,$img)
	{
		$this->bloggerId = $bloggerId;
		$this->blogAuthor = $blogAuthor;
		$this->blogTitle = $blogTitle;
		$this->blogDesc = $blogDesc;
		$this->blogCategory = $blogCategory;
		$this->img = $img;
 		$this->saveBlog();
	}

	public function saveBlog()
	{
			$save = 'INSERT INTO blog_master (bloggerId ,blogAuthor,blogTitle ,blogDesc,blogCategory,createdDate) VALUES("'.$this->bloggerId.'","' .$this->blogAuthor. '","' .$this->blogTitle. '","' .$this->blogDesc. '","' .$this->blogCategory. '","' .date("Y-m-d"). '")';
			$conn = new connect();
			$conn->exeQuery($save);
			$id = "SELECT MAX(blogId) as blogId  from blog_master";
			$result = $conn->exeQuery($id);
			$row = $result->fetch_assoc();
			$this->blogId = $row['blogId'];
			$saveImg = 'INSERT INTO blog_detail(blogId,blogImage) VALUES ("'.$this->blogId. '","'.$this->img. '")';
			$conn->exeQuery($saveImg);
	}

	public function updateBlog($blogId,$blogTitle,$blogDesc,$blogCategory,$img)
	{	$conn = new connect();
		$que = 'update blog_master set  blogTitle = "' .$blogTitle. '", blogDesc ="' .$blogDesc. '", blogCategory = "' .$blogCategory. '", updateDate="' .date("Y-m-d"). '" where blogId ="' .$blogId. '"';
		$conn->exeQuery($que);
		$imQue = 'update  blog_detail set blogImage ="' .$img. '" where blogId = "' .$blogId. '"';
		$conn->exeQuery($imQue); 
		
	}


	public function deleteBlog($blogId,$bloggerId)
	{
		$conn = new connect();
		$del = 'DELETE from blog_master where blogId="' .$blogId. '" AND bloggerId="' .$bloggerId. '"';
		$delImg= 'DELETE from blog_detail where blogId="' .$blogId. '"';
		$conn->exeQuery($del);
		$conn->exeQuery($delImg);
	}



	public function getBlogId()
	{
		return $this->blogId;
	}
	public function getBloggerId()
	{
		return $this->bloggerId;
	}
	public function getBlogActivity()
	{
		return $this->blogActivity;
	}

}

class LOGIN
{
	private $userName;
	private $password;
	private $type;

	public function __construct()
	{
		//create users table if not exist
		$que = "create table if not exists users(userName varchar(50),password varchar(25),type char(1))";
		$conn = new connect();
		$conn->exeQuery($que);


	}

	public function seprate($username,$password)
	{	
		$que = 'select userName,password,type from users';
		$conn = new connect();
		$result = $conn->exeQuery($que);
			//session_start();
			$_SESSION['noUser'] = "";
		while($row = $result->fetch_assoc())
		{		
			if($username == $row["userName"] && $password == $row["password"] && $row["type"] == "A")
			{	
				
				$_SESSION["admin"] = $username;
				header("location:../ST3/admin/");
				
			}
			if($username == $row["userName"] && $password == $row["password"] && $row["type"] == "U")
			{
					$blogger = new blogger();
					$blogger->login($username,$password);
					if(!empty($_SESSION['userName']))
						header("location:../login.php/");
				
			}
			else
				continue;
		}
		$_SESSION['noUser'] = "Check Username or password!";


	}



}




?>