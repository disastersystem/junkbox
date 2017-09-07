<?php
/**
 * This class contains methods that will take care of validating values like user input from a form.
 * Use it by passing check_values() an array of data to be checked and an an array of rules assign to the values:
 * 	$Validation = new Validation();
 *	$validated = $Validation->check_values($_POST, [
 *		"topic" => ["required" => true],
 *		"entry" => ["required" => true, "max" => 1000]
 *	]);
 * It's also possible to use the functions individually instead of calling check_values.
 */
class Validation
{
	private $db_instance = null;
	private $passed = false;
	private $errors = [];

	public function __construct() {
		# make sure this class can use the database connection
		$this->db_instance = Database::instance();
	}

	/**
	 * Check to see if the rules of the values matches any of the cases in the switch statement.
	 * If so, it calles the individual methods that does the actuall checking. Those methods returns nothing
	 * if everything is okay. If something is wrong, it sets an error.
	 */
	public function check_values($source, $items = [])
	{
		foreach ($items as $item => $rules) {
			foreach ($rules as $rule => $rule_value) {
				# Simple replace of the hyphen with a blank space, to make it look a little better on output.
				$item_name = str_replace('-', ' ', $item);
   				$value = $source[$item];

				if ($rule == "required" && empty($value)) {
					$this->add_error("{$item_name} is required.");
				} else if (!empty($value)) {

					switch ($rule) {
						case "min":
							$this->min_length($value, $rule_value, $item_name);
						break;
						case "max":
							$this->max_length($value, $rule_value, $item_name);
						break;
						case "unique":
							$this->unique($value, $rule_value, $item);
						break;
						case "matches":
							$this->matches($value, $rule_value, $source, $item_name);
						case "email":
							$this->email($value, $item_name);
						break;
					}
				}
			}
		}

		# If there is no errors in the errors array when we're done looping, then the validation passed.
		if (empty($this->errors)) {
			$this->passed = true;
		}

		# return this object so we can chain on methods
		return $this;
	}

	/**
	 * Check if a value contains too few characters.
	 */
	public function min_length($value, $rule_value, $item_name)
	{
		if (strlen($value) < $rule_value) {
			$this->add_error("{$item_name} must be atleast {$rule_value} characters long.");
		}
	}

	/**
	 * Check if a value contains too many characters.
	 */
	public function max_length($value, $rule_value, $item_name)
	{
		if (strlen($value) > $rule_value) {
			$this->add_error("{$item_name} can not be over {$rule_value} characters long.");
		}
	}

	/**
	 * Check if two values matches.
	 */
	public function matches($value, $rule_value, $source, $item_name)
	{
		if ($value != $source[$rule_value]) {
			$this->add_error("{$rule_value} must match {$item_name}.");
		}
	}

	/**
	 * Check if something already exists in the database, like a username for example.
	 */
	public function unique($value, $rule_value, $item)
	{
		$results = $this->db_instance->run_query("SELECT * FROM {$rule_value} WHERE {$item} = ?", [$value]);

		# If we get anything back, the username is already registered.
		if ($results->get_count() > 0) {
			$this->add_error("That email already exists");
		}
	}

	/**
	 * Check if a email is valid.
	 */
	public function email($value, $item_name) {
		if (filter_var($value, FILTER_VALIDATE_EMAIL) === false) {
			$this->add_error("Not a valid {$item_name}.");
		}
	}

	/**
	 * Setters and getters.
	 */
	public function passed() {
		return $this->passed;
	}

	private function add_error($error) {
		$this->errors[] = $error;
	}

	public function get_errors() {
		return $this->errors;
	}

}

?>
