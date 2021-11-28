create table users
(
    id         int auto_increment
        primary key,
    first_name varchar(255) not null,
    last_name  varchar(255) not null,
    team_id    int          not null,
    role       varchar(255) null,
    constraint users_teams_id_fk
        foreign key (team_id) references teams (id)
);

INSERT INTO trello_analyzer_db.users (id, first_name, last_name, team_id, role) VALUES (8, 'Nikita', 'Samkov', 3, 'leader');
INSERT INTO trello_analyzer_db.users (id, first_name, last_name, team_id, role) VALUES (9, 'Никита', 'Самков', 3, 'помощник');
INSERT INTO trello_analyzer_db.users (id, first_name, last_name, team_id, role) VALUES (10, 'N', 'S', 3, 'NS');
INSERT INTO trello_analyzer_db.users (id, first_name, last_name, team_id, role) VALUES (11, 'Булат', 'Валиев', 4, 'Тимлид');
INSERT INTO trello_analyzer_db.users (id, first_name, last_name, team_id, role) VALUES (12, 'Никита', 'Самков', 4, 'Бэкэнд');
INSERT INTO trello_analyzer_db.users (id, first_name, last_name, team_id, role) VALUES (13, 'Эммануил', 'Сафоян', 4, 'Бэкэнд');
INSERT INTO trello_analyzer_db.users (id, first_name, last_name, team_id, role) VALUES (14, 'Любовь', 'Лила', 4, 'Прогер');
INSERT INTO trello_analyzer_db.users (id, first_name, last_name, team_id, role) VALUES (15, 'Никита', 'Югай', 4, 'Аналитик');