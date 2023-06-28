## Установка и запуск проекта
1. ```git clone https://github.com/Ksunetka/docker-project.git```
2. ```docker-compose build```
3. ```docker compose up -d```
4. Войти в pgAdmin по адресу ```localhost:5050```, используя учетные данные сервиса ```pma``` из файла ```docker-compose.yml```
5. Добавить новый сервер и указать данные для подключения http://joxi.ru/52adXn7H07Bkwm
6. ```docker compose exec app bash```
7. ```cp .env.example .env```
8. ```bash dev```
9. Проект будет доступен по адресу ```localhost:8000```