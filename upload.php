<?php
$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
 //  echo("Target file: " . $target_file . "<br>");
  setcookie("chat_path", $target_file, time()+3600);
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
  $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
  if($check !== false) {
    // echo "File is an image - " . $check["mime"] . ".";
    $uploadOk = 1;
  } else {
    // echo "File is not an image.";
    $uploadOk = 0;
  }
}

// Check if file already exists
if (file_exists($target_file)) {
  // echo "Sorry, file already exists.";
  $uploadOk = 0;
}

// Check file size
if ($_FILES["fileToUpload"]["size"] > 50000000000000000000000000) {
  // echo "Sorry, your file is too large.";
  $uploadOk = 0;
}

// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
  // echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
  $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
  // echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
  if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
    // echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";
  } else {
    // echo "Sorry, there was an error uploading your file.";
  }
}
?>
<html>
<head>
  <script>
    var getCookie = function(cname){
  var name = cname + "=";
  var decodedCookie = decodeURIComponent(document.cookie);
  var ca = decodedCookie.split(';');
  for(var i = 0; i < ca.length; i++){
  var c = ca[i]
  while (c.charAt(0) == ' '){
  c = c.substring(1);
  }
  if (c.indexOf(name) == 0){
  return decodeURI(c.substring(name.length, c.length));
  }
  }
  return "";
  }
</script>
<center><img src="loadcat.gif"><br><p>Your file is being uploaded. Please wait</p></center>
<script>
  function sendMSG(m) {
u = getCookie("u");
col = getCookie("c");
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
       // console.log("message sent");
       // console.log("ANTI-LOUIS TIPS\n===========\nAlways make your password different for every site\nDon't open ports for FTP or OpenSSH\n\nThank you for finding this neat little easter egg. Stay safe.");
    }
  };
  xhttp.open("POST", "sender.php", true);
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhttp.send("m=" + encodeURIComponent(m) + "&u=" + encodeURIComponent(u) + "&col=" + encodeURIComponent(col));
   setTimeout(function () {
   window.history.back();
    }, 654);
  // reload chat
  // setTimeout(function(){ reloadChat() }, 100);
}
</script>
<script>
  path = getCookie("chat_path");
  sendMSG("[upload]" + path + "[/upload]");
</script>
