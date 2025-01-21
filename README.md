# Laravel ViaCEP

Este projeto é um exemplo de aplicação Laravel + Vue.Js  que realiza consultas de CEP utilizando a [API ViaCEP](https://viacep.com.br/), salva os endereços consultados em uma base de dados e permite excluí-los. Tudo foi containerizado via Docker para facilitar a execução local.

---

## Tecnologias Utilizadas

- **PHP 8+** (via Docker)
- **Laravel 9+**
- **MySQL** via Docker
- **Node.js + npm** (para gerenciar e compilar o front-end com Vue)
- **Vue 3** + **Vuex** (para a camada de front-end)
- **Axios** (para requisições HTTP ao backend)

---

## Funcionalidades

1. **Busca de CEP**:  
   - O usuário informa o CEP na tela inicial.  
   - O frontend (Vue) consome uma rota `GET /api/cep/{cep}` no Laravel, que por sua vez consome a [API ViaCEP](https://viacep.com.br/).  
   - Os dados retornados (logradouro, bairro, localidade, uf) são exibidos na tela.

2. **Salvar Endereço**:  
   - Após a busca, o usuário pode salvar o endereço no banco de dados.  
   - O front chama a rota `POST /api/address`, que armazena os dados em uma tabela `addresses`.

3. **Listar Endereços Salvos**:  
   - No carregamento inicial da tela (ou após salvar), o sistema carrega todos os endereços já salvos chamando `GET /api/address`.  
   - Exibe-os em uma tabela logo abaixo da busca.

4. **Excluir Endereço**:  
   - Cada item da lista possui um botão que chama `DELETE /api/address/{id}`, removendo-o do banco de dados.

---

## Passo a Passo de Instalação e Uso

```bash
# 1. Clonar o repositório
git clone https://github.com/joaozanqui/laravel-viacep.git
```
```bash
# 2. Entrar na pasta do projeto
cd laravel-viacep/
```
```bash
# 3. Copiar do arquivo de exemplo .env
cp .env.example .env
```
```bash
# 4. Subir os containers Docker (app e banco)
docker-compose up -d --build
```
```bash
# 5. Acessar o container da aplicação
docker exec -it viacep-app bash
```
```bash
# 6. Instalar as dependências do PHP (Laravel)
composer install
```
```bash
# 7. Instalar as dependências do front-end (Vue, etc.)
npm install
```
```bash
# 8. Rodar as migrations para criar a tabela de endereços
php artisan migrate
```
```bash
# 9. Gerar a chave da aplicação Laravel
php artisan key:generate
```
```bash
# 10. Carregar os arquivos do front-end 
npm run watch
```
