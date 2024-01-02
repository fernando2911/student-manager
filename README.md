# API de gestão de alunos em CodeIgniter v4

### 🔧 Instalação

Instalar dependências:
```
composer install
```

Configure o arquivo Database.php em app/Config.

No arquivo .env defina uma key para o JWT
```
JWT_SECRET= 'sua chave aqui'
```

Rode as migrations:
```
php spark migrate
```

Rode os seeders:
```
php spark db:seed UserAdminSeeder

php spark db:seed StudentSeeder
```

Inicie o servidor
```
php spark serve
```