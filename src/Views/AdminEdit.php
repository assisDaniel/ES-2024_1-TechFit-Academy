<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="icon" type="image/svg" href="/src/Views/static/icons/favicon.svg">
    <title>Admin - Editar</title>

    <link rel="stylesheet" href="/src/Views/static/css/AdminEdit.css">
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
            echo "Admin";

            $idk3 =  $_SESSION['idk']; 
            ?>
        </p>
    </div>

    <div class="title">
        <h1>Editar usuário</h1>
    </div>

    <form class="form" method="post" action="edit/process" enctype="multipart/form-data">
        <div class="container">
            <div class="col">
                <label class="form-label">Nome</label>
                <input type="text" name="nome" class="form-input" value="<?php echo $idk3['nome']?>">
            </div>

            <div class="col">
                <label class="form-label">E-mail</label>
                <input type="email" name="email" class="form-input" value="<?php echo $idk3['email']?>">
            </div>

            <div class="col">
                <label class="form-label">CPF</label>
                <input type="text" name="cpf" class="form-input" value="<?php echo $idk3['cpf']?>" oninput="formatarCPF(this)">
            </div>

            <div class="col">
                <label class="form-label">Contato</label>
                <input type="tel" name="telefone" class="form-input" value="<?php echo $idk3['telefone']?>">
            </div>

            <div class="col">
                <label class="form-label">Data de Nascimento</label>
                <input type="date" name="dtNascimento" class="form-input" value="<?php echo $idk3['dt_nascimento']?>">
            </div>

            <div class="col">
                <label class="form-label">Ficha de Treino</label>
                <input type="hidden" name="MAX_FILE_SIZE" value="1000000">
                <input type="file" name="ficha" id="ficha" class="form-input file-input">
                <label for="ficha" class="custom-file-input"><span class="file-label-text">Adicionar ficha</span></label>
                <?php if (!empty($usuario['pdf_ficha'])): ?>
                    <a href="data:application/pdf;base64,<?php echo base64_encode($usuario['pdf_ficha']); ?>" target="_blank">Ver ficha atual</a>
                <?php endif; ?>
            </div>

            <div class="col">
                <label class="form-label">Avaliação Física</label>
                <input type="file" name="aval" id="aval" class="form-input file-input">
                <label for="aval" class="custom-file-input"><span class="file-label-text">Adicionar avaliação</span></label>
                <?php if (!empty($usuario['pdf_avaliacao'])): ?>
                    <a href="data:application/pdf;base64,<?php echo base64_encode($usuario['pdf_avaliacao']); ?>" target="_blank">Ver avaliação atual</a>
                <?php endif; ?>
            </div>

            <div class="col">
                <button type="submit" class="botao" name="botaoAdminEdit">Editar</button>
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
    </script>
</body>
</html>
