<?php

// ========================================
// CONEXÃO COM O BANCO
// ========================================

$servidor = "localhost";
$usuario = "root";
$senhaBanco = "";
$banco = "hotel_pet";

// criar conexão
$conn = new mysqli($servidor, $usuario, $senhaBanco, $banco);

// verificar conexão
if ($conn->connect_error) {
    die("Erro de conexão: " . $conn->connect_error);
}

// ========================================
// PROCESSAR FORMULÁRIO
// ========================================

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // receber dados do formulário
    $nome = trim($_POST["nome"]);
    $email = trim($_POST["email"]);
    $senha = trim($_POST["senha"]);
    $confirmarSenha = trim($_POST["confirmarSenha"]);

    // ========================================
    // VALIDAR CAMPOS
    // ========================================

    if (
        empty($nome) ||
        empty($email) ||
        empty($senha) ||
        empty($confirmarSenha)
    ) {

        echo "
        <script>
            alert('⚠️ Preencha todos os campos!');
            window.history.back();
        </script>
        ";

        exit;
    }

    // ========================================
    // VALIDAR EMAIL
    // ========================================

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {

        echo "
        <script>
            alert('⚠️ Email inválido!');
            window.history.back();
        </script>
        ";

        exit;
    }

    // ========================================
    // VALIDAR SENHA
    // ========================================

    if (strlen($senha) < 6) {

        echo "
        <script>
            alert('⚠️ A senha deve ter pelo menos 6 caracteres!');
            window.history.back();
        </script>
        ";

        exit;
    }

    // ========================================
    // CONFIRMAR SENHA
    // ========================================

    if ($senha !== $confirmarSenha) {

        echo "
        <script>
            alert('⚠️ As senhas não coincidem!');
            window.history.back();
        </script>
        ";

        exit;
    }

    // ========================================
    // VERIFICAR EMAIL EXISTENTE
    // ========================================

    $sqlVerifica = "SELECT id FROM usuarios WHERE email = ?";

    $stmt = $conn->prepare($sqlVerifica);

    $stmt->bind_param("s", $email);

    $stmt->execute();

    $resultado = $stmt->get_result();

    if ($resultado->num_rows > 0) {

        echo "
        <script>
            alert('⚠️ Este email já está cadastrado!');
            window.history.back();
        </script>
        ";

        exit;
    }

    // ========================================
    // CRIPTOGRAFAR SENHA
    // ========================================

    $senhaHash = password_hash($senha, PASSWORD_DEFAULT);

    // ========================================
    // INSERIR USUÁRIO
    // ========================================

    $sql = "INSERT INTO usuarios (nome, email, senha)
            VALUES (?, ?, ?)";

    $stmt = $conn->prepare($sql);

    $stmt->bind_param("sss", $nome, $email, $senhaHash);

    // ========================================
    // EXECUTAR
    // ========================================

    if ($stmt->execute()) {

        echo "
        <script>
            alert('🎉 Cadastro realizado com sucesso!');
            window.location.href = 'login.html';
        </script>
        ";

    } else {

        echo "
        <script>
            alert('❌ Erro ao cadastrar usuário!');
            window.history.back();
        </script>
        ";
    }

    // fechar statement
    $stmt->close();
}

// fechar conexão
$conn->close();

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Processando Cadastro</title>
</head>
<body>

</body>
</html>