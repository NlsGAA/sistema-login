<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Permissões</title>
</head>
<body>

    <div class="container">
        <div class="container-fluid">
            <h1>Permissões</h1>
            <button class="btn-add-user" onclick="openModal()">NOVO+</button>
        </div>

        @foreach ($users as $user)
            <div class="user-card">
                <div class="user-info">
                    <h2>{{ $user['name'] }}</h2>
                    <span>{{ $user['email'] }}</span>
                </div>

                <button class="collapse-btn" onclick="togglePermissions({{ $user['id'] }})">
                    Ver Permissões
                </button>

                @if(isset($err))
                    <div style="color: red">
                        {{ $err['message'] }}
                    </div>
                @endif

                <form 
                    action="{{ route('delete-user', $user['id']) }}"
                    method="POST"
                    onsubmit="return confirm('Tem certeza que deseja excluir este usuário?')"
                >
                    @csrf
                    @method('DELETE')
                    
                    <button type="submit" class="collapse-btn" style="background: red">
                        Deletar usuário
                    </button>
                </form>
                
                <div class="permissions-container" id="permissions-{{ $user['id'] }}">
                    <fieldset disabled style="border: none">
                        <form action="{{ route('toggle-permissions') }}" method="POST">
                            <input type="hidden" name="user_id" value="{{ $user['id'] }}" />
                            @csrf
                            <ul class="permissions-list">
                                @foreach ($user['permissions'] as $permission)
                                    <li class="permission-item">
                                        <input type="checkbox" id="permission-{{ $permission['permission_name'] }}" name="permissions[]" value="{{ $permission['id'] }}" {{ $permission['has_permission'] ? 'checked' : '' }}>
                                        <label for="permission-{{ $permission['permission_name'] }}">{{ $permission['permission_name'] }}</label>
                                    </li>
                                @endforeach
                            </ul>
                            <button>Salvar Permissões</button>
                        </form>
                    </fieldset>
                    <button id="edit-permissions">Editar Permissões</button>
                </div>
            </div>
        @endforeach
    </div>

    <div class="modal" id="modal" tabindex="-1" role="dialog" style="display: none;">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Cadastre-se</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="closeModal()">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="login-body">
                        @if(isset($err) && $err['message'])
                            <div style="color: red">
                                {{ $err['message'] }}
                            </div>
                        @endif
                        <form action="{{ route('register-user') }}" method="POST">
                            @csrf
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
    </div>

    <script>
        function togglePermissions(userId) {
            const permissionsContainer = document.getElementById(`permissions-${userId}`);
            permissionsContainer.style.display = permissionsContainer.style.display === 'none' ? 'block' : 'none';
        }

        document.querySelector('#edit-permissions').addEventListener('click', function() {
            document.querySelector('fieldset').removeAttribute('disabled');
        })


        document.addEventListener('DOMContentLoaded', function () {
            window.openModal = function() {
                const modal = document.getElementById('modal');
                if (modal) {
                    modal.style.display = 'flex';
                } else {
                    console.error('Modal não encontrado!');
                }
            }

            window.closeModal = function() {
                const modal = document.getElementById('modal');
                if (modal) {
                    modal.style.display = 'none';
                } else {
                    console.error('Modal não encontrado!');
                }
            }
        });
    </script>

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        .container {
            max-width: 900px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .container-fluid {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        h1 {
            text-align: center;
            margin-bottom: 30px;
        }

        .user-card {
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 15px;
            margin-bottom: 15px;
            background-color: #fafafa;
        }

        .user-info {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
        }

        .permissions-list {
            list-style-type: none;
            padding: 0;
        }

        .permission-item {
            display: flex;
            align-items: center;
            margin: 10px 0;
        }

        .permission-item label {
            margin-left: 10px;
        }

        .collapse-btn {
            background-color: #007bff;
            color: #fff;
            padding: 10px;
            width: 100%;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-align: left;
            margin-bottom: 10px
        }

        .collapse-btn:hover {
            background-color: #0056b3;
        }

        .permissions-container {
            display: none;
            padding-left: 20px;
        }

        #edit-permissions {
            background-color: #007bff;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 10px;
        }

        .btn-add-user {
            background-color: green;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 10px;
        }

        .modal {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.5);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 1050;
        }

        .modal-dialog {
            max-width: 500px;
            width: 100%;
        }

        .modal-content {
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            width: 100%;
        }

        .modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-bottom: 10px;
        }

        .modal-header h5 {
            margin: 0;
        }

        .modal-header button {
            background: none;
            border: none;
            font-size: 1.5rem;
            cursor: pointer;
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
            font-weight: bold;
        }
    </style>

</body>
</html>
