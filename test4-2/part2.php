<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
   <head>
      <title>Test4-2</title>
   </head>
   <body> 
      <?php
          extract($_REQUEST);                         // create form variables
          error_reporting(E_ALL & ~E_NOTICE);         // get rid of runtime notices
          error_reporting(E_ALL ^ E_DEPRECATED);
		  
          // base logic
          if ( !isset( $_REQUEST['section'] ) ) {            // first time through (no section entered)
              drawForm();                                            // draw form
          } else {                                            // section number present
              $section = $_REQUEST['section'];
              
              $queryResult = runQuery($section);                // get info on section number
              if ( mysql_num_rows($queryResult) ) {                // if query returned results
                  print drawResults($queryResult);                    // print them out
                  $section = null;                                    // reset section number
                  $_REQUEST['section'] = null;
                  drawForm();                                            // redraw form
              } else {                                            // if not, let user know that section doesn't exist
                  print "<h2>Section not found!</h2>";                // let user know that section doesn't exist
                  $section = null;                                    // reset section number
                  $_REQUEST['section'] = null;
                  drawForm();                                            // redraw form
              }
          }
         
          function drawForm() {                    // function to draw form
              ECHO <<< HERE
                <h1>FIND MY SECTION...<br/><br/>
                <form class='center' id='myTest' name='myTest' method='post' > 
                   <label>Enter Section #: <input type='text' name='section' id='section' size='4' maxlength='4'/></label><br/> 
                   <button type='submit' value='Submit'>Submit</button> 
                </form></h1><br/><br/>
HERE;
          }
          function connect(){
			include "variables.php" ;       
			include "db_connection_info.php";     
			
			//$conn = mysql_connect("$localhost", "$cs85Username", "$cs85Password"); 
			
			if(!$conn = mysql_connect("$localhost", "$cs85Username", "$cs85Password") ){
				die("Could not make connection to server".mysql_errno() . ": " . mysql_error(). "\n");
			}
			
			if (!mysql_select_db("nyang_test4", $conn)){
				die("Could not connect to the database ".mysql_errno() . ": " . mysql_error(). "\n");
			}
            
			
		  }
		  
          function runQuery($section) {            // function to run query. Returns data as array
			include "variables.php";
			connect();
			
            //using the same database and tables in part 1 
            // return course number, title, instructor name
            $sql = "SELECT c.course_number, c.title, i.name
                    FROM instructors AS i INNER JOIN classes AS c ON i.instructor_id = c.instructor_id
                    WHERE c.section = '$section' ";

            if(!$result = mysql_query($sql, $conn)){
				die("Could not find your result".mysql_errno() . ": " . mysql_error(). "\n");
			}
                
            mysql_close();   
            return $result;

            }
            
            function drawResults($results) {    // formats table of results
                $retString = "<table><tr><th>Course Number</th><th>Course Title</th><th>Instructor</th></tr><tr>";
                while ($row = mysql_fetch_assoc($results) ) {
                     foreach ($row as $name => $value) {
                      $retString .= "<td>$value</td>";
                      }
                  $retString .= "</tr></table><br/>\n";
                  }
                  return $retString;
            }
      ?>

   </body>
</html>  