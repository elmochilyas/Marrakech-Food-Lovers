CREATE DATABASE maroc_food_lovers ;

USE maroc_food_lovers ; 

-- Table users 
CREATE TABLE users (
    id          INT AUTO_INCREMENT PRIMARY KEY,
    username    VARCHAR(50)  NOT NULL,
    email       VARCHAR(100) NOT NULL UNIQUE,
    password    VARCHAR(255) NOT NULL,
    created_at  TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Table categories
CREATE TABLE categories (
    id    INT AUTO_INCREMENT PRIMARY KEY,
    name  VARCHAR(50) NOT NULL
);

-- Table recipes
CREATE TABLE recipes (
    id           INT AUTO_INCREMENT PRIMARY KEY,
    user_id      INT NOT NULL,
    category_id  INT,
    title        VARCHAR(100) NOT NULL,
    ingredients  TEXT NOT NULL,
    instructions TEXT NOT NULL,
    prep_time    INT,                  
    cook_time    INT,                  
    portions     INT,
    created_at   TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id)     REFERENCES users(id)      ON DELETE CASCADE,
    FOREIGN KEY (category_id) REFERENCES categories(id) ON DELETE SET NULL
);

-- Seed data: categories
INSERT INTO categories (name) VALUES 
('Entrées'), 
('Plats'), 
('Desserts'), 
('Boissons');

-- Seed data: users (password is 'Password123' for all)
INSERT INTO users (username, email, password) VALUES
('fatima',  'fatima@test.com',  '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi'),
('youssef', 'youssef@test.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi'),
('leila',   'leila@test.com',   '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi');

-- Seed data: recipes (10 recipes across categories)
INSERT INTO recipes (user_id, category_id, title, ingredients, instructions, prep_time, cook_time, portions) VALUES
(1, 1, 'Salade Marocaine', 'Tomates, concombres, olives, oignons, huile d olive, citron, sel, coriandre', 'Mélanger tous les légumes coupés, ajouter l huile d olive et le citron, assaisonner.', 15, 0, 4),
(1, 2, 'Tajine Poulet', 'Poulet, olives, citron confit, oignons, épices, huile d olive, eau', 'Faire revenir le poulet, ajouter les oignons et épices, laisser mijoter 45 min.', 20, 45, 6),
(1, 3, 'Chebakia', 'Farine, amandes, miel, huile, épices', 'Préparer la pâte, former les formes, fryre, tremper dans le miel.', 40, 20, 8),
(2, 1, 'Harira', 'Lentilles, pois chiches, tomates, oignons, épices, Herbs', 'Cuire les légumineuses avec les épices pendant 1h.', 15, 60, 6),
(2, 2, 'Couscous Royal', 'Semoule, viande, légumes, épices, raisins secs', 'Préparer la semoule, cooker la viande et légumes, servir ensemble.', 30, 90, 8),
(2, 4, 'Mint Tea', 'Thé vert, menthe fraîche, sucre, eau', 'Infuser le thé, ajouter la menthe et le sucre.', 5, 0, 4),
(3, 2, 'Rfissa', 'Poulet, lentils, msemen, oignons, épices', 'Cuire le poulet et lentils, servir avec msemen.', 25, 60, 6),
(3, 3, 'Baklava', 'Pâte filo, amandes, miel, beurre', ' assembler les couches, bake until golden, add miel.', 30, 30, 10),
(3, 1, 'Zaalouk', 'Aubergines, tomates, ail, huile d olive, épices', 'Griller les aubergines, mixer avec tomates et épices.', 20, 15, 4),
(3, 4, 'Jus d Orange Frais', 'Oranges fraiches, sucre (optional)', 'Presser les oranges, servir immédiatement.', 5, 0, 2);