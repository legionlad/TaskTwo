<?php
require_once 'Model_builder.php';
require_once 'initialize/rb/rb-mysql.php';
require_once 'initialize/flight/Flight.php';

R::setup( 'mysql:host=localhost;dbname=phptask', 'root', '' );

Flight::register('model_builder', 'Model_builder');


// Get an instance of your class
Flight::route('/form_from_json', function(){
 $model_builder = Flight::model_builder();
 $model_builder->build();

});

Flight::route('/api/@model', function ($model){

          R::dispense("$model");

});








Flight::start();


//$string = file_get_contents("configurations.json");
//$model = json_decode($string, true);
//$not_exist = "CREATE TABLE IF NOT EXIST ";
//
//foreach($model as $names){
//
//  foreach($names as $fields => $field)
// {
//
//  if(is_array($field)){
//       foreach($field as $rows){
//
//        if(is_array($rows)) // else table name
//        {
//            foreach($rows as $row_cells){
//                 foreach($row_cells as $values){
//                  echo $values . ' - ';
//                 }
//             echo '<br>';
//
//            }
//            echo '<br>';
//        }else{  // name
//
//        }
//       }
//  }
//
// }
//}



?>
