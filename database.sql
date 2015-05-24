-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Erstellungszeit: 24. Mai 2015 um 14:23
-- Server Version: 5.5.39
-- PHP-Version: 5.4.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Datenbank: `schuelerpaten`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `classranges`
--

CREATE TABLE IF NOT EXISTS `classranges` (
`id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `locations`
--

CREATE TABLE IF NOT EXISTS `locations` (
`id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Daten für Tabelle `locations`
--

INSERT INTO `locations` (`id`, `name`) VALUES
(1, 'Berlin');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `partners`
--

CREATE TABLE IF NOT EXISTS `partners` (
`id` int(11) NOT NULL,
  `age` int(11) NOT NULL,
  `sex` varchar(30) NOT NULL,
  `degree_course` varchar(255) DEFAULT NULL,
  `job` varchar(255) DEFAULT NULL,
  `street` varchar(255) NOT NULL,
  `house_number` varchar(255) NOT NULL,
  `house_number_addition` varchar(255) DEFAULT NULL,
  `postcode` varchar(5) NOT NULL,
  `city` varchar(255) NOT NULL,
  `telephone` varchar(255) NOT NULL,
  `mobile` varchar(255) DEFAULT NULL,
  `teach_time` int(11) NOT NULL,
  `extra_time` int(11) NOT NULL,
  `spend_time` varchar(255) NOT NULL,
  `experience` varchar(510) NOT NULL,
  `preferred_gender` varchar(30) DEFAULT NULL,
  `support_wish` varchar(510) DEFAULT NULL,
  `reason_for_decision` varchar(510) NOT NULL,
  `additional_informations` varchar(510) DEFAULT NULL,
  `reason_for_schuelerpaten` varchar(255) NOT NULL,
  `location_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `status_id` int(11) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `preferred_classranges`
--

CREATE TABLE IF NOT EXISTS `preferred_classranges` (
`id` int(11) NOT NULL,
  `partner_id` int(11) DEFAULT NULL,
  `classrange_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `preferred_schooltypes`
--

CREATE TABLE IF NOT EXISTS `preferred_schooltypes` (
`id` int(11) NOT NULL,
  `partner_id` int(11) DEFAULT NULL,
  `schooltype_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `preferred_subjects`
--

CREATE TABLE IF NOT EXISTS `preferred_subjects` (
`id` int(11) NOT NULL,
  `subject_id` int(11) DEFAULT NULL,
  `partner_id` int(11) DEFAULT NULL,
  `maximum_class` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `schooltypes`
--

CREATE TABLE IF NOT EXISTS `schooltypes` (
`id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `maximum_class` int(11) NOT NULL,
  `minimum_class` int(11) NOT NULL,
  `location_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `status`
--

CREATE TABLE IF NOT EXISTS `status` (
`id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `students`
--

CREATE TABLE IF NOT EXISTS `students` (
`id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `telephone` varchar(255) NOT NULL,
  `mobile` varchar(255) DEFAULT NULL,
  `location_id` int(11) DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Daten für Tabelle `students`
--

INSERT INTO `students` (`id`, `first_name`, `last_name`, `telephone`, `mobile`, `location_id`) VALUES
(1, 'Testschueler', 'Test', '0304068024', '', 1);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `subjects`
--

CREATE TABLE IF NOT EXISTS `subjects` (
`id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `location_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `tandems`
--

CREATE TABLE IF NOT EXISTS `tandems` (
`id` int(11) NOT NULL,
  `partner_id` int(11) DEFAULT NULL,
  `student_id` int(11) DEFAULT NULL,
  `active` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `types`
--

CREATE TABLE IF NOT EXISTS `types` (
`id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Daten für Tabelle `types`
--

INSERT INTO `types` (`id`, `name`) VALUES
(1, 'Pate'),
(2, 'Matchmaker'),
(3, 'Vermittler'),
(4, 'Standort-Admin'),
(5, 'Global-Admin');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `users`
--

CREATE TABLE IF NOT EXISTS `users` (
`id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `location_id` int(11) DEFAULT NULL,
  `activation` int(11) DEFAULT NULL COMMENT 'NULL = activated; else = activation-key'
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=29 ;

--
-- Daten für Tabelle `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `password`, `created`, `location_id`, `activation`) VALUES
(1, '', '', 'pate@test.de', '$2y$10$T88C5MKYuql3JfJNw/BLv.q8Z/4DijCCS6GvR3iJM3CO2eLgJL.Rm', '2015-05-18 07:08:56', 1, NULL),
(2, '', '', 'vermittler@test.de', '$2y$10$8ulHxwWFKpqyxLQMCR9tQuRO0qh4Uv0SHabQVBodIZ2bGB2zQiWzS', '2015-05-18 07:09:31', 1, NULL);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `user_has_types`
--

CREATE TABLE IF NOT EXISTS `user_has_types` (
`id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `type_id` int(11) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Daten für Tabelle `user_has_types`
--

INSERT INTO `user_has_types` (`id`, `user_id`, `type_id`) VALUES
(1, 1, 1),
(2, 2, 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `classranges`
--
ALTER TABLE `classranges`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `locations`
--
ALTER TABLE `locations`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `partners`
--
ALTER TABLE `partners`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `user_id` (`user_id`);

--
-- Indexes for table `preferred_classranges`
--
ALTER TABLE `preferred_classranges`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `preferred_schooltypes`
--
ALTER TABLE `preferred_schooltypes`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `preferred_subjects`
--
ALTER TABLE `preferred_subjects`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `schooltypes`
--
ALTER TABLE `schooltypes`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `status`
--
ALTER TABLE `status`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subjects`
--
ALTER TABLE `subjects`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tandems`
--
ALTER TABLE `tandems`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `types`
--
ALTER TABLE `types`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_has_types`
--
ALTER TABLE `user_has_types`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `classranges`
--
ALTER TABLE `classranges`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `locations`
--
ALTER TABLE `locations`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `partners`
--
ALTER TABLE `partners`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `preferred_classranges`
--
ALTER TABLE `preferred_classranges`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `preferred_schooltypes`
--
ALTER TABLE `preferred_schooltypes`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `preferred_subjects`
--
ALTER TABLE `preferred_subjects`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `schooltypes`
--
ALTER TABLE `schooltypes`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `status`
--
ALTER TABLE `status`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tandems`
--
ALTER TABLE `tandems`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `types`
--
ALTER TABLE `types`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=29;
--
-- AUTO_INCREMENT for table `user_has_types`
--
ALTER TABLE `user_has_types`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
