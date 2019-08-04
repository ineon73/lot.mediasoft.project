<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Аукцион</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <style type="text/css">
        .login-form {
            width: 340px;
            margin: 50px auto;
        }

        .login-form form {
            margin-bottom: 15px;
            background: #f7f7f7;
            box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
            padding: 30px;
        }

        .login-form h2 {
            margin: 0 0 15px;
        }

        .form-control, .btn {
            min-height: 38px;
            border-radius: 2px;
        }

        .btn {
            font-size: 15px;
            font-weight: bold;
        }
    </style>
</head>
<body>
<div class="login-form">
    <h2 class="text-center">Пожалуйста войдите</h2>
    <p><?php echo validation_errors(); ?></p>
    <form action="<?= site_url('auth/login') ?>" method="post">
        <div class="form-group">
            <input type="text" placeholder="логин" name="username" class="form-control"/>
        </div>
        <div class="form-group">
            <input type="password" placeholder="пароль" name="password" class="form-control"/>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary btn-block">Войти</button>
        </div>
    </form>
    <p class="text-center">Нужно создать аккаунт? <a href="<?= site_url('auth/register') ?>">Регистрация</a></p>
</div>
</body>
</html>