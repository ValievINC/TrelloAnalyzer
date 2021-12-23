CREATE DATABASE [IF NOT EXISTS] trello_analyzer_db;
USE trello_analyzer_db;
create table teams
(
    id        int auto_increment
        primary key,
    team_name varchar(255) not null,
    topic     varchar(255) null,
    url       varchar(255) not null
);
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