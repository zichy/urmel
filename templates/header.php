<!DOCTYPE html><html lang="<?= $config['language'] ?>"><head prefix="og: https://ogp.me/ns#">
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?= $config['title'] ?></title>
<meta property="og:title" content="<?= $config['title'] ?>">
<meta property="og:type" content="<?= isset($_GET['p']) ? 'article' : 'website' ?>">
<?php if (isset($_GET['p'])): ?>
	<meta name="description" content="<?= $desc ?>">
	<meta property="og:description" content="<?= $desc ?>">
<?php elseif (!empty($config['description'])): ?>
	<meta name="description" content="<?= $config['description'] ?>">
	<meta property="og:description" content="<?= $config['description'] ?>">
<?php endif ?>
<meta property="og:url" content="<?= isset($_GET['p']) ? "{$home}{$self}?p={$_GET['p']}" : $home.$self ?>">
<link rel="alternate" type="text/xml" href="/?feed" title="<?= $config['title'] ?> <?= L10n::$feed ?>">
<link rel="icon" href="data:image/svg+xml,%3Csvg%20xmlns=%22http://www.w3.org/2000/svg%22%20viewBox=%220%200%20100%20100%22%3E%3Ctext%20y=%221em%22%20font-size=%2285%22%3E<?= $config['emoji'] ?>%3C/text%3E%3C/svg%3E">
<link href="assets/style.css" rel="stylesheet">
<?php if (!empty($config['customCSS'])): ?>
	<style><?= $config['customCSS'] ?></style>
<?php endif ?>
</head>
<body itemscope itemtype="https://schema.org/Blog">

<header class="header">
	<div class="name">
		<h1 itemprop="name">
			<?php if (!empty($_GET)): ?>
				<a href="<?= $self ?>"><?= $config['title'] ?></a>
			<?php else: ?>
				<?= $config['title'] ?>
			<?php endif ?>
		</h1>
		<?php if (!empty($config['description'])): ?>
			<p itemprop="description" class="meta"><?= $config['description'] ?>
		<?php endif ?>
	</div>

	<form class="search" action="<?= $self ?>" method="get" role="search">
		<input class="input" type="search" name="q" aria-label="<?= L10n::$search ?>" placeholder="<?= L10n::$search ?>" value="<?= isset($_GET['q']) ? $_GET['q'] : '' ?>" required>
	</form>
</header>

<main>

<?php if (!empty($_GET['q'])): ?>
	<p class="meta"><?= L10n::$searchText ?> <mark><?= $_GET['q'] ?></mark>: <?= count($posts).' '.ngettext(L10n::$postSingular, L10n::$postPlural, count($posts)) ?></p>
<?php endif ?>