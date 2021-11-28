create table teams
(
    id    int auto_increment
        primary key,
    name  varchar(255) not null,
    topic varchar(255) null,
    url   varchar(255) not null
);

