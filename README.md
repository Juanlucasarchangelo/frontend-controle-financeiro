<div align="center">
  <img src="https://archania.com.br/wp-content/uploads/2024/10/archania-solum-favicon-branco.png" width="120"/>
    <h1>🛠 Sistema de Controle Financeiro Empresarial</h1>
  <p>Sistema desenvolvido para controlar receitas e despesas de uma pequena empresa, com categorização de transações e relatórios básicos.</p>

  <a href="https://www.youtube.com/@ArchaniaSolum" target="_blank" rel="noopener noreferrer">
    <img src="https://img.shields.io/static/v1?message=Youtube&logo=youtube&label=&color=FF0000&logoColor=white&labelColor=&style=for-the-badge" height="35" alt="youtube logo"/>
  </a>
  <a href="https://www.instagram.com/juanarchangelo/" target="_blank" rel="noopener noreferrer">
    <img src="https://img.shields.io/static/v1?message=Instagram&logo=instagram&label=&color=E4405F&logoColor=white&labelColor=&style=for-the-badge" height="35" alt="instagram logo"/>
  </a>
  <a href="https://www.twitch.tv/zudokan_original" target="_blank" rel="noopener noreferrer">
    <img src="https://img.shields.io/static/v1?message=Twitch&logo=twitch&label=&color=9146FF&logoColor=white&labelColor=&style=for-the-badge" height="35" alt="twitch logo"/>
  </a>
  <a href="https://www.linkedin.com/in/juan-lucas-archangelo-061035180/" target="_blank" rel="noopener noreferrer">
    <img src="https://img.shields.io/static/v1?message=LinkedIn&logo=linkedin&label=&color=0077B5&logoColor=white&labelColor=&style=for-the-badge" height="35" alt="linkedin logo"/>
  </a>
</div>

---

## ✨ Demonstração

<img src="https://archania.com.br/wp-content/uploads/2025/10/sistema-financeiro.png" width="100%" alt="preview do projeto"/>

---

## 🚀 Tecnologias Utilizadas

<div align="left">
  <img src="https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/bootstrap/bootstrap-original.svg" height="30" alt="bootstrap logo" />
  <img width="12" />
  <img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/html5/html5-original.svg" height="30" alt="html5 logo" />
  <img width="12" />
  <img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/php/php-original.svg" height="30" alt="php logo" />
</div>

---

## ⚙️ Pré-requisitos

Antes de rodar o projeto, você precisa ter instalado:

- [XAMPP 7.4](https://www.apachefriends.org/pt_br/index.html)
- [MySQL Server](https://dev.mysql.com/downloads/mysql/)
- [Visual Studio Code](https://code.visualstudio.com/) ou [Visual Studio](https://visualstudio.microsoft.com/) (opcional)

---

## 🚀 Como rodar o projeto

1. Clone o repositório dentro da sua pasta htdocs:

   ```bash
   git clone https://github.com/Juanlucasarchangelo/frontend-controle-financeiro
   cd frontend-controle-financeiro
   ```

2. Importe o banco de dados:

   Na raiz do projeto, existe uma pasta chamada **@BD** que contém um arquivo `.sql` já populado com dados de teste.  
   
   **Credenciais padrão para acesso:**
   - **Usuário:** `adm@adm.com.br`  
   - **Senha:** `@adm2025`

3. Configure a conexão com o banco nos arquivos `model/init.php` e `controller/conexao.php`:

   ```php
   if ($bd == 1) { // Dados em produção
       define('BD_SERVIDOR', 'localhost');
       define('BD_USUARIO', '');
       define('BD_SENHA', '');
       define('BD_BANCO', '');
   } else { // Dados local
       define('BD_SERVIDOR', 'localhost');
       define('BD_USUARIO', 'root');
       define('BD_SENHA', 'root');
       define('BD_BANCO', 'sistema');
   }

4. Inicie o Apache no XAMPP:

   - Abra o **XAMPP Control Panel** e inicie o serviço **Apache**.  
   - Em seguida, acesse no navegador:  
     👉 [http://127.0.0.1/frontend-controle-financeiro/](http://127.0.0.1/frontend-controle-financeiro/)
