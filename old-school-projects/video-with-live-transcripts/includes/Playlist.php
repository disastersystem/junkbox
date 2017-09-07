<?php
/**
 * Handles anything playlist related.
 */
class Playlist
{
    private $db_instance = null;
    private $data;

    public function __construct() {
        # make sure this class can use the database connection
        $this->db_instance = Database::instance();
    }

    public function create_playlist($title, $desc, $user_id) {
        $results = $this->db_instance->run_query(
			"INSERT INTO playlists (title, description, user_id) VALUES (?, ?, ?)",
            [$title, $desc, $user_id]
		);
        $this->data = $results->get_results();

		if ($results->get_count() > 0) {
			return true;
		}

		return false;
    }

    public function update($values) {
		$results = $this->db_instance->run_query(
			"UPDATE playlists SET title = ?, description = ? WHERE id = ?", $values
		);

		if ($results->get_count() > 0)
			return true;

		return false;
    }

    /**
     * Updates the order of all videos in the playlist.
     */
    public function change_sort_order($playlist_id, $new_position, $old_position) {
        $results = $this->db_instance->run_query(
            "UPDATE playlist_videos
            SET sort_order = CASE sort_order
                WHEN ? THEN ?
                ELSE sort_order + SIGN(? - ?)
            END
            WHERE playlist_id = ? AND
            sort_order BETWEEN LEAST(?, ?)
            AND GREATEST(?, ?)",
            [$old_position, $new_position, $old_position,
            $new_position, $playlist_id, $new_position,
            $old_position, $new_position, $old_position]
        );
    }

    public function add_to_playlist($playlist_id, $video_id) {
        # select all the videos for the playlist so we can figure our which order number
        # to give the new row
        $r = $this->db_instance->run_query(
            "SELECT * FROM playlist_videos WHERE playlist_id = ?",
            [$playlist_id]
        );
        # assign the order number, number of results from the select query + 1
        $order = $r->get_count() + 1;

        $results = $this->db_instance->run_query(
            "INSERT INTO playlist_videos (playlist_id, video_id, sort_order) VALUES (?, ?, ?)",
            [$playlist_id, $video_id, $order]
        );

        $this->data = $results->get_results();

        if ($results->get_count() > 0) return true;

        return false;
    }

    public function user_owns_playlist($user_id, $playlist_id) {
        $results = $this->db_instance->run_query(
            "SELECT * FROM playlists WHERE user_id = ? AND id = ?",
            [$user_id, $playlist_id]
        );

        $this->data = $results->get_results();

        if ($results->get_count() > 0)
            return true;

        return false;
    }

    public function remove_from_playlist($playlist_id, $video_id) {
        $results = $this->db_instance->run_query(
            "DELETE FROM playlist_videos WHERE playlist_id = ? AND video_id = ?",
            [$playlist_id, $video_id]
        );

        $this->data = $results->get_results();

        if ($results->get_count() > 0)
            return true;

        return false;
    }

    public function get_users_playlists($user_id) {
        $results = $this->db_instance->run_query(
			"SELECT * FROM playlists WHERE user_id = ? ORDER BY id DESC",
            [$user_id]
		);

		if ($results->get_count() > 0) {
			$this->data = $results->get_results();
			return true;
		}

		return false;
    }

    public function get_playlist_videos($playlist_id) {
        $results = $this->db_instance->run_query(
            "SELECT *
            FROM playlist_videos AS pv
            JOIN videos AS v
            ON v.id = pv.video_id
            WHERE pv.playlist_id = ?
            ORDER BY sort_order",
            [$playlist_id]
        );

        $this->data = $results->get_results();

        if ($results->get_count() > 0) {
            return true;
        }

        return false;
    }

    public function get_playlist_by_id($id) {
        $results = $this->db_instance->run_query(
			"SELECT * FROM playlists WHERE id = ?", [$id]
		);

        $this->data = $results->get_results();

		if ($results->get_count() > 0) {
			return true;
		}

		return false;
    }

    public function get_all_playlists() {
        $results = $this->db_instance->run_query(
			"SELECT * FROM videos"
		);

		if ($results->get_count() > 0) {
			$this->data = $results->get_results();
			return true;
		}

		return false;
    }

    /**
     * Getters.
     */
     public function get_data() {
         return $this->data;
     }
}
