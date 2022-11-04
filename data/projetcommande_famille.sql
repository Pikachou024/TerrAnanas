create table famille
(
    id_famille    int unsigned auto_increment
        primary key,
    label_famille varchar(128) not null
)
    auto_increment = 3;

INSERT INTO projetcommande.famille (id_famille, label_famille) VALUES (1, 'Fruit');
INSERT INTO projetcommande.famille (id_famille, label_famille) VALUES (2, 'Légume');
