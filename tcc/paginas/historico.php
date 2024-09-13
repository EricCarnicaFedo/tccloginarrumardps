<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <!----======== CSS ======== -->
  <link rel="stylesheet" href="inicio.css">
  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="agenda.css">
  <link rel="stylesheet" href="editar.css">
  <!---------========= fontes =========------->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap">
  <!----===== Boxicons CSS ===== -->
  <script src="https://cdn.tailwindcss.com"></script>
  <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
  <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
</head>

<body>

  <style>
    /* Adicione estilos adicionais aqui */
    .search-container {
      margin-bottom: 20px;
    }
    .pagination {
      display: flex;
      justify-content: center;
      margin-top: 20px;
    }
    .pagination button {
      margin: 0 5px;
    }
    .filter-container {
      margin-bottom: 20px;
    }
    .filter-container select,
    .filter-container input {
      padding: 8px;
      margin-right: 10px;
    }
    .filter-container button {
      padding: 8px 12px;
    }
  </style>
</head>

<body class="bg-gray-100">
  <header id="navbar" class="flex justify-between items-center text-white p-4">
    <nav class="">
      <div class="titulonavbar">
        <i class="bx bxs-animal-paw"></i>
        <span class="text">Histórico</span>
      </div>
      <ul class="navbarconteudo">
        <!-- Manter apenas os itens desejados -->
      </ul>
    </nav>

    <div class="flex items-center space-x-4">
      <span class="hidden md:inline-block">Bem-vindo, Usuário</span>
      <a href="#" class="hover:underline">Sair</a>
      <i class="bx bx-bell"></i>
      <img src="https://placehold.co/30x30" alt="User avatar" class="w-8 h-8 rounded-full">
    </div>

    <i class='bx bx-menu menu-button' id="menu-button" style="font-size: 30px;"></i>
    <i class='bx bx-cog customize-button' id="customize-button" style="font-size: 20px;"></i>
    <div id="color-picker">
      <label for="navbar-color">Escolha a cor da navbar:</label>
      <input type="color" id="navbar-color" name="navbar-color" value="#4CAF50">
    </div>
  </header>

  <div id="sidebar" class="sidebar">
    <div class="sidebar-header">
      <i class='bx bx-home-alt' style="font-size: 40px; color: white;"></i>
      <h2>VetEtec</h2>
    </div>
    <a href="javascript:void(0)" class="closebtn" id="close-sidebar"> <i class='bx bxs-chevron-right'></i></a>
    <a href="#"><i class='bx bx-search'></i> <input type="text" placeholder="pesquisar..." id="search-bar"></a>
    <a href="inicio.php"><i class="bx bx-home"></i><span class="sidebar-text">Início</span></a>
    <a href="notificacoes.php"><i class='bx bx-bell'></i> <span class="sidebar-text">Notificações</span></a>
    <a href="#"><i class='bx bxs-user'></i> <span class="sidebar-text">Analíticas</span></a>
    <a href="#"><i class='bx bx-calendar'></i> <span class="sidebar-text">Agenda</span></a>
    <a href="#"><i class='bx bxs-cat'></i> <span class="sidebar-text">Pets</span></a>
    <a href="#"><i class='bx bx-dollar-circle'></i> <span class="sidebar-text">Gastos</span></a>
    <a href="#" style="margin-top: 100px;"><i class='bx bx-log-out'></i> <span class="sidebar-text">Sair</span></a>
    <a href="#"><i class='bx bx-moon theme-toggle' id="theme-toggle"></i> <span class="sidebar-text tema">Tema</span></a>
  </div>

  <div class="flex">
    <div class="flex-1">
      <main class="p-6">
        <div class="bg-white p-6 rounded shadow-md">
          <div class="flex items-center space-x-4 mb-6">
            <button class="bg-gray-300 text-gray-700 px-4 py-2 rounded flex items-center"><i class="fas fa-arrow-left mr-2"></i> VOLTAR</button>
            <h1 class="text-xl font-bold">Histórico de Alterações</h1>
          </div>

          <div class="filter-container">
            <label for="filter-type">Tipo:</label>
            <select id="filter-type">
              <option value="">Todos</option>
              <option value="Adição">Adição</option>
              <option value="Alteração">Alteração</option>
              <option value="Deleção">Deleção</option>
            </select>

            <label for="filter-table">Tabela:</label>
            <select id="filter-table">
              <option value="">Todas</option>
              <option value="Clientes">Clientes</option>
              <option value="Consultas">Consultas</option>
              <option value="Pets">Pets</option>
            </select>

            <label for="filter-date">Data:</label>
            <input type="date" id="filter-date">

            <button class="bg-blue-500 text-white px-4 py-2 rounded">Aplicar Filtros</button>
          </div>

          <div class="search-container">
            <input type="text" id="search-bar" placeholder="Pesquisar histórico..." class="border rounded px-4 py-2 w-full">
          </div>

          <div class="overflow-x-auto">
            <table class="min-w-full bg-white">
              <thead>
                <tr>
                  <th class="py-2 px-4 border-b">Data</th>
                  <th class="py-2 px-4 border-b">Hora</th>
                  <th class="py-2 px-4 border-b">Tipo</th>
                  <th class="py-2 px-4 border-b">Tabela</th>
                  <th class="py-2 px-4 border-b">ID</th>
                  <th class="py-2 px-4 border-b">Descrição</th>
                  <th class="py-2 px-4 border-b">Ações</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td class="py-2 px-4 border-b text-center">01/09/2024</td>
                  <td class="py-2 px-4 border-b text-center">14:30</td>
                  <td class="py-2 px-4 border-b text-center">Adição</td>
                  <td class="py-2 px-4 border-b text-center">Clientes</td>
                  <td class="py-2 px-4 border-b text-center">123</td>
                  <td class="py-2 px-4 border-b text-center">Cliente João Silva adicionado</td>
                  <td class="py-2 px-4 border-b text-center">
                    <button class="bg-blue-500 text-white px-2 py-1 rounded ml-2">Recuperar</button>
                  </td>
                </tr>
                <tr>
                  <td class="py-2 px-4 border-b text-center">02/09/2024</td>
                  <td class="py-2 px-4 border-b text-center">09:15</td>
                  <td class="py-2 px-4 border-b text-center">Alteração</td>
                  <td class="py-2 px-4 border-b text-center">Consultas</td>
                  <td class="py-2 px-4 border-b text-center">456</td>
                  <td class="py-2 px-4 border-b text-center">Consulta do animal Rex atualizada</td>
                  <td class="py-2 px-4 border-b text-center">
                    <button class="bg-blue-500 text-white px-2 py-1 rounded ml-2">Recuperar</button>
                  </td>
                </tr>
                <tr>
                  <td class="py-2 px-4 border-b text-center">03/09/2024</td>
                  <td class="py-2 px-4 border-b text-center">16:45</td>
                  <td class="py-2 px-4 border-b text-center">Deleção</td>
                  <td class="py-2 px-4 border-b text-center">Pets</td>
                  <td class="py-2 px-4 border-b text-center">789</td>
                  <td class="py-2 px-4 border-b text-center">Pet Carla removido</td>
                  <td class="py-2 px-4 border-b text-center">
                    <button class="bg-blue-500 text-white px-2 py-1 rounded ml-2">Recuperar</button>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>

          <div class="pagination">
            <button class="bg-gray-300 text-gray-700 px-4 py-2 rounded">« Anterior</button>
            <button class="bg-gray-300 text-gray-700 px-4 py-2 rounded">1</button>
            <button class="bg-gray-300 text-gray-700 px-4 py-2 rounded">2</button>
            <button class="bg-gray-300 text-gray-700 px-4 py-2 rounded">3</button>
            <button class="bg-gray-300 text-gray-700 px-4 py-2 rounded">Próximo »</button>
          </div>

        </div>
      </main>
    </div>
  </div>

  <script src="script.js"></script>
</body>

</html>


  <footer class="footer">
    <div class="footer-content">
      <h2 class="footer-title">Gestão Veterinária</h2>
      <p class="footer-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris at sapien eu justo ultrices feugiat at id quam. Vivamus eu tellus vel ex pretium hendrerit. Phasellus eget vehicula ex, sit amet dictum felis.</p>
      <ul class="footer-links">
        <li><a href="#">Início</a></li>
        <li><a href="#">Sobre</a></li>
        <li><a href="#">Serviços</a></li>
        <li><a href="#">Equipe</a></li>
        <li><a href="#">Contato</a></li>
      </ul>
      <div class="social-icons">
        <a href="#"><img src="https://img.icons8.com/ios-filled/50/ffffff/facebook-new.png" alt="Facebook"></a>
        <a href="#"><img src="https://img.icons8.com/ios-filled/50/ffffff/twitter.png" alt="Twitter"></a>
        <a href="#"><img src="https://img.icons8.com/ios-filled/50/ffffff/linkedin.png" alt="LinkedIn"></a>
        <a href="#"><img src="https://img.icons8.com/ios-filled/50/ffffff/instagram-new.png" alt="Instagram"></a>
      </div>
      <div class="contact-info">
        <div class="contact-info-item">
          <img src="https://img.icons8.com/material-rounded/24/ffffff/phone--v1.png" alt="Telefone">
          +1 234 567 890
        </div>
        <div class="contact-info-item">
          <img src="https://img.icons8.com/material-rounded/24/ffffff/email-open--v1.png" alt="E-mail">
          exemplo@exemplo.com
        </div>
      </div>
      <div class="subscribe">
        <input type="email" class="subscribe-input" placeholder="Digite seu e-mail">
        <button class="subscribe-button">Assinar</button>
      </div>
      <div class="company-info">
        <h3>Sobre Nós</h3>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris at sapien eu justo ultrices feugiat at id quam. Vivamus eu tellus vel ex pretium hendrerit. Phasellus eget vehicula ex, sit amet dictum felis.</p>
      </div>
      <div class="quick-links">
        <h3>Links Rápidos</h3>
        <ul>
          <li><a href="#">Política de Privacidade</a></li>
          <li><a href="#">Termos de Serviço</a></li>
          <li><a href="#">FAQ</a></li>
          <li><a href="#">Suporte</a></li>
        </ul>
      </div>
      <div class="about-section">
        <h3>Nossa Missão</h3>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris at sapien eu justo ultrices feugiat at id quam. Vivamus eu tellus vel ex pretium hendrerit. Phasellus eget vehicula ex, sit amet dictum felis.</p>
      </div>
      <div class="animal-images">
        <img src="https://placeimg.com/100/100/animals" alt="Animal">
        <img src="https://placeimg.com/100/100/animals" alt="Animal">
        <img src="https://placeimg.com/100/100/animals" alt="Animal">
      </div>
    </div>
  </footer>

  <script>
    const themeToggle = document.getElementById('theme-toggle');
    const customizeButton = document.getElementById('customize-button');
    const colorPicker = document.getElementById('color-picker');
    const navbar = document.getElementById('navbar');
    const body = document.body;
    const sidebar = document.getElementById('sidebar');
    const menuButton = document.getElementById('menu-button');
    const closeSidebar = document.getElementById('close-sidebar');
    let customNavbarColor = '#afd4c3'; // Cor padrão da barra de navegação e da barra lateral
    themeToggle.addEventListener('click', () => {
      body.classList.toggle('dark-theme');
      themeToggle.classList.toggle('bx-sun');
      // Restaurar a cor personalizada ao alternar entre temas claro e escuro
      if (body.classList.contains('dark-theme')) {
        navbar.style.backgroundColor = '#121212'; // Cor de fundo padrão do tema escuro
        sidebar.style.backgroundColor = '#121212'; // Cor de fundo padrão do tema escuro para a barra lateral
      } else {
        navbar.style.backgroundColor = customNavbarColor; // Restaurar a cor personalizada da barra de navegação
        sidebar.style.backgroundColor = customNavbarColor; // Restaurar a cor personalizada da barra lateral
      }
    });
    customizeButton.addEventListener('click', () => {
      colorPicker.style.display = colorPicker.style.display === 'block' ? 'none' : 'block';
    });
    document.getElementById('navbar-color').addEventListener('input', (event) => {
      customNavbarColor = event.target.value; // Armazenar a cor personalizada
      navbar.style.backgroundColor = customNavbarColor; // Atualizar a cor da barra de navegação
      sidebar.style.backgroundColor = customNavbarColor; // Atualizar a cor da barra lateral
    });
    menuButton.addEventListener('click', () => {
      sidebar.style.left = '0';
      navbar.style.transform = 'translateY(-100%)';
    });
    closeSidebar.addEventListener('click', () => {
      sidebar.style.left = '-250px';
      navbar.style.transform = 'translateY(0)';
    });
    document.getElementById('customize-button').addEventListener('click', function () {
      this.classList.toggle('rotated'); // Adiciona ou remove a classe 'rotated' ao clicar
    });
    document.addEventListener('DOMContentLoaded', function () {
      var conteudo = document.querySelector('.conteudo');
      setTimeout(function () {
        conteudo.classList.add('entrou');
      }, 500); // Ajuste o tempo conforme necessário
    });


  </script>
</body>

</html>
