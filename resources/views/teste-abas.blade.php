<!-- resources/views/layouts/app.blade.php -->
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Sistema com Abas - Limite de Abas</title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet">

    <!-- Alpine.js -->
    <script src="//unpkg.com/alpinejs" defer></script>
</head>

<body class="p-4" x-data="tabsComponent" x-init="loadTabs()">

<!-- Botões para abrir abas -->
<div class="mb-3">
    <button class="btn btn-primary me-2"
            @click="openTab('Clientes', '/clientes', 'fa-solid fa-users')">
        <i class="fa-solid fa-users me-1"></i> Abrir Clientes
    </button>
    <button class="btn btn-success me-2"
            @click="openTab('Produtos', '/produtos', 'fa-solid fa-box')">
        <i class="fa-solid fa-box me-1"></i> Abrir Produtos
    </button>
    <button class="btn btn-warning me-2"
            @click="openTab('Vendas', '/vendas', 'fa-solid fa-cash-register')">
        <i class="fa-solid fa-cash-register me-1"></i> Abrir Vendas
    </button>
</div>

<!-- Navegação de abas -->
<ul class="nav nav-tabs" role="tablist">
    <template x-for="tab in tabs" :key="tab.id">
        <li class="nav-item" role="presentation">
            <button
                class="nav-link d-flex align-items-center"
                :class="activeTab === tab.id ? 'active' : ''"
                @click="activeTab = tab.id; saveTabs()">

                <!-- Ícone -->
                <i class="me-1" :class="tab.icon"></i>

                <!-- Título -->
                <span x-text="tab.title"></span>

                <!-- Botão fechar -->
                <i class="fa-solid fa-xmark ms-2 text-danger"
                   style="cursor: pointer;"
                   @click.stop="closeTab(tab.id)"></i>
            </button>
        </li>
    </template>
</ul>

<!-- Conteúdo das abas -->
<div class="tab-content border p-3">
    <template x-for="tab in tabs" :key="tab.id">
        <div class="tab-pane fade"
             :class="activeTab === tab.id ? 'show active' : ''">
            <iframe :src="tab.url" class="w-100" style="height: 400px; border: 1px solid #ddd;"></iframe>
        </div>
    </template>
</div>

<!-- Bootstrap 5 JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('tabsComponent', () => ({
            tabs: [],
            activeTab: null,
            maxTabs: 5,

            openTab(title, url, icon) {
                let existing = this.tabs.find(tab => tab.url === url);
                if (existing) {
                    this.activeTab = existing.id;
                } else {
                    if (this.tabs.length >= this.maxTabs) {
                        alert('Você só pode abrir no máximo ' + this.maxTabs + ' abas.');
                        return;
                    }
                    let newTab = {id: Date.now(), title, url, icon};
                    this.tabs.push(newTab);
                    this.activeTab = newTab.id;
                    this.saveTabs();
                }
            },

            closeTab(tabId) {
                this.tabs = this.tabs.filter(t => t.id !== tabId);
                if (this.activeTab === tabId) {
                    this.activeTab = this.tabs.length ? this.tabs[0].id : null;
                }
                if (!this.tabs.length) {
                    this.openDefaultTab();
                }
                this.saveTabs();
            },

            saveTabs() {
                localStorage.setItem('tabs', JSON.stringify(this.tabs));
                localStorage.setItem('activeTab', this.activeTab);
            },

            loadTabs() {
                let savedTabs = localStorage.getItem('tabs');
                let savedActive = localStorage.getItem('activeTab');
                if (savedTabs) this.tabs = JSON.parse(savedTabs);
                if (savedActive) this.activeTab = parseInt(savedActive);
                if (!this.tabs.length) {
                    this.openDefaultTab();
                }
            },

            openDefaultTab() {
                let defaultTab = {
                    id: Date.now(),
                    title: 'Painel de Controle',
                    url: '/painel',
                    icon: 'fa-solid fa-gauge-high'
                };
                this.tabs.push(defaultTab);
                this.activeTab = defaultTab.id;
                this.saveTabs();
            }
        }));
    });
</script>


</body>
</html>
