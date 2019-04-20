CREATE TABLE `scores` (
  `username` varchar(30) NOT NULL,
  `score` int(11) NOT NULL,
  `lasttime` datetime NOT NULL,
  `foto` text NOT NULL,
  PRIMARY KEY ('username')
)
