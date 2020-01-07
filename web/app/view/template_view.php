<!DOCTYPE html>
<html>
	<head>
		<title>Тестовое задание для компании Work</title>
		<meta charset="utf-8">
		<link href="./assets/css/style.css" rel="stylesheet" type="text/css">
		<link href="./assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
	</head>
	<body>
		<nav class="navbar navbar-expand-lg navbar-light bg-light">
			<div class="collapse navbar-collapse">
				<ul class="navbar-nav">
					<?php if($_SESSION): ?>
						<li class="nav-item">
							<a class="nav-link">Текущий пользователь: <?= $_SESSION['username'] ?></a>
						</li>
						<li class="nav-item"><a class="nav-link" href="/">Личный кабинет</a></li>
						<li class="nav-item"><a class="nav-link" href="/logout">Выйти</a></li>
					<?php else : ?>
						<li class="nav-item"><a class="nav-link" href="/auth">Войти</a></li>
						<li class="nav-item"><a class="nav-link" href="/reg">Регистрация</a></li>
					<?php endif ?>
				</ul>
			</div>
		</nav>
		<div style="color: red; font-size: 14px; padding: 20px; margin: 0 auto; display: block; width:400px;">
			<?php if (isset($errors) && is_array($errors)): ?>
				<ul>
					<?php foreach ($errors as $error): ?>
						<li> - <?php echo $error; ?></li>
					<?php endforeach; ?>
				</ul>
			<?php endif; ?>
		</div>
		<?php include 'app/view/'.$content_view; ?>
	</body>
</html>