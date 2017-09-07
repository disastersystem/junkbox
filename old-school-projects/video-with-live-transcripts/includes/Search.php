<?php

/**
 * Containes methods with queries that searches different tables
 * based on a search term.
 */
class Search
{
    private $db_instance = null;
    private $search_data;
    private $search_term;

    public function __construct($search_term) {
        # make sure this class can use the database connection
        $this->db_instance = Database::instance();
        $this->search_term = $search_term;
    }

    # find all videos matching search term
    public function search_videos() {
        $this->search_data = $this->db_instance->run_query(
    		"SELECT *
    		FROM videos
    		WHERE title LIKE ?",
    		[$this->search_term]
    	)->get_results();
    }

    # find all playlists matching search term
    public function search_playlists() {
        $this->search_data = $this->db_instance->run_query(
    		"SELECT *
    		FROM playlists
    		WHERE description LIKE ? OR title LIKE ?",
    		[$this->search_term, $this->search_term]
    	)->get_results();
    }


    /**
     * getter
     */
    public function search_data() {
        return $this->search_data;
    }

} # end of class
