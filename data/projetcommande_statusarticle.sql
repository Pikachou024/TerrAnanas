create table statusarticle
(
    id_statusArticle    int unsigned auto_increment
        primary key,
    label_statusArticle varchar(128) not null
)
    auto_increment = 3;

INSERT INTO projetcommande.statusarticle (id_statusArticle, label_statusArticle) VALUES (1, 'stock');
INSERT INTO projetcommande.statusarticle (id_statusArticle, label_statusArticle) VALUES (2, 'rupture');
