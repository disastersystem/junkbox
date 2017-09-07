<?php
/**
 * Handles moving uploaded files and such.
 */
class Upload
{
    const MEDIA_FOLDER = "../videos/";

    private $db_instance = null;
    private $src;
    private $ext;
    private $user_id;
    private $inserted_video_id;

    public function __construct() {
        # make sure this class can use the database connection
        $this->db_instance = Database::instance();
    }

    private function allowed_formats($allowed, $ext) {
        # check the file extension against the allowed file extensions
        if(!in_array(strtolower($ext), $allowed)) {
            echo '{"error":"File format not allowed. Supported formats: ' . array_to_string($allowed) . '"}';
            exit;
        }
    }

    public function get_user_folder() {
        $user = new User;
        $user->user_data()[0]->id;
        $user_folder = self::MEDIA_FOLDER . $user->user_data()[0]->id;

        # create a user directory if the user hasn't uploaded before
        if (!file_exists($user_folder)) {
            mkdir($user_folder, 0777);
        }

        return $user_folder;
    }

    /**
     * Get all the neccessary info for saving the video in the db.
     * Save it and get the video auto increment id back from the db.
     * Use video id and the user id to put the video in this folder structure:
     * videos/user_id/video_id/video_name.extension
     */
    public function upload_video($files)
    {
        if (isset($files)) {
            $orignal_name = pathinfo($files['name'], PATHINFO_FILENAME);
            $this->ext = pathinfo($files['name'], PATHINFO_EXTENSION);
            $this->src = uniqid('', true); # generate a unique name for the file, in order to avoid files overriding
            $User = new User;
            $this->user_id = $User->user_data()[0]->id;

            $this->allowed_formats(['webm', 'mp4', 'ogv'], $this->ext);

            if ($this->insert_video($orignal_name)) {
                $user_folder = $this->get_user_folder();

                $video_folder = self::MEDIA_FOLDER . $user_folder . "/" . $this->inserted_video_id;

                if (mkdir($video_folder, 0777)) {
                    # move the uploaded file from the temporary location to one we specify
                    if (move_uploaded_file($files['tmp_name'], $video_folder . "/" . $this->src . '.' . $this->ext)) {
                        return true;
                    } else {
                        return false;
                    }
                }
            }

        }
    }

    private function insert_video($orignal_name) {
        $results = $this->db_instance->run_query(
			"INSERT INTO videos (src, type, title, user_id, uploaded) VALUES (?, ?, ?, ?, ?)",
            [$this->src, $this->ext, $orignal_name, $this->user_id, date("Y-m-d")]
		);

		if ($results->get_count() > 0) {
            $this->inserted_video_id = $results->get_last_inserted_id();
            return true;
        }

		return false;
    }

    public function add_transcript($files, $vid_id, $transcript_lang)
    {
        if (isset($files)) {
            $this->ext = pathinfo($files['name'], PATHINFO_EXTENSION);
            $this->src = uniqid('', true); # generate a unique name for the file, in order to avoid files overriding

            $this->allowed_formats(['vtt'], $this->ext);

            $video = new Video;
            $video = $video->get_video_by_id($vid_id);

            if ($this->insert_transcript($video[0]->id, $transcript_lang)) {

                $video_folder = self::MEDIA_FOLDER . $video[0]->user_id . "/" . $video[0]->id;

                # move the uploaded file from the temporary location to one we specify
                if (move_uploaded_file($files['tmp_name'], $video_folder . "/" . $this->src . '.' . $this->ext)) {
                    return true;
                } else {
                    return false;
                }
            }
        }
    }

    private function insert_transcript($video_id, $transcript_lang) {
        $results = $this->db_instance->run_query(
			"INSERT INTO transcripts (video_id, src, srclang, type) VALUES (?, ?, ?, ?)",
            [$video_id, $this->src, $transcript_lang, $this->ext]
		);

		if ($results->get_count() > 0) {
            return true;
        }

		return false;
    }


    /**
     * Getters.
     */
     public function getSrc() {
         return $this->src;
     }

     public function getExt() {
         return $this->ext;
     }


}
