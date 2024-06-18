<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cadastro</title>
  
  <link rel="stylesheet" href="/src/Views/static/css/cadastro.css">
  <link rel="stylesheet" href="/src/Views/static/css/global.css">
    <link rel="icon" href="/src/Views/static/icons/favicon.svg" type="image/svg">

  
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Merriweather:ital,wght@1,900&family=Poppins:wght@400;600&family=Roboto:wght@400;500&display=swap" rel="stylesheet">
</head>

<body>
  <main>
    <div>
      <h1 class='title'>Cadastre-se</h1>
    </div>
    <form action='/cadastro/process' method='post' class='form'>
      <div>
        <label for='nome'>Nome</label>
        <input type='text' id='nome' name='nome' required>
      </div>
      <div>
        <label for='email'>Email</label>
        <input type='email' id='email' name='email' required>
      </div>
      <div>
        <label for='cpf'>CPF</label>
        <input type='text' id='cpf' name='cpf' placeholder="000.000.000-00" oninput="formatarCPF(this)" required>
      </div>
      <div>
        <label for='senha'>Senha</label>
        <input type='password' id='senha' name='senha' placeholder="Máximo de 30 caracteres" required>
      </div>
      <div>
        <label for='contato'>Contato</label>
        <input type='text' id='contato' name='contato' placeholder="(00) 00000-0000" oninput="formatarTelefone(this)" required>
      </div>
      <div>
        <label for='data_nascimento'>Data de Nascimento</label>
        <input type='date' id='data_nascimento' name='data_nascimento' required>
      </div>
      <button type="submit" class='botao' name="botaoCadastro">Cadastrar</button>
      <p>Já tem uma conta? <a href='/login'>Fazer Login</a></p>
    </form>
  </main>
    <div class="alert">
        <?php
            if(isset($_SESSION['erroCPF'])){
                echo '<p class="message">' . $_SESSION['erroCPF'] . '</p>';
                unset($_SESSION['erroCPF']);
            }
        ?>
    </div>
    <br>
  <div class="alert">
      <?php
      if(isset($_SESSION['erroTel'])){
          echo '<p class="message">' . $_SESSION['erroTel'] . '</p>';
          unset($_SESSION['erroTel']);
      }
      ?>
  </div>

  <script>
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
