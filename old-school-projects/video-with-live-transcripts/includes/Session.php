<?php
/**
* The session class contains one simple method.
* This method takes a name and creates a session with that name.
* If a session with that name already exists, it destroys it.
* With this we can "flash" a message to the user: First time it's called it makes the session,
* the second time we can display and destroy that message.
*/
class Session
{
	public static function message($name, $string)
	{
		if (isset($_SESSION[$name])) {
			$session = $_SESSION[$name];
			unset($_SESSION[$name]);
			return $session;
		} else {
			$_SESSION[$name] = $string;
		}
	}

	public static function exists($key) {
		return isset($_SESSION[$key]);
	}

}
