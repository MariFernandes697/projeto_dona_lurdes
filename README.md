# projeto_dona_lurdes
 
# 🛒 Armazém Sítio

Armazém Sítio é uma plataforma de vendas online. O sistema simula uma loja virtual onde usuários podem visualizar produtos, realizar compras, acompanhar seus pedidos e onde a administradora, Dona Lourdes pode gerenciar o catálogo com total autonomia.

## 🌐 Tecnologias e Linguagens Utilizadas

- **HTML5**
- **CSS3**
- **JavaScript**
- **PHP 7+**
- **MySQL**
- **XAMPP (para ambiente local)
- **API Mercado Pago (simulada)
- 
## ✨ Funcionalidades do Projeto

### 👤 Usuário
- Cadastro e login com verificação de sessão.
- Visualização de produtos em destaque.
- Página de detalhes de produto com carrossel de imagens.
- Adição de produtos ao carrinho.
- Finalização de pedido com escolha de método de pagamento:
  - Pix (simulado)
  - Pagamento presencial (com status pendente)
  - Mercado Pago (API simulada)
- Histórico de compras com status e detalhes.
- Edição de dados pessoais (nome, email, endereço).

### 🧑‍🍳 Administradora - Dona Lurdes
- Login exclusivo e painel administrativo personalizado.
- Cadastro de novos produtos.
- Edição e exclusão de produtos.
- Visualização do catálogo com imagens e preços.

## 📦 Banco de Dados

O banco de dados possui as seguintes tabelas principais:

- `usuarios`  
- `produtos`  
- `pedidos`  
- `itens_pedido`  

## 🚀 Como Executar Localmente

1. Clone o repositório:
   ```bash
   git clone [https://github.com/seu-usuario/seu-repositorio.git](https://github.com/MariFernandes697/projeto_dona_lurdes.git)

2. Copie os arquivos para a pasta htdocs do XAMPP.


3. Importe o banco de dados no phpMyAdmin.


4. Inicie o Apache e MySQL no XAMPP.


5. Acesse via navegador:
http://localhost/projeto_integrador/index.php

💡 Possibilidades Futuras

Hospedagem completa na web.

Versão mobile desenvolvida com Flutter.

Integração com sistema de notificação e acompanhamento de pedidos.

Layout responsivo com foco em usabilidade.
