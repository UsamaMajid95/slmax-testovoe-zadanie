<?php
require 'function.php';

if(isset($_POST['name'])){
    
    $name = $_POST['name'] ;
    $lastname =$_POST['lastname'];
    $birthday=$_POST['birthday'];
    $gender= $_POST['gender'];
    $city = $_POST['city'];

    $user = new Person($name,$lastname,$birthday,$gender,$city);
   
    $result = $user->save_person($name,$lastname,$birthday,$gender,$city);

    echo $result;
   
}


?>