INSERT INTO Categorie(nom,description,image) VALUES
("hygiene","ici se trouvent les produits d'hygiene","hygiene.png"),
("electronique","des produits electroniques nouveaux, toujours a la pointe de la technologie","electronique.png"),
("mode","retrouvez ici l'ensembles des dernieres collections de mode","mode.png"),
("litterature","romans, mangas, reccueils de nouvelles, retrouvez tout dans la categorie litterature","litterature.png"),
("cinema","Avis aux mordus de cinema, tous les derniers films sont disponibles ici","cinema.png");

INSERT INTO Produit (nom, description, prix, stock, image, disponibilite, id_categorie) VALUES
('Savon antibacterial', 'Savon doux pour les mains', 3.50, 100, 'savon.png', TRUE, 1),
('Gel douche', 'Gel douche parfume pour toute la famille', 5.00, 80, 'gel_douche.png', TRUE, 1),
('Dentifrice menthe', 'Dentifrice fraicheur longue duree', 2.80, 120, 'dentifrice.png', TRUE, 1),
('Brosse a dents', 'Brosse a dents souple', 1.50, 150, 'brosse_dents.png', TRUE, 1),
('Deodorant spray', 'Deodorant longue duree', 4.20, 90, 'deodorant.png', TRUE, 1),

('Smartphone X1', 'Dernier smartphone avec ecran OLED', 699.99, 50, 'smartphone.png', TRUE, 2),
('Casque Bluetooth', 'Casque sans fil haute qualite', 89.99, 70, 'casque.png', TRUE, 2),
('Laptop Pro 15', 'Ordinateur portable puissant', 1299.00, 30, 'laptop.png', TRUE, 2),
('Tablette 10', 'Tablette tactile pour le multimedia', 399.00, 40, 'tablette.png', TRUE, 2),
('Smartwatch', 'Montre connectee avec suivi sportif', 199.00, 60, 'smartwatch.png', TRUE, 2),

('T-shirt homme', 'T-shirt en coton bio', 19.99, 100, 'tshirt_homme.png', TRUE, 3),
('Robe femme', 'Robe d ete legere', 49.99, 60, 'robe_femme.png', TRUE, 3),
('Jean slim', 'Jean pour homme taille normale', 39.99, 80, 'jean_slim.png', TRUE, 3),
('Sneakers', 'Chaussures sport confortables', 59.99, 50, 'sneakers.png', TRUE, 3),
('Veste impermeable', 'Veste legere pour la pluie', 79.99, 40, 'veste.png', TRUE, 3),


('Roman policier', 'Thriller captivant', 14.99, 70, 'roman_policier.png', TRUE, 4),
('Manga Naruto', 'Volume 1', 7.50, 100, 'manga_naruto.png', TRUE, 4),
('Recueil de nouvelles', 'Histoires courtes variees', 12.00, 60, 'nouvelles.png', TRUE, 4),
('Guide de voyage', 'Decouvrir l Italie', 18.00, 50, 'guide_italie.png', TRUE, 4),
('Poesie classique', 'Anthologie de poemes', 15.00, 40, 'poesie.png', TRUE, 4),


('Blu-ray Inception', 'Film de science-fiction', 12.99, 80, 'inception.png', TRUE, 5),
('DVD Avengers', 'Super-heros Marvel', 9.99, 70, 'avengers.png', TRUE, 5),
('Blu-ray Matrix', 'Film culte de science-fiction', 11.99, 60, 'matrix.png', TRUE, 5),
('DVD Interstellar', 'Film de science-fiction epique', 13.50, 50, 'interstellar.png', TRUE, 5),
('Blu-ray Toy Story', 'Film d animation Pixar', 10.00, 40, 'toystory.png', TRUE, 5);

INSERT INTO Client (adresse, ville, code_postal, email, mot_de_passe) VALUES
('12 rue de la Paix', 'Paris', '75001', 'client1@example.com', 'motdepasse1'),
('34 avenue des Champs', 'Lyon', '69002', 'client2@example.com', 'motdepasse2'),
('56 boulevard Saint-Michel', 'Marseille', '13001', 'client3@example.com', 'motdepasse3'),
('78 rue Victor Hugo', 'Toulouse', '31000', 'client4@example.com', 'motdepasse4'),
('90 avenue de la Republique', 'Nice', '06000', 'client5@example.com', 'motdepasse5');

INSERT INTO Commande (statut, montant_total, adresse, ville, code_postal, id_client) VALUES
('en cours', 23.50, '12 rue de la Paix', 'Paris', '75001', 1),
('livree', 89.99, '34 avenue des Champs', 'Lyon', '69002', 2),
('en cours', 149.50, '56 boulevard Saint-Michel', 'Marseille', '13001', 3),
('annulee', 59.99, '78 rue Victor Hugo', 'Toulouse', '31000', 4),
('livree', 39.99, '90 avenue de la Republique', 'Nice', '06000', 5),
('en cours', 72.50, '12 rue de la Paix', 'Paris', '75001', 1),
('livree', 119.00, '34 avenue des Champs', 'Lyon', '69002', 2),
('en cours', 25.00, '56 boulevard Saint-Michel', 'Marseille', '13001', 3),
('annulee', 199.00, '78 rue Victor Hugo', 'Toulouse', '31000', 4),
('livree', 54.50, '90 avenue de la Republique', 'Nice', '06000', 5);

INSERT INTO Contenir (id_produit, id_commande, quantite, prix_unitaire, sous_total) VALUES

(1, 1, 2, 3.50, 7.00),
(2, 1, 4, 5.00, 20.00),
(3, 1, 1, 2.50, 2.50),

(6, 2, 1, 699.99, 699.99),
(7, 2, 1, 89.99, 89.99),

(11, 3, 2, 19.99, 39.98),
(12, 3, 1, 49.99, 49.99),
(13, 3, 1, 39.99, 39.99),

(14, 4, 1, 59.99, 59.99),

(15, 5, 1, 79.99, 79.99),

(3, 6, 5, 2.80, 14.00),
(4, 6, 3, 1.50, 4.50),
(5, 6, 2, 4.20, 8.40),

(8, 7, 1, 1299.00, 1299.00),
(9, 7, 1, 399.00, 399.00),

(1, 8, 1, 3.50, 3.50),
(2, 8, 2, 5.00, 10.00),
(3, 8, 1, 2.80, 2.80),

(10, 9, 1, 199.00, 199.00),

(12, 10, 1, 49.99, 49.99),
(13, 10, 1, 39.99, 39.99),
(14, 10, 1, 59.99, 59.99);

INSERT INTO Administrateur (nom_utilisateur, email, mot_de_passe, superadmin) VALUES
('admin1', 'admin1@example.com', 'motdepasse1', FALSE),
('superadmin', 'superadmin@example.com', 'motdepasse2', TRUE);