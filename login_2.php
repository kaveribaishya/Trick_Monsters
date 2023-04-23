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
    // echo $_SESSION['user_id'];

    // Redirect to quiz game page
    header('Location: index.php');
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
  $score = mysqli_real_escape_string($conn_quiz, $_POST['score']);


  // // Insert the answers into the quiz_answers table
  // $user_id = $_SESSION['user_id'];
  // $sql_insert = "INSERT INTO user_records (user_id, answer1, answer2, answer3, answer4, answer5, answer6, answer7, answer8, answer9, answer10) VALUES ('$user_id', '$answer1', '$answer2', '$answer3', '$answer4', '$answer5', '$answer6', '$answer7', '$answer8', '$answer9', '$answer10')";
  // mysqli_query($conn_quiz, $sql_insert);

  // Insert the answers into the user_records table
  $user_id = $_SESSION['user_id'] ?? "User0";
  $sql_insert = "INSERT INTO user_records (user_id, answer1, answer2, answer3, answer4, answer5, answer6, answer7, answer8, answer9, answer10, score) VALUES ('$user_id', '$answer1', '$answer2', '$answer3', '$answer4', '$answer5', '$answer6', '$answer7', '$answer8', '$answer9', '$answer10','$score')";
  mysqli_query($conn_quiz, $sql_insert);
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Login Page</title>
  <link rel="stylesheet" href="./style_2.css">
</head>
<body>
  <div id="bg"></div>

  <form method="POST" action="login_2.php">
    <div class="form-field">
      <input type="text" placeholder="Email / Username" name="username" required/>
    </div>
  
    <div class="form-field">
      <input type="password" placeholder="Password" name="password" required/>
    </div>
  
    <div class="form-field">
      <button class="btn" type="submit" name="login_btn">Log in</button>
    </div>
    </form>
  </body>
</html>

