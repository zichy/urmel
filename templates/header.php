<!DOCTYPE html><html lang="en"><head prefix="og: https://ogp.me/ns#">
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?= constant('TITLE') ?></title>
<meta property="og:title" content="<?= constant('TITLE') ?>">
<meta property="og:type" content="<?= isset($_GET['p']) ? 'article' : 'website' ?>">
<?php if (isset($_GET['p'])): ?>
	<meta name="description" content="<?= $desc ?>">
	<meta property="og:description" content="<?= $desc ?>">
	<?php elseif (!empty(constant('DESCRIPTION'))): ?>
	<meta name="description" content="<?= constant('DESCRIPTION') ?>">
	<meta property="og:description" content="<?= constant('DESCRIPTION') ?>">
<?php endif ?>
<meta property="og:url" content="<?= isset($_GET['p']) ? "{$home}{$self}?p={$_GET['p']}" : $home.$self ?>">
<link rel="alternate" type="text/xml" href="/?feed" title="<?= constant('TITLE') ?> <?= L10n::$feed ?>">
<link rel="icon" href="data:image/svg+xml,%3Csvg%20xmlns=%22http://www.w3.org/2000/svg%22%20viewBox=%220%200%20100%20100%22%3E%3Ctext%20y=%221em%22%20font-size=%2285%22%3E<?= constant('EMOJI') ?>%3C/text%3E%3C/svg%3E">
<link href="assets/urmel.css" rel="stylesheet">
</head>
<body itemscope itemtype="https://schema.org/Blog">

<header class="header">
	<div>
		<h1 itemprop="name">
			<?php if (!empty($_GET)): ?>
				<a href="<?= $self ?>"><?= constant('TITLE') ?></a>
			<?php else: ?>
				<?= constant('TITLE') ?>
			<?php endif ?>
		</h1>
		<?php if (!empty(constant('DESCRIPTION'))): ?>
			<p itemprop="description" class="meta"><?= constant('DESCRIPTION') ?>
		<?php endif ?>
	</div>

	<form class="search" action="<?= $self ?>" method="get" role="search">
		<input class="button" type="search" name="q" aria-label="<?= L10n::$search ?>" placeholder="<?= L10n::$search ?>" value="<?= isset($_GET['q']) ? $_GET['q'] : '' ?>" required>
	</form>
</header>

<main>
