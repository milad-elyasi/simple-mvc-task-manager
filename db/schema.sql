create table users
(
    id   int auto_increment
        primary key,
    name varchar(255) null,
    constraint id
        unique (id)
);

create table tasks
(
    id            int auto_increment
        primary key,
    title         varchar(255) not null,
    status        int          null,
    starting_date datetime     null,
    ending_date   datetime     null,
    user_id       int          null
)
    charset = utf8;

