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

WEB APP

Emails for authors:                          Emails for reviewers:
author1@mail.com,                            reviewer1@mail.com,
author2@mail.com,                            reviewer2@mail.com,
author3@mail.com,                            reviewer3@mail.com,
author4@mail.com,                            reviewer4@mail.com,
author5@mail.com                             reviewer5@mail.com

Password: password

API

1. Open Postman
2. Type in url line: http://127.0.0.1:8000/api/login and choose POST request
3. Headers tab: 
key: Accept,
value: application/json
4. Body tab:
choose 'raw',
select 'JSON' nomination,
put:
{
    "email" : "reviewer1@mail.com",
    "password" : "password"
}
5. When you get a response copy 'token'
6. Open new tab:
* type in url line: http://127.0.0.1:8000/api/reviewed-articles and choose GET request
* Headers tab: 
key: Accept,
value: application/json
* Authorization: choose 'Bearer token' and paste copied one
7. Follow sixth step and instead .../reviewed-articles type .../unreviewed-articles
8. Follow sixth step and put in url line: http://127.0.0.1:8000/api/review-articles and choose POST request,
* Body tab: example of data set
{
    "data": [
        {
            "id": 29,
            "value": 2
        },
        {
            "id": 30,
            "value": 2
        }
    ]
}


