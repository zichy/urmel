<?php class Account
{
	private $cookie = '_cookie';

	public function login($username, $password) {
		$config = include('config.php');

		if (hash_equals($config['username'], $username) &&
			hash_equals($config['password'], $password)) {
			$_SESSION['urmel'] = true;
			$this->createCookie();
		} else {
			die(L10n::$errorLogin);
		}
	}

	public function loggedin() {
		if (isset($_SESSION['urmel']) &&
			$_SESSION['urmel'] === true &&
			isset($_COOKIE['urmel']) &&
			$_COOKIE['urmel'] === $this->getCookie()) {
			return true;
		}
	}

	public function logout() {
		session_destroy();
		$this->deleteCookie();
	}

	private function createCookie() {
		$path = $this->cookie;
		$identifier = bin2hex(random_bytes(64));
		file_put_contents($path, $identifier);
		chmod($path, 0600);
		setcookie('urmel', $identifier, time() + (3600 * 24 * 30));
	}

	private function deleteCookie() {
		$path = $this->cookie;
		unlink($path);
		setcookie('urmel', '', time() - (3600 * 24 * 30));
	}

	private function getCookie() {
		$path = $this->cookie;
		return file_exists($path) ? file_get_contents($path) : false;
	}

	public function deleteSession() {
		setcookie(session_name(), '', time() - 3600);
		session_destroy();
		session_write_close();
	}
}
?>
