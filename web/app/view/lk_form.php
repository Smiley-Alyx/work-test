<div class="container">
    <h3>Изменение данных пользователя</h3>
    <div class="row">
        <div class="col-6">
            <form action="" method="POST">
                <div class="form-group">
                    <label for="oldpassword">Введите старый пароль для подтверждения:</label>
                    <input type="password" class="form-control" id="oldpassword" name="oldpassword">
                </div>
                <div class="form-group">
                    <label for="fullname">ФИО:</label>
                    <input class="form-control" id="fullname" name="fullname">
                </div>
                <div class="form-group">
                    <label for="email">E-mail:</label>
                    <input class="form-control" id="email" name="email" placeholder="name@example.com">
                </div>
                <div class="form-group">
                    <label for="password">Новый пароль:</label>
                    <input class="form-control" type="password" id="password" name="password">
                </div>
                <div class="form-group">
                    <label for="password2">Повторите новый пароль:</label>
                    <input class="form-control" type="password" id="password2" name="password2">
                </div>
                <button class="btn btn-primary" type="submit" name="submit">Изменить данные</button>
            </form>
        </div>
    </div>
</div>
