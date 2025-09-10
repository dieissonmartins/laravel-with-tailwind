<!-- resources/views/layouts/app.blade.php -->
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Sistema com Abas - Bootstrap + FontAwesome</title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet">

    <!-- Alpine.js -->
    <script src="//unpkg.com/alpinejs" defer></script>
</head>
<body class="p-4" x-data="{
    tabs: [],
    activeTab: null,
    openTab(title, url, icon) {
        let existing = this.tabs.find(tab => tab.url === url);
        if (existing) {
            this.activeTab = existing.id; // ativa se já existir
        } else {
            let newTab = { id: Date.now(), title, url, icon };
            this.tabs.push(newTab);
            this.activeTab = newTab.id;
        }
    }
}">

<!-- Botões para abrir abas -->
<div class="mb-3">
    <button class="btn btn-primary me-2"
            @click="openTab('Clientes', '/clientes', 'fa-users')">
        <i class="fa-solid fa-users me-1"></i> Abrir Clientes
    </button>
    <button class="btn btn-success me-2"
            @click="openTab('Produtos', '/produtos', 'fa-box')">
        <i class="fa-solid fa-box me-1"></i> Abrir Produtos
    </button>
    <button class="btn btn-warning me-2"
            @click="openTab('Vendas', '/vendas', 'fa-cash-register')">
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
                @click="activeTab = tab.id">

                <!-- Ícone -->
                <i class="me-1" :class="tab.icon"></i>

                <!-- Título -->
                <span x-text="tab.title"></span>

                <!-- Botão fechar -->
                <span class="ms-2 text-danger fw-bold"
                      style="cursor: pointer;"
                      @click.stop="
                            tabs = tabs.filter(t => t.id !== tab.id);
                            if(activeTab === tab.id) activeTab = tabs.length ? tabs[0].id : null
                          ">
                        ×
                    </span>
            </button>
        </li>
    </template>
</ul>

<!-- Conteúdo das abas -->
<div class="tab-content border p-3">
    <template x-if="!tabs.length">
        <p class="text-muted">Nenhuma aba aberta</p>
    </template>

    <template x-for="tab in tabs" :key="tab.id">
        <div class="tab-pane fade"
             :class="activeTab === tab.id ? 'show active' : ''">
            <iframe :src="tab.url" class="w-100" style="height: 400px; border: 1px solid #ddd;"></iframe>
        </div>
    </template>
</div>

<!-- Bootstrap 5 JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
