<?php
session_start(); //to return the result of the deletion from delete.php

require "dbconnection.php";
$sql = "SELECT * FROM posts;";
$op = mysqli_query($conn,$sql);



?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]>      <html class="no-js"> <![endif]-->
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
         <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />

        <link rel="stylesheet" href="">
        <!-- custom css -->
    <style>
        .m-r-1em {
            margin-right: 1em;
        }
        
        .m-b-1em {
            margin-bottom: 1em;
        }
        
        .m-l-1em {
            margin-left: 1em;
        }
        
        .mt0 {
            margin-top: 0;
        }
    </style>
    </head>
    <body style="width:95%;margin-left:10px;margin-right:10px">
        <!--[if lt IE 7]>
            <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="#">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
        <h1 style="text-align:center;margin-bottom:50px;margin-top:50px">Read Data in The Database </h1>
        <table class="table table-striped">
           <thead>
             <tr>
               <th scope="col">Id</th>
               <th scope="col">Name</th>
               <th scope="col">Content</th>
               <th scope="col">Image</th>
               <th scope="col">Action</th>

            </tr>
           </thead>
        <tbody>
            <?php
              while($data = mysqli_fetch_assoc($op)){
            ?>
         <tr>
             <td><?php echo $data['id'];?></td>
             <td><?php echo $data['name'];?></td>
             <td><?php echo $data['content'];?></td>
             <td><?php echo $data['image'];?></td>
             <td>
                 <a class="btn btn-danger  m-r-1em  m-b-1em " href="delete.php?id=<?php echo $data['id']; ?>" role="button">Delete</a>
                 <a class="btn btn-primary m-r-1em" href="edit.php?id=<?php echo $data['id']; ?>" role="button">Edit</a>
             </td>
         </tr>
          <?php } ?>
         </tbody>
        </table>
        <?php 
        if(isset($_SESSION['message'])){
            echo $_SESSION['message'];

        }unset($_SESSION['message']); //after I recieved the message ,I need to end the session directly

       ?>
       
        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>

    <!-- Latest compiled and minified Bootstrap JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
     <script src="" async defer></script>
    </body>
</html>