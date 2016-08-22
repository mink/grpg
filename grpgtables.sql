-- phpMyAdmin SQL Dump
-- version 2.11.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 20, 2007 at 04:37 PM
-- Server version: 5.0.45
-- PHP Version: 5.2.4

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Database: `myneocorp`
--

-- --------------------------------------------------------

--
-- Table structure for table `5050game`
--

CREATE TABLE `5050game` (
  `owner` int(10) NOT NULL default '0',
  `amount` bigint(20) NOT NULL default '0',
  `id` int(10) NOT NULL auto_increment,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

-- --------------------------------------------------------

--
-- Table structure for table `ads`
--

CREATE TABLE `ads` (
  `when` int(20) NOT NULL,
  `poster` int(10) NOT NULL,
  `title` varchar(100) collate latin1_general_ci NOT NULL,
  `message` text collate latin1_general_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `bans`
--

CREATE TABLE `bans` (
  `id` int(10) NOT NULL default '0',
  `reason` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `carlot`
--

CREATE TABLE `carlot` (
  `id` int(20) NOT NULL auto_increment,
  `name` varchar(30) collate latin1_general_ci NOT NULL,
  `image` varchar(40) collate latin1_general_ci NOT NULL,
  `description` text collate latin1_general_ci NOT NULL,
  `cost` int(20) NOT NULL,
  `buyable` int(2) NOT NULL default '1',
  `basemod` int(20) NOT NULL,
  `level` int(5) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Table structure for table `cars`
--

CREATE TABLE `cars` (
  `userid` int(20) NOT NULL,
  `carid` int(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `chat`
--

CREATE TABLE `chat` (
  `chat_id` int(11) NOT NULL auto_increment,
  `chat_name` varchar(64) default NULL,
  `start_time` datetime default NULL,
  PRIMARY KEY  (`chat_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `cities`
--

CREATE TABLE `cities` (
  `id` int(3) NOT NULL auto_increment,
  `name` varchar(75) NOT NULL default '',
  `levelreq` int(3) NOT NULL default '0',
  `description` text NOT NULL,
  `landleft` int(20) NOT NULL,
  `landprice` int(20) NOT NULL,
  PRIMARY KEY  (`id`),
  FULLTEXT KEY `name` (`name`),
  FULLTEXT KEY `name_2` (`name`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

-- --------------------------------------------------------

--
-- Table structure for table `crimes`
--

CREATE TABLE `crimes` (
  `id` int(20) NOT NULL auto_increment,
  `name` varchar(40) collate latin1_general_ci NOT NULL,
  `nerve` int(6) NOT NULL,
  `stext` text collate latin1_general_ci NOT NULL,
  `ftext` text collate latin1_general_ci NOT NULL,
  `ctext` text collate latin1_general_ci NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=12 ;

-- --------------------------------------------------------

--
-- Table structure for table `effects`
--

CREATE TABLE `effects` (
  `userid` int(20) NOT NULL,
  `effect` varchar(40) collate latin1_general_ci NOT NULL,
  `timeleft` int(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` int(10) NOT NULL auto_increment,
  `to` int(10) NOT NULL,
  `timesent` int(20) NOT NULL,
  `text` text collate latin1_general_ci NOT NULL,
  `viewed` tinyint(1) NOT NULL default '1',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=143 ;

-- --------------------------------------------------------

--
-- Table structure for table `ganginvites`
--

CREATE TABLE `ganginvites` (
  `username` varchar(75) NOT NULL default '',
  `gangid` int(5) NOT NULL default '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ganglog`
--

CREATE TABLE `ganglog` (
  `id` int(30) NOT NULL auto_increment,
  `timestamp` int(20) NOT NULL default '0',
  `gangid` int(20) NOT NULL default '0',
  `attacker` int(20) NOT NULL default '0',
  `defender` int(20) NOT NULL default '0',
  `winner` int(20) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

-- --------------------------------------------------------

--
-- Table structure for table `gangs`
--

CREATE TABLE `gangs` (
  `id` int(10) NOT NULL auto_increment,
  `leader` varchar(75) NOT NULL default '',
  `description` text NOT NULL,
  `name` varchar(75) NOT NULL default '',
  `tag` char(3) NOT NULL default '',
  `exp` int(20) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

-- --------------------------------------------------------

--
-- Table structure for table `growing`
--

CREATE TABLE `growing` (
  `id` int(20) NOT NULL auto_increment,
  `userid` int(20) NOT NULL,
  `cityid` int(20) NOT NULL,
  `amount` int(20) NOT NULL,
  `croptype` varchar(75) collate latin1_general_ci NOT NULL,
  `cropamount` int(20) NOT NULL,
  `timeplanted` int(20) NOT NULL,
  `timedone` int(20) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=8 ;

-- --------------------------------------------------------

--
-- Table structure for table `grpgusers`
--

CREATE TABLE `grpgusers` (
  `id` int(10) NOT NULL auto_increment,
  `username` varchar(75) NOT NULL default '',
  `password` varchar(75) NOT NULL default '',
  `exp` int(30) NOT NULL default '0',
  `money` int(30) NOT NULL default '1000',
  `bank` int(30) NOT NULL default '0',
  `whichbank` int(2) NOT NULL default '0',
  `hp` int(10) NOT NULL default '50',
  `energy` int(10) NOT NULL default '10',
  `nerve` int(10) NOT NULL default '5',
  `workexp` int(10) NOT NULL default '0',
  `strength` int(10) NOT NULL default '10',
  `defense` int(10) NOT NULL default '10',
  `speed` int(10) NOT NULL default '10',
  `battlewon` int(10) NOT NULL default '0',
  `battlelost` int(10) NOT NULL default '0',
  `battlemoney` int(20) NOT NULL default '0',
  `crimesucceeded` int(10) NOT NULL default '0',
  `crimefailed` int(10) NOT NULL default '0',
  `crimemoney` int(20) NOT NULL default '0',
  `points` bigint(20) NOT NULL default '0',
  `rmdays` tinyint(5) NOT NULL default '0',
  `signuptime` int(20) NOT NULL default '0',
  `lastactive` int(20) NOT NULL default '0',
  `awake` int(5) NOT NULL default '100',
  `email` varchar(75) NOT NULL default '',
  `jail` int(1) NOT NULL default '0',
  `hospital` int(1) NOT NULL default '0',
  `hwho` varchar(30) NOT NULL,
  `hwhen` varchar(30) NOT NULL,
  `hhow` varchar(30) NOT NULL,
  `house` int(3) NOT NULL default '0',
  `gang` int(10) NOT NULL default '0',
  `quote` text NOT NULL,
  `avatar` varchar(50) NOT NULL,
  `city` int(3) NOT NULL default '1',
  `admin` int(1) NOT NULL default '0',
  `searchdowntown` int(3) NOT NULL default '100',
  `job` int(5) NOT NULL,
  `ip` int(20) NOT NULL,
  `eqweapon` int(20) NOT NULL,
  `eqarmor` int(20) NOT NULL,
  `potseeds` int(20) NOT NULL,
  `marijuana` int(20) NOT NULL,
  `cocaine` int(20) NOT NULL,
  `style` int(3) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=98 ;

-- --------------------------------------------------------

--
-- Table structure for table `houses`
--

CREATE TABLE `houses` (
  `id` int(3) NOT NULL auto_increment,
  `name` varchar(75) NOT NULL default '',
  `awake` int(10) NOT NULL default '0',
  `cost` int(15) NOT NULL default '0',
  KEY `id` (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

-- --------------------------------------------------------

--
-- Table structure for table `inventory`
--

CREATE TABLE `inventory` (
  `userid` int(20) NOT NULL,
  `itemid` int(20) NOT NULL,
  `quantity` int(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `id` int(7) NOT NULL auto_increment,
  `itemname` varchar(75) NOT NULL default '',
  `description` text NOT NULL,
  `cost` bigint(15) NOT NULL default '0',
  `image` varchar(100) NOT NULL default '',
  `offense` int(20) NOT NULL default '0',
  `defense` int(20) NOT NULL default '0',
  `heal` int(10) NOT NULL default '0',
  `buyable` int(1) NOT NULL default '0',
  `level` int(5) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` int(4) NOT NULL auto_increment,
  `name` varchar(50) collate latin1_general_ci NOT NULL,
  `money` int(10) NOT NULL,
  `strength` int(10) NOT NULL,
  `defense` int(10) NOT NULL,
  `speed` int(10) NOT NULL,
  `level` int(5) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Table structure for table `land`
--

CREATE TABLE `land` (
  `userid` int(20) NOT NULL,
  `amount` int(20) NOT NULL,
  `city` int(5) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `lottery`
--

CREATE TABLE `lottery` (
  `userid` int(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE `message` (
  `message_id` int(11) NOT NULL auto_increment,
  `chat_id` int(11) NOT NULL default '0',
  `user_id` int(11) NOT NULL default '0',
  `user_name` varchar(64) default NULL,
  `message` text,
  `post_time` datetime default NULL,
  PRIMARY KEY  (`message_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=69 ;

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `id` int(10) NOT NULL,
  `timeposted` int(20) NOT NULL,
  `body` text collate latin1_general_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `parts`
--

CREATE TABLE `parts` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(75) collate latin1_general_ci NOT NULL,
  `description` text collate latin1_general_ci NOT NULL,
  `mod` int(10) NOT NULL,
  `cost` int(40) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `pms`
--

CREATE TABLE `pms` (
  `id` int(50) NOT NULL auto_increment,
  `to` varchar(75) NOT NULL default '',
  `from` varchar(75) NOT NULL default '',
  `timesent` int(20) NOT NULL default '0',
  `subject` varchar(75) NOT NULL default '',
  `msgtext` text NOT NULL,
  `viewed` tinyint(1) NOT NULL default '1',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=146 ;

-- --------------------------------------------------------

--
-- Table structure for table `pointsmarket`
--

CREATE TABLE `pointsmarket` (
  `owner` int(10) NOT NULL default '0',
  `amount` bigint(20) NOT NULL default '0',
  `price` bigint(20) NOT NULL default '0',
  `id` int(10) NOT NULL auto_increment,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

-- --------------------------------------------------------

--
-- Table structure for table `referrals`
--

CREATE TABLE `referrals` (
  `id` int(30) NOT NULL auto_increment,
  `when` int(20) NOT NULL,
  `referrer` int(20) NOT NULL,
  `referred` varchar(20) collate latin1_general_ci NOT NULL,
  `credited` int(2) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=6 ;

-- --------------------------------------------------------

--
-- Table structure for table `school`
--

CREATE TABLE `school` (
  `id` int(11) NOT NULL auto_increment,
  `coursename` varchar(75) collate latin1_general_ci NOT NULL,
  `duration` int(11) NOT NULL,
  `cost` int(11) NOT NULL,
  `strength` int(11) NOT NULL,
  `defense` int(11) NOT NULL,
  `speed` int(11) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=4 ;

-- --------------------------------------------------------

--
-- Table structure for table `serverconfig`
--

CREATE TABLE `serverconfig` (
  `radio` varchar(5) NOT NULL default '',
  `serverdown` text NOT NULL,
  `messagefromadmin` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `shares`
--

CREATE TABLE `shares` (
  `userid` int(10) NOT NULL,
  `companyid` int(10) NOT NULL,
  `amount` int(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `shoutbox`
--

CREATE TABLE `shoutbox` (
  `id` int(10) NOT NULL auto_increment,
  `name` varchar(30) collate latin1_general_ci NOT NULL,
  `shouttext` text collate latin1_general_ci NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=4 ;

-- --------------------------------------------------------

--
-- Table structure for table `spylog`
--

CREATE TABLE `spylog` (
  `id` int(10) NOT NULL default '0',
  `spyid` int(10) NOT NULL default '0',
  `strength` int(10) NOT NULL default '0',
  `defense` int(10) NOT NULL default '0',
  `speed` int(10) NOT NULL default '0',
  `bank` int(30) NOT NULL default '0',
  `points` int(20) NOT NULL default '0',
  `age` int(20) NOT NULL default '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `stocks`
--

CREATE TABLE `stocks` (
  `id` int(10) NOT NULL auto_increment,
  `company_name` varchar(75) collate latin1_general_ci NOT NULL,
  `cost` int(10) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=12 ;

-- --------------------------------------------------------

--
-- Table structure for table `styles`
--

CREATE TABLE `styles` (
  `style` int(10) NOT NULL,
  `colornum` int(5) NOT NULL,
  `value` varchar(10) collate latin1_general_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `todo`
--

CREATE TABLE `todo` (
  `id` int(10) NOT NULL auto_increment,
  `when` varchar(80) collate latin1_general_ci NOT NULL,
  `text` text collate latin1_general_ci NOT NULL,
  `status` varchar(80) collate latin1_general_ci NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Table structure for table `updates`
--

CREATE TABLE `updates` (
  `name` varchar(75) NOT NULL default '',
  `lastdone` int(20) NOT NULL default '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;








--
-- Database: `myneocorp`
--

--
-- Dumping data for table `carlot`
--

INSERT INTO `carlot` (`id`, `name`, `image`, `description`, `cost`, `buyable`, `basemod`, `level`) VALUES
(1, 'Pacer', 'images/noimage.png', 'A beat up piece of crap. It doesn''t look like it will run well and is likely to break down at any minute, but those flames on the blue paint job lure you towards it anyway.', 1250, 1, 550, 0),
(2, 'Geo Storm', 'images/noimage.png', 'A small car, but at least it runs.', 1575, 1, 650, 0);

--
-- Dumping data for table `cities`
--

INSERT INTO `cities` (`id`, `name`, `levelreq`, `description`, `landleft`, `landprice`) VALUES
(1, 'New Jersey', 0, 'Welcome to New Jersey! New Jersey is where all major mobsters first got their start. Just take a look at Larry "Loose Legs" LaFleur! He started out stealing from granny''s and hitting Small Stores in this very town, and now he''s lifting beetles. Small world eh?', 0, 5),
(2, 'Los Angeles', 5, 'Los Angeles is best known for it''s great deals on cars, but L.A. is also home to most anything else you can find in the other cities.', 62, 30000),
(3, 'asdfasdfasdf', 0, '', 0, 0),
(4, 'asdfasdfasdf', 0, '', 0, 0),
(5, 'New York, New York', 0, 'lulzorcake', 0, 0);

--
-- Dumping data for table `crimes`
--

INSERT INTO `crimes` (`id`, `name`, `nerve`, `stext`, `ftext`, `ctext`) VALUES
(1, 'Pickpocket Granny', 1, 'You slowly sneak up on a random granny. You get up right behind her and jack her purse. Congratulations, you just stole a poor old lady''s bingo money. I hope you are proud of yourself.^You walk right up to an old lady in the park and beat her over the head with a rock. After she passes out and falls on the ground you reach into her pocket and grab out a wad of cash. If you were looking for an impressive story to tell the guys back at the hideout, you may want to try another crime.^At your hideout you put on a disguise consisting of a yellow suit and a white mustache and wig. You grab a random blunt object on the way out and head to the public library. You beat an old lady over the head with the candlestick you grabbed. You steal her money and are just leaving the library as a group of oddly dressed detectives walk in.', 'You slowly sneak up on a random granny. You get up right behind her and attempt to steal her purse by bumping into her and making it look like an accident while you reach into her pocket. Unfortunately for you, she notices. She tells you that if you wanted to get close to her, all you had to do was ask.  20 minutes later you sulk back into your hideout. It is going to take a long time to get the taste of prune juice out of your mouth.^You walk right up to an old lady in the park with a rock in your hand. As you are about to hit the old lady in the head and steal her money, you see someone else run up right behind the old lady and beat her in the head with their own rock. You contemplate the odds of such an occurrence the entire way back to the hideout.', 'At your hideout you put on a disguise consisting of a yellow suit and a white mustache and wig. You grab a random blunt object on the way out and head to the public library. You beat an old lady over the head with the candlestick you grabbed. You steal her money and walk towards the door. You are about to make it out with your hard earned money when a a stunning woman dressed in red points at you and exclaims "It was him with the candlestick in the library!". The cops apprehend you.'),
(2, 'Shoplift Small Store', 2, '', '', ''),
(3, 'Shoplift Electronics Store', 3, '', '', ''),
(4, 'Shoplift Jewelry Store', 4, '', '', ''),
(5, 'Lottery Scam', 5, '', '', ''),
(6, 'Rob A House', 10, '', '', ''),
(7, 'Insurance Scam', 12, '', '', ''),
(8, 'Drug Deal', 15, '', '', ''),
(9, 'Steal A VW Beetle', 20, '', '', ''),
(10, 'Steal A Mercedes C320', 25, '', '', '');

--
-- Dumping data for table `houses`
--

INSERT INTO `houses` (`id`, `name`, `awake`, `cost`) VALUES
(1, 'Cardboard Box', 200, 7500),
(2, 'Small Caravan', 350, 25000),
(3, 'Medium Caravan', 550, 75000),
(4, 'Large Caravan', 800, 225000),
(5, 'Small House', 1100, 1250000),
(6, 'Medium House', 1450, 5000000),
(7, 'Large House', 1850, 12500000),
(8, 'Small Mansion', 2300, 27500000),
(9, 'Medium Mansion', 2800, 65000000),
(10, 'Large Mansion', 3250, 140000000);

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`id`, `itemname`, `description`, `cost`, `image`, `offense`, `defense`, `heal`, `buyable`, `level`) VALUES
(1, 'Baseball Bat', 'It''s a baseball bat. You could use it to hit baseballs. Sure... baseballs.', 1000, 'images/bat.png', 10, 0, 0, 1, 0),
(2, 'Radio GRPG Shirt', 'A shirt won in a Radio GRPG Contest!', 0, 'images/rgrpgpwnz.png', 0, 10, 0, 0, 0),
(3, 'Brass Knuckles', 'A four fingered ring that just looks nice. Yep, it''s just decoration...', 2000, 'images/brassknuckles.jpg', 15, 0, 0, 1, 0),
(4, 'Switch Blade', 'This switch blade is of the finest quality, and can be used to... who am I kidding, you''re just going to go stab someone with it anyway, so I promise its sharp.', 4000, 'images/switchblade.jpg', 20, 0, 0, 1, 0),
(5, 'Katana', 'Its a sword.', 10000, 'images/katana.jpg', 25, 0, 0, 1, 0),
(6, 'Pistol', 'Standard 9 mm', 20000, 'images/pistol.jpg', 30, 0, 0, 1, 0),
(7, 'SMG', 'It shoots bullets... A lot of bullets.', 50000, 'images/smg.jpg', 35, 0, 0, 1, 0),
(8, 'Handcannon', 'A Handcannon bought from the RM store.', 0, 'images/handcannon.png', 70, 0, 0, 0, 0),
(9, 'Full Plate Armour', 'Full plate armour bought in the RM store.', 0, 'images/platearm.png', 0, 70, 0, 0, 0),
(10, 'Light Bullet Proof Vest', 'A lighter bullet proof vest.', 1000, 'http://www.army-technology.com/contractor_images/rabintex/3-bulletproof-vest.jpg', 0, 10, 0, 1, 0),
(11, 'Martini', 'An armor bought from the RM store.', 0, 'images/martini.png', 0, 70, 0, 0, 0),
(12, 'Battle Ready Martini', 'A weapon bought from the RM store.', 0, 'images/martini.png', 70, 0, 0, 0, 0),
(14, 'Awake Pill', 'A pill that refills your awake.', 0, 'http://www.trimp3.com/news/pill.jpg', 0, 0, 0, 0, 0),
(15, 'Swat Vest', 'Featured item of the month for September 2007', 0, 'images/noimage.png', 0, 100, 0, 0, 0);

--
-- Dumping data for table `jobs`
--

INSERT INTO `jobs` (`id`, `name`, `money`, `strength`, `defense`, `speed`, `level`) VALUES
(1, 'Live Crash Test Dummy', 100, 0, 30, 0, 0),
(2, 'Bouncer at BK Lounge', 500, 400, 400, 200, 0);

--
-- Dumping data for table `parts`
--


--
-- Dumping data for table `serverconfig`
--

INSERT INTO `serverconfig` (`radio`, `serverdown`, `messagefromadmin`) VALUES
('off', '', 'sdfsdf^dsfsdf');

--
-- Dumping data for table `stocks`
--

INSERT INTO `stocks` (`id`, `company_name`, `cost`) VALUES
(1, 'The Generica Daily', 57),
(2, 'Crazy Rileys Armour Emporium', 92),
(3, 'Clocks and Glocks', 4),
(4, 'REAG', 404),
(5, 'Games ''R'' Us', 15),
(6, 'MyNeoCorp Productions', 5),
(7, 'Generica Telecoms', 68),
(8, 'Generica Gas', 2936),
(9, 'Bank of Generica', 250),
(10, 'Ground TV', 310),
(11, 'MicroHard', 39999955);

--
-- Dumping data for table `styles`
--

INSERT INTO `styles` (`style`, `colornum`, `value`) VALUES
(1, 0, '#333'),
(1, 1, '#ddd'),
(1, 2, '#444'),
(1, 3, '#ffffff'),
(1, 4, '#111'),
(1, 5, '#000000'),
(1, 6, '#666666'),
(1, 7, '#FFFF00'),
(1, 8, '#1E1E1E'),
(1, 9, '#ffcc00'),
(1, 10, '#444'),
(1, 11, '#000000'),
(1, 12, '#FFFF33'),
(2, 0, '#546D8E'),
(2, 1, '#ddd'),
(2, 2, '#444'),
(2, 3, '#ffffff'),
(2, 4, '#709AD1'),
(2, 5, '#B4B4B4'),
(2, 6, '#666666'),
(2, 7, '#FFFF00'),
(2, 8, '#B4B4B4'),
(2, 9, '#ffcc00'),
(2, 10, '000000'),
(2, 11, '#709AD1	'),
(2, 12, '#FFFF33');

--
-- Dumping data for table `updates`
--

INSERT INTO `updates` (`name`, `lastdone`) VALUES
('trevor', 1192684410),
('hospital', 1192684653),
('rollover', 1182549644);

-- 
-- Table structure for table `gangarmory`
-- 

CREATE TABLE `gangarmory` (
  `id` int(20) NOT NULL auto_increment,
  `itemid` int(20) NOT NULL,
  `gangid` int(20) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=36 ;

-- --------------------------------------------------------

-- 
-- Table structure for table `itemmarket`
-- 

CREATE TABLE `itemmarket` (
  `id` int(20) NOT NULL auto_increment,
  `itemid` int(20) NOT NULL,
  `userid` int(20) NOT NULL,
  `cost` int(20) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=122 ;
