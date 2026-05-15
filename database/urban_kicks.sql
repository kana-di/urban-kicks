-- ============================================================
-- Urban Kicks
-- IMPORTANT : ne pas selectionner de base dans phpMyAdmin
-- Aller sur le serveur (racine) -> onglet SQL -> coller -> Executer
-- ============================================================

SET NAMES utf8mb4;

CREATE DATABASE IF NOT EXISTS `boutique` CHARACTER SET utf8mb4;
USE `boutique`;

-- ------------------------------------------------------------
-- utilisateurs
-- ------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `utilisateurs` (
  `id`          INT          NOT NULL AUTO_INCREMENT,
  `nom`         VARCHAR(100) NOT NULL,
  `email`       VARCHAR(150) NOT NULL,
  `password`    VARCHAR(255) NOT NULL,
  `address`     VARCHAR(255) DEFAULT NULL,
  `ville`       VARCHAR(100) DEFAULT NULL,
  `code_postal` VARCHAR(20)  DEFAULT NULL,
  `pays`        VARCHAR(100) DEFAULT 'Canada',
  `role`        VARCHAR(10)  NOT NULL DEFAULT 'client',
  `created_at`  TIMESTAMP    NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uq_email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ------------------------------------------------------------
-- produits
-- ------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `produits` (
  `product_id`  INT           NOT NULL AUTO_INCREMENT,
  `name`        VARCHAR(200)  NOT NULL,
  `description` TEXT,
  `price`       DECIMAL(10,2) NOT NULL,
  `stock`       INT           NOT NULL DEFAULT 10,
  `brand`       VARCHAR(100)  DEFAULT NULL,
  `image_url`   VARCHAR(500)  DEFAULT NULL,
  `created_at`  TIMESTAMP     NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ------------------------------------------------------------
-- panier
-- ------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `panier` (
  `id`          INT       NOT NULL AUTO_INCREMENT,
  `user_id`     INT       NOT NULL,
  `product_id`  INT       NOT NULL,
  `quantite`    INT       NOT NULL DEFAULT 1,
  `created_at`  TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uq_item` (`user_id`, `product_id`),
  FOREIGN KEY (`user_id`)    REFERENCES `utilisateurs`(`id`) ON DELETE CASCADE,
  FOREIGN KEY (`product_id`) REFERENCES `produits`(`product_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ------------------------------------------------------------
-- Produits de demonstration
-- ------------------------------------------------------------
INSERT IGNORE INTO `produits` (`name`, `description`, `price`, `stock`, `brand`, `image_url`) VALUES
('Air Force 1 07',
 'Le classique intemporel de Nike. Cuir premium, semelle Air cushion.',
 149.99, 15, 'Nike',
 '/dashboard/boutique/image/acceuil_image1.webp'),
('Air Jordan 1 Retro High OG',
 'Edition limitee coloris Chicago. Cuir et toile, finitions premium.',
 299.99, 5, 'Jordan',
 '/dashboard/boutique/image/image2.webp'),
('Yeezy Boost 350 V2',
 'Confort exceptionnel grace a la semelle Boost. Design iconique.',
 399.99, 3, 'Adidas',
 '/dashboard/boutique/image/image_backgro.jpeg');

-- ------------------------------------------------------------
-- Compte admin
-- Email    : admin@urbankicks.ca
-- Password : password
-- ------------------------------------------------------------
INSERT IGNORE INTO `utilisateurs` (`nom`, `email`, `password`, `role`) VALUES
('Admin', 'admin@urbankicks.ca',
 '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
 'admin');
