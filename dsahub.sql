-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 17 Sep 2016 la 18:49
-- Versiune server: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `dsahub`
--

-- --------------------------------------------------------

--
-- Structura de tabel pentru tabelul `alumni`
--

CREATE TABLE IF NOT EXISTS `alumni` (
`alumn_id` int(11) NOT NULL,
  `user_id` int(10) DEFAULT NULL,
  `email` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `lastname` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `firstname` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `person` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `section` varchar(40) COLLATE latin1_general_ci NOT NULL DEFAULT 'others',
  `country` varchar(50) COLLATE latin1_general_ci DEFAULT NULL,
  `city` varchar(50) COLLATE latin1_general_ci DEFAULT NULL,
  `telephone` varchar(50) COLLATE latin1_general_ci DEFAULT NULL,
  `occupation_type` varchar(40) COLLATE latin1_general_ci DEFAULT NULL,
  `occupation` varchar(50) COLLATE latin1_general_ci DEFAULT NULL,
  `year_in` int(10) NOT NULL,
  `year_out` int(10) NOT NULL,
  `description` varchar(1000) COLLATE latin1_general_ci NOT NULL DEFAULT 'Keine Beschreibung wurde bis jetzt eingegeben...',
  `mailing_subscription` varchar(10) COLLATE latin1_general_ci NOT NULL DEFAULT 'NO',
  `contact_agree` varchar(40) COLLATE latin1_general_ci NOT NULL DEFAULT 'NO'
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Salvarea datelor din tabel `alumni`
--

INSERT INTO `alumni` (`alumn_id`, `user_id`, `email`, `lastname`, `firstname`, `person`, `section`, `country`, `city`, `telephone`, `occupation_type`, `occupation`, `year_in`, `year_out`, `description`, `mailing_subscription`, `contact_agree`) VALUES
(11, 2, 'andrei.bubeneck@yahoo.com', 'Bubeneck', 'Wilhelm Andrei', 'student', 'Real-Spezialklasse', 'DE', 'Muenchen', '0040726207227', 'Life, Physical, and Social Science', 'Student', 2012, 2016, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis sagittis cursus ante vitae aliquet. Vivamus congue pretium vestibulum. Suspendisse semper volutpat sapien a iaculis. Phasellus sem eros, ullamcorper in urna ac, cursus iaculis turpis. Aenean tristique pellentesque ante. Maecenas aliquam lectus turpis, id lobortis mi ullamcorper a. Nam consectetur ipsum sed elit feugiat consequat. Vivamus rhoncus viverra neque, et dapibus orci congue non. Duis vitae arcu ornare, finibus nisl euismod, pharetra enim. Duis tristique a nulla quis elementum. Vestibulum tempus dolor nec tempus tincidunt. Praesent aliquam augue posuere nisi lobortis gravida.', 'YES', 'YES'),
(12, 27, 'abc@abc.com', 'Trandafir', 'Anca', 'teacher', 'Informatik', 'RO', 'Bukarest', '', 'Education, Training, and Library', 'Lehrer', 2012, 2016, 'Keine Beschreibung wurde bis jetzt eingegeben...', 'YES', 'NO');

-- --------------------------------------------------------

--
-- Structura de tabel pentru tabelul `contactform`
--

CREATE TABLE IF NOT EXISTS `contactform` (
`ticketId` int(6) NOT NULL COMMENT 'starts at 100000',
  `surname` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `firstname` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `email` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `subject` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `message` varchar(100) COLLATE latin1_general_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=100010 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Salvarea datelor din tabel `contactform`
--

INSERT INTO `contactform` (`ticketId`, `surname`, `firstname`, `email`, `subject`, `message`) VALUES
(100000, 'Test', 'Test', 'Test', 'Test', 'Test'),
(100001, 'Bubeneck', 'Andrei', 'andrei.bubeneck@yahoo.com', 'Telefonnummer Kollege', 'Wie kann ich die Telefonnummer von Andreas OhligschlÃ¤ger (2005) erhalten? Vielen Dank!'),
(100002, 'Bubeneck', 'Andrei', 'andrei.bubeneck@yahoo.com', 'Telefonnummer Kollege', 'Wie kann ich die Telefonnummer von Andreas OhligschlÃ¤ger (2005) erhalten? Vielen Dank!'),
(100003, 'Manger', 'Oliver', 'oli@olima.de', 'Test', 'Testnachricht.'),
(100004, 'Tester', 'Testos', 'tester.testos@test.org', 'Testing', 'Hello there! I am a test!'),
(100005, 'Manger', 'Oliver', 'oli@olima.de', 'alles wird gut', 'blubb'),
(100006, 'Tester', 'Testy', 'tester.testy@test.com', 'Hello world!', 'Ich wollte Sie nur begruessen!'),
(100007, 'avzvfsdf', 'sdfvsdfv', 'daerbsfg@sfvsd.com', 'svsdfvaewr', 'svsgbnishvkjdsfdrvsndfkvjdsnh'),
(100008, 'aervatrb', 'aetbargba', 'acssdf@dfvsbtg.com', 'atdbnaijetlb', 'oidrsdlgjbsdbf'),
(100009, 'ds', 'sd', 'dsadasd@fsad.ro', 'dsd', 'sd');

-- --------------------------------------------------------

--
-- Structura de tabel pentru tabelul `events`
--

CREATE TABLE IF NOT EXISTS `events` (
`event_id` int(10) NOT NULL,
  `event_name` varchar(40) COLLATE latin1_general_ci NOT NULL,
  `event_start` varchar(40) COLLATE latin1_general_ci NOT NULL,
  `event_end` varchar(40) COLLATE latin1_general_ci NOT NULL,
  `event_place` varchar(40) COLLATE latin1_general_ci NOT NULL,
  `event_type` varchar(40) COLLATE latin1_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Structura de tabel pentru tabelul `groups`
--

CREATE TABLE IF NOT EXISTS `groups` (
`group_id` int(10) NOT NULL,
  `group_name` varchar(40) COLLATE latin1_general_ci NOT NULL,
  `group_description` varchar(1000) COLLATE latin1_general_ci NOT NULL DEFAULT 'Keine Beschreibung wurde bis jetzt eingegeben...'
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Salvarea datelor din tabel `groups`
--

INSERT INTO `groups` (`group_id`, `group_name`, `group_description`) VALUES
(4, 'Ankunft 2012', 'Diese ist eine Beschreibung'),
(5, 'Abgang 2016', 'Keine Beschreibung wurde bis jetzt eingegeben...'),
(6, 'Real-Spezialklasse', 'Keine Beschreibung wurde bis jetzt eingegeben...'),
(7, 'DE', 'Keine Beschreibung wurde bis jetzt eingegeben...'),
(8, 'Life, Physical, and Social Science', 'Keine Beschreibung wurde bis jetzt eingegeben...'),
(9, 'Muenchen', 'Keine Beschreibung wurde bis jetzt eingegeben...'),
(10, 'Chemiestudent', 'Keine Beschreibung wurde bis jetzt eingegeben...'),
(11, 'Informatik', 'Keine Beschreibung wurde bis jetzt eingegeben...'),
(12, 'RO', 'Keine Beschreibung wurde bis jetzt eingegeben...'),
(13, 'Education, Training, and Library', 'Keine Beschreibung wurde bis jetzt eingegeben...'),
(14, 'Bukarest', 'Keine Beschreibung wurde bis jetzt eingegeben...'),
(15, 'Lehrer', 'Keine Beschreibung wurde bis jetzt eingegeben...'),
(16, 'Student', 'Keine Beschreibung wurde bis jetzt eingegeben...'),
(17, 'Testgruppe', 'TEST'),
(18, 'Test2', 'dasdsvst');

-- --------------------------------------------------------

--
-- Structura de tabel pentru tabelul `int_alumni_groups`
--

CREATE TABLE IF NOT EXISTS `int_alumni_groups` (
`id` int(10) NOT NULL,
  `alumn_id` int(10) NOT NULL,
  `group_id` int(10) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Salvarea datelor din tabel `int_alumni_groups`
--

INSERT INTO `int_alumni_groups` (`id`, `alumn_id`, `group_id`) VALUES
(2, 11, 4),
(3, 11, 5),
(4, 11, 6),
(6, 11, 8),
(7, 11, 9),
(9, 12, 4),
(10, 12, 11),
(11, 12, 12),
(12, 12, 13),
(13, 12, 14),
(14, 12, 15),
(20, 11, 7),
(23, 11, 16),
(24, 11, 10),
(25, 11, 17),
(26, 11, 18);

-- --------------------------------------------------------

--
-- Structura de tabel pentru tabelul `int_events_gropus`
--

CREATE TABLE IF NOT EXISTS `int_events_gropus` (
`id` int(10) NOT NULL,
  `event_id` int(10) NOT NULL,
  `group_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Structura de tabel pentru tabelul `int_mails_groups`
--

CREATE TABLE IF NOT EXISTS `int_mails_groups` (
`id` int(10) NOT NULL,
  `group_id` int(10) NOT NULL,
  `mail_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Structura de tabel pentru tabelul `login_attempts`
--

CREATE TABLE IF NOT EXISTS `login_attempts` (
`attempt_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `time` varchar(30) CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Salvarea datelor din tabel `login_attempts`
--

INSERT INTO `login_attempts` (`attempt_id`, `user_id`, `time`) VALUES
(1, 26, '1464123413'),
(2, 2, '1473952888'),
(3, 2, '1474112017');

-- --------------------------------------------------------

--
-- Structura de tabel pentru tabelul `mails`
--

CREATE TABLE IF NOT EXISTS `mails` (
  `mail_id` int(10) NOT NULL,
  `subject` varchar(40) COLLATE latin1_general_ci NOT NULL,
  `message` varchar(200) COLLATE latin1_general_ci NOT NULL,
  `timing` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Structura de tabel pentru tabelul `members`
--

CREATE TABLE IF NOT EXISTS `members` (
`id` int(11) NOT NULL,
  `person` varchar(40) COLLATE latin1_general_ci NOT NULL,
  `lastname` varchar(40) COLLATE latin1_general_ci NOT NULL,
  `firstname` varchar(40) COLLATE latin1_general_ci NOT NULL,
  `username` varchar(40) COLLATE latin1_general_ci NOT NULL,
  `email` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `password` char(128) COLLATE latin1_general_ci NOT NULL,
  `salt` char(128) COLLATE latin1_general_ci NOT NULL,
  `access` varchar(30) COLLATE latin1_general_ci NOT NULL DEFAULT 'user'
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Salvarea datelor din tabel `members`
--

INSERT INTO `members` (`id`, `person`, `lastname`, `firstname`, `username`, `email`, `password`, `salt`, `access`) VALUES
(1, 'teacher', 'asd', 'dsad', 'Testy', 'test@example.com', '00807432eae173f652f2064bdca1b61b290b52d40e429a7d295d76a71084aa96c0233b82f1feac45529e0726559645acaed6f3ae58a286b9f075916ebf66cacc', 'f9aab579fc1b41ed0c44fe4ecdbfcdb4cb99b9023abb241a6db833288f4eea3c02f76e0d35204a8695077dcf81932aa59006423976224be0390395bae152d4ef', 'user'),
(2, 'student', 'Bubeneck', 'Wilhelm Andrei', 'AndreiChim', 'andrei.bubeneck@yahoo.com', 'ac1a7cecc76e9b6076594dfe796e68dd76b56b329288395887f4636862602dae8bef561e46490e531c1831548a126afea9a3dddb6650a62285af47d3333f34be', '5df3a5085f63326f7d505a8c21bbe8e16830b525f3fc11454f07f106337a774ac8642306a2e23dbff011fc33a9e8950747e6f25226a7405efd2d1b157d1aefd8', 'admin'),
(24, 'student', 'asdasd', 'sdasd', 'dum2@dum.dum', 'dum2@dum.dum', '76ffe848131b724161a54d56cfac87c83cd98a1121213c3a3743d9ca0c91cfa4d7910bec18d2b3fec532f3ca1f0025867b97a2a15efb7026d790f02bc60b69a1', '5f3b08eccc48b244d6492ee637c6271527a4350c8133ce4188828b5bb1dad4b282e8512fa78121bbe9cc042b800bf6003679a80b75e0a02b92622dc66d549e51', 'user'),
(25, 'teacher', 'sdfsdfdfsdf', 'sdfgdfxvxvs', 'dummy@olima.de', 'dummy@olima.de', 'f31a6a0e315b1574efaab0629c2eb750a9f74a0c5c2376465e035ceaa0358daef73a8e497af81a78a0d8be56052c19c758ed8d3a56780e1500dd9bef1dddbaab', '490d3bade3252cfeb4d1b3f08631fe6d73f4ab37cd60ba05dec9578737bf80501092387042ed7d5bb0e89f5b5990d519bdfa49746d1d566fe5ae1b427495d2e4', 'user'),
(26, 'student', 'Ionescu', 'Ionel', 'abcdefc@test.co.uk', 'abcdefc@test.co.uk', 'c373918cca27d101262c84e8109e29110156b459e537073a472756b5843e60a29b8fcf25f8f88f9064150a600bce1362732658e4907b46b1b114f3bda80cdeb5', 'f2e51405f297d298508ad031aba3155d5c9d8dd6e5bfd8c050f2f7dbb947634a8cf1cab3797db2fc83524edb9012f9c1b47e734393d0fca869e9558fa2e7e80e', 'user'),
(27, 'teacher', 'Trandafir', 'Anca', 'abc@abc.com', 'abc@abc.com', 'a86ec4bb3b8cff133412b9f5ddbee48309c92377b6af7626443a6a5fd03b30d058fbdc092afc8ce41cfc17b938d29cd990244d1566ec7a220026d70dc1713008', '325d23770a9cb3f82ed29fd5d0895d0426569b856f0781d464e30ae078fec80e4b0d500cb7f56e088727844c1558c2e02465954b9156ee77da9964553956e7c5', 'user');

-- --------------------------------------------------------

--
-- Structura de tabel pentru tabelul `registration_requests`
--

CREATE TABLE IF NOT EXISTS `registration_requests` (
`request_id` int(10) NOT NULL,
  `email` varchar(50) CHARACTER SET latin1 NOT NULL,
  `token` char(40) CHARACTER SET latin1 NOT NULL,
  `timestamp` int(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `alumni`
--
ALTER TABLE `alumni`
 ADD PRIMARY KEY (`alumn_id`), ADD UNIQUE KEY `email` (`email`), ADD UNIQUE KEY `user_id` (`user_id`);

--
-- Indexes for table `contactform`
--
ALTER TABLE `contactform`
 ADD PRIMARY KEY (`ticketId`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
 ADD PRIMARY KEY (`event_id`);

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
 ADD PRIMARY KEY (`group_id`);

--
-- Indexes for table `int_alumni_groups`
--
ALTER TABLE `int_alumni_groups`
 ADD PRIMARY KEY (`id`), ADD KEY `alumn_id` (`alumn_id`), ADD KEY `group_id` (`group_id`);

--
-- Indexes for table `int_events_gropus`
--
ALTER TABLE `int_events_gropus`
 ADD PRIMARY KEY (`id`), ADD KEY `group_id` (`group_id`), ADD KEY `event_id` (`event_id`);

--
-- Indexes for table `int_mails_groups`
--
ALTER TABLE `int_mails_groups`
 ADD PRIMARY KEY (`id`), ADD KEY `group_id` (`group_id`), ADD KEY `mail_id` (`mail_id`);

--
-- Indexes for table `login_attempts`
--
ALTER TABLE `login_attempts`
 ADD PRIMARY KEY (`attempt_id`);

--
-- Indexes for table `mails`
--
ALTER TABLE `mails`
 ADD PRIMARY KEY (`mail_id`);

--
-- Indexes for table `members`
--
ALTER TABLE `members`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `registration_requests`
--
ALTER TABLE `registration_requests`
 ADD PRIMARY KEY (`request_id`), ADD UNIQUE KEY `token` (`token`), ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `alumni`
--
ALTER TABLE `alumni`
MODIFY `alumn_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `contactform`
--
ALTER TABLE `contactform`
MODIFY `ticketId` int(6) NOT NULL AUTO_INCREMENT COMMENT 'starts at 100000',AUTO_INCREMENT=100010;
--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
MODIFY `event_id` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
MODIFY `group_id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `int_alumni_groups`
--
ALTER TABLE `int_alumni_groups`
MODIFY `id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=27;
--
-- AUTO_INCREMENT for table `int_events_gropus`
--
ALTER TABLE `int_events_gropus`
MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `int_mails_groups`
--
ALTER TABLE `int_mails_groups`
MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `login_attempts`
--
ALTER TABLE `login_attempts`
MODIFY `attempt_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `members`
--
ALTER TABLE `members`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=28;
--
-- AUTO_INCREMENT for table `registration_requests`
--
ALTER TABLE `registration_requests`
MODIFY `request_id` int(10) NOT NULL AUTO_INCREMENT;
--
-- Restrictii pentru tabele sterse
--

--
-- Restrictii pentru tabele `int_alumni_groups`
--
ALTER TABLE `int_alumni_groups`
ADD CONSTRAINT `11` FOREIGN KEY (`alumn_id`) REFERENCES `alumni` (`alumn_id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `2` FOREIGN KEY (`group_id`) REFERENCES `groups` (`group_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restrictii pentru tabele `int_events_gropus`
--
ALTER TABLE `int_events_gropus`
ADD CONSTRAINT `5` FOREIGN KEY (`event_id`) REFERENCES `events` (`event_id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `6` FOREIGN KEY (`group_id`) REFERENCES `groups` (`group_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restrictii pentru tabele `int_mails_groups`
--
ALTER TABLE `int_mails_groups`
ADD CONSTRAINT `1` FOREIGN KEY (`group_id`) REFERENCES `groups` (`group_id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `int_mails_groups_ibfk_1` FOREIGN KEY (`mail_id`) REFERENCES `mails` (`mail_id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
