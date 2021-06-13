<?php
session_start();
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
require_once "config.php";
require('vendor/autoload.php');

// use Spipu\Html2Pdf\Html2Pdf;
// use Spipu\Html2Pdf\Exception\Html2PdfException;
// use Spipu\Html2Pdf\Exception\ExceptionFormatter;
$Question_paper_name = NULL;
$Question_paper_id = NULL;
$Question_paper_password = NULL;
$Question=NULL;
$Marks=NULL;
$Time=NULL;
$Instructions=NULL;
if($_SERVER["REQUEST_METHOD"] == "POST") {
  
  $Question_paper_name = $_POST["Question_paper_name"];
  $Question_paper_id = $_POST["Question_paper_id"];
  $Question_paper_password = $_POST["Question_paper_password"];
  // $Question=$_POST["total"];
  // $Marks=$_POST["marks"];
  // $Time=$_POST["time"];
  // $Instructions=$_POST["instructions"];
  // $query = "SELECT id FROM `question_papers` WHERE Question_paper_id = '$Question_paper_id' AND Question_paper_password = '$Question_paper_password'";
  // $result = mysqli_query($conn,$query);
  // while($row = mysqli_fetch_array($result)) {

  //   // If you want to display all results from the query at once:
  //   // print_r($result);
  //   // print_r($row);
  // $a=$row["id"];
  // $b=$row["user_id"];
    // If you want to display the results one by one
   // echo $row['column1'];
 //   echo $row['column2']; // etc..

// }
  if ($a=$_SESSION["user_id"]) {
    // if($_SESSION["loggedin"] == true){

      $q="SELECT * FROM $Question_paper_id";
      $r= mysqli_query($conn,$q);
      while($row = mysqli_fetch_array($r)) {
        $t=$row["id"];
    }
    // echo $t;
    // echo $Question;
    $random_number_array = range(1, $t);
    shuffle($random_number_array );
    $random_number_array = array_slice($random_number_array ,1,$Question);
    // print_r($random_number_array);
    $html="<h2 style='text-align: center'>L.E.College, Morbi</h2><h3 style='text-align: center'>Competitive Exam - 2021</h3><br><hr /><br><a>Subject Code:234567</a>	&nbsp;	&nbsp;	&nbsp;	&nbsp;&nbsp;&nbsp;&nbsp;	&nbsp;	&nbsp;	&nbsp;	&nbsp;	&nbsp;	&nbsp;	&nbsp;&nbsp;&nbsp;&nbsp;	&nbsp;	&nbsp;	&nbsp;	&nbsp;&nbsp;&nbsp;&nbsp;	&nbsp;	&nbsp;	&nbsp;	&nbsp;&nbsp;&nbsp;&nbsp;	&nbsp;	&nbsp;	&nbsp;	&nbsp;&nbsp;&nbsp;&nbsp;	&nbsp;	&nbsp;	&nbsp;	&nbsp;&nbsp;&nbsp;&nbsp;	&nbsp;	&nbsp;	&nbsp;	&nbsp;&nbsp;&nbsp;&nbsp;	&nbsp;&nbsp;&nbsp;&nbsp;<a>Date:5/22/2021</a><br><a>Subject Name:abcd</a>	&nbsp;	&nbsp;	&nbsp;	&nbsp;&nbsp;&nbsp;&nbsp;	&nbsp;	&nbsp;	&nbsp;	&nbsp;&nbsp;&nbsp;&nbsp;	&nbsp;	&nbsp;	&nbsp;	&nbsp;&nbsp;&nbsp;&nbsp;	&nbsp;	&nbsp;	&nbsp;	&nbsp;	&nbsp;	&nbsp;&nbsp;&nbsp;&nbsp;	&nbsp;	&nbsp;	&nbsp;	&nbsp;&nbsp;&nbsp;&nbsp;	&nbsp;	&nbsp;	&nbsp;	&nbsp;&nbsp;&nbsp;&nbsp;	&nbsp;	&nbsp;&nbsp;&nbsp;&nbsp;	&nbsp;	&nbsp;	&nbsp;	&nbsp;&nbsp;&nbsp;&nbsp;<a>Time: 30 minit</a><hr /><a>Marks:50</a><div><h4>Instructions:</h4><ol><li> Make suitable assumptions wherever necessary.</li><li>Figures to the right indicate full marks.</li></ol></div>";
    $i=0;
    foreach ( $random_number_array as $value )
    {
      $i++;
      // echo  "$value<br />";
      $qi="SELECT * FROM $Question_paper_id WHERE `id`=$value";
      $ri= mysqli_query($conn,$qi);
      $rowi = mysqli_fetch_array($ri);
      // print_r($rowi);
      // echo $rowi['Question'];
      // exit;
      $html .="(".$i.")	&nbsp;".$rowi['Question']."?"."<br>";
      $html .="	&nbsp;	&nbsp;	&nbsp;(A)	&nbsp;".$rowi['A']."	&nbsp;	&nbsp;	&nbsp;	&nbsp;&nbsp;&nbsp;&nbsp;(B) ".$rowi['B']."</br>";
      $html .="	&nbsp;	&nbsp;	&nbsp;(C)	&nbsp;".$rowi['C']."	&nbsp;	&nbsp;	&nbsp;  &nbsp;&nbsp;&nbsp;&nbsp;(D) ".$rowi['D']."<br>"; 
      $html .="<br>";
    } 
    $mpdf=new \Mpdf\Mpdf();
    $mpdf->WriteHTML($html);
    $file='media/'.time().'.pdf';
    $mpdf->output($file,'I');
    } 
    else {
    $eror="<p>you are not owner of this paper</p>";
    $_SESSION["eror"] = $eror;
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
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-6">
          <div class="card card-primary card-outline">
              <div class="card-body box-profile">
                <div class="text-center">
                  <img class="profile-user-img img-fluid img-circle"
                       src="dist/img/user4-128x128.jpg"
                       alt="User profile picture">
                </div>
                <div class="card-body">
              <div class="card-body box-profile">                        
                                        
              <!-- <p class="login-box-msg">Create new paper</p> -->
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
        <div class="input-group mb-3">
        <input type="text" class="form-control" placeholder="NO of Qustion" name="total">
        <div class="input-group-append">
        <div class="input-group-text">
            <span class="fas fa-eye"></span>
        </div>
        </div>
    </div><div class="input-group mb-3">
        <input type="text" class="form-control" placeholder="Total Marks" name="marks">
        <div class="input-group-append">
        <div class="input-group-text">
            <span class="fas fa-eye"></span>
        </div>
        </div>
    </div>
    <div class="input-group mb-3">
        <input type="text" class="form-control" placeholder="Time In Hours" time="time">
        <div class="input-group-append">
        <div class="input-group-text">
            <span class="fas fa-eye"></span>
        </div>
        </div>
    </div>
    <div class="input-group mb-3">
        <input type="text" class="form-control" placeholder="instructions" name="instruction">
        <div class="input-group-append">
        <div class="input-group-text">
            <span class="fas fa-eye"></span>
        </div>
        </div>
    </div>               
                   

                    <button type="submit" class="btn btn-primary btn-block"><b>Create paper</b></button></from>
              </div>
            </div>
            </form>
    </section>
  </div>
