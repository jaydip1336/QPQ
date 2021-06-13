<?php
session_start();
$result="";
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}

$Question_paper_id=$_SESSION["Question_paper_id"];
$user_id=$_SESSION["user_id"];
require_once "config.php";
// session_start();
$_SESSION["data"]="";
if($_SERVER["REQUEST_METHOD"] == "POST") {
    if(       !empty($_POST["Question"]) && 
              !empty($_POST["A"]) && 
              !empty($_POST["B"]) && 
              !empty($_POST["C"]) && 
              !empty($_POST["D"]) )
    {      
    $Question = $_POST["Question"];
    $A = $_POST["A"];
    $B = $_POST["B"];
    $C = $_POST["C"];
    $D = $_POST["D"];
    $sql = "INSERT INTO `$Question_paper_id` (`Question`,`A`,`B`,`C`,`D`,`user_id`) VALUES ('$Question','$A','$B','$C','$D','$user_id')";
    $result = mysqli_query($conn, $sql);
    
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
                   
                    <div class="input-group mb-3">  <div class="input-group mb-3">
                      <input type="text" class="form-control" placeholder="Question" name="Question">
                      <div class="input-group-append">
                        <div class="input-group-text">
                          <span class="fas fa-plus"></span>
                        </div>
                      </div>
</div>
<div class="input-group mb-3">
        <div class="col-3"> <input type="text" class="form-control" placeholder="Option (A)" name="A"> </div>
        <div class="col-3"> <input type="text" class="form-control" placeholder="Option (B)" name="B"> </div>
        <div class="col-3"> <input type="text" class="form-control" placeholder="Option (C)" name="C"> </div>
        <div class="col-3"> <input type="text" class="form-control" placeholder="Option (D)" name="D"> </div>
</div>
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">Create</button>
            <!-- <a href="http://localhost/project/view_question.php" class="btn btn-primary btn-block">View question</a> -->
            </div>

       
          </div>
      </form>
  </div>
</div>
