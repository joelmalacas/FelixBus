# Sistema de Gerenciamento de Rodoviária

## Descrição
Este é um software completo para gerenciamento de rodoviárias desenvolvido em PHP com MySQL. Ele foi projetado para facilitar a criação e gestão de rotas, utilizadores, funcionários e bilhetes de viagem. O sistema oferece uma interface de fácil usabilidade e funcionalidades robustas para garantir eficiência no gerenciamento de operações.

## Funcionalidades
- **Gerenciamento de Rotas:**
  - Criação, edição e exclusão de rotas de viagem.
  - Definição de horários, paradas intermediárias e preços.

- **Gestão de Utilizadores:**
  - Cadastro e autenticação de utilizadores.
  - Perfis diferenciados para clientes e funcionários.
  
- **Gestão de Funcionários:**
  - Controle de acesso baseado em permissões.
  - Cadastro de motoristas e atendentes.

- **Venda de Bilhetes:**
  - Compra e reserva de bilhetes.
  - Emissão de comprovantes de viagem.

- **Relatórios e Estatísticas:**
  - Geração de relatórios detalhados sobre viagens, vendas e utilização de rotas.

## Tecnologias Utilizadas
- **Backend:** PHP 8.x
- **Banco de Dados:** MySQL
- **Frontend:** HTML5, CSS3, JavaScript (com uso de frameworks como Bootstrap e jQuery)
- **Serviço Web:** Apache
- **Versionamento:** Git

## Instalação
Siga os passos abaixo para configurar o ambiente de desenvolvimento:

1. **Clone o repositório:**
   ```bash
   git clone https://github.com/joelmalacas/FelixBus.git
   ```

2. **Configure o servidor local:**
   - Instale o [XAMPP](https://www.apachefriends.org/index.html) ou [WAMP](https://www.wampserver.com/).
   - Coloque os arquivos do projeto na pasta `htdocs` (ou equivalente no seu servidor).

3. **Importe o banco de dados:**
   - Acesse o phpMyAdmin.
   - Crie um banco de dados com o nome `rodoviaria`.
   - Importe o arquivo `rodoviaria.sql` localizado na pasta `database` do projeto.

4. **Atualize as credenciais de banco de dados:**
   - Abra o arquivo `config/database.php`.
   - Atualize as credenciais de acordo com o seu ambiente:
     ```php
     define('DB_HOST', 'localhost');
     define('DB_USER', 'root');
     define('DB_PASS', '');
     define('DB_NAME', 'felixbus');
     ```

5. **Inicie o servidor:**
   - No XAMPP ou WAMP, inicie o Apache e o MySQL.
   - Acesse o sistema no navegador em `http://localhost/seu-projeto`.

## Uso
1. **Login:** Utilize as credenciais padrão para acessar o sistema:
   - Administrador: `admin@felixbus.com` / `admin`

2. **Navegação:**
   - Utilize o menu principal para acessar as funcionalidades do sistema.

3. **Customização:**
   - Personalize as configurações através do painel de administrador.

## Contribuição
Contribuições são bem-vindas! Para contribuir:

1. Fork o repositório.
2. Crie uma branch com sua funcionalidade: `git checkout -b minha-feature`.
3. Faça commit de suas alterações: `git commit -m 'Adiciona nova funcionalidade'`.
4. Envie para o repositório remoto: `git push origin minha-feature`.
5. Abra um Pull Request.

## Licença
Este projeto está licenciado sob a [Licença MIT](LICENSE).

---

## Contato
Para mais informações ou suporte, entre em contato:
- **Email:** suporte@dominios.pt
- **Website:** [www.malacas.pt](http://www.malacas.pt)
