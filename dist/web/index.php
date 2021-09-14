<?php
$target_dir = "./uploads/";

if(isset($_POST["submit"])) {
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $savefile = $target_dir . trim(basename($_FILES["fileToUpload"]["name"]), ".txt") . "-" . date('m-d-Y_hia') . '.txt';
    $fileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    $check = mime_content_type($_FILES["fileToUpload"]["tmp_name"]);
    $uploadOk = 0; 
    
    if($check == 'text/plain' && $fileType == "txt") {
        if (!file_exists($savefile)) {
            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $savefile))  {
                echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";
              } else {
                echo "Sorry, there was an error uploading your file.";
              }
        }else{
            echo "Error: file already exists.";
        }
    } else {
        echo "Error: only txt files allowed";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Listing Page</title>
    </head>
<body>
<a href="/"> HOME </a> &nbsp;|&nbsp; <a href="/view/"> VIEW </a>
<form action="index.php" method="post" enctype="multipart/form-data">
  Select file to upload:
  <input type="file" name="fileToUpload" id="fileToUpload">
  <input type="submit" value="Upload File" name="submit">
</form>

<table>
    <tr>
        <td style="min-width: 200px;">Filename</td><td style="min-width: 200px;">Execute</td>
    </tr>
<?php 
$files = scandir($target_dir);

foreach ($files as $file){
    if ($file == '.' || $file == ".."){
        continue;
    }
    echo '<tr>';
    echo "<td>" . $file . '</td><td><a href="/view/index.php?script=' . urlencode($file) . '">Execute</a></td>'; 
    echo '</tr>';
}
?>
</table>

</body>
</html>