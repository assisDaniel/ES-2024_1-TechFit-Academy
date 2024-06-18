<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="icon" type="image/svg" href="/src/Views/static/icons/favicon.svg">
    <title>Admin - Adicionar</title>

    <link rel="stylesheet" href="/src/Views/static/css/adminAdd.css  ">
    <link rel="stylesheet" href="/src/Views/static/css/global.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Merriweather:ital,wght@1,900&family=Poppins:wght@400;600&family=Roboto:wght@400;500&display=swap" rel="stylesheet">
</head>
<body>
<div class="userInfo">
    <div class="userImage">
        <img src="/src/Views/static/icons/user.svg" alt="Imagem do usuário">
    </div>

    <p>
        <?php
        if(session_status() == PHP_SESSION_NONE){
            session_start();
        }

        $getter= json_decode($_SESSION['userData'], true);
        //        var_dump($getter);
        echo $getter['nome'];
        //            echo "Admin";
        ?>
    </p>
</div>

<div class="title">
    <h1>Adicionar usuário</h1>
</div>

<form class="form" method="post" action="add/process" enctype="multipart/form-data">
    <div class="container">
        <div class="col">
            <label class="form-label">Nome</label>
            <input type="text" name="nome" class="form-input" required>
        </div>

        <div class="col">
            <label class="form-label">E-mail</label>
            <input type="email" name="email" class="form-input" required>
        </div>

        <div class="col">
            <label class="form-label">CPF</label>
            <input type="text" name="cpf" class="form-input" placeholder="000.000.000-00" oninput="formatarCPF(this)" required>
        </div>

        <div class="col">
            <label class="form-label">Senha</label>
            <input type="password" name="senha" class="form-input" required>
        </div>

        <div class="col">
            <label class="form-label">Contato</label>
            <input type="tel" name="telefone" class="form-input" placeholder="(00) 00000-0000" oninput="formatarTelefone(this)" required>
        </div>

        <div class="col">
            <label class="form-label">Data de Nascimento</label>
            <input type="date" name="dtNascimento" class="form-input" required>
        </div>

        <div class="col">
            <label class="form-label">Ficha de Treino</label>
            <input type="File" name="ficha" id="ficha" class="form-input file-input">
            <label for="ficha" class="custom-file-input"><span class="file-label-text">Adicionar ficha</span></label>
        </div>

        <div class="col">
            <label class="form-label">Avaliação Física</label>
            <input type="File" name="aval" id="aval" class="form-input file-input">
            <label for="aval" class="custom-file-input"><span class="file-label-text">Adicionar avaliação</span></label>
        </div>

        <div class="col">
            <button type="submit" class="botao" name="botaoAdminAdd">Adicionar</button>
        </div>
        <div class="alert">
            <?php
            if(isset($_SESSION['erroCPF'])){
                echo '<p class="message">' . $_SESSION['erroCPF'] . '</p>';
                unset($_SESSION['erroCPF']);
            }
            ?>
        </div>
    </div>
</form>
<script>
    document.getElementById('ficha').addEventListener('change', function() {
        let fileName = this.files[0].name;
        let label = this.nextElementSibling.querySelector('.file-label-text');
        label.textContent = fileName;
    });

    document.getElementById('aval').addEventListener('change', function() {
        let fileName = this.files[0].name;
        let label = this.nextElementSibling.querySelector('.file-label-text');
        label.textContent = fileName;
    });

    function formatarCPF(campo) {
        let cpf = campo.value.replace(/\D/g, '');
        if (cpf.length > 11) cpf = cpf.substr(0, 11);

        campo.value = cpf.replace(/(\d{3})(\d{3})(\d{3})(\d{0,2})/,
            function(regex, part1, part2, part3, part4) {
                let formattedCPF = part1 + '.' + part2 + '.' + part3;
                if (part4) formattedCPF += '-' + part4;
                return formattedCPF;
            }
        );
    }

    function formatarTelefone(campo) {
        // Remove todos os caracteres não numéricos, exceto o '+' inicial para internacional
        let telefone = campo.value.replace(/(?!^\+)\D/g, '');

        // Remove o prefixo "+55" para formatação, se presente
        let hasPrefix = telefone.startsWith("+55");
        if (hasPrefix) {
            telefone = telefone.substring(3);
        }

        // Limita a 10 ou 11 dígitos para número nacional com DDD
        telefone = telefone.substr(0, 11);

        // Adiciona formatação dependendo do comprimento do telefone
        let formattedPhone = telefone.replace(/^(\d{2})(\d{4,5})(\d{0,4})/,
            function(regex, part1, part2, part3) {
                let formatted = '(' + part1 + ') ' + part2;
                if (part3) formatted += '-' + part3;
                return formatted;
            }
        );

        campo.value= formattedPhone;
    }
</script>

</body>
</html>