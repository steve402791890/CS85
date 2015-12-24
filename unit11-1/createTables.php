<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">  
   <head>
      <title>Unit11-1</title>    
	  <style type="text/css">
         body {background-color: grey}
         h1 {color:black; font-family:Ariel; font-size:14pt; 
                 font-weight:bold; text-align: center}
         h2 {color:red; font-family:Ariel; font-size:14pt; font-weight:bold}
         h3 {color:black; font-family:Ariel; font-size:24pt; 
                 font-weight:normal; text-align:center}
         .center {margin-left: auto;
                margin-right: auto;}
         h4 {color:black; font-family:Ariel; font-size:11pt; font-weight:normal; text-align:center}
         h5 {color:red; font-family:Ariel; font-size:24pt;
                 font-weight:normal; text-align:center}
         h6 {color:red; font-family:Ariel; font-size: 180%}
      </style> 
   </head>
   <body> 
      <?php
	  
        extract($_REQUEST);                         // create form variables
        error_reporting(E_ALL & ~E_NOTICE);         // get rid of runtime notices
        error_reporting(E_ALL ^ E_DEPRECATED);

        $sql = "SELECT * FROM yang_ning_artists";          
        connect();                        
        $result = mysql_query($sql, $conn);
        mysql_close();  
        
        if (!$result) {
            createTables();       
            printForm();
            }
        else {
			$action = isset($_REQUEST['switch']) ? $_REQUEST['switch'] : null;
            switch ( $action ) 
            {
            case '1':
                printform();
                break;
            case '2':                        // add artist into db
                $artist = $_REQUEST['artist'];                                        // get data
                
                $sql = "INSERT INTO yang_ning_artists VALUES( NULL, '$artist')"; // write query
                
                connect();                                                            // write to db
                $result = mysql_query($sql, $conn) or die( "<br>Error storing Artist to db in Case 2: ".mysql_error() );
                mysql_close();                                                      // close connection
                
                print "<h5>\"".$artist."\" has been added</h5>";
                $_REQUEST['artist'] = "";                                            // clear variable for next time through
                $_REQUEST['switch']='1';                                            // reset switch
                printform();                                                        // print form
                  break;
            case '3':                        // add album to database
                                                                                    // get data
                $album = $_REQUEST['album'];
                $artist = $_REQUEST['selArt'];
                $year = $_REQUEST['year'];
                $media = $_REQUEST['selMed'];
                                                                                    // connect, make query, close
                $sql = "INSERT INTO yang_ning_albums VALUES(NULL, '$album', '$artist', '$year', '.jpg', '$media')";  
                
                connect();                
                $result = mysql_query($sql, $conn) or die( "<br>Error storing Album to db in Case 3: ".mysql_error() );
                mysql_close();  
                                                                                    // confirm, clean up, print form
                print "<h5>\"".$album."\" has been added</h5>";
                $_REQUEST['album'] = "";    
                $_REQUEST['selArt'] = "";  
                $_REQUEST['year'] = "";  
                $_REQUEST['selMed'] = "";
                $_REQUEST['switch'] ='1';
                printform();
                  break;
            case '4':                        // search database
                $lookFor = $_REQUEST['lookFor'];                                    // get search string
                
                if ($lookFor != "" && $lookFor != " ") {                            // if legit search, create query...
                    $lookFor = '%'.$lookFor.'%';                                    // make it 'internal' search
                    $sql = "SELECT art.artistName Artist, alb.albumTitle Album
							FROM yang_ning_artists art INNER JOIN yang_ning_albums alb
							ON art.artistID = alb.artist_id
							WHERE     (art.artistName LIKE '%$lookFor%' OR alb.albumTitle LIKE '%$lookFor%')";
    
                    connect();                                                        // ...get results
                    $result = mysql_query($sql, $conn) or die( "<br>Error querying db in Case 4: ".mysql_error() );
                    mysql_close();                                                  // close connection
            
                                                                                    // create and print out search results...
                    $table = "<table class='center' border='2px' bordercolor='black' cellpadding='2px' cellspacing='2px' ><tr><th>Artist</th><th>Album</th></tr>";
                    while ($row = mysql_fetch_assoc($result) ) 
                        {
                        foreach ($row as $index => $value)
                            {
                            switch ($index)
                                {
                                case 'Artist':
                                  $table .= "<tr><td>".$value."</td>";
                                  break;
                                case 'Album':
                                  $table .= "<td>".$value."</td>";
                                  break;
                                default:
                                  print "Error in 'print search results' switch -- invalid case = ".$index;
                                }  
                            } // end foreach
                        } // end while
                    $table .= "</table>";
                    print "<h3>Your Search Found...</h3>";
                    print "<br>$table";
                }
                        
                $_REQUEST['switch'] ='1';                                            // clean up and reprint screen
                $_REQUEST['lookFor'] = '';
                printform();
                  break;
            case '5':                        // display music collection
                                                                                    // create query, connect, query, close
                $sql = "SELECT art.artistName Artist, alb.albumTitle Album, alb.yearReleased Released
						FROM yang_ning_artists art INNER JOIN platz_brian_albums alb 
						ON art.artistID = alb.artist_id
						ORDER BY Artist ";          
    
                connect();                            
                $result = mysql_query($sql, $conn) or die( "<br>Error getting Album Information in Case 5: ".mysql_error() );
                mysql_close();  
            
                                                                                    // create and print out albums table...
                $table = "<table class='center' border='2px' bordercolor='black' cellpadding='2px' cellspacing='2px' ><tr><th>Artist</th><th>Album</th><th>Year Released</th></tr>";
                while ($row = mysql_fetch_assoc($result) ) 
                    {
                     foreach ($row as $index => $value)
                         {
                        switch ($index)
                            {
                            case 'Artist':
                              $table .= "<tr><td>".$value."</td>";
                              break;
                            case 'Album':
                              $table .= "<td>".$value."</td>";
                              break;
                            case 'Released':
                              $table .= "<td>".$value."</td></tr>";
                              break;
                            default:
                              print "Error in 'print collection' switch -- invalid case = ".$index;
                            }  
                         } // end foreach
                     } // end while
                 $table .= "</table>";
                 print "<h3>Your Music Collection</h3>";
                print "<br>$table";

                                                                                    // clean up and reprint screen    
                $_REQUEST['switch']='1';
                printform();
                  break;
            case '6':                        // revert to baseline db
                createTables();
                $_REQUEST['switch'] ='1';
                print "<h5>The database has been restored to its default.</h5>";
                printform();
                break;
            default:
                createTables();
                $_REQUEST['switch'] ='1';
                printform();
            }
		}
		

        
	function getSelect($name, $listVals) {
		include "variables.php" ;       
		include "db_connection_info.php";    
		 $sel = "";
		 $sel = "<select name=\"$name\" >\n";
		 while ($row = mysql_fetch_assoc($listVals) ) {
			 $first = 1;
			 foreach ($row as $index => $value) {
				if ($first) { 
					$sel .= "    <option value= \"$value\">"; 
				} else { 
					$sel .= "$value</option> \n"; 
				}
				$first = 0;
			 } // end foreach
		 } // end while
		 $sel .= "</select> \n"; 
		 return $sel;
		 }

		 
	function createTables() {                // code to create or revert back to original dbinclude("db_connection_info.inc");    

		include "variables.php" ;       
		include "db_connection_info.php";    
		
		$dropTables = array();
		$dropTables[10] ="USE albums";
		$dropTables[20] ="DROP TABLE IF EXISTS yang_ning_albums";
		$dropTables[30] ="DROP TABLE IF EXISTS yang_ning_artists";
		$dropTables[40] ="DROP TABLE IF EXISTS yang_ning_media";
	/*
	foreach ($dropTables as $indexVar => $valueStoredAtIndex) {
	print "\$indexVar = $indexVar<br>    \$valueStoredAtIndex = $valueStoredAtIndex<br><br>";
	}
	*/ 
		
		
		$createArtists = array();
		$createArtists[10] = "USE albums";
		$createArtists[20] = "CREATE TABLE yang_ning_artists(
		artistID int AUTO_INCREMENT PRIMARY KEY,
		artistName varchar(25) NOT NULL
		)";
		$createArtists[30] = "INSERT INTO yang_ning_artists values( NULL, 'Eagles')";
		$createArtists[40] = "INSERT INTO yang_ning_artists values( NULL, 'Meat Loaf')";    
		$createArtists[50] = "INSERT INTO yang_ning_artists values( NULL, 'Fleetwood Mac')";
		$createArtists[60] = "INSERT INTO yang_ning_artists values( NULL, 'Madonna')";

		$createAlbums = array();
		$createAlbums[10] = "USE albums";
		$createAlbums[20] = "CREATE TABLE yang_ning_albums( 
		albumID int AUTO_INCREMENT PRIMARY KEY, 
		albumTitle varchar(25) NOT NULL,
		artist_id int NOT NULL, 
		yearReleased int, 
		coverArt varchar(30), 
		media int
		)";
		$createAlbums[30] = "INSERT INTO yang_ning_albums values( NULL, 'Ray of Light', 4, 1998, 'ray_of_light.jpg', 4)";
		$createAlbums[40] = "INSERT INTO yang_ning_albums values( NULL, 'Rumours', 3, 1977, 'rumours.jpg', 1)";    
		$createAlbums[50] = "INSERT INTO yang_ning_albums values( NULL, 'Bat out of Hell', 2, 1977, 'bat_out_of_hell.jpg', 3)";
		$createAlbums[60] = "INSERT INTO yang_ning_albums values( NULL, 'Hotel California', 1, 1976, 'hotel_california.jpg', 2)";
		$createAlbums[70] = "INSERT INTO yang_ning_albums values( NULL, 'American Life', 4, 2003, 'american_life.jpg', 5)";
		
		// get link to mysql and db
		 
		connect();
		foreach ($dropTables as $index => $val) {
			$result = mysql_query($val, $conn);
		}
		
		foreach ($createArtists as $index => $val) {
			$result = mysql_query($val, $conn);
		}
		foreach ($createAlbums as $index => $val) {
			$result = mysql_query($val, $conn);
		}
		mysql_close(); 
	}

	function printForm() {
			// create ARTIST selectbox
			// create query variable
		include "variables.php" ;       
		include "db_connection_info.php";    
		
		$sqluse = "USE albums";
		$sql = "SELECT artistID, artistName FROM yang_ning_artists ORDER BY artistName";
		
		connect();
		$result =  mysql_query($sqluse, $conn); 
			// assign query results to a variable
		$curArtists = mysql_query($sql, $conn) or die("<br>Error in printForm() getting info for Artist select: ".mysql_error() );
			// generate a select box of artists        
		$selArtist = getSelect('selArt', $curArtists);
		
		mysql_close();     
		
			// print out form(s), using invisible field to submit a flag
		echo <<<HERE
			<h6 style='text-align:center'><em>Music Master</em></h6>
			<form name='addArtist1' id='addArtist1' action='' method='POST' >
			<h3 style="color:green;">Add a new Artist</h3>
			<h1>Artist's Name: <input type='text' name='artist' size='25' maxlength='25'/></h1>
			<input type='text' name='switch' value='2' style='display:none'/>
			<h1><button type='submit' value='addArtist'>Submit Artist</button></h1>
			</form>
			<h1>------------------------------------------</h1>
			<form name='addAlbum1' id='addAlbum1' action='' method='POST' >
			<h3 style="color:blue;">Add a new Album</h3>
			<h1>Title: <input type='text' name='album' size='25' maxlength='25'/></h1>
			<h1>Artist: $selArtist</h1>
			<h1>Year Released: <input type='text' name='year' size='4' maxlength='4'/></h1>
			
			<h4>Note: if your artist does not appear in the dropbox, please submit artist before album</h4>
			<input type='text' name='switch' value='3' style='display:none'/>
			<h1><button type='submit' value='addAlbum'>Submit Album</button></h1>
			</form>
			<h1>------------------------------------------</h1>
			<form name='makeQuery1' id='makeQuery1' action='' method='POST' >
			<h3 style="color:yellow;">Search Music</h3>
			<h1>Search For: <input type='text' name='lookFor' size='25' maxlength='25'/></h1>
			<input type='text' name='switch' value='4' style='display:none'/>
			<h1><button type='submit' value='makeQuery'>Go Look</button></h1>
			</form>
			<h1>------------------------------------------</h1>
			<form name='collection1' id='collection1' action='' method='POST' >
			<input type='text' name='switch' value='5' style='display:none'/>
			<h1><button type='submit' value='collection'>See Album Collection</button></h1>
			</form>
			<h1>------------------------------------------</h1>
			<form name='revert1' id='revert1' action='' method='POST' >
			<input type='text' name='switch' value='6' style='display:none'/>
			<h1><button type='submit' value='revert'>Restore Basic Collection</button></h1>
			</form>
HERE;
		}
		
	function connect() {
		include "variables.php" ;       
		include "db_connection_info.php";    
		
		$conn = mysql_connect("$localhost", "$cs85Username", "$cs85Password");        // connect to server/db        
		mysql_select_db("nyang_unit11", $conn);  
		}
?>

   </body>
</html>  