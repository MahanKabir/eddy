<?php

namespace Mahan\Eddy\Http\Services;

class VideoService
{

    public function upload(){
        $target_dir = "../public/storage/videos/";

        $target_file = $target_dir . basename($_FILES["video"]["name"]);
        $uploadOk = 1;
        $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

        // Check if file already exists
        if (file_exists($target_file)) {
            echo "Sorry, file already exists.";
            $uploadOk = 0;
        }

        // Check file size -- Kept for 500Mb
        if ($_FILES["video"]["size"] > 500000000) {
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }

        // Allow certain file formats
        if($imageFileType != "wmv" && $imageFileType != "mp4" && $imageFileType != "avi" && $imageFileType != "MP4") {
            echo "Sorry, only wmv, mp4 & avi files are allowed.";
            $uploadOk = 0;
        }

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
            // if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($_FILES["video"]["tmp_name"], $target_file)) {
                echo "The file ". basename( $_FILES["video"]["name"]). " has been uploaded.";
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
    }
}