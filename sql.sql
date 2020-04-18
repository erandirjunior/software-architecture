create table subscription
(
    id         int auto_increment
        primary key,
    name       varchar(255) not null,
    email      varchar(255) not null,
    identifier varchar(11)  not null,
    birth_date date         not null,
    graduated  tinyint(1)   not null,
    state      varchar(2)   not null
);