# assignment-library

## INSTALLATION STEPS

*preferably linux

1. Clone repo in local directory

2. Create local database 

3. Position yourself on the project folder (console) and type:

- composer install
- cp .env.example .env 
- adjust .env settings:

Open .env in your IDE and set db connection as described bellow

DB_DATABASE={db name}
DB_USERNAME={db username}
DB_PASSWORD={db password}

Back to console and type: 
- php artisan key:generate
- php artisan migrate
- php artisan db:seed
- php artisan storage:link
- php artisan jwt:secret

Laravel server
- type in console: php artisan serve

Emails for authors:                          Emails for reviewers:
author1@mail.com,                            reviewer1@mail.com,
author2@mail.com,                            reviewer2@mail.com,
author3@mail.com,                            reviewer3@mail.com,
author4@mail.com,                            reviewer4@mail.com,
author5@mail.com                             reviewer5@mail.com

Password: password
