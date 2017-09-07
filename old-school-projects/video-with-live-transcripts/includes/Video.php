<?php
/**
 * Handles anything video related.
 */
class Video
{
    private $db_instance = null;
    private $data;

    public function __construct() {
        # make sure this class can use the database connection
        $this->db_instance = Database::instance();
    }

    public function get_users_videos($user_id) {
        $results = $this->db_instance->run_query(
			"SELECT * FROM videos WHERE user_id = ? ORDER BY id DESC",
            [$user_id]
		);

		if ($results->get_count() > 0) {
			$this->data = $results->get_results();
			return true;
		}

		return false;
    }

    public function get_video_transcripts($video_id) {
        $results = $this->db_instance->run_query(
            "SELECT * FROM transcripts WHERE video_id = ?",
            [$video_id]
        );

        $this->data = $results->get_results();

        if ($results->get_count() > 0) {
            return true;
        }

        return false;
    }

    public function get_video_by_id($id) {
        $results = $this->db_instance->run_query(
			"SELECT * FROM videos WHERE id = ?", [$id]
		);

        return $results->get_results();
    }

    public function get_all_videos() {
        $results = $this->db_instance->run_query(
			"SELECT * FROM videos ORDER BY id DESC"
		);

		if ($results->get_count() > 0) {
			$this->data = $results->get_results();
			return true;
		}

		return false;
    }

    public function video_url() {
        return 'videos/' . $video[0]->user_id . '/' . $video[0]->src . '/' . $video[0]->src . '.' . $video[0]->type;
    }

    /**
     * Getters.
     */
     public function get_data() {
         return $this->data;
     }
}
