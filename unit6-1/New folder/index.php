<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html lang="EN" dir="ltr" xmlns="http://www.w3.org/1999/xhtml">
<head>
<title> a simple guest book</title>
<link rel = "stylesheet"
      type = "text/css"
      href = "quiz.css" />
       
</head>
<body>
<h1> A Simple Guest Book</h1>

<?php

getFiles();
showEdit();


function getFiles(){
  //get list of all files for use in other routines

  global $dirPtr, $theFiles;
  
  chdir(".");
  $dirPtr = openDir(".");
  $currentFile = readDir($dirPtr);
  while ($currentFile !== false){
    $theFiles[] = $currentFile;
    $currentFile = readDir($dirPtr);
  } // end while
  
} // end getFiles


function showTest(){
  //print a list of tests for user to take

  global $theFiles;
  

  //select only quiz html files
  $testFiles = preg_grep("/mas$/", $theFiles);

  //generate the select box first
  $selQuiz = "    <select name = \"takeFile\"> \n";
  foreach ($testFiles as $myFile){
    $fileBase = substr($myFile, 0, strlen($myFile) - 4);
    $selQuiz .= <<<HERE
      <option value = "$fileBase">
        $fileBase
      </option>
      
HERE;

  } // end foreach
  $selQuiz .= "    </select> \n";
  
  print <<<HERE
<form action = "takeQuiz.php"
      method = "post">

  <fieldset>
    <h3>Take a quiz</h3>
    <label>quiz password</label>
    <input type = "password"
           name = "password" />

    <label>quiz</label>
    $selQuiz

    <button type = "submit">
      Take quiz
    </button>
  </fieldset>
</form>

HERE;
} // end showTest


function showEdit(){
  // let user select a master file to edit

  global $theFiles;
  //get only quiz master files
  $testFiles = preg_grep("/mas$/", $theFiles);

  //generate the select box first
  $selEdit = "    <select name = \"editFile\"> \n";
  foreach ($testFiles as $myFile){
    $fileBase = substr($myFile, 0, strlen($myFile) - 4);
    $selEdit .= <<<HERE
      <option value = "$fileBase">
        $fileBase
      </option>
      
HERE;

  } // end foreach
  // add a 'new quiz' option
  $selEdit .= <<<HERE
      <option value = "new" selected>
        NEW Comment 
      </option>
      
HERE;
  
  $selEdit .= "    </select> \n";
  

  //edit a quiz
  print <<<HERE
<form action = "editQuiz.php"
      method = "post">

  <fieldset>
    <h3>Please select your name if you want to edit</br>Or select NEW  then press enter to add your words to the owner</h3>
   
    $selEdit

    <button type = "submit">
      Enter
    </button>
  </fieldset>
</form>

HERE;

} // end showEdit

function showLog(){

  //let user choose from a list of log files
  global $theFiles;
  $testFiles = preg_grep("/log$/", $theFiles);

  //generate the select box first
  $selLog = "    <select name = \"logFile\"> \n";
  foreach ($testFiles as $myFile){
    $fileBase = substr($myFile, 0, strlen($myFile) - 4);
    $selLog .= <<<HERE
      <option value = "$fileBase">
        $fileBase
      </option>
      
HERE;

  } // end foreach
  $selLog .= "    </select> \n";
  
  //edit a quiz
  print <<<HERE
<form action = "showLog.php"
      method = "post">

  <fieldset>
    <h3>View a quiz log</h3>
    <label>admin password</label>
    <input type = "password"
           name = "password"
           value = "absolute" />

    <label>quiz</label>
    $selLog

    <button type = "submit">
      View log
    </button>
  </fieldset>
</form>

HERE;

} // end showLog

?>

</body>
</html>
