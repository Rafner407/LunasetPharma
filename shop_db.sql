-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 03, 2022 at 01:54 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shop_db`
--


CREATE TABLE `cart` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` int(100) NOT NULL,
  `quantity` int(100) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


CREATE TABLE `message` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `number` varchar(12) NOT NULL,
  `message` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


CREATE TABLE `orders` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `number` varchar(12) NOT NULL,
  `email` varchar(100) NOT NULL,
  `method` varchar(50) NOT NULL,
  `address` varchar(500) NOT NULL,
  `total_products` varchar(1000) NOT NULL,
  `total_price` int(100) NOT NULL,
  `placed_on` varchar(50) NOT NULL,
  `payment_status` varchar(20) NOT NULL DEFAULT 'pendente'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


CREATE TABLE `products` (
  `id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` int(100) NOT NULL,
  `image` varchar(100) NOT NULL,
  `descricao` varchar(1000) NOT NULL,
  `id_categoria` int not null
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


CREATE TABLE `users` (
  `id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `user_type` varchar(20) NOT NULL DEFAULT 'user',
  `image` varchar (50) NOT NULL,
  `alergia` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `categoria`(
	`id` int PRIMARY KEY AUTO_INCREMENT not null,
  `categoria` varchar (50)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);


ALTER TABLE `message`
  ADD PRIMARY KEY (`id`);


ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);


ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);


ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);


ALTER TABLE `cart`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;


ALTER TABLE `message`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;


ALTER TABLE `orders`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;


ALTER TABLE `products`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT;

ALTER TABLE `users` CHANGE `image` `image` VARCHAR(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'profile.jpg';


ALTER TABLE `users`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT;
COMMIT;

INSERT INTO products(name, price, image, descricao, id_categoria) VALUES ('TYLENOL', '7', 'tylenol.jpg', 'O Tylenol 500mg ?? um analg??sico e antit??rmico com o princ??pio ativo paracetamol e ?? indicado para a redu????o da febre e al??vio tempor??rio da dor leve a moderada, como aquelas associadas a resfriados comuns, dor de cabe??a, dor no corpo, dores musculares, dor de dente, dor nas costas, dores leves associadas a artrites e c??licas menstruais. A embalagem cont??m 2 comprimidos revestidos de libera????o imediata contendo 500mg de paracetamol cada. Dose = 1 ou 2 comprimidos. Uso adulto e pedi??trico acima de 12 anos.', '1'), 
('DORFLEX', '5', 'dorflex.jpg', 'Dorflex age na dor e relaxa a tens??o muscular causada pela m?? postura e movimentos repetitivos. Uma potente combina????o de analg??sico e relaxante muscular dispon??vel em vers??es de 10, 24, 36, 50 comprimidos e gotas.', '1'),
('LORATADINA', '8', 'loratadina.jpg', 'A loratadina ?? um rem??dio antial??rgico usado no al??vio dos sintomas de rinite al??rgica como coceira nasal, tosse al??rgica, coriza, espirros, ardor e coceira nos olhos.', '1'),
('PARACETAMOL', '6', 'paracetamol.jpg', 'O Paracetamol ?? indicado em adultos para a redu????o da febre e para o al??vio tempor??rio de dores leves a moderadas, tais como: dores associadas a resfriados comuns, dor de cabe??a, dor no corpo, dor de dente, dor nas costas, dores musculares, dores leves associadas a artrites e c??licas menstruais.', '1'),
('DIPIRONA', '15', 'dipirona.jpg', 'Este medicamento ?? indicado como antit??rmico (para febre) e analg??sico (para dor).', '1'),
('SIMETICONA', '15', 'simeticona.jpg', 'Simeticona atua no est??mago e no intestino, diminuindo a tens??o superficial dos l??quidos digestivos, levando ao rompimento das bolhas(gases).', '1'),
('SHAMPOO INFANTIL', '23', 'shampooi.jpg', '???Limpa suavemente e protege os cabelos e o couro cabeludo.
???Deve ser aplicado por um adulto ou sob sua supervis??o, massageando os cabelos molhados do beb??.
???N??o usar se o couro cabeludo estiver ferido ou irritado.
???F??rmula chega de l??grimas, n??o irrita os olhos.
???Tem pH fisiol??gico, ?? hipoalerg??nico e livre de corantes, parabenos e sulfatos.', '3'),
('PROTETOR SOLAR', '64', 'protetorsolar.jpg', '???Protetor solar facial com cor - Tom 2 Claro.
???N??o obstrui os poros.
???Efeito mate e toque seco.
???Textura foundant e efeito base.
???Ajuda a prevenir o envelhecimento precoce da pele.', '2'),
('SABONETE EM BARRA', '5', 'sabonetebarra.jpg', '???Nutre a pele enquanto remove a sujeira do dia a dia. ???Deixa a sua pele macia, bem cuidada e saud??vel. ???Cont??m pH neutro respeitando a microflora da pele. ???Agrad??vel fragr??ncia e frescor da erva doce. ???Dermatologicamente recomendado.', '2');

INSERT INTO categoria(categoria) VALUES ('medicamentos'), ('cosm??ticos'), ('infantil'), ('vitaminas e suplementos');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
