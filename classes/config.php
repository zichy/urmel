<?php class Config
{
	public $file = 'config.json';

	public function set() {
		$i = 0;
		foreach ($this->get() as $key => $value) {
			$i++;
			define($this->get('key', $i), $this->get('value', $i));
		}
	}

	private function get($query = false, $count = false) {
		if (file_exists($this->file)) {
			chmod($this->file, 0600);
			$content = file_get_contents($this->file);

			if (json_validate($content)) {
				$config = json_decode($content);
				$configVars = get_object_vars($config);

				if (!$query) {
					return $config;
				} elseif ($query == 'key') {
					return array_keys($configVars)[$count - 1];
				} elseif ($query == 'value') {
					return array_values($configVars)[$count - 1];
				}
			} else {
				die(L10n::$errorConfigInvalid);
			}
		} else {
			die(L10n::$errorConfigMissing);
		}
	}
}
?>
