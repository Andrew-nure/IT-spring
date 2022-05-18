# Вариант 0
## Лабораторная работа 1
### Унифицированный интерфейс PDO

Создать и заполнить произвольными данными БД для хранения информации об информационных ресурсах библиотеки. Различают 3 вида ресурсов: книги, журналы, газеты. Книги характеризуются названием, уникальным номером (ISBN), издательством, годом издания, количеством страниц. У книги может быть произвольное количество авторов. Журналы характеризуются названием, годом выпуска, номером. Газеты характеризуются названием и датой выхода (день, месяц, год). Книги и журналы могут содержать дополнительные информационные ресурсы (например, компакт-диски), которые учитываются и регистрируются отдельно.
Сформировать запросы, которые будут выводить на экран информацию о:
книгах указанного издательства;
книгах, журналах и газетах, опубликованных за указанный временной период (учитывать год издания);
книгах указанного автора.

Начальная страница:
![image](https://user-images.githubusercontent.com/105606664/169170204-015beebd-5b1d-4528-9db9-e48e0dde9717.png)

Пример:  
Запрос/ответ  
![image](https://user-images.githubusercontent.com/105606664/169170261-2dff6b3a-c2bf-459c-807c-722650db5c99.png)
![image](https://user-images.githubusercontent.com/105606664/169170286-87d6c7a5-8bf4-4e4a-8ca3-6aad22eac130.png)


## Лабораторная работа 2
### Нереляционная СУБД MongoDB и хранение данных на стороне клиента

Создать и заполнить БД для хранения информации о литературных ресурсах библиотеки (книгах, газетах, журналах и т.д.). Для описания множества литературных ресурсов достаточно использовать одну коллекцию. Каждый ресурс, представленный в виде документа в составе коллекции, характеризуется набором свойств (и каждый, возможно, своим собственным, особым набором). Например, книги могут характеризоваться названием, уникальным номером (ISBN), издательством, годом издания, количеством страниц, автором (авторов может быть больше одного). У каких-то книг какого-то из перечисленных для примера свойств может и не быть, или быть какое-то новое свойство (например, наличие в комплекте диска). Журналы характеризуются обычно названием, годом выпуска, номером. Помните, что нет жесткого ограничения на одинаковый набор полей для разных ресурсов, пользуйтесь преимуществами MongoDB. Запросы на выборку предполагают, что требуемые поля будут у какой-то части документов в коллекции - но совсем не обязательно, что у всех.
Предоставить пользователю возможность получения информации о:
литературе указанного издательства;
литературе, опубликованной за указанный временной период (учитывать год издания);
литературе указанного автора.

Начальная страница:  
![image](https://user-images.githubusercontent.com/105606664/169170454-8d810691-1e10-4d3a-b78d-d16a752c88a1.png)

Примеры:
Запрос/ответ
![image](https://user-images.githubusercontent.com/105606664/169170510-2537b8da-81db-4c71-be34-ded20ed795a7.png)
![image](https://user-images.githubusercontent.com/105606664/169170494-308801d1-e6fd-4618-bb3c-59c531e01288.png)

![image](https://user-images.githubusercontent.com/105606664/169170555-cf44a643-e2a0-4b71-898d-9929d90bef8f.png)
![image](https://user-images.githubusercontent.com/105606664/169170578-6278ed85-d71a-4e3b-920e-e78b4eb22b9f.png)

![image](https://user-images.githubusercontent.com/105606664/169170603-822fe0d9-5727-45ea-b1d2-0547578d7938.png)
![image](https://user-images.githubusercontent.com/105606664/169170617-e56cefc5-6621-4f94-8864-d71cea337bf8.png)

Сохраненные запросы
![image](https://user-images.githubusercontent.com/105606664/169170672-81ddae98-de05-4a04-9282-601cc4461e37.png)


## Лабораторная работа 
### Асинхронный обмен данными с сервером на основе технологии AJAX

Используется исходный код с лабораторной работы, посвященной работе с данными с помощью интерфейса PDO или MySQLi. Проверить его работу.
Изменить код для обработки данных результатов запросов (для параметризированных запросов, реализуемых в прошлой лабораторной по вариантам) таким образом, чтобы вывод результата пользователю не приводил к перезагрузке страницы - т.е. использовать технологию Ajax. Использовать следующие форматы ответа от сервера:
в формате простого текста (непосредственно получать сгенерированный фрагмент HTML-кода и выводить его в заданном элементе стартовой страницы);
в формате XML (результат запроса на выборку помещается в генерируемом сервером XML-документе, который клиент считывает через свойство responseXml и формирует вывод пользователю);
в формате JSON (результат запроса на выборку помещается в массив, который затем преобразуется в JSON-строку с помощью метода json_encode и отправляется клиенту, который получает данные выборки из строки с помощью метода JSON.parse и формирует вывод пользователю).

Начальная страница:  
![image](https://user-images.githubusercontent.com/105606664/169170784-6b7b5d34-3479-47a3-8fdb-e36297fa520f.png)

Пример:
![image](https://user-images.githubusercontent.com/105606664/169170913-ac013738-9f0b-444d-8f66-0d6b79b6bdba.png)