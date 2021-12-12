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

INSERT INTO trello_analyzer_db.users (id, first_name, last_name, team_id, role) VALUES (8, 'Юрий', 'Перов', 7, 'Бэкэнд');
INSERT INTO trello_analyzer_db.users (id, first_name, last_name, team_id, role) VALUES (9, 'Булат', 'Валиев', 8, 'Тимлид');
INSERT INTO trello_analyzer_db.users (id, first_name, last_name, team_id, role) VALUES (19, 'Никита', 'Самков', 8, 'Бэкэнд');
INSERT INTO trello_analyzer_db.users (id, first_name, last_name, team_id, role) VALUES (20, 'Никита', 'Самков', 9, 'Тимлид');