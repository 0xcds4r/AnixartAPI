# Anixart API

Пустой совместимый каркас Anixart API на PHP без внешних зависимостей, основанный на обратных исследованиях. 

## Структура

```text
.../
├── index.php          # входная точка
└── src/
    ├── ApiApplication.php # сборка приложения и регистрация маршрутов
    ├── ApiController.php  # контроллеры заглушек API
    ├── Request.php        # объект HTTP-запроса
    ├── Response.php       # объект JSON-ответа и CORS
    └── Router.php         # ООП-маршрутизатор
```

## Запуск

```bash
php -S 127.0.0.1:8787 index.php
```

Проверка:

```bash
curl http://127.0.0.1:8787/history/1?token=test
curl -X POST http://127.0.0.1:8787/discover/watching/1?token=test
curl -X POST http://127.0.0.1:8787/auth/signIn
```

## Поддержанные группы маршрутов

- `auth/signIn`
- `profile/{id}`
- `profile/list/all/{status}/{page}`
- `favorite/all/{page}`
- `history/{page}` и `history/add/{release}/{source}/{position}` [Насчёт position не уверен, вроде как это хранится локально]
- `discover/*`
- `search/releases/{page}`
- `release/{id}`
- `episode/{release}`, `episode/{release}/{type}`, `episode/{release}/{type}/{source}`
- `episode/target/*`
- `episode/watch/*` и `episode/unwatch/*`

Состояние пока in-memory: после перезапуска все токены и данные сбрасываются. Это намеренно пустая основа для последующего добавления вами SQLite/PostgreSQL и реальных моделей.
