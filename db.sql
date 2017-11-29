
CREATE TABLE `twitt` (
  `id` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `txt` text NOT NULL
);
CREATE TABLE `user` (
  `uid` int(11) NOT NULL,
  `name` varchar(32) NOT NULL,
  `mdp` varchar(64) NOT NULL
);
ALTER TABLE `twitt`ADD PRIMARY KEY (`id`);
ALTER TABLE `twitt` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
ALTER TABLE `user`ADD PRIMARY KEY (`uid`);
ALTER TABLE `user` MODIFY `uid` int(11) NOT NULL AUTO_INCREMENT;
