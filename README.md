Веб-приложение "Телефонная книга"
=========================

Приложение написано на Laravel 8.12.

#### Основной функционал:

- регистрация, авторизация, восстановление пароля

- пользователь имеет возможность:

    - создавать, редактировать контакты (ФИО, номер телефона);
    
    - просматривать список собственных контактов;
    
    - просматривать контакт на отдельной странице;
    
    - отмечать контакты как избранные;
    
    - удалять контакты;
    
    - api для crud контактов.
    
### Запуск приложения.

`docker-compose up -d`

`docker-compose exec php-cli composer install`

`docker-compose exec nodejs npm install`

`docker-compose exec nodejs npm run dev`

`docker-compose exec php-cli php artisan key:generate`

`docker-compose exec php-cli php artisan migrate`

`docker-compose exec php-cli php artisan passport:install`

Открывается по адресу http://localhost:8080

Регистрация аккаунта:

/register

Кабинет пользователя:

/register/contacts

### API для crud контактов.

Базовый url: http://localhost:8080

#### Авторизация:

Для начала нужно сгенирировать токен. Для этого нужно сделать следующий запрос:

**POST** /oauth/token

```json
{
    "grant_type": "password",
    "client_id": 2,
    "client_secret": "secret",
    "username": "user@site.ru",
    "password": "123456789",
    "scope": ""
}
```

**grant_type** - значение `password` остется

**client_id** - id клиента `Laravel Password Grant Client` из таблицы `oauth_client`, который создается после команды php artisan passport:install

**client_secret** - поле `secret` из таблицы `oauth_client`

**username** - email зарегистрированного пользователя 

**password** - пароль зарегистрированного пользователя 

**scope** - пустой

Получившийся `access_token` нужно использовать в дальнейшем для авторизации типом Barer Token.


#### Создать контакт:

**POST**  /api/contacts/store

```json
{
    "name": "Ivanov Ivan",
    "phone": "+79123456789"
}
```

#### Показать контакт:

**GET**  /api/contacts/{id}/show

#### Обновить контакт:

**POST**  /api/contacts/{id}/update

```json
{
    "name": "Иванов Вася",
    "phone": "+79123456788"
}
```

#### Список контактов:

**GET**  /api/contacts


#### Удалить контакт:

**DELETE**  /api/contacts/{id}/destroy

