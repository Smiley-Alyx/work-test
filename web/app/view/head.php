<nav class="navbar navbar-expand-lg navbar-light bg-light">
	<div class="collapse navbar-collapse">
		<ul class="navbar-nav">
			<?php
				if($user === false){
					echo '<li class="nav-item"><a class="nav-link" href="'.host.'?mode=auth">Войти</a></li>';
					echo '<li class="nav-item"><a class="nav-link" href="'.host.'?mode=reg">Регистрация</a></li>';
				}
				else{
					echo '<li class="nav-item"><a class="nav-link">Текущий пользователь: '.$username.'</a></li>';
					echo '<li class="nav-item"><a class="nav-link" href="'.host.'">Личный кабинет</a></li>';
					echo '<li class="nav-item"><a class="nav-link" href="'.host.'?mode=auth&exit=true">Выйти</a></li>';
				}
			?>
		</ul>
	</div>
</nav>