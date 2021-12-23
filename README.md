# Анализатор Трелло
![demo-gif](for%20readme/trello-analyzer.gif)
## Квикстарт
Создайте базу данных: скопируйте код из [create-db](data/create_db.sql) 
в консоль MySQL и выполните.  
Конец.
## Как работает
В поиске выбираем название желаемой команды (списком выходят все команды, 
но поле работает как поиск, то есть при наборе части названия происходит 
сортировка списка)  
При нажатии на нужную команду или отправки названия из поля ввода с помощью 
enter происходит поиск команды и, если таковая есть, выводит информацию о ней 
(гиф выше), иначе выводит, что такая команда не найдена  

![search](for%20readme/search.PNG)  
поиск

![team-info](for%20readme/team-info.PNG)  
информация о команде

![search-error](for%20readme/search-error.PNG)  
ошибка

![charts](for%20readme/charts.PNG)  
диаграммы

## О диграммах
Для построения диаграмм используется ChartJS.  

### Левая верхняя
![bar-chart](for%20readme/bar-chart.PNG)  
Столбчатая диаграмма: рапределение карточек по столбикам.  
Горизонтальная ось - название столбика, вертикальная - количество карточек
в нём.  
Есть подписи.

### Правая верхняя
![pie-chart](for%20readme/pie-chart.PNG)  
Круговая диаграмма: распределение задач по участникам.  
Для полной информации можно наводить курсором на части диаграммы.

### Левая нижняя
![graph](for%20readme/graph.PNG)  
График: отражает статистику по добавлениям карточек.  
Горизонтальная ось - даты, вертикальная ось - количетво добавленных карточек 
в этот день.  
Есть подписи.

### Правая нижняя
![button](for%20readme/button.PNG)  
Не диаграмма.  
Кнопка, которая перенаправляет на случайную карточку доски Трелло команды.

## Изнутри
### Google lib
![google-lib](for%20readme/google-lib.PNG)  
Вот эти все страшные файлы: токены, ключи, quickstart, vendor с 15000 файлов - 
библиотека Гугла для получения данных из таблицы в Гугл доках. Подробнее об
этом можно прочитать 
[вот тут](https://developers.google.com/sheets/api/quickstart/php?hl=ru).  

### config.json
![config](for%20readme/config.PNG)  
[config.json](config.json) необходим для правильного заполнения базы данных
инфой из гугл таблицы.
* users  отвечает за заполнение таблицы users базы данных.  
Важные правила:
  * Ключ - название вопроса в гугл форме, при изменении/добавлении
  вопросов меняйте/добавляйте их в [config.json](config.json).
  * Значение - название колонки в базе даных, лучше названия в базе не менять :)
  * Колонки users:
    * name - имя участника
    * team_id - id проекта, устанавливается автоматически
    * role - роль в команде
* teams аналогично users отвечает за заполнение таблицы teams базы данных. 
    * Колонки users:
        * url - ссылка на доску Trello
        * team_name - название проекта
        * topic - описание проекта
* sheet_id - id гугл таблицы формы
* range - радиус забора данных из таблицы (из каких колонок надо брать инфу)  
если добавляете какие-нибудь вопросы в форму, количество заполняемых колонок
в таблице увеличится, необходимо будет поменять значение и тут.

### Алгоритм вкратце
Обновление базы данными из таблицы формы -> Получение данных из базы данных 
-> Передача данных в фронт -> Построение графиков

## Остальные файлы
В данном пункте я разберу осатльные важные файлы.

### [index.php](index.php)
Собственно, он и запускается при открытии страницы, 
просто подключает необходимые файлы и получает инфу из базы данных.

### [update_db.php](update_db.php)
Файл обновления базы данных данными из гугл таблицы.

### [content.html](content.html)
Верстка сайта.

### [graphs.js](graphs.js)
Файл для построения графиков с помощью ChartJS.

### [DBConnection.php](DBConnection.php)
Класс подключения к базе данных.

### [style.css](style.css)
Файл стилей.
