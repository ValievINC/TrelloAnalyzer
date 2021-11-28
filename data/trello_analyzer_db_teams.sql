create table teams
(
    id    int auto_increment
        primary key,
    name  varchar(255) not null,
    topic varchar(255) null,
    url   varchar(255) not null
);

INSERT INTO trello_analyzer_db.teams (id, name, topic, url) VALUES (3, 'test1', 'djfhuodihfdjfodj', 'suidfhsidh.com');
INSERT INTO trello_analyzer_db.teams (id, name, topic, url) VALUES (4, 'Nibble Studio', 'Trello Anal yzer', 'нету пока :(');