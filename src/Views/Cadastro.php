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
        <input type='text' id='cpf' name='cpf' required>
      </div>
      <div>
        <label for='senha'>Senha</label>
        <input type='password' id='senha' name='senha' required>
      </div>
      <div>
        <label for='contato'>Contato</label>
        <input type='text' id='contato' name='contato' required>
      </div>
      <div>
        <label for='data_nascimento'>Data de Nascimento</label>
        <input type='date' id='data_nascimento' name='data_nascimento' required>
      </div>
      <button type="submit" class='botao' name="botaoCadastro">Cadastrar</button>
      <p>Já tem uma conta? <a href='/login'>Fazer Login</a></p>
    </form>
  </main>
</body>

</html>
