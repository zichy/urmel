<article class="box" data-box="draft">
	<div class="block" data-block="text">
		<?php if ($title): ?>
			<?php if ($via): ?>
				<hgroup>
					<h2><a href="<?= $via ?>" aria-describedby="source-<?= $id ?>" rel="external" target="_blank"><?= $title ?></a></h2>
					<p class="meta" id="source-<?= $id ?>"><?= $source ?></p>
				</hgroup>
			<?php else: ?>
				<h2><a href="?p=<?= $id ?>"><?= $title ?></a></h2>
			<?php endif ?>
		<?php endif ?>
		<?php if ($text): ?>
			<div class="text"><?= $post->parse($text) ?></div>
		<?php endif ?>
	</div>
	<footer class="block" data-block="footer">
		<p class="meta row">
			<?php if (!isset($_GET['p'])): ?>
				<a class="permalink" href="?p=<?= $id ?>" title="<?= L10n::$permalink ?>">
			<?php endif ?>
			<time datetime="<?= $sys->date($date, $postDateFormat) ?>"><?= $sys->date($date, $config['dateformat']) ?></time>
			<?php if (!isset($_GET['p'])): ?></a><?php endif ?>
			<strong class="pill"><?= L10n::$draft ?></strong>
		</p>

		<?php if ($account->loggedin()): ?>
			<a class="button" href="?edit=<?= $id ?>"><?= L10n::$edit ?></a>
		<?php endif ?>
	</footer>
</article>
