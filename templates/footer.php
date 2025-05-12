</main>

<footer class="footer">
	<div class="text">
		<p class="meta"><?= constant('FOOTERTEXT') ?>
	</div>

	<?php if ($account->loggedin()): ?>
		<div class="row">
			<div class="text">
				<p class="meta"><?= $totalCount ?> / <?= intval(memory_get_usage() / 1024) ?> KB / <?= sys_getloadavg()[0] ?>
			</div>

			<form action="<?= $self ?>" method="post">
				<button class="button" type="submit" name="logout"><?= L10n::$logout ?></button>
			</form>
		</div>
	<?php endif ?>
</footer>

<?php if ($account->loggedin()): ?>
	<script src="assets/urmel.js"></script>
<?php endif ?>

</body></html>
