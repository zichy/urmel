</main>

<footer class="footer">
	<div class="text">
		<p class="meta"><?= $config['footerText'] ?>

		<?php if ($account->loggedin()): ?>
			<p class="meta"><?= $totalCount ?> / <?= intval(memory_get_usage() / 1024) ?> KB / <?= sys_getloadavg()[0] ?>
		<?php endif ?>
	</div>
</footer>

<?php if ($account->loggedin()): ?>
	<script src="assets/script.js"></script>
<?php endif ?>

</body></html>
