<?php

if (isset($_GET['status']) and $_GET['status'] == 'ok') {
	echo '<h3>Вы успешно зарегистрировались!</h3>';
	echo '<a href="'.host.'?mode=auth">Войти</a>';
}
