<nav class="row">
	<?php if (!($totalCount <= $postCount) && !isset($_GET['p']) && !isset($_GET['q'])): ?>
	<div class="row">
		<?php if ($skipCount > 0): ?>
			<a href="?skip=<?= (@$_GET['skip'] > 0 ? $skipCount - $config['postsPerPage'] : 0).$queryURI ?>" class="button">
				<span aria-hidden="true">&larr;</span><?= L10n::$newer ?>
			</a>
		<?php endif ?>
		<?php if ($skipCount + $config['postsPerPage'] <= $totalCount): ?>
			<a href="?skip=<?= ($skipCount + $config['postsPerPage'] <= $totalCount ? $skipCount + $config['postsPerPage'] : $skipCount).$queryURI ?>" class="button">
				<?= L10n::$older ?><span aria-hidden="true">&rarr;</span>
			</a>
		<?php endif ?>
	</div>
	<?php endif ?>

	<a class="button" href="<?= $self ?>?feed" target="_blank"><?= L10n::$feed ?></a>
</nav>
