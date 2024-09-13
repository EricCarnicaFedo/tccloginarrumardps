<?php
session_start();
include('conexaobd.php'); // Conexão ao banco de dados

// Buscar todas as clínicas cadastradas
$sql_clinicas = "SELECT id, nome FROM clinicas";
$stmt_clinicas = $conexao->prepare($sql_clinicas);
$stmt_clinicas->execute();
$clinicas = $stmt_clinicas->fetchAll(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $action = $_POST['action'];

    if ($action == 'login') {
        // Lógica de Login
        $email = $_POST['email'];
        $senha = $_POST['senha'];

        $sql = "SELECT * FROM usuarios WHERE email = ?";
        $stmt = $conexao->prepare($sql);
        $stmt->execute([$email]);
        $usuario = $stmt->fetch();

        if ($usuario && crypt($senha, $usuario['senha']) == $usuario['senha']) {
            $_SESSION['usuario_id'] = $usuario['id'];
            $_SESSION['nome'] = $usuario['nome'];
            $_SESSION['tipo'] = $usuario['tipo'];

            // Redireciona conforme o tipo de usuário
            if ($usuario['tipo'] == 'tutor') {
                header("Location: tutor.php");
            } elseif ($usuario['tipo'] == 'veterinario') {
                header("Location: veterinario.php");
            }
            exit();
        } else {
            echo "Email ou senha incorretos!";
        }
    } elseif ($action == 'cadastro') {
        // Lógica de Cadastro
        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $senha = $_POST['senha'];
        $tipo = $_POST['tipo'];

        // Verifica se o email já está em uso
        $sql_check_email = "SELECT id FROM usuarios WHERE email = ?";
        $stmt_check_email = $conexao->prepare($sql_check_email);
        $stmt_check_email->execute([$email]);
        if ($stmt_check_email->fetch()) {
            echo "O email já está em uso. Escolha outro email.";
            exit();
        }

        // Gerar um salt para o hash
        $salt = substr(md5(uniqid(rand(), true)), 0, 22);

        // Hash da senha com o salt
        $senha_hash = crypt($senha, '$2y$10$' . $salt . '$');

        if ($tipo == 'veterinario') {
            // Cadastro da clínica
            $clinica_nome = $_POST['clinica_nome'];
            $sql_clinica = "INSERT INTO clinicas (nome) VALUES (?)";
            $stmt_clinica = $conexao->prepare($sql_clinica);
            $stmt_clinica->execute([$clinica_nome]);
            $clinica_id = $conexao->lastInsertId();

            // Cadastro do veterinário vinculado à clínica
            $sql_vet = "INSERT INTO usuarios (nome, email, senha, tipo, clinica_id) VALUES (?, ?, ?, ?, ?)";
            $stmt_vet = $conexao->prepare($sql_vet);
            $stmt_vet->execute([$nome, $email, $senha_hash, $tipo, $clinica_id]);

            echo "Veterinário cadastrado com sucesso!";
        } else {
            // Cadastro do tutor com a clínica selecionada
            $clinica_id = $_POST['clinica_id'];
            $sql_tutor = "INSERT INTO usuarios (nome, email, senha, tipo, clinica_id) VALUES (?, ?, ?, ?, ?)";
            $stmt_tutor = $conexao->prepare($sql_tutor);
            $stmt_tutor->execute([$nome, $email, $senha_hash, $tipo, $clinica_id]);

            echo "Tutor cadastrado com sucesso!";
        }
    }
}
?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="login.css">
    <link rel="stylesheet" href="cadastroteste.css">
    <title>Página de Login</title>
</head>

<body>

    <div class="container" id="container">
        <!-- Formulário de Cadastro -->
        <div class="form-container sign-up">
            <form id="signupForm" method="POST" action="login.php">
                <h1>Criar conta</h1>
                <span>ou use seu E-mail</span>
                <input type="hidden" name="action" value="cadastro">
                <span>Seleção de Serviço</span>
                <select name="tabela" id="tabela" class="custom-select">
                    <option value="tabela1">Monitoramento de Pet</option>
                    <option value="tabela2">Cadastro de Clínica</option>
                </select>
                <div id="additionalFields"></div>
                <input type="text" name="nome" placeholder="Nome" class="custom-input" required>
                <input type="email" name="email" placeholder="Email" class="custom-input" required>
                <input type="password" name="senha" placeholder="Senha" class="custom-input" required>
                <input type="hidden" name="tipo" id="tipo">

                <div id="clinicaSelect" class="hide">
                    <span>Selecione a Clínica</span>
                    <select name="clinica_id" class="custom-select">
                        <?php foreach ($clinicas as $clinica): ?>
                            <option value="<?= $clinica['id'] ?>"><?= $clinica['nome'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div id="clinicaNameField" class="hide">
                    <span>Nome da Clínica</span>
                    <input type="text" name="clinica_nome" placeholder="Nome da Clínica" class="custom-input">
                </div>

                <button type="submit">Cadastre-se</button>
            </form>
        </div>

        <!-- Formulário de Login -->
        <div class="form-container sign-in">
            <form method="POST" action="login.php">
                <h1>Entrar</h1>
                <span>ou use seu E-mail</span>
                <input type="hidden" name="action" value="login">
                <input type="email" name="email" placeholder="Email" class="custom-input" required>
                <input type="password" name="senha" placeholder="Senha" class="custom-input" required>
                <a href="#">Esqueceu sua senha?</a>
                <button type="submit">Entrar</button>
            </form>
        </div>

        <div class="toggle-container">
            <div class="toggle">
                <div class="toggle-panel toggle-left">
                    <h1>Já possui uma conta?</h1>
                    <p>Clique aqui e faça seu login!</p>
                    <button class="hidden" id="login">Logar</button>
                </div>
                <div class="toggle-panel toggle-right">
                    <h1>Olá, Amigo!</h1>
                    <p>Cadastre-se com seus dados pessoais para acessar todas as funcionalidades exclusivas do nosso
                        sistema de gestão veterinária.</p>
                    <button class="hidden" id="register">Cadastre-se</button>
                </div>
            </div>
        </div>
    </div>

    <script src="script.js"></script>
    <script>
        const container = document.getElementById('container');
        const registerBtn = document.getElementById('register');
        const loginBtn = document.getElementById('login');
        const tabelaSelect = document.getElementById('tabela');
        const additionalFields = document.getElementById('additionalFields');
        const clinicaSelect = document.getElementById('clinicaSelect');
        const clinicaNameField = document.getElementById('clinicaNameField');

        const inputs = document.querySelectorAll('.custom-input');

        registerBtn.addEventListener('click', () => {
            container.classList.add("active");
        });

        loginBtn.addEventListener('click', () => {
            container.classList.remove("active");
        });

        tabelaSelect.addEventListener('change', function () {
            additionalFields.innerHTML = '';

            if (tabelaSelect.value === 'tabela2') {
                clinicaNameField.classList.remove('hide');
                clinicaSelect.classList.add('hide');
                document.getElementById('tipo').value = 'veterinario';
            } else {
                clinicaNameField.classList.add('hide');
                clinicaSelect.classList.remove('hide');
                document.getElementById('tipo').value = 'tutor';
            }
        });

        window.onload = () => {
            inputs.forEach(input => {
                input.value = '';
            });
        };
    </script>
</body>

</html>
