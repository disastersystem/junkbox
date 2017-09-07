<?php
/**
 * Handles moving the uploaded files and such.
 */
class UploadHandler
{
    const MEDIA_FOLDER = "../../uploads/posts/";
    private $src;

    public function saveMedia()
    {
        if (isset($_FILES)) {
            # first determine which file type was uploaded
            if ($_FILES["camera"]["size"][0] != 0) {
                $uploaded_file = $_FILES['camera'];
                # get the first five characters of the type property
                $type = substr($_FILES["camera"]["type"][0], 0, 5);
            }

            if (isset($_FILES["video"]) && $_FILES["video"]["size"][0] != 0) {
                $uploaded_file = $_FILES['video'];
                # get the first five characters of the type property
                $type = substr($_FILES["video"]["type"][0], 0, 5);
            }

            if ($_FILES["media"]["size"][0] != 0) {
                $uploaded_file = $_FILES['media'];
                # get the first five characters of the type property
                $type = substr($_FILES["media"]["type"][0], 0, 5);
            }

            $files = $this->reArrangeArray($uploaded_file);

            foreach ($files as $file)
            {
                $split_name = explode(".", $file['name']);
                $ext = strtolower(end($split_name));
                $uniq_name = uniqid('', true) . "." . $ext;

                $target_file = self::MEDIA_FOLDER . $uniq_name;

                # move the uploaded file from the temporary location to one we specify
                if (move_uploaded_file($file['tmp_name'], $target_file)) {
                    # save the file name for use later
                    $this->src = $uniq_name;

                    # crop the file if it's an image
                    if ($type == "image") {
                        # params: file to make thumb of, destination
                        $this->makeThumb($target_file, self::MEDIA_FOLDER . "thumb_" . $uniq_name, $ext);
                    }
                    return true;
                } else {
                    return false;
                }
            }
        }
    }


    /**
     * Rearranges the structure of the $_FILES array,
     * into a better more logical structure.
     */
    private function reArrangeArray(&$file_post)
    {
    	$file_array = [];
    	$file_count = count($file_post['name']);
    	$file_keys = array_keys($file_post);

    	for ($i = 0; $i < $file_count; $i++) {
    		foreach ($file_keys as $key) {
    			$file_array[$i][$key] = $file_post[$key][$i];
    		}
    	}

    	return $file_array;
    }

    /**
     * Crop a square image thumbnail with the GD library.
     */
    public function makeThumb($imageFile, $dest, $ext)
    {
        # getting the image dimensions
        list($width, $height) = getimagesize($imageFile);

        # saving the image into memory (for manipulation with GD Library)
        switch($ext) {
            case 'jpg': $myImage = imagecreatefromjpeg($imageFile); break;
            case 'jpeg': $myImage = imagecreatefromjpeg($imageFile); break;
            case 'png': $myImage = imagecreatefrompng($imageFile); break;
            case 'gif': $myImage = imagecreatefromgif($imageFile); break;
        }

        # calculating the part of the image to use for thumbnail
        if ($width > $height) {
            $y = 0;
            $x = ($width - $height) / 2;
            $smallestSide = $height;
        } else {
            $x = 0;
            $y = ($height - $width) / 2;
            $smallestSide = $width;
        }

        # copying the part into thumbnail
        $thumbSize = 250;
        $thumb = imagecreatetruecolor($thumbSize, $thumbSize);

        # prevent black background on pngs and gifs
        switch ($ext) {
            case "png":
                $background = imagecolorallocate($thumb, 0, 0, 0);
                imagecolortransparent($thumb, $background);
                imagealphablending($thumb, false);
                imagesavealpha($thumb, true);

            break;
            case "gif":
                $background = imagecolorallocate($thumb, 0, 0, 0);
                imagecolortransparent($thumb, $background);
            break;
        }

        imagecopyresampled($thumb, $myImage, 0, 0, $x, $y, $thumbSize, $thumbSize, $smallestSide, $smallestSide);

        # final output
        switch($ext) {
            case 'jpg': imagejpeg($thumb, $dest, 100); break;
            case 'jpeg': imagejpeg($thumb, $dest, 100); break;
            case 'png': imagepng($thumb, $dest); break;
            case 'gif': imagegif($thumb, $dest); break;
        }
    }


    /**
     * Getters.
     */
     public function getSrc() {
         return $this->src;
     }


} # End of UplaodHandler class
