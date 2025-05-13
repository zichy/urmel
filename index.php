<?php

// URIs
$home = "https://{$_SERVER['HTTP_HOST']}";
$self = $_SERVER['PHP_SELF'];
$self = ($self == '/index.php') ? '/' : $self;

// Import classes
require_once('classes/config.php');
$config = new Config();
require_once('classes/sys.php');
$sys = new Sys();
require_once('classes/account.php');
$account = new Account();
require_once('classes/post.php');
$post = new Post();
require_once('classes/l10n.php');

// Set config
$config->set();

// Create post directory
$sys->createDirectory($post->dir);

// Login & Session
session_start();
if (isset($_POST['login'])) {
	$account->login($_POST['username'], $_POST['password']);
	$sys->goto();
} elseif (!$account->loggedin()) {
	$account->deleteSession();
}

// Logout
if (isset($_POST['logout'])) {
	$account->logout();
	$sys->goto();
}

if ($account->loggedin()) {
	// Save post
	if (isset($_POST['save-post']) || isset($_POST['save-draft'])) {
		if (empty($_POST['text'])) {
			die(L10n::$errorPostEmpty);
		}

		$content = new stdClass();

		if (empty($_POST['id'])) {
			$id = time();
		} else {
			if (!$post->exists($_POST['id'])) {
				die(L10n::$errorPostExists);
			}

			$currentId = $_POST['id'];
			$draft = $post->get($currentId, 'draft');
			$id = $draft ? time() : $currentId;

			if ($draft) $post->delete($_POST['id']);
		}

		$content->draft = isset($_POST['save-draft']) ? true : false;
		$content->text = htmlspecialchars($_POST['text']);
		$post->set($id, $content);
		$sys->goto();
	}

	// Delete post
	if (isset($_POST['delete-post'])) {
		$post->delete($_POST['id']);
		$sys->goto();
	}
} elseif (isset($_POST['save-post']) ||
	isset($_POST['save-draft']) ||
	isset($_POST['delete-post']) ||
	isset($_GET['edit'])) {
	die(L10n::$errorHacker);
}

// Get posts
$postCount = isset($_GET['feed']) ? constant('POSTS_PER_FEED') : constant('POSTS_PER_PAGE');
$skipCount = isset($_GET['skip']) ? $_GET['skip'] : 0;
$posts = !$account->loggedin() || isset($_GET['feed']) ? $post->list($postCount, $skipCount) : $post->list($postCount, $skipCount, false);
$totalCount = $post->totalCount();

// Single post
if (isset($_GET['p'])) {
	if (!$post->exists($_GET['p'])) {
		die(L10n::$errorPostNotFound);
	}
	$posts = ["0" => "{$_GET['p']}.json"];
}

// Search
if (!empty($_GET['q'])) {
	$results = $post->search($posts, $_GET['q']);
	$posts = array_intersect($results, $posts);

	if (empty($posts)) die(L10n::$errorNoResults);
}

// Feed
if (isset($_GET['feed'])) {
	if (isset($_GET['p']) ||
		isset($_GET['q']) ||
		isset($_GET['skip']) ||
		isset($_GET['login'])) {
		$sys->goto('?feed');
	}

	$dateFormat = 'Y-m-d\TH:i:sP';
	$lastUpdate = $post->id(reset($posts));
	header('Content-type: text/xml');
	include('templates/feed.php');
	die();
}

// Site header
if (isset($_GET['p'])) {
	$text = $post->get($_GET['p'], 'text');

	if ($text) {
		$text = strip_tags($post->parse($text));
		$text = str_replace(array(":"), ': ', $text);
		$desc = strlen($text) > 200 ? substr($text, 0, 200)."…" : $text;
	}
}
include('templates/header.php');

// Panel
if ($account->loggedin() && !isset($_GET['p']) && !isset($_GET['q'])) {
	if (isset($_GET['edit'])) {
		if (!$post->exists($_GET['edit'])) {
			$sys->goto();
		}
		$id = $_GET['edit'];
	}
	include('templates/panel.php');
}

if (isset($_GET['login'])) {
	// Login
	$account->loggedin() ? $sys->goto() : include('templates/login.php');
} else {
	if (!isset($_GET['edit'])) {
		if (isset($_GET['p']) && empty($_GET['p'])) {
			die(L10n::$errorNoResults);
		}

		// Posts & Drafts
		foreach ($posts as $item) {
			$id = $post->id($item);
			$url = "{$home}{$self}?p={$id}";
			$text = $post->get($id, 'text');
			$draft = $post->get($id, 'draft');

			if ($draft && $account->loggedin()) {
				include('templates/draft.php');
			} elseif(!$draft) {
				include('templates/post.php');
			}
		}

		// Pagination
		$queryURI = isset($_GET['q']) ? '&amp;q='.@urlencode($_GET['q']) : '';
		include('templates/navigation.php');
	}
}

// Site footer
include('templates/footer.php');

?>
