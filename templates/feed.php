<?xml version="1.0" encoding="utf-8"?>
<feed xmlns="http://www.w3.org/2005/Atom">
<title><?= $config['title'] ?></title>
<?php if (!empty($config['description'])): ?>
<subtitle><?= $config['description'] ?></subtitle>
<?php endif ?>
<link href="<?= $home ?>" type="text/html" rel="alternate"/>
<link href="<?= $home.$self ?>?feed" type="application/atom+xml" rel="self"/>
<id><?= $home.$self ?>?feed</id>
<author>
	<name><?= $config['title'] ?></name>
</author>
<?php
	$latestPost = $post->id(reset($posts));
	$latestDate = new DateTime();
	$latestDate->setTimestamp($latestPost);
?>
<updated><?= $sys->date($latestDate, $feedDateFormat) ?></updated>
<?php foreach ($posts as $postItem) {
	$id = $post->id($postItem);
	$date = new DateTime();
	$date->setTimestamp($id);
	$url = "{$home}{$self}?p={$id}";
	$text = $post->get($id, 'text');
	$text = $text ? $post->parse($text) : '';
	$titleText = strip_tags($text);
	$title = $post->get($id, 'title');
	$title = $title ? $title : (strlen($titleText) > 60 ? substr($titleText, 0, 60)."…" : $titleText);
	$via = $post->get($id, 'via');
	$source = $via ? parse_url($via)['host'] : ''; ?>
<entry>
	<title><?= $title ?></title>
	<?php if ($via): ?><link href="<?= $via ?>" type="text/html" rel="alternate"/><?php endif ?>
	<link href="<?= $url ?>" type="text/html" rel="<?= $via ? 'related' : 'alternate' ?>"/>
	<?php if ($text): ?><content type="html"><![CDATA[<?= $text ?>]]></content><?php endif ?>
	<updated><?= $sys->date($date, $feedDateFormat) ?></updated>
	<id><?= $home.'/?p='.$id ?></id>
</entry>
<?php } ?>
</feed>
