create table detailscommande
(
    id_detailsCommande int unsigned auto_increment
        primary key,
    id_commande        int unsigned           not null,
    id_article         int unsigned           not null,
    prix               decimal(6, 2) unsigned not null,
    quantite           int(3) unsigned        not null,
    constraint fk_article
        foreign key (id_article) references article (id_article)
            on update cascade on delete cascade,
    constraint fk_commande
        foreign key (id_commande) references commande (id_commande)
            on update cascade on delete cascade
)
    auto_increment = 7;

INSERT INTO projetcommande.detailscommande (id_detailsCommande, id_commande, id_article, prix, quantite) VALUES (1, 1, 1, 1.70, 3);
INSERT INTO projetcommande.detailscommande (id_detailsCommande, id_commande, id_article, prix, quantite) VALUES (2, 1, 2, 3.30, 2);
INSERT INTO projetcommande.detailscommande (id_detailsCommande, id_commande, id_article, prix, quantite) VALUES (3, 1, 3, 2.50, 1);
INSERT INTO projetcommande.detailscommande (id_detailsCommande, id_commande, id_article, prix, quantite) VALUES (5, 2, 1, 1.70, 3);
INSERT INTO projetcommande.detailscommande (id_detailsCommande, id_commande, id_article, prix, quantite) VALUES (6, 2, 3, 2.50, 2);
INSERT INTO projetcommande.detailscommande (id_detailsCommande, id_commande, id_article, prix, quantite) VALUES (7, 3, 1, 1.70, 3);
INSERT INTO projetcommande.detailscommande (id_detailsCommande, id_commande, id_article, prix, quantite) VALUES (8, 3, 3, 2.50, 2);
INSERT INTO projetcommande.detailscommande (id_detailsCommande, id_commande, id_article, prix, quantite) VALUES (9, 3, 2, 3.30, 3);
INSERT INTO projetcommande.detailscommande (id_detailsCommande, id_commande, id_article, prix, quantite) VALUES (10, 4, 2, 3.30, 2);
INSERT INTO projetcommande.detailscommande (id_detailsCommande, id_commande, id_article, prix, quantite) VALUES (11, 4, 7, 1.30, 1);
INSERT INTO projetcommande.detailscommande (id_detailsCommande, id_commande, id_article, prix, quantite) VALUES (12, 4, 3, 2.50, 1);
INSERT INTO projetcommande.detailscommande (id_detailsCommande, id_commande, id_article, prix, quantite) VALUES (13, 4, 8, 2.20, 1);
INSERT INTO projetcommande.detailscommande (id_detailsCommande, id_commande, id_article, prix, quantite) VALUES (14, 4, 9, 2.90, 1);
INSERT INTO projetcommande.detailscommande (id_detailsCommande, id_commande, id_article, prix, quantite) VALUES (15, 4, 5, 12.10, 1);
INSERT INTO projetcommande.detailscommande (id_detailsCommande, id_commande, id_article, prix, quantite) VALUES (16, 4, 1, 1.70, 3);
INSERT INTO projetcommande.detailscommande (id_detailsCommande, id_commande, id_article, prix, quantite) VALUES (17, 5, 1, 1.80, 1);
INSERT INTO projetcommande.detailscommande (id_detailsCommande, id_commande, id_article, prix, quantite) VALUES (18, 5, 10, 1.00, 2);
INSERT INTO projetcommande.detailscommande (id_detailsCommande, id_commande, id_article, prix, quantite) VALUES (19, 5, 7, 1.34, 2);
INSERT INTO projetcommande.detailscommande (id_detailsCommande, id_commande, id_article, prix, quantite) VALUES (20, 5, 6, 3.60, 2);
INSERT INTO projetcommande.detailscommande (id_detailsCommande, id_commande, id_article, prix, quantite) VALUES (21, 5, 9, 2.90, 1);
INSERT INTO projetcommande.detailscommande (id_detailsCommande, id_commande, id_article, prix, quantite) VALUES (22, 6, 1, 1.80, 1);
INSERT INTO projetcommande.detailscommande (id_detailsCommande, id_commande, id_article, prix, quantite) VALUES (23, 6, 10, 1.00, 1);
INSERT INTO projetcommande.detailscommande (id_detailsCommande, id_commande, id_article, prix, quantite) VALUES (24, 6, 7, 1.34, 1);
INSERT INTO projetcommande.detailscommande (id_detailsCommande, id_commande, id_article, prix, quantite) VALUES (25, 6, 5, 12.10, 1);
