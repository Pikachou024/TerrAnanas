create table unite
(
    id_unite    int unsigned auto_increment
        primary key,
    label_unite varchar(64) not null
)
    auto_increment = 3;

INSERT INTO projetcommande.unite (id_unite, label_unite) VALUES (1, 'pièce');
INSERT INTO projetcommande.unite (id_unite, label_unite) VALUES (2, 'Kg');
