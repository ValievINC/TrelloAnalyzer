create table teams
(
    id    int auto_increment
        primary key,
    name  varchar(255) not null,
    topic varchar(255) null,
    url   varchar(255) not null
);

INSERT INTO trello_analyzer_db.teams (id, name, topic, url) VALUES (7, 'Calculus Bakery', 'Игра по математике', 'https://trello.com/b/WgYpbucY/calculus-bakery');
INSERT INTO trello_analyzer_db.teams (id, name, topic, url) VALUES (8, 'TrelloAnalyzer', 'Создать анализатор досок Trello', 'https://trello.com/b/XllYwyv4/%D1%82%D0%B5%D1%81%D1%82%D0%BE%D0%B2%D0%B0%D1%8F-%D0%B4%D0%BE%D1%81%D0%BA%D0%B0');
INSERT INTO trello_analyzer_db.teams (id, name, topic, url) VALUES (9, 'NS Team', '2д рогалик на C#', 'https://trello.com/b/jzAF2ZN0/great-hero');