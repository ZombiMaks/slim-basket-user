### Установленные микрофреймворки
1. Slim - это микроструктура PHP, которая помогает быстро писать простые, но мощные веб-приложения и API. По сути, Slim - диспетчер, который получает HTTP-запрос, вызывает соответствующую процедуру обратного вызова и возвращает HTTP-ответ. Вот и все.
2. PHP-View" - HTML шаблонизатор.
3. Faker - это библиотека которая генерирует данные искусственного наполнителя.
4. Collect - для работы с массивами. 

### Принцип работы кода:
1. С помощью Faker генерируем список пользователей с их информацией.(мини база данных)
2. С помощью Slim проверяем получаем HTTP-запрос.
3. Проверяем что находится в адресной строке.
4. Если /user - выводим список пользователей, по 5 на страницу.
5. Если /user/ + id пользователя - выводим информацию пользователя с указанным id.


### Commits

#### Search
Был добавлен микрофреймворк Stringy - для рапоты со строками.
Была добавлена возможность поиска пользователей (search.phtml).
