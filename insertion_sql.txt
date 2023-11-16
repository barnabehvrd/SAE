DROP TABLE IF EXISTS ADMINISTRATEUR;
DROP TABLE IF EXISTS CONTENU;
DROP TABLE IF EXISTS MESSAGE;
DROP TABLE IF EXISTS PRODUIT;
DROP TABLE IF EXISTS TYPE_DE_PRODUIT;
DROP TABLE IF EXISTS UNITE;
DROP TABLE IF EXISTS COMMANDE;
DROP TABLE IF EXISTS PRODUCTEUR;
DROP TABLE IF EXISTS STATUT;
DROP TABLE IF EXISTS UTILISATEUR;











CREATE TABLE UTILISATEUR(
   Id_Uti INT,
   Prenom_Uti VARCHAR(50) NOT NULL,
   Nom_Uti VARCHAR(50) NOT NULL,
   Mail_Uti VARCHAR(50) NOT NULL,
   Adr_Uti VARCHAR(50) NOT NULL,
   Pwd_Uti VARCHAR(50) NOT NULL,
   PRIMARY KEY(Id_Uti),
   UNIQUE(Mail_Uti)
);

CREATE TABLE PRODUCTEUR(
   Id_Prod INT,
   Id_Uti INT NOT NULL,
   Prof_Prod VARCHAR(50),
   PRIMARY KEY(Id_Prod),
   UNIQUE(Id_Uti),
   FOREIGN KEY(Id_Uti) REFERENCES UTILISATEUR(Id_Uti)
);

CREATE TABLE ADMINISTRATEUR(
   Id_Admin INT,
   Id_Uti INT NOT NULL,
   PRIMARY KEY(Id_Admin),
   UNIQUE(Id_Uti),
   FOREIGN KEY(Id_Uti) REFERENCES UTILISATEUR(Id_Uti)
);

CREATE TABLE UNITE(
   Id_Unite INT,
   Nom_Unite VARCHAR(50) NOT NULL,
   PRIMARY KEY(Id_Unite)
);

CREATE TABLE STATUT(
   Id_Statut INT,
   Desc_Statut VARCHAR(50) NOT NULL,
   PRIMARY KEY(Id_Statut)
);

CREATE TABLE TYPE_DE_PRODUIT(
   Id_Type_Produit INT,
   Desc_Type_Produit VARCHAR(50),
   PRIMARY KEY(Id_Type_Produit)
);

CREATE TABLE MESSAGE(
   Id_Msg INT,
   Emetteur INT NOT NULL,
   Destinataire INT NOT NULL,
   Date_Msg DATETIME NOT NULL,
   Date_Expi_Msg DATETIME,
   Contenu_Msg VARCHAR(4096),
   PRIMARY KEY(Id_Msg),
   FOREIGN KEY(Emetteur) REFERENCES UTILISATEUR(Id_Uti),
   FOREIGN KEY(Destinataire) REFERENCES UTILISATEUR(Id_Uti)
);

CREATE TABLE COMMANDE(
   Id_Commande VARCHAR(50),
   Id_Statut INT NOT NULL,
   Id_Prod INT NOT NULL,
   Id_Uti INT NOT NULL,
   PRIMARY KEY(Id_Commande),
   FOREIGN KEY(Id_Prod) REFERENCES PRODUCTEUR(Id_Prod),
   FOREIGN KEY(Id_Statut) REFERENCES STATUT(Id_Statut),
   FOREIGN KEY(Id_Uti) REFERENCES UTILISATEUR(Id_Uti)
);

CREATE TABLE PRODUIT(
   Id_Produit INT,
   Id_Prod INT NOT NULL,
   Nom_Produit VARCHAR(50) NOT NULL,
   Id_Type_Produit INT NOT NULL,
   Qte_Produit DECIMAL(15,2) NOT NULL,
   Id_Unite_Stock INT NOT NULL,
   Prix_Produit_Unitaire DECIMAL(15,2) NOT NULL,
   Id_Unite_Prix INT NOT NULL,
   PRIMARY KEY(Id_Produit),
   FOREIGN KEY(Id_Prod) REFERENCES PRODUCTEUR(Id_Prod),
   FOREIGN KEY(Id_Unite_Prix) REFERENCES UNITE(Id_Unite),
   FOREIGN KEY(Id_Unite_Stock) REFERENCES UNITE(Id_Unite),
   FOREIGN KEY(Id_Type_Produit) REFERENCES TYPE_DE_PRODUIT(Id_Type_Produit)
);

CREATE TABLE CONTENU(
   Id_Commande VARCHAR(50),
   Id_Produit INT,
   Qte_Produit_Commande INT NOT NULL,
   Num_Produit_Commande INT NOT NULL,
   PRIMARY KEY(Id_Commande, Id_Produit),
   FOREIGN KEY(Id_Commande) REFERENCES COMMANDE(Id_Commande),
   FOREIGN KEY(Id_Produit) REFERENCES PRODUIT(Id_Produit)
);

INSERT INTO UTILISATEUR (Id_Uti, Prenom_Uti, Nom_Uti, Mail_Uti, Adr_Uti, Pwd_Uti)
VALUES 
    ('1', 'John', 'Doe', 'johndoe1@gmail.com', '1 Rue des Lilas, Paris, 75001', 'password123'),
    ('2', 'Alice', 'Smith', 'alicesmith2@gmail.com', '2 Rue de la Liberté, Lyon, 69002', 'securepass'),
    ('3', 'Maria', 'Garcia', 'mariagarcia3@gmail.com', '3 Rue des Chênes, Marseille, 13003', 'securepassword'),
    ('4', 'David', 'Wilson', 'davidwilson4@gmail.com', '4 Rue des Tulipes, Bordeaux, 33004', 'strongpass123'),
    ('5', 'Sophie', 'Brown', 'sophiebrown5@gmail.com', '5 Rue de la Paix, Lille, 59005', 'userpass567'),
    ('6', 'Michael', 'Davis', 'michaeldavis6@gmail.com', '6 Rue du Soleil, Nice, 06006', 'michaelpass'),
    ('7', 'Linda', 'Johnson', 'lindajohnson7@gmail.com', '7 Rue des Érables, Toulouse, 31007', 'lindapassword'),
    ('8', 'Robert', 'Martinez', 'robertmartinez8@gmail.com', '8 Rue de la Mer, Strasbourg, 67008', 'robertpass123'),
    ('9', 'Lisa', 'Taylor', 'lisataylor9@gmail.com', '9 Rue de la Montagne, Nantes, 44009', 'lisapassword'),
    ('10', 'William', 'Anderson', 'williamanderson10@gmail.com', '10 Rue des Roses, Montpellier, 34010', 'williampass'),
    ('11', 'Sophia', 'Garcia', 'sophiagarcia1@gmail.com', '11 Rue des Violettes, Paris, 75011', 'sophiapassword'),
    ('12', 'Ethan', 'Brown', 'ethanbrown2@gmail.com', '12 Rue des Lilas, Lyon, 69012', 'ethanpass123'),
    ('13', 'Olivia', 'Davis', 'oliviadavis3@gmail.com', '13 Rue de la Liberté, Marseille, 13013', 'oliviapass567'),
    ('14', 'Noah', 'Smith', 'noahsmith4@gmail.com', '14 Rue des Chênes, Bordeaux, 33014', 'noahpass123'),
    ('15', 'Aria', 'Wilson', 'ariawilson5@gmail.com', '15 Rue de la Mer, Lille, 59015', 'ariapassword'),
    ('16', 'Logan', 'Martinez', 'loganmartinez6@gmail.com', '16 Rue des Tulipes, Nice, 06016', 'loganpass567'),
    ('17', 'Amelia', 'Garcia', 'ameliagarcia7@gmail.com', '17 Rue de la Liberté, Toulouse, 31017', 'ameliapassword'),
    ('18', 'Jackson', 'Brown', 'jacksonbrown8@gmail.com', '18 Rue des Érables, Strasbourg, 67018', 'jacksonpass123'),
    ('19', 'Mia', 'Taylor', 'miataylor9@gmail.com', '19 Rue de la Montagne, Nantes, 44019', 'miapassword'),
    ('20', 'Ella', 'Anderson', 'ellaanderson10@gmail.com', '20 Rue des Roses, Montpellier, 34020', 'ellapassword'),
    ('21', 'Oliver', 'Smith', 'oliversmith1@gmail.com', '21 Rue des Chênes, Paris, 75021', 'oliverpass123'),
    ('22', 'Ava', 'Garcia', 'avagarcia2@gmail.com', '22 Rue des Violettes, Lyon, 69022', 'avapassword'),
    ('23', 'Lucas', 'Brown', 'lucasbrown3@gmail.com', '23 Rue de la Liberté, Bordeaux, 33023', 'lucaspass567'),
    ('24', 'Ella', 'Davis', 'elladavis4@gmail.com', '24 Rue de la Mer, Marseille, 13024', 'ellapass123'),
    ('25', 'Chloe', 'Smith', 'chloesmith5@gmail.com', '25 Rue des Tulipes, Lille, 59025', 'chloepassword'),
    ('26', 'Mason', 'Martinez', 'masonmartinez6@gmail.com', '26 Rue de la Paix, Nice, 06026', 'masonpass567'),
    ('27', 'Harper', 'Garcia', 'harpergarcia7@gmail.com', '27 Rue des Érables, Toulouse, 31027', 'harperpassword'),
    ('28', 'Ethan', 'Wilson', 'ethanwilson8@gmail.com', '28 Rue de la Mer, Strasbourg, 67028', 'ethanpass123'),
    ('29', 'Ella', 'Taylor', 'ellataylor9@gmail.com', '29 Rue de la Montagne, Nantes, 44029', 'ellapassword'),
    ('30', 'Liam', 'Martinez', 'liammartinez10@gmail.com', '30 Rue des Roses, Montpellier, 34030', 'liampassword'),
    ('31', 'Chloe', 'Garcia', 'chloegarcia1@gmail.com', '31 Rue des Chênes, Paris, 75031', 'chloepass567'),
    ('32', 'Benjamin', 'Wilson', 'benjaminwilson2@gmail.com', '32 Rue des Violettes, Lyon, 69032', 'benjaminpassword'),
    ('33', 'Mia', 'Taylor', 'miataylor3@gmail.com', '33 Rue de la Liberté, Bordeaux, 33033', 'miapassword'),
    ('34', 'William', 'Davis', 'williamdavis4@gmail.com', '34 Rue des Tulipes, Lille, 59034', 'williampass123'),
    ('35', 'Sophia', 'Smith', 'sophiasmith5@gmail.com', '35 Rue de la Paix, Nice, 06035', 'sophiapassword'),
    ('36', 'Elijah', 'Brown', 'elijahbrown6@gmail.com', '36 Rue des Chênes, Toulouse, 31036', 'elijahpass567'),
    ('37', 'Amelia', 'Anderson', 'ameliaanderson7@gmail.com', '37 Rue des Violettes, Strasbourg, 67037', 'ameliapassword'),
    ('38', 'James', 'Johnson', 'jamesjohnson8@gmail.com', '38 Rue de la Liberté, Nantes, 44038', 'jamespassword'),
    ('39', 'Ava', 'Martinez', 'avamartinez9@gmail.com', '39 Rue de la Mer, Montpellier, 34039', 'avapass123'),
    ('40', 'Sophia', 'Garcia', 'sophiagarcia10@gmail.com', '40 Rue de la Montagne, Paris, 75040', 'sophiapass567'),
    ('41', 'Daniel', 'Smith', 'danielsmith1@gmail.com', '41 Rue de la Liberté, Lyon, 69041', 'danielpass123'),
    ('42', 'James', 'Brown', 'jamesbrown52@gmail.com', '42 Rue de la Liberté, Bordeaux, 33042', 'jamespass567'),
    ('43', 'Amelia', 'Garcia', 'ameliagarcia3@gmail.com', '43 Rue de la Liberté, Marseille, 13043', 'ameliapass567'),
    ('44', 'Elijah', 'Davis', 'elijahdavis44@gmail.com', '44 Rue de la Liberté, Lille, 59044', 'elijahpassword'),
    ('45', 'Luna', 'Smith', 'lunasmith6@gmail.com', '45 Rue de la Liberté, Nice, 06045', 'lunapass123'),
    ('46', 'Benjamin', 'Martinez', 'benjaminmartinez46@gmail.com', '46 Rue de la Liberté, Toulouse, 31046', 'benjaminpass567'),
    ('47', 'Aria', 'Garcia', 'ariagarcia7@gmail.com', '47 Rue de la Liberté, Strasbourg, 67047', 'ariapassword'),
    ('48', 'Oliver', 'Wilson', 'oliverwilson8@gmail.com', '48 Rue de la Liberté, Nantes, 44048', 'oliverpass123'),
    ('49', 'Chloe', 'Davis', 'chloedavis9@gmail.com', '49 Rue de la Liberté, Montpellier, 34049', 'chloepass567'),
    ('50', 'Benjamin', 'Wilson', 'benjaminwilson10@gmail.com', '50 Rue de la Liberté, Paris, 75050', 'benjaminpass123'),
    ('51', 'Chloe', 'Smith', 'chloesmith1@gmail.com', '51 Rue de la Liberté, Lyon, 69051', 'chloepass567'),
    ('52', 'James', 'Brown', 'jamesbrown2@gmail.com', '52 Rue de la Liberté, Bordeaux, 33052', 'jamespass123'),
    ('53', 'Amelia', 'Garcia', 'ameliagarcia35@gmail.com', '53 Rue de la Liberté, Marseille, 13053', 'ameliapass567'),
    ('54', 'Elijah', 'Davis', 'elijahdavis4@gmail.com', '54 Rue de la Liberté, Lille, 59054', 'elijahpassword'),
    ('55', 'Luna', 'Smith', 'lunasmith5@gmail.com', '55 Rue de la Liberté, Nice, 06055', 'lunapass123'),
    ('56', 'Benjamin', 'Martinez', 'benjaminmartinez6@gmail.com', '56 Rue de la Liberté, Toulouse, 31056', 'benjaminpass567');

INSERT INTO PRODUCTEUR (Id_Prod, Id_Uti, Prof_Prod)
VALUES
    (1, '1', 'Agriculteur'),
    (2, '2', 'Agriculteur'),
    (3, '3', 'Vigneron'),
    (4, '4', 'Vigneron'),
    (5, '5', 'Maraîcher'),
    (6, '6', 'Apiculteur'),
    (7, '7', 'Maraîcher'),
    (8, '8', 'Éleveur de volaille'),
    (9, '9', 'Viticulteur'),
    (10, '10', 'Pépiniériste');

INSERT INTO ADMINISTRATEUR (Id_Admin, Id_Uti)
VALUES (1, '24');

INSERT INTO ADMINISTRATEUR (Id_Admin, Id_Uti)
VALUES (2, '35'); 


INSERT INTO UNITE (Id_Unite, Nom_Unite)
VALUES (1, 'Kg'),
 (2, 'l'),
 (3, 'm²'),
 (4, 'unité'); 



INSERT INTO MESSAGE (Id_Msg, Date_Msg, Date_Expi_Msg, Contenu_Msg, Emetteur, Destinataire)
VALUES
    ('1', '2023-10-23 09:00:00', '2024-04-23 09:00:00', "Bonjour, j'aimerais acheter des légumes frais.", '2', '6'),
    ('2', '2023-10-23 09:05:00', '2024-04-23 09:05:00', 'Bonjour, nous avons une variété de légumes disponibles. Que recherchez-vous en particulier ?', '6', '2'),
    ('3', '2023-10-23 09:10:00', '2024-04-23 09:10:00', 'Je suis intéressé par des carottes et des tomates. Pouvez-vous me donner les détails ?', '2', '6'),
    ('4', '2023-10-23 09:15:00', '2024-04-23 09:15:00', 'Bien sûr ! Nos carottes sont fraîches du jour. Les tomates sont également en stock. Souhaitez-vous les acheter en quantité ?', '6', '2'),
    ('5', '2023-10-23 09:20:00', '2024-04-23 09:20:00', 'Je prendrais 2 kg de carottes et 1 kg de tomates. Quel est le prix ?', '2', '6');

INSERT INTO MESSAGE (Id_Msg, Date_Msg, Date_Expi_Msg, Contenu_Msg, Emetteur, Destinataire)
VALUES
    ('6', '2023-10-24 10:00:00', '2024-04-24 10:00:00', 'Bonjour, avez-vous des fraises en ce moment ?', '4', '5'),
    ('7', '2023-10-24 10:05:00', '2024-04-24 10:05:00', 'Bonjour ! Oui, nous avons des fraises fraîches en stock. Combien de kilos souhaitez-vous ?', '5', '4'),
    ('8', '2023-10-24 10:10:00', '2024-04-24 10:10:00', 'Je voudrais 3 kg de fraises. Pouvez-vous les livrer demain ?', '4', '5'),
    ('9', '2023-10-24 10:15:00', '2024-04-24 10:15:00', 'Bien sûr ! La livraison sera planifiée pour demain. Les frais de livraison sont de 5 €. Acceptez-vous ?', '5', '4'),
    ('10', '2023-10-24 10:20:00', '2024-04-24 10:20:00', "D'accord, je suis d'accord pour la livraison. Merci !", '4', '5');


INSERT INTO MESSAGE (Id_Msg, Date_Msg, Date_Expi_Msg, Contenu_Msg, Emetteur, Destinataire)
VALUES
    ('11', '2023-10-25 11:00:00', '2024-04-25 11:00:00', 'Bonjour, je cherche des pommes biologiques. En avez-vous ?', '8', '7'),
    ('12', '2023-10-25 11:05:00', '2024-04-25 11:05:00', 'Bonjour ! Oui, nous avons des pommes biologiques. Combien en voulez-vous ?', '7', '8'),
    ('13', '2023-10-25 11:10:00', '2024-04-25 11:10:00', 'Je prendrais 5 kg de pommes biologiques. Pouvez-vous me donner le prix ?', '8', '7'),
    ('14', '2023-10-25 11:15:00', '2024-04-25 11:15:00', 'Certainement ! Le prix des pommes biologiques est de 2,5 € par kg. Voulez-vous que je les réserve pour vous ?', '7', '8'),
    ('15', '2023-10-25 11:20:00', '2024-04-25 11:20:00', "Oui, s'il vous plaît, réservez-les pour moi. Je passerai les chercher demain.", '8', '7');

-- Conversation 4 entre un client et un maraîcher
INSERT INTO MESSAGE (Id_Msg, Date_Msg, Date_Expi_Msg, Contenu_Msg, Emetteur, Destinataire)
VALUES
    ('16', '2023-10-26 12:00:00', '2024-04-26 12:00:00', 'Bonjour, je suis à la recherche de miel local. En avez-vous ?', '10', '6'),
    ('17', '2023-10-26 12:05:00', '2024-04-26 12:05:00', 'Bonjour ! Oui, nous produisons du miel local de haute qualité. Combien de pots souhaitez-vous ?', '6', '10'),
    ('18', '2023-10-26 12:10:00', '2024-04-26 12:10:00', 'Je prendrais 3 pots de miel local. Pouvez-vous me donner le prix ?', '10', '6'),
    ('19', '2023-10-26 12:15:00', '2024-04-26 12:15:00', 'Bien sûr ! Le prix par pot de miel local est de 10 €. Puis-je organiser la livraison ?', '6', '10'),
    ('20', '2023-10-26 12:20:00', '2024-04-26 12:20:00', "D'accord, organisez la livraison. Merci !", '10', '6');

INSERT INTO MESSAGE (Id_Msg, Date_Msg, Date_Expi_Msg, Contenu_Msg, Emetteur, Destinataire)
VALUES
    ('21', '2023-10-27 13:00:00', '2024-04-27 13:00:00', 'Bonjour, je recherche des œufs frais de poule. En avez-vous en stock ?', '3', '8'),
    ('22', '2023-10-27 13:05:00', '2024-04-27 13:05:00', 'Bonjour ! Oui, nous avons des œufs frais de poule. Combien de douzaines souhaitez-vous ?', '8', '3'),
    ('23', '2023-10-27 13:10:00', '2024-04-27 13:10:00', "Je prendrais 2 douzaines d'œufs frais de poule. Pouvez-vous me donner le prix ?', '3', '8'),
    ('24', '2023-10-27 13:15:00', '2024-04-27 13:15:00', 'Certainement ! Le prix par douzaine d'œufs frais de poule est de 3 €. Voulez-vous que je les livre ?", '8', '3'),
    ('25', '2023-10-27 13:20:00', '2024-04-27 13:20:00', "D'accord, je suis d'accord pour la livraison. Merci !", '3', '8');

INSERT INTO MESSAGE (Id_Msg, Date_Msg, Date_Expi_Msg, Contenu_Msg, Emetteur, Destinataire)
VALUES
    ('45', '2023-10-28 14:00:00', '2024-04-28 14:00:00', 'Bonjour, je trouve le prix de vos fraises un peu élevé. Pouvez-vous faire une réduction ?', '4', '5'),
    ('46', '2023-10-28 14:05:00', '2024-04-28 14:05:00', 'Bonjour ! Nous fixons nos prix en fonction de la qualité de nos produits. Nous pouvons envisager une petite réduction pour une commande régulière.', '5', '4'),
    ('456', '2023-10-28 14:10:00', '2024-04-28 14:10:00', 'Je comprends, mais je reste sur ma position. Pouvez-vous réduire le prix de 10 % ?', '4', '5'),
    ('465', '2023-10-28 14:15:00', '2024-04-28 14:15:00', "D'accord, nous pouvons réduire de 5 % pour cette commande.", '5', '4'),
    ('789', '2023-10-28 14:20:00', '2024-04-28 14:20:00', "Cela me convient. Merci pour l'effort !", '4', '5');

INSERT INTO MESSAGE (Id_Msg, Date_Msg, Date_Expi_Msg, Contenu_Msg, Emetteur, Destinataire)
VALUES
    ('897', '2023-10-29 15:00:00', '2024-04-29 15:00:00', "Bonjour, je suis insatisfait de la qualité des pommes de terre que j'ai achetées. Elles ne sont pas fraîches.", '3', '8'),
    ('434', '2023-10-29 15:05:00', '2024-04-29 15:05:00', "Je suis désolé d'apprendre cela. Nous nous efforçons de fournir des produits de haute qualité. Pouvez-vous me donner plus de détails ?", '8', '3'),
    ('756', '2023-10-29 15:10:00', '2024-04-29 15:10:00', 'Les pommes de terre sont molles et ont un goût étrange. Je souhaite un remboursement.', '3', '8'),
    ('126', '2023-10-29 15:15:00', '2024-04-29 15:15:00', 'Je suis vraiment désolé pour cette expérience. Nous procéderons au remboursement complet.', '8', '3');
    
INSERT INTO MESSAGE (Id_Msg, Date_Msg, Date_Expi_Msg, Contenu_Msg, Emetteur, Destinataire)
VALUES
    ('132', '2023-10-30 16:00:00', '2024-04-30 16:00:00', 'Le prix de vos œufs de poule est trop élevé. Pouvez-vous réduire le prix ?', '2', '7'),
    ('7564', '2023-10-30 16:05:00', '2024-04-30 16:05:00', 'Nous vendons des œufs de haute qualité. Le prix reflète la qualité de nos produits. Nous ne pouvons pas réduire davantage.', '7', '2');
    
INSERT INTO MESSAGE (Id_Msg, Date_Msg, Date_Expi_Msg, Contenu_Msg, Emetteur, Destinataire)
VALUES
    ('37', '2023-10-25 17:00:00', '2024-04-25 17:00:00', "Les carottes que j'ai achetées ne sont pas fraîches et ont un goût étrange. Je veux un remboursement.", '10', '2'),
    ('38', '2023-10-25 17:05:00', '2024-04-25 17:05:00', 'Je suis désolé pour cette expérience. Nous vérifierons la qualité de nos produits et procéderons au remboursement complet.', '2', '10');
    
INSERT INTO MESSAGE (Id_Msg, Date_Msg, Date_Expi_Msg, Contenu_Msg, Emetteur, Destinataire)
VALUES
    ('39', '2023-11-01 18:00:00', '2024-05-01 18:00:00', 'Le prix de vos tomates est élevé. Pouvez-vous faire une réduction pour une commande en grande quantité ?', '7', '9'),
    ('40', '2023-11-01 18:05:00', '2024-05-01 18:05:00', 'Nous offrons des tarifs spéciaux pour les commandes en grande quantité. Vous bénéficiez déjà de la réduction.', '9', '7');


INSERT INTO STATUT (Id_Statut, Desc_Statut)
VALUES (1, 'En cours'),
(2, 'prête'),
(3, 'annulée'),
(4, 'livrée');



INSERT INTO COMMANDE (Id_Commande, Id_Prod, Id_Uti, Id_Statut)
VALUES ('1', 1, '1', 1),
('2', 2, '2', 2),
('4', 3, '5', 3),
('5', 1, '12', 1),
('6', 1, '32', 2),
('7', 2, '42', 3),
('8', 1, '15', 4),
('9', 3, '18', 4),
('10', 3, '2', 4),
('11', 1, '3', 2),
('12', 2, '7', 4);

INSERT INTO TYPE_DE_PRODUIT (Id_Type_Produit, Desc_Type_Produit)
VALUES (1, 'Fruits'),
(2, 'Légumes'),
(3, 'Grains'),
(4, 'Viande'),
(5, 'Vin'),
(6, 'Animaux'),
(7, 'Plances');

-- Pour un agriculteur
INSERT INTO PRODUIT (Id_Produit, Nom_Produit, Id_Type_Produit, Id_Prod, Qte_Produit, Id_Unite_Stock, Prix_Produit_Unitaire, Id_Unite_Prix)
VALUES
(12, 'Blé', 6, 6, '100', 1, '2.00', 1),
(13, 'Maïs', 6, 6, '80', 1, '1.50', 1);

-- Pour un vigneron
INSERT INTO PRODUIT (Id_Produit, Nom_Produit, Id_Type_Produit, Id_Prod, Qte_Produit, Id_Unite_Stock, Prix_Produit_Unitaire, Id_Unite_Prix)
VALUES
(14, 'Vin rouge', 7, 7, '10', 1, '15.00', 1),
(15, 'Vin blanc', 7, 7, '8', 1, '12.00', 1);

-- Pour un maraîcher
INSERT INTO PRODUIT (Id_Produit, Nom_Produit, Id_Type_Produit, Id_Prod, Qte_Produit, Id_Unite_Stock, Prix_Produit_Unitaire, Id_Unite_Prix)
VALUES
(5, 'Tomates', 5, 4, '20', 1, '2.00', 1),
(6, 'Poivrons', 5, 4, '10', 1, '1.50', 1),
(7, 'Courgettes', 5, 4, '15', 1, '1.75', 1),
(8, 'Carottes', 2, 4, '18', 1, '1.40', 1),
(9, 'Aubergines', 5, 4, '12', 1, '2.25', 1);

-- Pour un apiculteur
INSERT INTO PRODUIT (Id_Produit, Nom_Produit, Id_Type_Produit, Id_Prod, Qte_Produit, Id_Unite_Stock, Prix_Produit_Unitaire, Id_Unite_Prix)
VALUES
(16, 'Miel', 3, 8, '5', 1, '10.00', 1),
(17, 'Cire d''abeille', 4, 8, '2', 1, '5.00', 1);

-- Pour un éleveur de volaille
INSERT INTO PRODUIT (Id_Produit, Nom_Produit, Id_Type_Produit, Id_Prod, Qte_Produit, Id_Unite_Stock, Prix_Produit_Unitaire, Id_Unite_Prix)
VALUES
(18, 'Poulet entier', 6, 9, '5', 1, '6.00', 1),
(19, 'Œufs de poule', 7, 9, '30', 1, '0.50', 1);

-- Pour un viticulteur
INSERT INTO PRODUIT (Id_Produit, Nom_Produit, Id_Type_Produit, Id_Prod, Qte_Produit, Id_Unite_Stock, Prix_Produit_Unitaire, Id_Unite_Prix)
VALUES
(20, 'Chardonnay', 7, 10, '12', 1, '18.00', 1),
(21, 'Merlot', 7, 10, '15', 1, '16.00', 1);

-- Pour un pépiniériste
INSERT INTO PRODUIT (Id_Produit, Nom_Produit, Id_Type_Produit, Id_Prod, Qte_Produit, Id_Unite_Stock, Prix_Produit_Unitaire, Id_Unite_Prix)
VALUES
(22, 'Rosiers', 5, 1, '10', 1, '7.50', 1),
(23, 'Sapins', 5, 1, '8', 1, '9.00', 1);


INSERT INTO CONTENU (Id_Commande, Id_Produit, Qte_Produit_Commande, Num_Produit_Commande) VALUES ('1', '16', '12', '2'), ('1', '13', '320', '3'), ('2', '9', '560', '1'), ('2', '17', '12', '7'), ('4', '21', '36', '8'), ('5', '20', '21', '9'), ('7', '15', '12', '11'), ('12', '12', '1250', '12'), ('12', '6', '3', '14'), ('8', '5', '1', '16');