create table user
(
    id_user   int unsigned auto_increment
        primary key,
    society   varchar(128)    not null,
    address   varchar(255)    not null,
    city      varchar(128)    not null,
    postal    int(5) unsigned not null,
    contact   varchar(64)     null,
    phone     varchar(64)     null,
    email     varchar(128)    not null,
    hash      varchar(128)    not null,
    id_status int unsigned    not null,
    id_role   int unsigned    not null,
    constraint fk_role
        foreign key (id_role) references role (id_role),
    constraint fk_statusUser
        foreign key (id_status) references status (id_status)
)
    auto_increment = 3;

create index society
    on user (society);

INSERT INTO projetcommande.user (id_user, society, address, city, postal, contact, phone, email, hash, id_status, id_role) VALUES (1, 'bcb', 'adresse1', 'Marseille', 13005, '', '0611223344', 'bcb@gmail.com', '$2y$10$SvFbWnSzJsMM7fxDHbrZNuq8gROBOXXtHikVO5sDmf3Ljz18NW/t6', 1, 2);
INSERT INTO projetcommande.user (id_user, society, address, city, postal, contact, phone, email, hash, id_status, id_role) VALUES (2, 'admin', 'adresse2', 'Marseille', 13006, '', '0611223344', 'admin@gmail.com', '$2y$10$NO/p2nIQ0DVkfIRXSDntXOpkjRaPhqlkVFDNgIgwW7v1MEuPuoI62', 2, 2);
INSERT INTO projetcommande.user (id_user, society, address, city, postal, contact, phone, email, hash, id_status, id_role) VALUES (3, 'biobio', 'adresse de biobio', 'Aix-en-Provence', 13190, 'Bioman', '0491343536', 'biobio@gmail.com', '$2y$10$h6qXPM4LDdVr8sFx0Vt/BujNVO32POZvVEHRJIwg2EqP95lBDwxuS', 1, 2);
INSERT INTO projetcommande.user (id_user, society, address, city, postal, contact, phone, email, hash, id_status, id_role) VALUES (4, 'aaa', 'aaaa', 'aaaa', 13013, '', '0611223344', 'adresse1@mail.com', '$2y$10$Z3sVn4wMBRbYOCgRoibiPO/0dI/3WPlPmctUxxgZZwOt1yFitQq42', 2, 2);
