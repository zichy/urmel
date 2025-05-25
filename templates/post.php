<article class="box" itemprop="blogPost" itemscope itemtype="https://schema.org/BlogPosting" itemid="<?= $url ?>">
	<div itemprop="articleBody" class="text"><?= $post->parse($text) ?></div>
	<footer class="box-footer">
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
