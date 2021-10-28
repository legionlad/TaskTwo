<?php
require 'initialize/rb/rb-mysql.php';


class Model_builder
{
 private $_config;
 public $json;
 private $dir = 'release';
 private $not_exist = "CREATE TABLE IF NOT EXISTS ";

 public function __construct()
 {
  $this->_config = json_decode(file_get_contents('configurations.json'), TRUE);
 }

 public function build()
 {


  foreach($this->_config as $names){
   $file = '';

   foreach($names as $fields => $field){
    $form_start = "<div style='text-align: center; display: block;'>";
    $form_input = '';
    $form_end = '<input type="submit" value="Submit Form"></form></div>';

    if(is_array($field)){

     foreach($field as $rows){
      if(is_array($rows)){
       foreach($rows as $row_cells){
        $arr = array();
        foreach($row_cells as $values){
         $arr[] = $values;
        }
        $input_type = $this->input_type($arr[1]);

        $form_input .= "<label style='margin: 10px;'>" . $arr[2] . "</label>
                                <input style='margin: 10px;' type='" . $input_type . "' 
                                       name='" . $arr[0] . "' " . $arr[3] . "><br>";

       }
//        echo htmlentities($form_input).'<br>';
      } else{
       $file = $rows;
       $form_start .= " <h4>Form for " . ucfirst($rows) . "</h4> <form method='POST' action='/api/";
       $form_start .= $rows . "'>";


      }
      $form = $form_start . $form_input . $form_end;
     }


    }

    echo $form;
    echo '<br><br>';
    $form_start = '';
    $form_input = '';
    $form_end = '';


    $string_code = '<html><body>' . $form . '</body></html>';
    $file = $this->dir . '/' . $file . '.html';

    if(!file_exists($file)){
     $File = fopen($file, 'w+');
     $status = fwrite($File, $string_code);
     fclose($File);

    } else{
     echo '<div style="text-align: center; color: red;"><span >File already exist, only displayed.</span></div><br>';
    }

   }
  }

  $this->build_tables();

 }

 public function input_type($type)
 {

  switch($type){

   case 'string':
    return "text";
    break;

   case 'integer':
    return "number";
    break;

   default:
    return "text";

  }

 }

 public function build_tables()
 {

  foreach($this->_config as $names){

   foreach($names as $fields => $field){

    if(is_array($field)){

     foreach($field as $rows){
      $create = '';
      $disected = '';

      if(is_array($rows)){
       foreach($rows as $row_cells){
        $arr = array();
        foreach($row_cells as $values){
         $arr[] = $values;
            }
        $disected .= $this->disect($arr);

       }
       $disected = rtrim($disected,", ");
       $disected .= " );";
      } else{
       $table = $rows;
      }

      $create .= "CREATE TABLE IF NOT EXISTS " . $table . " ( ";

     }
     $query = $create.$disected;


    }
   R::exec($query );
   }

  }
 }

 public function disect($arr)
 {

// field columns are (the field name, the field type, the field label, the validation rule)
  $disected = '';

  $disected .= $arr[0];

  $disected .= ' ' . $this->data_type($arr[1]);

  if($arr[0] == 'id'){
   $disected .= ' PRIMARY KEY AUTO_INCREMENT, ';
  }
  if($arr[0] != 'id'){
  if($arr[3] == 'required'){
   $disected .= " NOT NULL,";
  } else{
   $disected .= " NULL,";
  }
  }

  return $disected;

 }

 public function data_type($type)
 {
  switch($type){
   case 'integer':
    return 'INT';
    break;

   case 'string':
    return 'TEXT';
  }

 }

}