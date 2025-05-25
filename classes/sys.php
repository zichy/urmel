<?php class Sys
{
	public function goto($path = false) {
		global $self;
		header('Location: '.$self.($path ? $path : ''));
	}

	public function createDirectory($dir)
	{
		if (!(file_exists($dir) && is_dir($dir))) {
			mkdir($dir);
		}
	}

	public function date(\DateTime $time, $pattern = null) {
		$formatter = new \IntlDateFormatter(
			constant('LANGUAGE'),
			\IntlDateFormatter::MEDIUM,
			\IntlDateFormatter::MEDIUM,
			constant('TIMEZONE'));

		$formatter->setPattern($pattern ? $pattern : constant('DATEFORMAT'));

		return $formatter->format($time);
	}
}
?>
