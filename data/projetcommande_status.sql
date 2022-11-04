create table status
(
    id_status    int unsigned auto_increment
        primary key,
    label_status varchar(128) not null
)
    auto_increment = 4;

INSERT INTO projetcommande.status (id_status, label_status) VALUES (1, 'En attente');
INSERT INTO projetcommande.status (id_status, label_status) VALUES (2, 'Validé');
INSERT INTO projetcommande.status (id_status, label_status) VALUES (3, 'Refusé');
