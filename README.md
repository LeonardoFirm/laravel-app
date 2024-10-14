## Requisitos

* PHP 8.2 ou superior
* Composer

## Como rodar o projeto baixado

Duplicar o arquivo ".env.example" e renomear para ".env".<br>

Instalar as dependências do PHP.
```
composer install
```

Gerar a chave
```
php artisan key:generate
```

Iniciar o projeto criado com Laravel
```
php artisan serve
```

Acessar o conteúdo padrão do Laravel
```
http://127.0.0.1:8000
```


## Sequencia para criar o projeto
Criar o projeto com Laravel.
```
composer create-project laravel/laravel .
```

Iniciar o projeto criado com Laravel.
```
php artisan serve
```

Acessar o conteúdo padrão do Laravel.
```
http://127.0.0.1:8000
```

## Conectar o PC ao servidor com SSH

Criar chave SSH (chave pública e privada).
```
ssh-keygen -t rsa -b 4096 -C "seu-email@exemplo.com"
```
```
ssh-keygen -t rsa -b 4096 -C "cesar@celke.com.br"
```

Senha usada no tutorial, não utilizar a mesma: 5sg#82sXnw64<br>

Local que é criado a chave pública.
```
C:\Users\SeuUsuario\.ssh\id_rsa
```
```
C:\Users\cesar/.ssh/id_rsa
```

Exibir o conteúdo da chave pública.
```
cat ~/.ssh/id_rsa.pub
```

Acessar o servidor com SSH.
```
ssh root@93.127.210.72
```

Remover os arquivos do servidor.
```
rm -rf /home/user/htdocs/endereco-do-servidor/{*,.*}
```
```
rm -rf /home/user/htdocs/srv566492.hstgr.cloud/{*,.*}
```

Compactar os arquivos com ZIP. Usar terminal sem conexão com o servidor.
```
Compress-Archive -Path .\* -DestinationPath celke_hostinger.zip
```

Enviar o projeto local para o servidor. Usar terminal sem conexão com o servidor.
```
scp /caminho/do/seu/projeto.zip usuario-ssh@ip_do_servidor:/home/user/htdocs/endereco-do-servidor
```
```
scp C:\xampp\htdocs\celke\celke_hostinger.zip root@93.127.210.72:/home/user/htdocs/srv566492.hstgr.cloud
```

Usar o terminal conectado ao servidor. Primeiro acessar o diretório do projeto no servidor. Em seguida descompactar o arquivo.
```
cd /home/user/htdocs/srv566492.hstgr.cloud
```
```
unzip celke_hostinger.zip
```

Instalar as dependências do PHP
```
composer install
```

Alterar a propriedade do diretório.
```
sudo chown -R user:user /home/user/htdocs/srv566492.hstgr.cloud
```

Reiniciar Nginx.
```
sudo systemctl restart nginx
```


