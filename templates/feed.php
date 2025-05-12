<?xml version="1.0" encoding="utf-8"?>
<feed xmlns="http://www.w3.org/2005/Atom">
<title><?= constant('TITLE') ?></title>
<?php if (!empty(constant('DESCRIPTION'))): ?>
<subtitle><?= constant('DESCRIPTION') ?></subtitle>
<?php endif ?>
<link href="<?= $home ?>" />
<link href="<?= $home.$self ?>?feed" rel="self"/>
<author>
	<name><?= constant('TITLE') ?></name>
</author>
<updated><?= date($dateFormat, $lastUpdate) ?></updated>
<id><?= $home.$self ?>?feed</id>
<?php foreach ($posts as $postItem) {
	$id = $post->id($postItem);
	$url = "{$home}{$self}?p={$id}";
	$text = $post->get($id, 'text');
	$title = strlen($text) > 60 ? substr($text, 0, 60)."…" : $text; ?>
<entry>
	<title><?= $title ?></title>
	<link href="<?= $url ?>" />
	<content type="html"><![CDATA[<?= $post->parse($text) ?>]]></content>
	<updated><?= date($dateFormat, $id) ?></updated>
	<id><?= $home.'/?p='.$id ?></id>
</entry>
<?php } ?>
</feed>
