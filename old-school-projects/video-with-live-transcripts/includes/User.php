<?php
/**
* This class has methods that concerns the user. Like logging the user in, or updating profile information.
* The results from the queries is assigned to the $user_data property.
*/
class User
{
	private $db_instance = null;
	private $logged_in = false;
	private $user_data;

	/**
	 * Whenever this object is instantiated the constructor determines if there is a logged in user or not.
	 */
	public function __construct($user = null)
	{
		# make sure this class can use the database connection
		$this->db_instance = Database::instance();

		# if no user id has been passed to the constructor
		if (!$user) {
			# If we have a session already set, check if the user is in the database and if so
			# log the user in. Else find the user by the id we gave the constructor.
			if (isset($_SESSION["user"])) {
				$words = explode(",", $_SESSION["user"]);
				$user = $words[0];

				if ($this->find_user_by_id([$user])) {
					$this->logged_in = true;
				}
			} else {
				$this->find_user_by_id([$user]);
			}
		}
	}

	public function login($username = null, $passphrase = null)
	{
		# Did we find a user?
		if ($this->find_user([$username])) {
			# Check if the passphrase provided by the user, matches the hashed passphrase from the database.
			if (password_verify($passphrase, $this->user_data()[0]->passphrase)) {

				# If they do match, the user is authenticated and we can set a session.
				$_SESSION["user"] = $this->user_data()[0]->id;
				return true;
			}
		}

		return false;
	}

	/**
	 * Insert a new user into the users table.
	 */
	public function create_user($user)
	{
		$results = $this->db_instance->run_query(
			"INSERT INTO users (email, passphrase, joined, permissions) VALUES (?, ?, ?, ?)", $user
		);

		if ($results->get_count() > 0) {
			return true;
		}

		return false;
	}

	public function find_user($email)
	{
		$results = $this->db_instance->run_query(
			"SELECT * FROM users WHERE email = ?", $email
		);

		if ($results->get_count() > 0) {
			$this->user_data = $results->get_results();
			return true;
		}

		return false;
	}


	public function find_user_by_id($id)
	{
		$results = $this->db_instance->run_query(
			"SELECT * FROM users WHERE id = ?", $id
		);

		if ($results->get_count() > 0) {
			$this->user_data = $results->get_results();
			return true;
		}

		return false;
	}

	public function find_all_users()
	{
		$results = $this->db_instance->run_query(
			"SELECT id, email, joined FROM users ORDER BY id DESC"
		);

		if ($results->get_count() > 0) {
			$this->user_data = $results->get_results();
			return true;
		}

		return false;
	}

	public function update_info($field, $value)
	{
		$values[0] = $value;
		$values[1] = $this->user_data()[0]->id;

		$results = $this->db_instance->run_query(
			"UPDATE users SET {$field} = ? WHERE id = ?", $values
		);

		if ($results->get_count() > 0) {
			return true;
		}

		return false;
	}

	/**
	 * Checks whether the permission level we give it matches the users level.
	 * We can use this to decide which features the user should have access to.
	 */
	public function has_permission($level)
	{
		if ($level == $this->user_data()[0]->permissions) {
			return true;
		}

		return false;
	}

	public function delete($id)
	{
		$results = $this->db_instance->run_query(
			"DELETE FROM users WHERE id = ?", [$id]
		);

		if ($results->get_count() > 0) { return true; }

		return false;
	}

	/**
	 * Wipe the session to log the user out.
	 */
	public function logout() {
		unset($_SESSION["user"]);
	}

	# Getters.
	public function user_data() {
		return $this->user_data;
	}

	public function logged_in(){
		return $this->logged_in;
	}

}
