create table commande
(
    id_commande    int unsigned auto_increment
        primary key,
    id_user        int unsigned  not null,
    montant        decimal(8, 2) not null,
    remise         int(3)        null,
    montant_remise decimal(6, 2) null,
    date_commande  date          not null,
    date_livraison date          not null,
    id_status      int unsigned  not null,
    constraint fk_status
        foreign key (id_status) references status (id_status),
    constraint fk_user
        foreign key (id_user) references user (id_user)
)
    auto_increment = 3;

INSERT INTO projetcommande.commande (id_commande, id_user, montant, remise, montant_remise, date_commande, date_livraison, id_status) VALUES (1, 1, 85.90, null, null, '2022-09-07', '2022-09-08', 1);
INSERT INTO projetcommande.commande (id_commande, id_user, montant, remise, montant_remise, date_commande, date_livraison, id_status) VALUES (2, 1, 22.94, null, null, '2022-09-07', '2022-09-09', 1);
INSERT INTO projetcommande.commande (id_commande, id_user, montant, remise, montant_remise, date_commande, date_livraison, id_status) VALUES (3, 3, 187.70, null, null, '2022-09-13', '2022-09-15', 1);
INSERT INTO projetcommande.commande (id_commande, id_user, montant, remise, montant_remise, date_commande, date_livraison, id_status) VALUES (4, 1, 235.44, null, null, '2022-09-22', '2022-09-24', 1);
INSERT INTO projetcommande.commande (id_commande, id_user, montant, remise, montant_remise, date_commande, date_livraison, id_status) VALUES (5, 4, 141.24, null, null, '2022-11-03', '2022-11-04', 1);
INSERT INTO projetcommande.commande (id_commande, id_user, montant, remise, montant_remise, date_commande, date_livraison, id_status) VALUES (6, 4, 71.32, null, null, '2022-11-03', '2022-11-05', 1);
