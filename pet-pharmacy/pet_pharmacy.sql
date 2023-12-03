CREATE TABLE `pharmacy_products` (
  `product_id` int(11) NOT NULL,
  `product_image` varchar(255) NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `product_price` decimal(10,2) NOT NULL,
  `product_description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


INSERT INTO `pharmacy_products` (`product_id`, `product_image`, `product_name`, `product_price`, `product_description`) VALUES
(1, 'uploads/pet_care.png', 'Test Product Edited', '100.00', 'Test description updated');


CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;



INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `password`, `phone`) VALUES
(1, 'Test', 'User', 'testuser@test.com', 'test123', '212-331-2121'),
(2, 'Admin', '', 'admin@petpharmacy.com', 'admin123', '');


ALTER TABLE `pharmacy_products`
  ADD PRIMARY KEY (`product_id`);


ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);




ALTER TABLE `pharmacy_products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;


ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

