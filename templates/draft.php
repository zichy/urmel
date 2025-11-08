<article class="box" data-box="draft">
	<div class="block" data-block="text">
		<div class="text"><?= $post->parse($text) ?></div>
	</div>
	<footer class="block" data-block="footer">
		<p class="meta row">
			<?php if (!isset($_GET['p'])): ?>
				<a itemprop="url" class="permalink" href="?p=<?= $id ?>" title="<?= L10n::$permalink ?>">
			<?php endif ?>
			<time itemprop="datePublished" datetime="<?= $sys->date($date, $postDateFormat) ?>"><?= $sys->date($date, $config['dateformat']) ?></time>
			<?php if (!isset($_GET['p'])): ?></a><?php endif ?>
			<strong class="pill"><?= L10n::$draft ?></strong>
		</p>

		<?php if ($account->loggedin()): ?>
			<a class="button" href="?edit=<?= $id ?>"><?= L10n::$edit ?></a>
		<?php endif ?>
	</footer>
</article>
