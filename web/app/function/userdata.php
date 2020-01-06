<?php

$sql = 'SELECT * 
		FROM `users`
		WHERE `id` = :id';

$stmt = $db->prepare($sql);
$stmt->bindValue(':id', $user_id, PDO::PARAM_STR);
$stmt->execute();
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="container">
    <h1>Личный кабинет пользователя <?= $username ?> </h1>
    <div class="row">
        <?php foreach ($rows as $el): ?>
            <div class="col">
            	<h5>ФИО: <small class="text-muted"><?= $el['fullname'] ?></small></h3>
            	<h5>Email: <small class="text-muted"><?= $el['email'] ?></small></h3>
            </div>
        <?php endforeach; ?>
    </div>
</div>
