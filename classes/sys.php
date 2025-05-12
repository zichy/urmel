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
}
?>
