<?php
$conn = mysqli_connect("localhost", "root", "", "websitelogin_1"); // Connection to login database

if (isset($_POST['login_btn'])) {
  $username = mysqli_real_escape_string($conn, $_POST['username']); // to prevent SQL injection attacks
  $password = mysqli_real_escape_string($conn, $_POST['password']); // to prevent SQL injection attacks

  // Inserting username and password to the database
  $sql_insert = "INSERT INTO `logindetails`(`id`, `username`, `password`) VALUES ('', '$username', '$password')";
  mysqli_query($conn, $sql_insert);

  // Checking if the entered username and password are correct
  $sql_select = "SELECT * FROM logindetails WHERE username='$username' AND password='$password'";
  $result = mysqli_query($conn, $sql_select);

  if (mysqli_num_rows($result)) {
    // If login is successful, store the user id in a session variable
    session_start();
    $row = mysqli_fetch_assoc($result);
    $_SESSION['user_id'] = $row['id'];

    // Redirect to quiz game page
    header('Location: login_2.php');
    exit();
  } else {
    echo "<script>
         alert('Login unsuccessful');
    </script>";
  }
}


// Connect to the quiz game database
$conn_quiz = mysqli_connect("localhost", "root", "", "websitelogin_1");

if (isset($_POST['submit_answers'])) {
  // Get the user's quiz answers from the form
  $answer1 = mysqli_real_escape_string($conn_quiz, $_POST['answer1']);
  $answer2 = mysqli_real_escape_string($conn_quiz, $_POST['answer2']);
  $answer3 = mysqli_real_escape_string($conn_quiz, $_POST['answer3']);
  $answer4 = mysqli_real_escape_string($conn_quiz, $_POST['answer4']);
  $answer5 = mysqli_real_escape_string($conn_quiz, $_POST['answer5']);
  $answer6 = mysqli_real_escape_string($conn_quiz, $_POST['answer6']);
  $answer7 = mysqli_real_escape_string($conn_quiz, $_POST['answer7']);
  $answer8 = mysqli_real_escape_string($conn_quiz, $_POST['answer8']);
  $answer9 = mysqli_real_escape_string($conn_quiz, $_POST['answer9']);
  $answer10 = mysqli_real_escape_string($conn_quiz, $_POST['answer10']);


  // Insert the answers into the quiz_answers table
  $user_id = $_SESSION['user_id'];
  $sql_insert = "INSERT INTO user_records (user_id, answer1, answer2, answer3, answer4, answer5, answer6, answer7, answer8, answer9, answer10) VALUES ('$user_id', '$answer1', '$answer2', '$answer3', '$answer4', '$answer5', '$answer6', '$answer7', '$answer8', '$answer9', '$answer10')";
  mysqli_query($conn_quiz, $sql_insert);

  // // Insert the answers into the user_records table
  // $user_id = $_SESSION['user_id'];
  // $sql_insert = "INSERT INTO user_records (user_id, answer1, answer2, answer3, answer4, answer5, answer6, answer7, answer8, answer9, answer10) VALUES ('$user_id', '$answers[0]', '$answers[1]', '$answers[2]', '$answers[3]', '$answers[4]', '$answers[5]', '$answers[6]', '$answers[7]', '$answers[8]', '$answers[9]')";
  // mysqli_query($conn_quiz, $sql_insert);
  
}
?>




<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Trick Monsters</title>
    <link rel="stylesheet" href="style.css" />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css"
    />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha.6/css/bootstrap.min.css"
    />
  </head>
  <body>
    <header class="header bg-primary">
      <div class="left-title">Trick Monsters</div>
      <div class="right-title">Total Challengesx: <span id="tque"></span></div>
      <div class="clearfix"></div>
    </header>
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-sm-12">
            <div id="result" class="quiz-body">
                <div class="head-cont">

                    <h3 class="head">
                        Welcome, Trick Monster.  
                    </h3>
                    <h3 class="head">
                       This is a multiple choice quiz to test your General Knowledge.
                    </h3>
                </div>
<hr>
                <form method="POST" action="index.php">  
                <fieldset class="form-group">
                  <h4><span id="qid">1.</span> <span id="question"></span></h4>
                  <div
                    class="option-block-container"
                    id="question-options"
                  ></div>
                  <!-- End of option block -->
                </fieldset>
                <button name="previous" id="previous" class="btn btn-success">
                  Previous
                </button>
                &nbsp;
                <button name="next" id="next" class="btn btn-success">
                  Next
                </button>
              </form>
            </div>
          </div>
          <!-- End of col-sm-12 -->
        </div>
        <!-- End of row -->
      </div>
      <!-- End of container fluid -->
    </div>
    <!-- End of content -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha.6/js/bootstrap.min.js"></script>
    <script src="script.js"></script>
    
  </body>
</html>