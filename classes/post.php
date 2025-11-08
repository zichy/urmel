<?php class Post
{
	public $dir = 'posts/';

	public function set(int $id, $content) {
		$file = "{$this->dir}{$id}.json";
		file_put_contents($file, json_encode($content));
		chmod($file, 0600);
	}

	public function get(int $id, $value = false) {
		if (isset($id)) {
			if (!str_ends_with($id, '.json')) {
				$id = "{$id}.json";
			}
			$file = $this->dir.$id;

			if (file_exists($file)) {
				if (!$value) {
					return file_get_contents($file);
				} else {
					return json_decode(file_get_contents($file))->$value;
				}
			}
		}
	}

	public function id($name) {
		if (str_ends_with($name, '.json')) {
			$id = substr($name, 0, -5);
		}

		return $id;
	}

	public function exists($id) {
		return file_exists("{$this->dir}{$id}.json");
	}

	public function delete(int $id) {
		$file = "{$this->dir}{$id}.json";

		if ($this->exists($id)) {
			unlink($file);
		}
	}

	public function list(int $count, int $skip, $drafts = false) {
		$files = new DirectoryIterator($this->dir);
		$list = array();

		foreach ($files as $file) {
			if ($file->isFile()) {
				$name = $file->getFilename();

				if (str_ends_with($name, '.json')) {
					if (!$drafts) {
						$id = $this->id($name);
						$isDraft = $this->get($id, 'draft');
						if (!$isDraft) $list[] = $name;
					} else {
						$list[] = $name;
					}
				};
			}
		}

		asort($list);
		$list = array_reverse($list);
		$list = @array_slice($list, $skip, $count);
		return $list;
	}

	public function totalCount($drafts = false) {
		$files = new DirectoryIterator($this->dir);
		$count = 0;

		foreach ($files as $file) {
			if ($file->isFile()) {
				$name = $file->getFilename();

				if (str_ends_with($file, '.json')) {
					if (!$drafts) {
						$id = $this->id($name);
						$isDraft = $this->get($id, 'draft');
						if (!$isDraft) $count++;
					} else {
						$count++;
					}
				}
			}
		}

		return $count;
	}

	public function search($posts, $queries) {
		$queries = explode(' ', $queries);

		foreach ($queries as $query) {
			$query = strtolower($query);
			$results = array();

			foreach ($posts as $item) {
				$id = $this->id($item);
				$text = strtolower($this->get($id, 'text'));

				if (str_contains($text, $query)) {
					$results[] = $item;
				}
			}
		}

		return $results;
	}

	public function parse($t) {
		$t = preg_replace('/(\*\*|__)(.*?)\1/', '<strong>\2</strong>', $t);
		$t = preg_replace('/(\*|_)(.*?)\1/', '<em>\2</em>', $t);
		$t = preg_replace('/\~\~(.*?)\~\~/', '<del>\1</del>', $t);
		$t = preg_replace('/\@(.*?)\@/', '<code>\1</code>', $t);
		$t = preg_replace('/\[([^\[]+)\]\(([^\)]+)\)/', '<a href=\'\2\' rel=\'external\' target=\'_blank\'>\1</a>', $t);
		$t = preg_replace('/\[(.*?)\]/', '<a href=\'\1\' rel=\'external\'>\1</a>', $t);
		$t = '<p>'.$t.'</p>';
		$t = str_replace("\r\n\r\n", "</p><p>", $t);
		$t = str_replace("\n\n", "</p><p>", $t);
		$t = str_replace("\r\n", "<br>", $t);
		$t = str_replace("\n", "<br>", $t);
		$t = preg_replace('/<p>&gt;(.*?)<\/p>/', '<blockquote><p>\1</p></blockquote>', $t);

		return $t;
	}
}
?>
