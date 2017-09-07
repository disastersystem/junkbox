<?php
	session_start();
	include('../../db/db.php');							// Call database.
	
	$fileName = @$_FILES['file']['name'];		// Name of the file.type.
	$fileSize = @$_FILES['file']['size'];		// Size of the file (int).
	$fileType = @$_FILES['file']['type'];		// Type of the file (image/png).
	$fileError = @$_FILES['file']['error'];		// Type of the file (image/png).
	
	if(! $fileError) 							// Check if the file is 
		$tempName = $_FILES['file']['tmp_name'];	// Temporarily storing on server.
	else
		die("The Image size cannot exceed 2 Mb");
	
												
	switch($_POST["option"]){					// Sets parameter depends on the "option":
		case "profilePicture": 		$path = "img/"; 	break;
		case "newPictureInFolder":  $path = "../gallery/pictures/";	
									$private = (isset($_POST["private"]))? 1 : 0;
									break;
	}
		
	$validExt 
	= array('.jpg', '.jpeg', '.png', '.gif');	// Valid extensions.
	
	$fileExt = strrchr($fileName, '.');			// Get file extension of the current file.
	$fileExt = strtolower($fileExt);
	
	
	// If name already exist in the folder, add a number. in the future.
	
	if( isset($fileName)) 							// The user has uploaded a file:
	{	
		if (in_array($fileExt, $validExt)) 			// The file is a image.
		{
			if($_POST["option"] == "profilePicture"){
				$croppedImage = cropImage($tempName, $fileExt, $fileName);	// Crop image.
			
				switch( $fileExt )
				{
					case '.jpg':  imagejpeg($croppedImage, $path.$fileName, 100);   break; // The current file is a JPG extension.
					case '.jpeg':  imagejpeg($croppedImage, $path.$fileName, 100);   break; // The current file is a JPEG extension.
					case '.png':  imagepng($croppedImage, $path.$fileName, 0); 	 break; // The current file is a PNG extension.
					case '.gif':  imagegif($croppedImage, $path.$fileName);		 break; // The current file is a GIF extension.
				}
			}elseif($_POST["option"] == "newPictureInFolder"){
				move_uploaded_file($tempName,$path.$fileName);
			}
			
			
					// Database Update/Insert:
			switch($_POST["option"]){			// Set nr of Mb.
				case "profilePicture": 		
					$query = "UPDATE user SET profileImg = ? WHERE username = ?";
					$sth = $db->prepare($query);
					if(!$sth->execute(array( $fileName, $_SESSION['username'])))
						echo "ERROR pushing the picture to the DB.."; 
					break;
				case "newPictureInFolder": 			// Insert the new picture into the DB:
					$sql = "INSERT INTO photos(photoOwner, folderID, photoTitle, photoDesc, photoSRC, photoPrivate)
							VALUES(?,?,?,?,?,?)";
					$sth = $db->prepare($sql);
					if(!$sth->execute(array($_SESSION['username'], $_SESSION["folderID"], $_POST["pictureTitle"], $_POST["pictureDesc"], $fileName, $private)))
						echo "ERROR pushing the picture to the DB...";
					break;
			}
				
			echo @$_SESSION["folderID"]."%".$fileName; 		// Returns "folderID%fileName" so the Javascript can handle this.
		}
		else
			echo "The file must be a image (jpg, png or gif)";
	}
	else
		echo "Error on uploading";	
	

function cropImage( $imageFile, $fileExt, $fileName )
{
	$imageProps = getimagesize( $imageFile );
	
	$imageW = $imageProps[0];
	$imageH = $imageProps[1];
	
	switch( $fileExt )
	{
		case '.jpg':  $oldImage = imagecreatefromjpeg( $imageFile );  break; // The current file is a JPG extension.
		case '.jpeg':  $oldImage = imagecreatefromjpeg( $imageFile );  break; // The current file is a JPEG extension.
		case '.png':  $oldImage = imagecreatefrompng(  $imageFile );  break; // The current file is a PNG extension.
		case '.gif':  $oldImage = imagecreatefromgif(  $imageFile );  break; // The current file is a GIF extension.
	}
	
	$newImage = imagecreatetruecolor(150,150); 			// Create a new image as the new profile image.
	
	$cropH = 0;
	$cropW = 0;
	
	
	if($imageW > $imageH)         						// The original image has an aspect greater than 1.
	{
		$cropW = ($imageW - $imageH) / 2;
		$cropH = 0;
		$imageW = $imageH;
	}
	else 						// The original image has an aspect less than 1.
	{
		$cropW = 0;
		$cropH = ($imageH - $imageW) /2;
		$imageH = $imageW;
	} 
	
	
	imagecopyresampled($newImage, $oldImage, 0, 0, $cropW, $cropH,  150, 150, $imageW, $imageH);

	return $newImage;
}
