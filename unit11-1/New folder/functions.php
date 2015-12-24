<?php
    	
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
    $createMedia = array();
    $createMedia[10] = "USE albums";
    $createMedia[20] = "CREATE TABLE yang_ning_media( 
    mediaType int AUTO_INCREMENT PRIMARY KEY, 
    mediaString varchar(10) NOT NULL
    )";    
    $createMedia[30] = "INSERT INTO yang_ning_media values( Null, 'Album' )";
    $createMedia[40] = "INSERT INTO yang_ning_media values( Null, '8-Track' )";
    $createMedia[50] = "INSERT INTO yang_ning_media values( Null, 'Cassette' )";
    $createMedia[60] = "INSERT INTO yang_ning_media values( Null, 'CD' )";    
    $createMedia[70] = "INSERT INTO yang_ning_media values( Null, 'DVD' )";
    
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
    foreach ($createMedia as $index => $val) {
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
    
        // create similar MEDIA selectbox
    $sql2 = "SELECT mediaType, mediaString FROM yang_ning_media ORDER BY mediaType";      
    $media = mysql_query($sql2, $conn) or die("<br>Error in printForm() getting info for Media select: ".mysql_error() );
    $selMedia = getSelect('selMed', $media);
    
    mysql_close();     
    
        // print out form(s), using invisible field to submit a flag
    echo <<<HERE
        <h6 style='text-align:center'><em>Music Master</em></h6>
        <form name='addArtist1' id='addArtist1' action='' method='POST' >
        <h3>Add a new Artist</h3>
        <h1>Artist's Name: <input type='text' name='artist' size='25' maxlength='25'/></h1>
        <input type='text' name='switch' value='2' style='display:none'/>
        <h1><button type='submit' value='addArtist'>Submit Artist</button></h1>
        </form>
        <h1>-------------------------------------------------------------------------</h1>
        <form name='addAlbum1' id='addAlbum1' action='' method='POST' >
        <h3>Add a new Album</h3>
        <h1>Title: <input type='text' name='album' size='25' maxlength='25'/></h1>
        <h1>Artist: $selArtist</h1>
        <h1>Year Released: <input type='text' name='year' size='4' maxlength='4'/></h1>
        <h1>Media: $selMedia</h1>
        <h4>Note: if your artist does not appear in the dropbox, please submit artist before album</h4>
        <input type='text' name='switch' value='3' style='display:none'/>
        <h1><button type='submit' value='addAlbum'>Submit Album</button></h1>
        </form>
        <h1>-------------------------------------------------------------------------</h1>
        <form name='makeQuery1' id='makeQuery1' action='' method='POST' >
        <h3>Search Music</h3>
        <h1>Search For: <input type='text' name='lookFor' size='25' maxlength='25'/></h1>
        <input type='text' name='switch' value='4' style='display:none'/>
        <h1><button type='submit' value='makeQuery'>Go Look</button></h1>
        </form>
        <h1>-------------------------------------------------------------------------</h1>
        <form name='collection1' id='collection1' action='' method='POST' >
        <input type='text' name='switch' value='5' style='display:none'/>
        <h1><button type='submit' value='collection'>See Album Collection</button></h1>
        </form>
        <h1>-------------------------------------------------------------------------</h1>
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
    mysql_select_db("albums", $conn);  
    }
?>