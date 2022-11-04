create table article
(
    id_article       int unsigned auto_increment
        primary key,
    label_article    varchar(255)  not null,
    poids            int(3)        not null,
    id_unite         int unsigned  not null,
    prix             decimal(6, 2) not null,
    origine          varchar(128)  null,
    id_famille       int unsigned  not null,
    id_statusArticle int unsigned  not null,
    constraint fk_famille
        foreign key (id_famille) references famille (id_famille),
    constraint fk_statusArticle
        foreign key (id_statusArticle) references statusarticle (id_statusArticle),
    constraint fk_unite
        foreign key (id_unite) references unite (id_unite)
)
    auto_increment = 5;

create index label_article
    on article (label_article);

INSERT INTO projetcommande.article (id_article, label_article, poids, id_unite, prix, origine, id_famille, id_statusArticle) VALUES (1, 'carotte', 10, 2, 1.80, 'france', 2, 1);
INSERT INTO projetcommande.article (id_article, label_article, poids, id_unite, prix, origine, id_famille, id_statusArticle) VALUES (2, 'tomate', 5, 2, 3.30, 'espagne', 2, 2);
INSERT INTO projetcommande.article (id_article, label_article, poids, id_unite, prix, origine, id_famille, id_statusArticle) VALUES (3, 'fraise', 10, 1, 2.50, 'france', 1, 1);
INSERT INTO projetcommande.article (id_article, label_article, poids, id_unite, prix, origine, id_famille, id_statusArticle) VALUES (5, 'cerises noir', 2, 2, 12.10, 'France', 1, 1);
INSERT INTO projetcommande.article (id_article, label_article, poids, id_unite, prix, origine, id_famille, id_statusArticle) VALUES (6, 'kiwi', 5, 2, 3.60, 'france', 1, 1);
INSERT INTO projetcommande.article (id_article, label_article, poids, id_unite, prix, origine, id_famille, id_statusArticle) VALUES (7, 'banane', 18, 2, 1.34, 'Equateur', 1, 1);
INSERT INTO projetcommande.article (id_article, label_article, poids, id_unite, prix, origine, id_famille, id_statusArticle) VALUES (8, 'pomme gala', 10, 2, 2.20, 'france', 1, 1);
INSERT INTO projetcommande.article (id_article, label_article, poids, id_unite, prix, origine, id_famille, id_statusArticle) VALUES (9, 'pomme juliet', 10, 2, 2.90, 'france', 1, 1);
INSERT INTO projetcommande.article (id_article, label_article, poids, id_unite, prix, origine, id_famille, id_statusArticle) VALUES (10, 'courgette', 5, 2, 1.00, 'france', 2, 1);
INSERT INTO projetcommande.article (id_article, label_article, poids, id_unite, prix, origine, id_famille, id_statusArticle) VALUES (11, 'poireau', 10, 2, 2.30, 'france', 2, 1);
