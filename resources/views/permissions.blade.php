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
        <h1>Permissões</h1>

        @foreach ($users as $user)
            <div class="user-card">
                <div class="user-info">
                    <h2>{{ $user['name'] }}</h2>
                    <span>{{ $user['email'] }}</span>
                </div>

                <button class="collapse-btn" onclick="togglePermissions({{ $user['id'] }})">
                    Ver Permissões
                </button>

                <div class="permissions-container" id="permissions-{{ $user['id'] }}">
                    <fieldset disabled style="border: none">
                        <ul class="permissions-list">
                            <input type="checkbox" id="permission-abacate" name="permissions[]" value="abacate">
                            <label for="permission-abacate">abacate</label>
                            {{-- @foreach ($user['permissions'] as $permission)
                                <li class="permission-item">
                                    <input type="checkbox" id="permission-{{ $permission }}" name="permissions[]" value="{{ $permission }}">
                                    <label for="permission-{{ $permission }}">{{ $permission }}</label>
                                </li>
                            @endforeach --}}
                        </ul>
                    </fieldset>
                    <button id="edit-permissions">Editar Permissões</button>
                </div>
            </div>
        @endforeach

    </div>

    <script>
        function togglePermissions(userId) {
            const permissionsContainer = document.getElementById('permissions-' + userId);
            const isVisible = permissionsContainer.style.display === 'block';

            permissionsContainer.style.display = isVisible ? 'none' : 'block';
        }

        const editPermissionsButton = document.getElementById('edit-permissions');

        editPermissionsButton.addEventListener('click', () => {
            document.querySelector('fieldset').removeAttribute('disabled');
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
</style>

</body>
</html>
