<article class="box" itemprop="blogPost" itemscope itemtype="https://schema.org/BlogPosting" itemid="<?= $url ?>">
	<div class="block" data-block="text">
		<?php if ($title): ?>
			<?php if ($via): ?>
				<hgroup>
					<h2 itemprop="name"><a itemprop="url" href="<?= $via ?>" aria-describedby="source-<?= $id ?>" rel="external" target="_blank"><?= $title ?></a></h2>
					<p class="meta" id="source-<?= $id ?>"><?= $source ?></p>
				</hgroup>
			<?php else: ?>
				<h2 itemprop="name"><a href="?p=<?= $id ?>"><?= $title ?></a></h2>
			<?php endif ?>
		<?php endif ?>
		<?php if ($text): ?>
			<div itemprop="articleBody" class="text"><?= $post->parse($text) ?></div>
		<?php endif ?>
	</div>

	<footer class="block" data-block="footer">
		<p class="meta">
			<?php if (!isset($_GET['p'])): ?>
				<a itemprop="url" class="permalink" href="?p=<?= $id ?>" title="<?= L10n::$permalink ?>">
			<?php endif ?>
			<time itemprop="datePublished" datetime="<?= $sys->date($date, $postDateFormat) ?>"><?= $sys->date($date) ?></time>
			<?php if (!isset($_GET['p'])): ?></a><?php endif ?>
		</p>

		<?php if ($account->loggedin()): ?>
			<a class="button" href="?edit=<?= $id ?>"><?= L10n::$edit ?></a>
		<?php endif ?>
	</footer>
</article>
