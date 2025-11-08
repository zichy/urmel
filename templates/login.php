<form class="box" action="<?= $self ?>" method="post">
	<div class="block">
		<label for="username"><?= L10n::$username ?></label>
		<input class="input" type="text" id="username" name="username" autocomplete="username" required>
	</div>
	<div class="block">
		<label for="password"><?= L10n::$password ?></label>
		<input class="input" type="password" id="password" name="password" autocomplete="current-password" required>
	</div>
	<div class="block" data-footer>
		<button class="button" type="submit" name="login"><?= L10n::$login ?></button>
	</div>
</form>
