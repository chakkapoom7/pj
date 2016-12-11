
<?php
if(move_uploaded_file($_FILES["filUpload"]["tmp_name"],"uploads/".$_FILES["filUpload"]["name"]))
{
	echo "Copy/Upload Complete";
}

?>