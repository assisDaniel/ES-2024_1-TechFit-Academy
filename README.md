# Engenharia de Software-2024.1 | Universidade Federal do Tocantins - Palmas

---
## TechFit Academy

---
#### Curso: Bacharelado em Ciência da Computação
#### Professor: Edeilson Milhomem da Silva
#### Monitor: João Gabriel Alves de Souza
#### Time: Daniel Barbosa de Assis Costa, Danilo Oliveira Maciel, Pablo Pereira Brito, Tarciso Filho Miranda Dias

---
## Introdução 

O projeto "TechFit Academy" visa disponibilizar aos usuários acesso aos serviços online da academia. Tendo em vista uma forma de facilitar o acesso aos serviços disponíveis na academia, o projeto disponibiliza acesso básico aos serviços, dentro os quais estão: Visualizar avaliações físicas, visualizar fichas de treinos e acesso a informações

---

### Definindo os requisitos funcionais do projeto:

---

 - R01 - Cadastar usuário. [Tarciso Filho](https://github.com/tarcisof) Revisado por @assisDaniel
 - R02 - Fazer login do usuário. [Daniel Barbosa](https://github.com/assisDaniel) Revisado por @httpablo
 - R03 - Visualizar avaliação física. [Daniel Barbosa](https://github.com/assisDaniel) Revisado por @httpablo
 - R04 - Visualizar ficha de treino. [Pablo Pereira](https://github.com/httpablo) Revisado por @danmaciel23
 - R05 - Acessar informações da academia. [Danilo Maciel](https://github.com/danmaciel23) Revisado por @tarcisof

---

# R01 - Cadastrar o usuário.
### Autor: @tarcisof -  Tarciso Filho de Miranda Dias

### Revisor: @assisDaniel - Daniel Barbosa de Assis Costa

| Item | Descrição |
|------|-----------|
| Caso de uso | Cadastrar o usuário. |
| Resumo | Permitir que um usuário interessado em acessar as funcionalidades da academia possa se cadastrar no sistema, desde que não tenha um cadastro prévio. O processo de cadastro deve ser acessível e intuitivo para o usuário. |
| Ator principal | Usuário interessado em acessar as suas funcionalidades na academia em que faz atividade física. |
| Pré-condição | O ator principal deve conseguir se cadastrar, bem como acessar a plataforma. O ator precisa ter colocado seu número de celular válido. O ator precisa ter e-mail válido para continuar. O ator precisa criar uma senha com no mínimo 8 caracteres. |
| Pós-condição | O ator principal não deve ter um cadastro no sistema. |

## Descrição sucinta 
Realizar o cadastro do usuário na plataforma.

## Fluxo principal
Aqui está o texto sem a tabela:

1. O usuário acessa o sistema de TechFit - Academy e é apresentada a tela inicial.
2. Na tela inicial, o usuário encontra um botão com o título “Criar uma conta” e clica nele para ir para a tela de cadastro.
3. Exibe um formulário de cadastro com campos para o usuário preencher com seus dados.
4. Após preencher o formulário, clica no botão "Cadastrar".
5. O sistema verifica os dados fornecidos pelo usuário.
   - Se correto, ele é redirecionado para a página inicial.
   - Se estiver incorreto, irá retornar mensagens de erro no formulário.

## Campos do formulário de cadastro:

| Campo            | Obrigatório? | Editável? | Formato      |
|------------------|--------------|-----------|--------------|
| Nome             | Sim          | Sim       | Texto        |
| Email            | Sim          | Sim       | Texto        |
| CPF              | Sim          | Não       | Texto        |
| Senha            | Sim          | Sim       | Alfanumérico |
| Contato          | Sim          | Sim       | Alfanumérico |
| Data de Nascimento | Não        | Sim       | Alfanumérico |

## Opções do usuário
| Opção                 | Descrição                                                      |
|-----------------------|----------------------------------------------------------------|
| Cadastro no sistema   | Permite ao usuário se cadastrar no sistema.                    |
| Verificar os dados preenchidos | Permite ao usuário revisar os dados inseridos no formulário.   |

## Relatório do usuário
| Campo                    | Descrição                                                                       | Formato |
|--------------------------|---------------------------------------------------------------------------------|---------|
| Conta criada com sucesso | Assegura o usuário do resultado positivo do registro no sistema.               | Texto   |

## Fluxo alternativo
1. O ator já possui uma conta no sistema.
2. O ator clica no botão "Já tenho uma conta. Fazer Login." e é redirecionado para tela de Login.

---
# **R02 - Fazer login do usuário**
### Autor: @assisDaniel - Daniel Barbosa de Assis Costa
### Revisor: @httpablo - Pablo Pereira Brito

| Item           | Descrição                                                                                                                                                      |
|----------------|----------------------------------------------------------------------------------------------------------------------------------------------------------------|
| Caso de uso    | Login.                                                                                                                                                         |
| Resumo         | Permitir que o usuário faça login na plataforma, desde que o mesmo tenha cadastro prévio. Caso o usuário não tenha conta, redirecioná-lo a página de cadastro. |
| Ator principal | Usuário interessado em entrar na plataforma.                                                                                                                   |
| Pré-condição   | Usuário estar conectado à internet.                                                                                                                            |
| Pós-condição   | Usuário ter feito seu cadastro.                                                                                                                                |

## Descrição sucinta
Realizar login do usuário na plataforma (TechFit Academy).

## Fluxo principal

1. O usuário acessa o sistema de TechFit Academy e é apresentada a tela inicial.
2. Na tela inicial, o usuário clica no botão "Login".
3. Exibe um formulário de login com campos para o usuário preencher com seus dados.
4. Após preencher o formulário, clicar no botão "Confirmar".
5. Sistema verifica os dados fornecidos pelo usuário.
   - Se correto, ele é direcionado para a página principal da plataforma.
   - Se estiver incorreto, irá retornar mensagens de erro no formulário.

## Campos do formulário de login
| Campo | Obrigatório? | Editável? | Formato      |
|-------|--------------|-----------|--------------|
| CPF   | Sim          | Não       | texto        |
| Senha | Sim          | Sim       | Alfanumérico |

## Opções do usuário

| Campo                          | Descrição                                                    | 
|--------------------------------|--------------------------------------------------------------|
| Login na plataforma            | Permite ao usuário entrar na página principal.               |
| Verificar os dados preenchidos | Permite ao usuário revisar os dados inseridos no formulário. |


## Relatório do usuário
| Campo                                      | Descrição                                                      | Formato |
|--------------------------------------------|----------------------------------------------------------------|---------|
| "Logado com sucesso!"                      | Assegura ao usuário que ele conseguiu realizar o login.        | Texto   |
| "CPF ou senha inválidos! Tente novamente." | Mostra ao usuário que algo inserido no formulário está errado. | Texto   |

## Fluxo alternativo

1. O ator ainda não possui uma conta no sistema.
2. O ator clica no botão "Criar uma conta" e é redirecionado para a página de cadastro.

---
# **R03 - Visualizar avaliação física**
### Autor: @assisDaniel - Daniel Barbosa de Assis Costa
### Revisor: @httpablo - Pablo Pereira Brito

| Item           | Descrição                                                                               |
|----------------|-----------------------------------------------------------------------------------------|
| Caso de uso    | Visualizar sua avaliação física.                                                        |
| Resumo         | Quando nesta página o usuário consegue ter acesso a avaliação física feita na academia. |
| Ator principal | Usuário interessado em visualizar sua avaliação física.                                 |
| Pré-condição   | Estar cadastrado no sistema e logado na plataforma.                                     |
| Pós-condição   | Visualizou a avaliação física.                                                          |

## Descrição sucinta
Visualizar a avaliação física feita na academia.

## Fluxo principal

1. O usuário realiza o login.
2. Usuário é redirecionado para a página principal.
3. O usuário clica em "Avaliação física".
4. Usuário é redirecionado para a página com o documento requisitado.

## Opções do usuário
| Campo                    | Descrição                                                                              |
|--------------------------|----------------------------------------------------------------------------------------|
| Acessar documento (.pdf) | Permite ao usuário ter acesso/visualizar o arquivo .pdf contendo sua avaliação física. |

---

# R04: - Visualizar ficha de treino

### Autor: @httpablo - Pablo Pereira Brito

### Revisor: @danmaciel23 - Danilo Oliveira Maciel

| Item            | Descrição                                                                                                                                                                                               |
| --------------- | ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- |
| Caso de uso     | Visualizar ficha de treino.                                                                                                                                                                                                  |
| Resumo          | Este caso de uso permite que o usuário visualize a ficha de treino previamente cadastrada no sistema da academia. O usuário pode acessar informação detalhada sobre o exercício e quaisquer outras instruções relevantes para a realização dos treinos.                                                          |
| Ator principal | Usuário da academia.                                                                                                                                                                                                                                                                                                       |
| Pré-condição    | O usuário devem estar logados no sistema e ter acesso a tela inicial.                                                                                                                       |
| Pós-condição    | O usuário visualiza as informações detalhadas da ficha de treino.

## Descrição Sucinta:

O usuário pode acessar a ficha de treino previamente cadastrada no sistema.

## Fluxo Principal:

1. O usuário faz login;
2. O sistema exibe a tela inicial com o menu de opções;
3. O usuário seleciona a opção “Treinos”;
4. O sistema exibe a tela com a ficha de treino;

## Opções dos Usuários:

| Campo                                   | Descrição | 
| --------------------------------------- | ----------- | 
|Acessar documento (.pdf)                             | Permite o usuário visualizar o arquivo em .pdf.       | 
