<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html lang="EN" dir="ltr" xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Quiz Builder</title>
<link rel = "stylesheet"
      type = "text/css"
      href = "quiz.css" />
      
</head>
<body>
<h1>Thank you!!</h1>
<h2>Add you lovely comment to the owner</h2>
<?php 

//retrieve variables from form
$password = filter_input(INPUT_POST, "password");
$editFile = filter_input(INPUT_POST, "editFile");

if ($password != ""){
  print <<<HERE
  
<p class = "error">
Incorrect Password.<br />
You must have a password in order to edit this quiz.
</p>
</body>
</html>

HERE;
} else {
  //check to see if user has chosen a form to edit
  if ($editFile == "new"){
    //if it's a new file, put in some dummy values
    $quizName = "Your Name Here";
    $quizEmail = "Your Email Here";
    $quizData = "Plese enter Your Comment Here";
    $quizPwd = "php";
  } else {    
    //open up the file and get the data from it
    $editFile .= ".mas";
    $fp = fopen($editFile, "r");
    $quizName = fgets($fp);
    $quizEmail = fgets($fp);
    $quizPwd = fgets($fp);
    $quizData = "";
    while (!feof($fp)){
      $quizData .= fgets($fp);
    } // end while
  } // end 'new form' if

  print <<<HERE

  <form action = "writeQuiz.php"
        method = "post">
        
    <fieldset>
      <label>Your Name</label>
      <input type = "text"
             name = "quizName"
             value = "$quizName" />
             
      <label>Your Email</label>
      <input type = "text"
             name = "quizEmail"
             value = "$quizEmail" />
      
      
      <textarea name = "quizData"
                rows = "20"
                cols = "60">
$quizData</textarea>            

      <button type = "submit">
        Summit
      </button>
    </fieldset>
  </form>
HERE;

} // end if

?>
</body>
</html>
