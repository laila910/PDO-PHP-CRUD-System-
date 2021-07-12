<?php

session_start(); 

$id=$_GET['id'];
// echo $id; //to check if the id is sent correctly :) 

//start the vlidation of the id 
$id = filter_var($id,FILTER_SANITIZE_NUMBER_INT);
$message ='';

if(filter_var($id,FILTER_VALIDATE_INT)){
   require "dbconnection.php";
   $sql = "DELETE from posts where id=".$id;
   $op = mysqli_query($conn,$sql);
   
   if($op){
       $message = "Success to delete the post of id=".$id;

   }else{
       $message = "Error in delete this query";
   }

}else{
    $message = "Error Invalid Id ";
}
//to check the delete or the error 

$_SESSION['message']= $message;
//after delete ,return to index.php 
header("Location: index.php");

?>