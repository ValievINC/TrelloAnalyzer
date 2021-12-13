create table teams
(
    id        int auto_increment
        primary key,
    team_name varchar(255) not null,
    topic     varchar(255) null,
    url       varchar(255) not null
);

INSERT INTO trello_analyzer_db.teams (id, team_name, topic, url) VALUES (12, 'тест', 'тест обновы', 'https://trello.com/b/jzAF2ZN0/great-hero');
INSERT INTO trello_analyzer_db.teams (id, team_name, topic, url) VALUES (19, 'тест2', 'второй тест', 'https://trello.com/b/s1MULz42/доска-1');