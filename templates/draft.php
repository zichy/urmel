<article class="box draft">
	<div class="text"><?= $post->parse($text) ?></div>
	<footer class="box-footer">
		<p class="meta row">
			<?php if (!isset($_GET['p'])): ?>
				<a itemprop="url" class="permalink" href="?p=<?= $id ?>" title="<?= L10n::$permalink ?>">
			<?php endif ?>
			<time itemprop="datePublished" datetime="<?= $sys->date($date, $postDateFormat) ?>"><?= $sys->date($date, constant('DATEFORMAT')) ?></time>
			<?php if (!isset($_GET['p'])): ?></a><?php endif ?>
			<strong><?= L10n::$draft ?></strong>
		</p>

		<?php if ($account->loggedin()): ?>
			<a class="button" href="?edit=<?= $id ?>"><?= L10n::$edit ?></a>
		<?php endif ?>
	</footer>
</article>
