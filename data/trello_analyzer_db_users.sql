create table users
(
    id      int auto_increment
        primary key,
    name    varchar(255) not null,
    team_id int          not null,
    role    varchar(255) null,
    constraint users_teams_id_fk
        foreign key (team_id) references teams (id)
);

INSERT INTO trello_analyzer_db.users (id, name, team_id, role) VALUES (23, 'Никита Самков', 12, 'БОГ');
INSERT INTO trello_analyzer_db.users (id, name, team_id, role) VALUES (24, 'Самков Никита', 12, 'Божество');
INSERT INTO trello_analyzer_db.users (id, name, team_id, role) VALUES (25, 'НС', 12, 'просто чел');
INSERT INTO trello_analyzer_db.users (id, name, team_id, role) VALUES (56, 'Шихаил Местеров', 19, 'создатель');
INSERT INTO trello_analyzer_db.users (id, name, team_id, role) VALUES (57, 'Брейсон Джоди', 19, 'я не знаю');
INSERT INTO trello_analyzer_db.users (id, name, team_id, role) VALUES (58, 'Геннадий', 19, 'работяга');
INSERT INTO trello_analyzer_db.users (id, name, team_id, role) VALUES (59, 'Renounced', 19, 'художник');
INSERT INTO trello_analyzer_db.users (id, name, team_id, role) VALUES (60, 'silonsilon', 19, 'бэк');