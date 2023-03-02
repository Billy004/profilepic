<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="main.css">
    <title>Document</title>
</head>
<body>
<?php
include 'db.php';

if(isset($_POST['upload'])) {
	$file_name = $_FILES['profile_pic']['name'];
	$file_size = $_FILES['profile_pic']['size'];
	$file_tmp  = $_FILES['profile_pic']['tmp_name'];
	$file_type = $_FILES['profile_pic']['type'];
	
	$file_ext = strtolower(end(explode('.',$_FILES['profile_pic']['name'])));
	$extensions = array("jpeg","jpg","png");
	
	if(in_array($file_ext,$extensions) === true) {
		
	
        if($file_size < 2097152) {
            
        
	
        $time_stamp = date("d-m-Y-h-m-s");
        $file_name = $time_stamp.$file_name;
        $file_path = "uploads/".$file_name;
	
        if(empty($errors)==true) {
            move_uploaded_file($file_tmp,$file_path);
            echo "Successfully uploaded";
            
                $sql = "INSERT INTO profile_pic (name) VALUES ('".$file_name."')";
                if ($conn->query($sql) === TRUE) {
                    echo "New record created successfully";
                } else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }
            }
        }
    else {
        echo "File size must be less than 2 MB";
    }
	
}
    else {
        echo "Extension not allowed, please choose a JPEG or PNG file.";
        
    }
}
?>
<form action="" method="POST" enctype="multipart/form-data">
	<input type="file" name="profile_pic" />
	<input type="submit" name="upload" value="Upload" />
</form>

<div class='main'>


<?php 
$sql = "SELECT * FROM profile_pic";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "
        
           <div class='profile_pic_container'>

                <img class='pic' src='uploads/".$row['name']."' />

            </div>
        
        ";
    }
} else {
    echo "0 results";
}
?>
</div>
</body>
</html>