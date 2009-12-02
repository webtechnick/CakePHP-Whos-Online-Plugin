--
-- Table structure for table `onlines`
--

CREATE TABLE `onlines` (
  `ip` int(11) unsigned NOT NULL,
  `url` varchar(255) default NULL,
  `modified` datetime NOT NULL,
  UNIQUE KEY `ip` (`ip`)
) ENGINE=MEMORY DEFAULT CHARSET=latin1;
