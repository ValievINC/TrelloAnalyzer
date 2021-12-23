create table users
(
    id      int auto_increment
        primary key,
    name    varchar(255) not null,
    team_id int          not null,
    role    varchar(255) null,
    constraint users_teams_id_fk
        foreign key (team_id) references teams (id)
            on delete cascade
);

INSERT INTO trello_analyzer_db.users (id, name, team_id, role) VALUES (23, 'Никита Самков', 12, 'БОГ');
INSERT INTO trello_analyzer_db.users (id, name, team_id, role) VALUES (24, 'Самков Никита', 12, 'Божество');
INSERT INTO trello_analyzer_db.users (id, name, team_id, role) VALUES (25, 'НС', 12, 'просто чел');
INSERT INTO trello_analyzer_db.users (id, name, team_id, role) VALUES (56, 'Renounced', 19, 'художник');
INSERT INTO trello_analyzer_db.users (id, name, team_id, role) VALUES (57, 'silonsilon', 19, 'бэк');
INSERT INTO trello_analyzer_db.users (id, name, team_id, role) VALUES (58, 'Шихаил Местеров', 19, 'создатель');
INSERT INTO trello_analyzer_db.users (id, name, team_id, role) VALUES (59, 'Брейсон Джоди', 19, 'я не знаю');
INSERT INTO trello_analyzer_db.users (id, name, team_id, role) VALUES (60, 'Геннадий', 19, 'работяга');
INSERT INTO trello_analyzer_db.users (id, name, team_id, role) VALUES (61, 'Тест Тестов', 12, 'тестировщик');
INSERT INTO trello_analyzer_db.users (id, name, team_id, role) VALUES (62, 'Тестов Тест', 12, 'тестировщик');
INSERT INTO trello_analyzer_db.users (id, name, team_id, role) VALUES (63, 'Тест', 12, 'тестировщик');
INSERT INTO trello_analyzer_db.users (id, name, team_id, role) VALUES (64, 'Богдан Потапов', 20, 'Генерал');
INSERT INTO trello_analyzer_db.users (id, name, team_id, role) VALUES (65, 'Булат Валиев', 20, 'Модбилдер');
INSERT INTO trello_analyzer_db.users (id, name, team_id, role) VALUES (66, 'Алина Красникова', 20, 'Архитектор');
INSERT INTO trello_analyzer_db.users (id, name, team_id, role) VALUES (67, 'Любовь Лила', 21, 'Участник');
INSERT INTO trello_analyzer_db.users (id, name, team_id, role) VALUES (68, 'Булат Валиев', 21, 'Участник');
INSERT INTO trello_analyzer_db.users (id, name, team_id, role) VALUES (69, 'кто-то кто-тов', 21, 'Участник');