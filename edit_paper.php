<?php
session_start();
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
require_once "config.php";
$a=$b="";
// session_start();
$_SESSION["data"]="";
if($_SERVER["REQUEST_METHOD"] == "POST") {
    if(!empty($_POST["Question_paper_name"]) && !empty($_POST["Question_paper_id"]) && !empty($_POST["Question_paper_password"]))
    {
  $Question_paper_name = $_POST["Question_paper_name"];
  $Question_paper_id = $_POST["Question_paper_id"];
  $Question_paper_password = $_POST["Question_paper_password"];
//  echo $Question_paper_name."</br>".$Question_paper_id."</br>".$Question_paper_password;
  $query = "SELECT id FROM `question_papers` WHERE  Question_paper_name = '$Question_paper_name' AND Question_paper_id = '$Question_paper_id' AND Question_paper_password = '$Question_paper_password'";
        $result = mysqli_query($conn,$query);
        // $result = mysql_query($sql);
        
while($row = mysqli_fetch_array($result)) {

    // If you want to display all results from the query at once:
    // print_r($result);
    // print_r($row);
  $a=$row["id"];
  // $b=$row["user_id"];
    // If you want to display the results one by one
   // echo $row['column1'];
 //   echo $row['column2']; // etc..

}
if($a)
{
  $_SESSION["Question_paper_id"]=$Question_paper_id;
  header("location: edit_question.php");
}
// echo $mysqli_query() -> info;
    
} 
}
include 'navbar.php'; ?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Profile</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">User Profile</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12 ">
            <!-- Profile Image -->
            <div class="card card-primary card-outline">
              <div class="card-body box-profile">
                <div class="text-center">
                  <img class="profile-user-img img-fluid img-circle"
                       src="dist/img/user4-128x128.jpg"
                       alt="User profile picture">
                </div>
                <div class="card-body">
                  <p class="login-box-msg">Create new paper</p>
                  <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                  <div class="input-group mb-3">
          <input type="text" class="form-control" placeholder="Qustion paper name" name="Question_paper_name">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-plus"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
        <input type="text" class="form-control" placeholder="Qustion paper id"name="Question_paper_id">
        <div class="input-group-append">
        <div class="input-group-text">
            <span class="fas fa-eye"></span>
        </div>
        </div>
    </div>
    <div class="input-group mb-3">
        <input type="text" class="form-control" placeholder="Qustion paper password" name="Question_paper_password">
        <div class="input-group-append">
        <div class="input-group-text">
            <span class="fas fa-lock"></span>
        </div>
        </div>
        </div>
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">Edit</button>
          </div>
       
          </div>
      </form>
  </div>
</div>