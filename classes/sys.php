<?php class Sys
{
	public function goto($path = false) {
		header('Location: '.'/'.($path ? $path : ''));
	}

	public function createDirectory($dir)
	{
		if (!(file_exists($dir) && is_dir($dir))) {
			mkdir($dir);
		}
	}

	public function date(\DateTime $time, $pattern = null) {
		$config = include('config.php');

		$formatter = new \IntlDateFormatter(
			$config['language'],
			\IntlDateFormatter::MEDIUM,
			\IntlDateFormatter::MEDIUM,
			$config['timezone']);

		$formatter->setPattern($pattern ? $pattern : $config['dateformat']);

		return $formatter->format($time);
	}
}
?>
