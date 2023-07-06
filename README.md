# shopM
Проект магазина на Symfony.

Загрузите проект в xampp/htdocs.
Выполните команду в консоли(перейдя в папку с проектом). composer install
Затем php bin/console doctrine:database:create
Команда создаст базу данных Megano7.
Затем php bin/console doctrine:migrations:migrate 
Может возникнуть ошибка типа  Provided directory "C:\Users\D395~1\AppData\Local\Temp" does not exist
Если вы используете Windows, проблема может быть в "vendor/friendsofphp/proxy-manager-lts/src/ProxyManager/FileLocator/FileLocator.php ".
Чтобы выполнить миграцию, вы можете просто прокомментировать $absolutePath = realpath($proxiesDirectory);строку в конструкторе и явно указать путь к вашему временному каталогу. например.:

//$absolutePath = realpath($proxiesDirectory);
$absolutePath = 'C:\Temp';

Загрузите фикстуры.
php bin/console hautelook:fixtures:load  (ответив утвердительно на вопрос "у").
Администратор admin@example.com (password: 123456), при авторизации заходит в админпанель.

Запустите сервер symfony serve -d и можете тестировать магазин.
