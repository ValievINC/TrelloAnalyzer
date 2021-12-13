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

