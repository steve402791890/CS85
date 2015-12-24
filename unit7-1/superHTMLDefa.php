<?php

// SuperHTML Class Def
// Andy Harris
// PHP / MySQL Programming for the Absolute Beginner
// 3rd Ed. (Now XHTML strict compliant)

class SuperHTML{

  //properties
  var $title;
  var $thePage;

  function __construct($tTitle = "Super HTML"){
    //constructor
    $this->setTitle($tTitle);
  } // end constructor

  function getTitle(){
    return $this->title;
  } // end getTitle

  function setTitle($tTitle){
    $this->title = $tTitle;
  } // end setTitle

  function getPage(){
    return $this->thePage;
  } // end getPage

  //most basic tags
  function addText($content){
    //given any text (including HTML markup)
    //adds the text to the page
    $this->thePage .= $content;
    $this->thePage .= "\n";
  } // end addText

  function gAddText($content){
    //given any text (including HTML markup)
    //returns the text
    $temp= $content;
    $temp .= "\n";
    return $temp;
  } // end addText

  function buildTop(){
    $cssFile = str_replace(" ", "_", $this->title);
    $temp = <<<HERE
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html lang="EN" dir="ltr" xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta http-equiv="content-type" content="text/xml; charset=utf-8" />
  <title>$this->title</title>
  <link rel = "stylesheet"
        type = "text/css"
        href = "$cssFile.css" />
</head>
<body>
  <h1>$this->title</h1>

HERE;
    $this->addText($temp);
  } // end buildTop;

  function buildBottom(){
    //builds the bottom of a generic web page
    $temp = <<<HERE
</body>
</html>

HERE;
    $this->addText($temp);
  } // end buildBottom;

  //general tag function
  function tag($tagName, $contents){
    //given any tag, surrounds contents with tag
    //improve so tag can have attributes
    $this->addText($this->gTag($tagName, $contents));
  } // end tag

  function gTag($tagName, $contents){
    //given any tag, surrounds contents with tag
    //improve so tag can have attributes
    //returns tag but does not add it to page
    $temp = "<$tagName>\n";
    $temp .= "  " . $contents . "\n";
    $temp .= "</$tagName>\n";
    return $temp;
  } // end tag

  //header functions
  function h1($stuff){
    $this->tag("h1", $stuff);
  } // end h1

  function h2($stuff){
    $this->tag("h2", $stuff);
  } // end h2

  function h3($stuff){
    $this->tag("h3", $stuff);
  } // end h3

  function h4($stuff){
    $this->tag("h4", $stuff);
  } // end h4

  function h5($stuff){
    $this->tag("h5", $stuff);
  } // end h5

  function h6($stuff){
    $this->tag("h6", $stuff);
  } // end h6

  function gBuildList($theArray, $type = "ul"){
    //given an array of values, builds a list based on that array
    $temp= "<$type> \n";
    foreach ($theArray as $value){
      $temp .= " <li>$value</li> \n";
    } // end foreach
    //shorten type if it included style information
    $type = substr($type, 0, 2);
    $temp .= "</$type> \n";
    return $temp;
  } // end gBuildList

  function buildList($theArray, $type = "ul"){
    $temp = $this->gBuildList($theArray, $type);
    $this->addText($temp);
  } // end buildList

  function gDl ($listVals){
    //Create a definition list from an associative array   
    $temp = "";
    $temp .= "<dl>\n";
    foreach ($listVals as $term => $def){
      $temp .= "  <dt>$term</dt> \n";
      $temp .= "  <dd>$def</dd> \n";
    } // end foreach
    $temp .= "</dl> \n";
    return $temp;
  }
  
  function dl($listVals){
    $this->addText($this->gDl($listVals));
  } // end dl

  function gBuildTable($theArray){
    //given a 2D array, builds an HTML table based on that array
    $table = "<table> \n";
    foreach ($theArray as $row){
      $table .= "<tr> \n";
      foreach ($row as $cell){
        $table .= "  <td>$cell</td> \n";
      } // end foreach
      $table .= "</tr> \n";
    } // end foreach
    $table .= "</table> \n";

    return $table;
  } // end gBuildTable

  function buildTable($theArray){
    $temp = $this->gBuildTable($theArray);
    $this->addText($temp);
  } // end buildTable


  function startTable(){
    $this->thePage .= "<table>\n";
  } // end startTable

  function tRow ($rowData, $rowType = "td"){
    //expects an array in rowdata, prints a row of th values
    $this->thePage .= "<tr> \n";
    foreach ($rowData as $cell){
      $this->thePage .= "  <$rowType>$cell</$rowType> \n";
    } // end foreach
    $this->thePage .= "</tr> \n";
  } // end tRow

  function endTable(){
    $this->thePage .= "</table> \n";
  } // end endTable

  //form elements
  
  function startForm($action = "", $method = "post"){
    //begins form creation with fieldset
    $temp = <<<HERE
    <form action = "$action"
          method = "$method">
      <fieldset>

HERE;
    $this->thePage .= $temp;
  } // end startForm
  
  function endForm(){
    //adds form end tag
    $this->thePage .= <<<HERE
      </fieldset>
    </form>
    
HERE;

  }// end endForm
  
  function label($value) {
    $this->tag("label", $value);
  } // end label
  
  function gTextbox($name, $value = ""){
    // returns but does not print
    // an input type = text element
    // used if you want to place form elements in a table
    $temp = <<<HERE
       <input type = "text"
              name = "$name"
              value = "$value" />

HERE;

    return $temp;
  } // end textBox

  function textbox($name, $value = ""){
    $this->addText($this->gTextbox($name, $value));
  } // end textBox

  function gSubmit($value = "Submit Query"){
    // returns but does not print
    // an input type = submit element
    // used if you want to place form elements in a table
    $temp = <<<HERE
      <button type = "submit">
       $value 
      </button>

HERE;

    return $temp;
  } // end submit

  function submit($value = "Submit Query"){
    $this->addText($this->gSubmit($value));
  } // end submit

  function gSelect($name, $listVals){
    //given an associative array,
    //prints an HTML select object
    //Each element has the appropriate
    //value and displays the associated name
    $temp = "";
    $temp .= "<select name = \"$name\" >\n";
    foreach ($listVals as $val => $desc){
      $temp .= "  <option value = \"$val\">$desc</option> \n";
    } // end foreach
    $temp .= "</select> \n";
    return $temp;

  } // end gSelect

  function select($name, $listVals){
    $this->addText($this->gSelect($name, $listVals));
  } // end select
  
  function formResults(){
    //returns the names and values of all form elements
    //in an HTML definition list
   if (!empty($_REQUEST)){
      $this->dl($_REQUEST);
    } // end isset
    
   
  } // end formResults

} // end class def

?>