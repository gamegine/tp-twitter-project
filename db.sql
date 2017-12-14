
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
CREATE TABLE `like` (
  `id` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `mid` text NOT NULL
);
ALTER TABLE `twitt`ADD PRIMARY KEY (`id`);
ALTER TABLE `twitt` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
ALTER TABLE `user`ADD PRIMARY KEY (`uid`);
ALTER TABLE `user` MODIFY `uid` int(11) NOT NULL AUTO_INCREMENT;
ALTER TABLE `like`ADD PRIMARY KEY (`id`);
ALTER TABLE `like` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;


ALTER TABLE twitt ADD CONSTRAINT user FOREIGN KEY (uid) REFERENCES user(uid);
ALTER TABLE `like` ADD CONSTRAINT userlike FOREIGN KEY (uid) REFERENCES user(uid);
ALTER TABLE `like` ADD CONSTRAINT `msg_id` FOREIGN KEY (`mid`) REFERENCES `twitt`(`id`);
