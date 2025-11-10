<form class="box" action="<?= $self ?>" method="post" data-box="panel">
	<div class="block">
		<input class="field" type="text" name="title" id="title" spellcheck="false" aria-label="<?= L10n::$titleLabel ?>" placeholder="<?= L10n::$titlePlaceholder ?>" value="<?= (isset($_GET['edit']) ? $post->get($id, 'title') : '') ?>">
	</div>

	<div class="block">
		<input class="field" type="url" name="via" id="via" aria-label="<?= L10n::$viaLabel ?>" placeholder="<?= L10n::$viaPlaceholder ?>" value="<?= (isset($_GET['edit']) ? $post->get($id, 'via') : '') ?>">
	</div>

	<div class="block">
		<textarea class="field" name="text" id="text" spellcheck="false" rows="8" aria-label="<?= L10n::$textLabel ?>" placeholder="<?= L10n::$textPlaceholder ?>"><?= (isset($_GET['edit']) ? $post->get($id, 'text') : '') ?></textarea>
	</div>

	<div class="block" data-block="footer">
		<?php if (isset($_GET['edit'])): ?>
			<p class="meta row">
				<?php
					$time = '<time datetime="'.$sys->date($date, $postDateFormat).'">'.$sys->date($date, $config['dateformat']).'</time>';
					if (isset($_GET['p'])) {
						echo $time;
					} else { ?>
					<a itemprop="url" class="permalink" href="?p=<?= $id ?>" title="<?= L10n::$permalink ?>"><?= $time ?></a>
				<?php } ?>
				<?php if ($post->get($id, 'draft')): ?>
					<strong class="pill"><?= L10n::$draft ?></strong>
				<?php endif ?>
			</p>
		<?php else: ?>
			<p class="meta">(<a class="permalink" href="https://github.com/zichy/urmel#text-formatting" rel="external" target="_blank"><?= L10n::$textFormatting ?></a>)
		<?php endif ?>

		<div class="row">
			<input type="hidden" name="id" value="<?= (isset($_GET['edit']) ? $id : '') ?>">

			<?php if (isset($_GET['edit'])): ?>
				<button class="button delete" type="submit" name="delete-post" data-warning="<?= L10n::$deleteWarning ?>"><?= L10n::$delete ?></button>
			<?php endif ?>

			<button class="button" type="submit" name="save-draft"><?= L10n::$saveDraft ?></button>
			<button class="button" type="submit" name="save-post"><?= L10n::$publish ?></button>
		</div>
	</div>
</form>
