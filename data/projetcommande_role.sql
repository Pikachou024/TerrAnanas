create table role
(
    id_role    int unsigned auto_increment
        primary key,
    label_role varchar(64) not null
)
    auto_increment = 3;

INSERT INTO projetcommande.role (id_role, label_role) VALUES (1, 'admin');
INSERT INTO projetcommande.role (id_role, label_role) VALUES (2, 'client');
