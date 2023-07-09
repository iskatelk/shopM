# shopM - проект магазина на Symfony.

## Настройка проекта

1. Загрузить проект в xampp/htdocs.  
2. Перейти в папку с проектом и выполнить команды в консоли:
```
composer install
php bin/console doctrine:database:create # Команда создаст базу данных Megano7.
php bin/console doctrine:migrations:migrate # заполнение БД
``` 
**Важно!** Может возникнуть ошибка типа  ```Provided directory "C:\Users\D395~1\AppData\Local\Temp" does not exist```.

Если работаем в Windows, проблема может быть в настройках файла **"vendor/friendsofphp/proxy-manager-lts/src/ProxyManager/FileLocator/FileLocator.php"**.
В этом случае, рекомендуется закоментировать в конструкторе строку **$absolutePath = realpath($proxiesDirectory);** и явно указать путь к вашему временному каталогу. например:
```
//$absolutePath = realpath($proxiesDirectory);
$absolutePath = 'C:\Temp';
```
и снова выполнить предыдущую команду.

Далее ввести:
```
php bin/console hautelook:fixtures:load # Загрузить фикстуры (ответить утвердительно на вопрос "у")
```
Для тестирования магазина запустить сервер **symfony**:
```
symfony serve -d # режим демона освобождает консоль для работы
```

## Настройки для admin

```
admin@example.com (password: 123456) # при авторизации входит в админпанель.
```

