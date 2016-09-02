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
   require '../phpfile/classHeader.php';
   session_start();
   if(empty($_SESSION['admin'])){
      header("location:../index.php");
   }
else{
  
   if(isset($_POST['bloggerId'])){
    $userID = $_POST['bloggerId'];
    $conn = new connect();
    $que = 'SELECT * from blogger_info where bloggerid = "' .$userID. '"';
    $res = $conn->exeQuery($que);
    $row = $res->fetch_assoc();
    $blogAuthor = $row['userName'];
   }
   
   
   if(!empty($_POST['blogId']) && !empty($_POST['bloggerId']) && !empty($_POST['confirmString']) ){
    $blog = new blog();
    $blog->deleteBlog($_POST['blogId'],$_POST['bloggerId']);
    
   // echo $_POST['blogId'];
  //  echo $_POST['bloggerId'];
    // we need post[bloggerId] to load this page ,to set bloggerId after del submit form like previous page
    echo  '<form name="forUser" action="showUser.php"  method="post">';
    echo '<input type="hidden" name="bloggerId" value="'.$_POST['bloggerId'].'">'; 
    echo '</form>';
    
    }
  
}
?>
<script type="text/javascript">
  window.onload = function (){
    document.forms['forUser'].submit();
  }
</script>

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
      <a class="navbar-brand" href="../../ST3/">PIYblogGER</a>
    </div>
    <div class="collapse navbar-collapse" id="nvbar">
      <ul class="nav navbar-nav">
        <li><a href="../../ST3/"><span class="glyphicon glyphicon-home"></span> Home</a></li>
        <li><a href="#">News</a></li> 
       <li><a href="../about_us.php">About Us</a></li> 
      </ul>
      <ul class="nav navbar-nav navbar-right" style="margin-right:2px;">
        <li><a href="../admin/"><span class="glyphicon glyphicon-arrow-left"></span> Back</a></li>
        <li><a href="../logout.php"> <span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
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
  
<h2 class="text-cap"><?php echo  $blogAuthor."'s"; ?> blog</h2>
<hr>

<table class="table table-hover table-responsive" >
<thead>
<tr>
  <th>Image</th>
  <th>BlogTitle</th>
  <th>BlogCategory</th>
  <th>BlogDesc</th>
  <th>Action</th>
</tr>
</thead>
<tbody>

<?php
    $conn = new connect();
    $que = 'SELECT * from blog_master where bloggerId="'.$userID.'"' ;
    $blogs = $conn->exeQuery($que);
    if(!empty($blogs))
    {
      while($row = $blogs->fetch_assoc()){
        $imgQue = 'select * from blog_detail where blogId="' .$row['blogId'].'"';
          $imgRes = $conn->exeQuery($imgQue);
          $img = $imgRes->fetch_assoc();
?>
<tr>
<td>
<img class="img-responsive"    src="data:image;base64,<?php echo $img['blogImage']; ?>" alt="..." style="width:100px;height:100px; border-radius: 5px;">

</td>
<td><?php echo $row['blogTitle']; ?></td>
<td><?php echo $row['blogCategory'];?></td>  
<td><?php echo $row['blogDesc'];?></td>
<td>
<form action="showUser.php" onsubmit="return confirmDel()" method="post">
<?php
    echo '<input type="hidden" name="bloggerId" value="'.$userID.'">';
    echo '<input type="hidden" name="blogId" value="' .$row['blogId']. '">';

?>
<input type="hidden" name="confirmString" value="OK">
<button type ="submit" class="btn btn-danger " ><span class="glyphicon glyphicon-trash"></span> delete</button>
</form>
</td>
</tr> 
<?php }}  ?>


</tbody>

</table>
</div>
</body>
<div class="container-fluid  pi-footer" >

  <footer class="footer">
   <p> <small>Copyright &copy; PIYblogGER 2016</small></p>
 </footer>
 
</div>

</html>