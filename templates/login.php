<form action="<?= $self ?>" method="post" class="box">
	<div>
		<label for="username"><?= L10n::$username ?></label>
		<input class="button" type="text" id="username" name="username" autocomplete="username" required>
	</div>
	<div>
		<label for="password"><?= L10n::$password ?></label>
		<input class="button" type="password" id="password" name="password" autocomplete="current-password" required>
	</div>
	<div class="box-footer"><button class="button" type="submit" name="login"><?= L10n::$login ?></button></div>
</form>
