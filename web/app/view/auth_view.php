<div class="container">
	<h3>Для входа введите логин и пароль</h3>
	<div class="row">
		<div class="col-6">
			<?php if ($data->isGuest()): ?>
				<form action="" method="POST">
					<div class="form-group">
						<label for="login">Логин:</label>
						<input class="form-control" id="login" name="login">
					</div>
					<div class="form-group">
						<label for="password">Пароль:</label>
						<input type="password" class="form-control" id="password" name="password">
					</div>
					<button class="btn btn-primary" type="submit" name="submit">Вход</button>
				</form>
			<?php else: ?>
				<div style="display: block; width: 400px; margin: 0 auto; background: #f2f1f0; padding: 20px; color:#555; text-align: center;">
					<center><h2 style="color:#555;">Вы уже авторизированы </h2></center>
				</div>
			<?php endif; ?>
		</div>
	</div>
</div>
