<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html lang="EN" dir="ltr" xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Write Quiz</title>

<link rel = "stylesheet"
      type = "text/css"
      href = "quiz.css" />
      
</head>
<body>
<?php
//given a quiz file from editQuiz,
//generates a master file and an HTML file for the quiz

//load variables from form
$quizName = filter_input(INPUT_POST, "quizName");
$quizEmail = filter_input(INPUT_POST, "quizEmail");
$quizPwd = filter_input(INPUT_POST, "quizPwd");
$quizData = filter_input(INPUT_POST, "quizData");

//open the output file
$fileBase = str_replace(" ", "_", $quizName);
$htmlFile = $fileBase . ".html";
$masFile = $fileBase . ".mas";

$htfp = fopen($htmlFile, "w");
$htData = buildHTML();
fputs($htfp, $htData);
fclose($htfp);

$msfp = fopen($masFile, "w");
$msData = buildMas();
fputs($msfp, $msData);

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


print <<<HERE
<pre>
$msData
</pre>

HERE;

fclose($msfp);

function buildMas(){
  //builds the master file
  global $quizName, $quizEmail, $quizPwd, $quizData;
  $msData = $quizName . "\n";
  $msData .= $quizEmail . "\n";
  $msData .= $quizPwd . "\n";
  $msData .=  $quizData;
  return $msData;
} // end buildMas

function buildHTML(){
  global $quizName, $quizData;
  $htData = <<<HERE

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html lang="EN" dir="ltr" xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>$quizName</title>
<style type = "text/css">
ol ol {
  border-bottom: 1px solid black;
}

ol ol li {
  list-style-type: upperAlpha;
}
</style>
</head>
<body>

HERE;

  //get the quiz data
  $problems = split("\n", $quizData);
/*  $htData .= <<<HERE

<h1>$quizName</h1>

<form action = "gradeQuiz.php"
      method = "post">
  <fieldset>
    <label>Name</label>
    <input type = "text"
           name = "student" />
    
    <ol>

HERE;
  $questionNumber = 1;

  foreach ($problems as $currentProblem){
      list($question, $answerA, $answerB, $answerC, $answerD, $correct) =
      explode (":", $currentProblem);
      $htData .= <<<HERE
      <li>
        $question
        <ol>
          <li>
            <input type = "radio"
                   name = "quest[$questionNumber]"
                   value = "A" />
              $answerA
          </li>

      <li>
        <input type = "radio"
               name = "quest[$questionNumber]"
               value = "B" />
          $answerB
      </li>

      <li>
        <input type = "radio"
               name = "quest[$questionNumber]"
               value = "C" />
        $answerC
      </li>

      <li>
        <input type = "radio"
               name = "quest[$questionNumber]"
               value = "D" />
          $answerD
      </li>

    </ol>
    
  </li>

HERE;
    $questionNumber++;
  
  } // end foreach*/
  $htData .= <<<HERE
</ol>

<input type = "hidden"
       name = "quizName"
       value = "$quizName" />
       
<input type = "submit"
       value = "submit quiz" />
</fieldset>       
</form>
</body>
</html>

HERE;

  //print $htData;
  return $htData;
} // end buildHTML


?>

</a>
</body>
</html>