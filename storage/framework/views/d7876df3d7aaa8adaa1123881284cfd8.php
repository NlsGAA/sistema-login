<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cadastre-se</title>
   
</head>
<body>
    <div class="container">
        <div class="container-fluid">
            <div class="login-body">
                <h1>Cadastre-se</h1>
                <div class="input-group">
                    <?php if(isset($err) && $err['message']): ?>
                        <div style="color: red">
                            <?php echo e($err['message']); ?>

                        </div>
                    <?php endif; ?>
                    <form action="<?php echo e(route('register-user')); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <div class="input-w-label">
                            <label>Nome:</label>
                            <input name="name" type="text" class="form-control" placeholder="Nome" />
                        </div>
    
                        <div class="input-w-label">
                            <label>Email:</label>
                            <input name="email" type="text" class="form-control" placeholder="E-mail" />
                        </div>
    
                        <div class="input-w-label">
                            <label>Senha:</label>
                            <input name="password" type="password" class="form-control" placeholder="Senha"/>
                        </div>
    
                        <button class="btn-login">Acessar</button>
                    </form>

                    <span class="register-info">
                        Já possui uma conta?
                        <a href="/">Acesse</a>
                    </span>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

<style>
    body {
        margin: 0;
        padding: 0;
    }

    .container {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        margin: 0;
    }

    .container-fluid {
        text-align: center;
    }

    .input-group {
        display: flex;
        flex-direction: column;
        background: transparent;
    }

    .login-body {
        width: 250px;
        border: 1px solid #ccc;
        padding: 20px;
        border-radius: 10px;
    }

    .form-control {
        margin-bottom: 10px;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
    }

    .btn-login {
        padding: 10px 20px;
        background-color: #007bff;
        color: #fff;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }

    .register-info {
        margin-top: 10px;
    }

    a {
        text-decoration: none;
        color: #007bff;
    }

    .input-w-label {
        display: flex;
        flex-direction: column;
        margin-bottom: 10px;
        text-align: left;
        font-weight: bold
    }
</style>
<?php /**PATH C:\Users\Nico\Documents\Programação\testes\permission\resources\views\register.blade.php ENDPATH**/ ?>