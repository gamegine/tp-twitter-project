
CREATE TABLE `twitt` (
  `id` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `txt` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
ALTER TABLE `twitt`ADD PRIMARY KEY (`id`);
ALTER TABLE `twitt` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
