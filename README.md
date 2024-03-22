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
