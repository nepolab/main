<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1251">
</head>
<body><center>
<?php
// put do papkata
$upload_dir = "D:/xampp/htdocs/private/upload/";
//kolko faila da se ka4wat ednovremenno
$num_files = 7;
// razmer
$size_bytes =51200000; //51200 bytes = 50KB.
//vidove pozvoleni failove
$limitedext = array(".gif",".jpg",".jpeg",".png",".txt",".nfo",".doc",".rtf",".pdf",".zip",".rar",".gz",".exe");

if (!is_dir("$upload_dir")) {
die ("Error: The directory <b>($upload_dir)</b> doesn't exist");
}
if (!is_writeable("$upload_dir")){
die ("Error: The directory <b>($upload_dir)</b> is NOT writable, Please CHMOD (777)");
}

if (isset($_POST['upload_form'])){

echo "<h3>Upload results:</h3>";


for ($i = 1; $i <= $num_files; $i++) {


$new_file = $_FILES['file'.$i];
$file_name = $new_file['name'];

$file_name = str_replace(' ', '_', $file_name);
$file_tmp = $new_file['tmp_name'];
$file_size = $new_file['size'];


if (!is_uploaded_file($file_tmp)) {

echo "File $i: Not selected.<br>";
}else{

$ext = strrchr($file_name,'.');
if (!in_array(strtolower($ext),$limitedext)) {
echo "File $i: ($file_name) Wrong file extension. <br>";
}else{

if ($file_size > $size_bytes){
echo "File $i: ($file_name) Faild to upload. File must be <b>". $size_bytes / 1024000 ."</b> MB. <br>";
}else{
if(file_exists($upload_dir.$file_name)){
echo "File $i: ($file_name) already exists.<br>";
}else{

if (move_uploaded_file($file_tmp,$upload_dir.$file_name)) {
echo "File $i: ($file_name) Uploaded.<br>";
}else{
echo "File $i: Faild to upload.<br>";
}#end of (move_uploaded_file).

}#end of (file_exists).

}#end of (file_size).

}#end of (limitedext).

}#end of (!is_uploaded_file).

}#end of (for loop).
# print back button.
echo "»<a href=\"$_SERVER[PHP_SELF]\">Назад</a>";

}else{
echo " <h3>Избери Файл.</h3>
<h4>Позволени файлове > ".gif", ".jpg", ".jpeg", ".png", ".txt", ".nfo", ".doc", ".rtf", ".pdf", ".zip", ".rar", ".gz", ".exe" </h4>
Max file size = ". $size_bytes / 1024000 ." MB";
echo " <form method=\"post\" action=\"$_SERVER[PHP_SELF]\" enctype=\"multipart/form-data\">";

for ($i = 1; $i <= $num_files; $i++) {
echo "File $i: <input type=\"file\" name=\"file". $i ."\"><br>";
}
echo " <input type=\"hidden\" name=\"MAX_FILE_SIZE\" value=\"$size_bytes\">
<input type=\"submit\" name=\"upload_form\" value=\"Качи\">
</form>";
}
?>
</center>

</body>
</html>

