 <?php 
 
    require "dbconnection.php";
  $errorMessages=array(); //associative array to carry the errors during check the validation 
  
function CleanInputs($input)
{ 
    $input=trim($input);
    $input=stripcslashes($input);
    $input=htmlspecialchars($input);
    return $input; 
}

 if($_SERVER['REQUEST_METHOD']=="POST"){
     
     $name =CleanInputs($_POST["name"]);  
     $content =CleanInputs($_POST["content"]);  

     //check the Image 
     if(!empty($_FILES['image']['name'])&& isset($_FILES['image']['name'])){ //check if the file is uploded or not
        $PathOfTemp = $_FILES['image']['tmp_name']; //path of temp is the name of the file when is uploaded and is putted in the temp folder in the server 
        $nameOfTheImage = $_FILES['image']['name']; //the Original name of the file that is in the user's Device. Note: the name is sent and included the extension of the uploaded file
        $sizeOfTheImage = $_FILES['image']['size']; 
        $type = $_FILES['image']['type'];//the type of the uploaded file 
        
        $array= explode('.',$nameOfTheImage);//separate the name string to get the extension of the uploaded File 
        $FileExtension = strtolower($array[1]); // get the extension of the uploaded File :)


        // to prevent the error when two users or more uploaded file at the same time with the same name as example 
        //I need to create new name for every file will be uploaded and Must this Name is Unique 
        $FinalNameOfTheImage = rand().time().'.'.$FileExtension;
        
        // Now ,I need to Limit the types of the uploaded Files 
        $limitedExtensions = ['png','jpg']; //note : sometimes , some Files are uploaded with extensions Like As Example:JPG,PNG,PDF .and that will be prevent the files with capital letters to be uploaded. to solve with this problem I will make the extension with lower letters by Built-In function => strtolower() 
        //to check if the uploaded file with the limited Extensions
        if(in_array($FileExtension,$limitedExtensions)){
            // the uploaded file extension is in limitedExtensions :) . Now ,I can uploaded the file and get the file from the temp folder in the server to myuploads folder that I previously created in the server 
            $myDistenationFolder ='./myuploads/';
            $destinationFile = $myDistenationFolder.$FinalNameOfTheImage;
            if(move_uploaded_file($PathOfTemp,$destinationFile)){
                $fileIsUploadedToDesFolder ='File Uploaded';
                
            }else{
                 $errorMessages['image'] = 'error in Upload the file Please try again later !';
            }
            
            
        }else{
              $errorMessages['image'] = 'error Extension Is not allowed !';
        }
         
     }else{
            $errorMessages['image'] = 'error your file is required please uploaded it!';
     }
     
     // Name Validation ...
        if(!empty($name)){
           if(strlen($name) < 3){
              $errorMessages['name'] = "Name Length must be > 2 "; 
             }
        }else{
          $errorMessages['name'] = " your Name is Required!";
        }
     
 
    
     //print the result 
     
     if(count($errorMessages) == 0){
       //form is valid then print the data 
        // echo 'your name is : '.$name.'<br> your email is :'.$email.'<br> your password is:'.$password.'<br> your LinkedIn Account is:'.$AccountOfLinkedIn.'<br>' .$fileIsUploadedToDesFolder.'<br> and your file path is :'.$nameOfTheFile;
        $sql = "INSERT INTO posts(name,content,image) VALUES ('$name','$content','$FinalNameOfTheImage');";
        $op = mysqli_query($conn,$sql);
        if($op){
              echo'Data Inserted';
        }else{
            echo'ERROR In Insert the data ';
        }
     }else{

     // print error messages 
     foreach($errorMessages as $key => $value){

        echo '* '.$key.' : '.$value.'<br>';
     }


    }
}
        
    
                    
  ?>
 <!DOCTYPE html>
 <html lang="en">

     <head>
         <title>register </title>
         <meta charset="utf-8">
         <meta name="viewport" content="width=device-width, initial-scale=1">
         <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
         <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
         <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
     </head>

     <body>

         <div class="container">
             <h2> create post  </h2>
             <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>"
                 enctype="multipart/form-data">

                 <div class="form-group">
                     <label for="exampleInputEmail1">Enter The Post Name</label>
                     <input type="text" name="name" class="form-control" id="exampleInputName" aria-describedby=""
                         placeholder="Enter The post name ">
                 </div>


                 <div class="form-group">
                     <label for="exampleInputEmail1">Enter your Content</label>
                     <input type="text" name="content" class="form-control" id="exampleInputEmail1"
                         placeholder="Enter your content">
                 </div>

                 
                 
                 <div class="form-group">
                     <label for="exampleInputEmail1">Enter An Image of The Post</label>
                     <input type="file" name="image" id=" exampleInputName" aria-describedby="">
                 </div>

                 <button type="submit" class="btn btn-primary">create Post</button>
             </form>
         </div>

     </body>

 </html>
