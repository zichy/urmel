<form class="box panel" action="<?= $self ?>" method="post">
	<input type="hidden" name="id" value="<?= (isset($_GET['edit']) ? $id : '') ?>">

	<div class="field">
		<textarea name="text" id="text" spellcheck="false" rows="8" required autofocus aria-label="<?= L10n::$newPost ?>" placeholder="<?= L10n::$placeholder ?>"><?= (isset($_GET['edit']) ? $post->get($id, 'text') : '') ?></textarea>
	</div>

	<div class="box-footer">
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
					<strong><?= L10n::$draft ?></strong>
				<?php endif ?>
			</p>
		<?php endif?>

		<div class="row">
			<input type="hidden" name="id" value="<?= (isset($_GET['edit']) ? $id : '') ?>">

			<?php if (!isset($_GET['edit'])): ?>
				<button class="button" type="submit" name="logout" formnovalidate><?= L10n::$logout ?></button>
			<?php else: ?>
				<button class="button delete" type="submit" name="delete-post" data-warning="<?= L10n::$deleteWarning ?>"><?= L10n::$delete ?></button>
			<?php endif ?>

			<button class="button" type="submit" name="save-draft"><?= L10n::$saveDraft ?></button>
			<button class="button" type="submit" name="save-post"><?= L10n::$publish ?></button>
		</div>
	</div>
</form>
