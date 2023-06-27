-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Generation Time: Jun 27, 2023 at 11:44 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mydb`
--
CREATE DATABASE IF NOT EXISTS `mydb` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `mydb`;

-- --------------------------------------------------------

--
-- Table structure for table `administrator`
--

CREATE TABLE `administrator` (
  `opis` varchar(1024) NOT NULL,
  `idkor` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `administrator`
--

INSERT INTO `administrator` (`opis`, `idkor`) VALUES
('Kratka opis administratora Davida.', 1),
('Kratak opis administratora Milice D.', 2),
('Kratak opis Bojane -administratora.', 4),
('Kratak opis administratora Milice P.', 17);

-- --------------------------------------------------------

--
-- Table structure for table `cenovnik`
--

CREATE TABLE `cenovnik` (
  `idcena` int(11) NOT NULL,
  `naziv` varchar(100) DEFAULT NULL,
  `ukupno` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `cenovnik`
--

INSERT INTO `cenovnik` (`idcena`, `naziv`, `ukupno`) VALUES
(1, 'Rekreativni trening bez nadzora profesionalnog trenera', 2000),
(2, 'Rekreativni trening pod nadzorom profesionalnog trenera', 4000),
(3, 'Individualni trening učenika pod nadzorom profesionalnog trenera', 6000),
(4, 'Grupni trening učenika pod nadzorom profesionalnog trenera', 3500),
(5, 'Cena termina od 1 h teren šljaka', 1000),
(6, 'Cena termina od 1 h teren beton', 1200),
(7, 'Cena termina od 1 h teren trava', 1500),
(8, 'Cena iznajmljivanja reketa', 100);

-- --------------------------------------------------------

--
-- Table structure for table `clan`
--

CREATE TABLE `clan` (
  `grupa_idgru` int(11) NOT NULL,
  `ucenik_idkor` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `clan`
--

INSERT INTO `clan` (`grupa_idgru`, `ucenik_idkor`) VALUES
(1, 11),
(1, 12);

-- --------------------------------------------------------

--
-- Table structure for table `grupa`
--

CREATE TABLE `grupa` (
  `idgru` int(11) NOT NULL,
  `naziv` varchar(15) NOT NULL,
  `trener_idkor` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `grupa`
--

INSERT INTO `grupa` (`idgru`, `naziv`, `trener_idkor`) VALUES
(1, 'Juniori', 5);

-- --------------------------------------------------------

--
-- Table structure for table `korisnik`
--

CREATE TABLE `korisnik` (
  `idkor` int(11) NOT NULL,
  `korime` varchar(15) NOT NULL,
  `pass` varchar(15) NOT NULL,
  `ime` varchar(25) NOT NULL,
  `prezime` varchar(35) NOT NULL,
  `brtel` varchar(15) NOT NULL,
  `poster` varchar(32) NOT NULL,
  `email` varchar(45) NOT NULL DEFAULT '0',
  `status` int(1) NOT NULL,
  `tip` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `korisnik`
--

INSERT INTO `korisnik` (`idkor`, `korime`, `pass`, `ime`, `prezime`, `brtel`, `poster`, `email`, `status`, `tip`) VALUES
(1, 'david', 'admin1234', 'David', 'Admin', '0601234567', '1.jpg', 'david@gmail.com', 1, 3),
(2, 'milicad', 'admin1234', 'Milica', 'Admin D', '0612345678', '2.jpg', 'milicad@gmail.com', 1, 3),
(4, 'bojana', 'admin1234', 'Bojana', 'Admin', '45678912', '4.jpg', 'bojana@gmail.com', 1, 3),
(5, 'trener1', 'trener1234', 'Ivan', 'Ivanov', '0601234567', '5.jpg', 'ivan@gmail.com', 1, 2),
(6, 'trener2', 'trener1234', 'Marko', 'Markov', '0611234567', '6.jpg', 'marko@gmail.com', 1, 2),
(7, 'trener3', 'trener1234', 'Jovan', 'Jovanov', '0621235467', '7.jpg', 'jovan@gmail.com', 1, 2),
(8, 'ucenik1', 'ucenik1234', 'Sonja', 'Simin', '0631234567', '8.jpg', 'sonja@gmai.com', 1, 1),
(9, 'ucenik2', 'ucenik1234', 'Toma', 'Tomic', '0641234567', '9.jpg', 'toma@gmail.com', 3, 1),
(10, 'ucenik3', 'ucenik1234', 'Maja', 'Maric', '0651234567', '10.jpg', 'maja@gmail.com', 3, 1),
(11, 'ucenik4', 'ucenik1234', 'Darko', 'Danic', '0661234567', '11.jpg', 'darko@gmail.com', 1, 1),
(12, 'ucenik5', 'ucenik1234', 'Sara', 'Savin', '0671234567', '12.jpg', 'sara@gmail.com', 1, 1),
(13, 'ucenik6', 'ucenik1234', 'Rade', 'Radic', '0601234567', '13.jpg', 'rade@gmail.com', 1, 1),
(14, 'ucenik7', 'ucenik1234', 'Mirko', 'Miric', '0641234567', '14.jpg', 'mirko@gmail.com', 1, 1),
(15, 'rekreativac1', 'rekreativac', 'Sima', 'Simic', '0611234567', '15.jpg', 'sima@gmail.com', 1, 0),
(16, 'rekreativac2', 'rekreativac', 'Sale', 'Sasic', '0611234567', '16.jpg', 'sale@gmail.com', 2, 0),
(17, 'milicap', 'admin1234', 'Milica', 'Admin P', '07894561', '17.jpg', 'milicap@gmail.com', 1, 3);

-- --------------------------------------------------------

--
-- Table structure for table `rezervacija`
--

CREATE TABLE `rezervacija` (
  `idrez` int(11) NOT NULL,
  `idteren` int(11) NOT NULL,
  `idtermin` int(11) NOT NULL,
  `status` char(3) NOT NULL,
  `brrek` int(11) NOT NULL DEFAULT 0,
  `cena` double NOT NULL,
  `trener_idkor` int(11) DEFAULT NULL,
  `korisnik_idkor` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rezervacija_grupa`
--

CREATE TABLE `rezervacija_grupa` (
  `idrez` int(11) NOT NULL,
  `idteren` int(11) NOT NULL,
  `idtermin` int(11) NOT NULL,
  `status` char(3) NOT NULL,
  `brrek` int(11) NOT NULL DEFAULT 0,
  `cena` double NOT NULL,
  `trener_idkor` int(11) DEFAULT NULL,
  `idgru` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `teren`
--

CREATE TABLE `teren` (
  `idteren` int(11) NOT NULL,
  `tippod` char(1) NOT NULL,
  `opis` varchar(600) NOT NULL,
  `poster_vertical` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `teren`
--

INSERT INTO `teren` (`idteren`, `tippod`, `opis`, `poster_vertical`) VALUES
(1, 'T', 'Travnati tereni su najbrži tereni. Oni sadrže travu koja je uzgajana na veoma tvrdoj zemlji slično golf terenima, koja daje dodatne efekte loptici. Poeni traju veoma kratko i servis igra najznačajniju ulogu, i zbog toga se faforizuju servis-volej igrači. Ova podloga je mekša od tvrde podloge i zbog toga loptica niže odskače tako da igrači moraju da udare lopticu mnogo ranije.', '1_vertical.jpg'),
(2, 'T', 'Travnati tereni su najbrži tereni. Oni sadrže travu koja je uzgajana na veoma tvrdoj zemlji slično golf terenima, koja daje dodatne efekte loptici. Poeni traju veoma kratko i servis igra najznačajniju ulogu, i zbog toga se faforizuju servis-volej igrači. Ova podloga je mekša od tvrde podloge i zbog toga loptica niže odskače tako da igrači moraju da udare lopticu mnogo ranije.', '2_vertical.jpg'),
(3, 'T', 'Vimbldon je jedini Gren Slem sa travnatom podlogom koja je ujedno najbrža i najzahtevnija za igrače. Loptica putuje brzo i odskače relativno nisko od podloge. Pored toga, zbog konfiguracije podloge loptica zadržava spin i nakon odskoka i veoma nepredvidivo odskače.', '3_vertical.jpg'),
(4, 'S', 'Naši tereni od šljake su napravljeni od lomljene cigle i crvene su boje. Šljakasti tereni se smatraju sporim terenima jer loptica odskače relativno visoko i sporije tako da je igračima teško da udare winere. Poeni obično traju duže i jako je mali broj winera. Zbog toga ovakve terene vole igrači koji igraju više sa osnovne linije i defanzivno. Kretanje na šljakastim terenima se veoma razlikuje od drugih terena. Igranje na šljaci često uključuje proklizavanje ka loptici tokom udarca. Najpoznatiji tereni od šljake su Roland Garros.', '4_vertical.jpg'),
(5, 'S', 'Naši tereni od šljake su napravljeni od lomljene cigle i crvene su boje. Šljakasti tereni se smatraju sporim terenima jer loptica odskače relativno visoko i sporije tako da je igračima teško da udare winere. Poeni obično traju duže i jako je mali broj winera. Zbog toga ovakve terene vole igrači koji igraju više sa osnovne linije i defanzivno. Kretanje na šljakastim terenima se veoma razlikuje od drugih terena. Igranje na šljaci često uključuje proklizavanje ka loptici tokom udarca. Najpoznatiji tereni od šljake su Roland Garros.', '5_vertical.jpg'),
(6, 'S', 'Teren sa ovom podlogom su najrasprostranjeniji u Srbiji. Spada u red sporih podloga jer zbog velikog trenja loptica odskače sporije, više i predvidljivije nego na travnatim terenima. Više odgovara teniserima koji vole igru sa osnovne linije i precizne, duboke udarce.', '6_vertical.jpg'),
(7, 'B', 'Napravljen od asfalta ili betona presvučenog višeslojnim akrilom. U zavisnosti od završnog sloja, loptica ima veće ili manje prianjanje za podlogu, što za posledicu ima promenu smera rotacije. Idealno za tenisere koji vole napadački stil i one koji preferiraju udarce sa osnovne linije.', '7_vertical.jpg'),
(8, 'B', 'Napravljen od asfalta ili betona presvučenog višeslojnim akrilom. U zavisnosti od završnog sloja, loptica ima veće ili manje prianjanje za podlogu, što za posledicu ima promenu smera rotacije. Idealno za tenisere koji vole napadački stil i one koji preferiraju udarce sa osnovne linije.', '8_vertical.jpg'),
(9, 'B', 'Naši tvrdi treni su napravljeni od betona.Smatraju se srednje brzom podlogom gde loptica brzo ide i odskače nisko i zbog toga poeni traju relativno kratko. Snažni igrači sa jakim servisom imaju blagu prednost. Ovakvi tereni se mogu razlikovati po brzini ali su brži od šljakastih terena i sporiji od travnatih. Tvrdi tereni smatraju se pogodnim za najveći broj igrača. ', '9_vertical.jpg'),
(10, 'B', 'Naši tvrdi treni su napravljeni od betona.Smatraju se srednje brzom podlogom gde loptica brzo ide i odskače nisko i zbog toga poeni traju relativno kratko. Snažni igrači sa jakim servisom imaju blagu prednost. Ovakvi tereni se mogu razlikovati po brzini ali su brži od šljakastih terena i sporiji od travnatih. Tvrdi tereni smatraju se pogodnim za najveći broj igrača. ', '10_vertical.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `termin`
--

CREATE TABLE `termin` (
  `idtermin` int(11) NOT NULL,
  `datum` date NOT NULL,
  `vreme` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `trener`
--

CREATE TABLE `trener` (
  `opis` varchar(1024) NOT NULL,
  `idkor` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `trener`
--

INSERT INTO `trener` (`opis`, `idkor`) VALUES
('Licencirani trener sa višegodišnjim iskustvom u radu sa decom i odraslima. Bivši broj 1 na ATP listi.', 5),
('Licencirani trener teniskog saveza Srbije. Trener sa iskustvom u radu grupnih i individualnih treninga.', 6),
('Licencirani trener, rad sa početnicima, sparing, usavršavanje tehnike, kretanja, kondicije.', 7);

-- --------------------------------------------------------

--
-- Table structure for table `ucenik`
--

CREATE TABLE `ucenik` (
  `idkor` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `ucenik`
--

INSERT INTO `ucenik` (`idkor`) VALUES
(8),
(9),
(10),
(11),
(12),
(13),
(14);

-- --------------------------------------------------------

--
-- Table structure for table `zahtev`
--

CREATE TABLE `zahtev` (
  `idzahtev` int(11) NOT NULL,
  `ucenik_idkor` int(11) NOT NULL,
  `trener_idkor` int(11) NOT NULL,
  `status` char(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `zahtev`
--

INSERT INTO `zahtev` (`idzahtev`, `ucenik_idkor`, `trener_idkor`, `status`) VALUES
(1, 8, 5, 'cek'),
(2, 9, 5, 'cek'),
(3, 10, 5, 'cek'),
(4, 11, 5, 'slo'),
(5, 12, 5, 'slo'),
(6, 13, 5, 'slo'),
(7, 14, 5, 'cek');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `administrator`
--
ALTER TABLE `administrator`
  ADD PRIMARY KEY (`idkor`),
  ADD KEY `fk_administrator_korisnik1_idx` (`idkor`);

--
-- Indexes for table `cenovnik`
--
ALTER TABLE `cenovnik`
  ADD PRIMARY KEY (`idcena`);

--
-- Indexes for table `clan`
--
ALTER TABLE `clan`
  ADD PRIMARY KEY (`grupa_idgru`,`ucenik_idkor`),
  ADD KEY `fk_ucenik_has_grupa_grupa1_idx` (`grupa_idgru`),
  ADD KEY `fk_clan_ucenik1_idx` (`ucenik_idkor`);

--
-- Indexes for table `grupa`
--
ALTER TABLE `grupa`
  ADD PRIMARY KEY (`idgru`),
  ADD KEY `fk_grupa_trener1_idx` (`trener_idkor`);

--
-- Indexes for table `korisnik`
--
ALTER TABLE `korisnik`
  ADD PRIMARY KEY (`idkor`);

--
-- Indexes for table `rezervacija`
--
ALTER TABLE `rezervacija`
  ADD PRIMARY KEY (`idrez`),
  ADD KEY `fk_rezervacija_teren1_idx` (`idteren`),
  ADD KEY `fk_rezervacija_termin1_idx` (`idtermin`),
  ADD KEY `fk_rezervacija_trener1_idx` (`trener_idkor`),
  ADD KEY `fk_rezervacija_korisnik1_idx` (`korisnik_idkor`);

--
-- Indexes for table `rezervacija_grupa`
--
ALTER TABLE `rezervacija_grupa`
  ADD PRIMARY KEY (`idrez`),
  ADD KEY `fk_rezervacija_grupa_teren1_idx` (`idteren`),
  ADD KEY `fk_rezervacija_grupa_termin1_idx` (`idtermin`),
  ADD KEY `fk_rezervacija_grupa_trener1_idx` (`trener_idkor`),
  ADD KEY `fk_rezervacija_grupa_grupa1_idx` (`idgru`);

--
-- Indexes for table `teren`
--
ALTER TABLE `teren`
  ADD PRIMARY KEY (`idteren`);

--
-- Indexes for table `termin`
--
ALTER TABLE `termin`
  ADD PRIMARY KEY (`idtermin`);

--
-- Indexes for table `trener`
--
ALTER TABLE `trener`
  ADD PRIMARY KEY (`idkor`),
  ADD KEY `fk_trener_korisnik1_idx` (`idkor`);

--
-- Indexes for table `ucenik`
--
ALTER TABLE `ucenik`
  ADD PRIMARY KEY (`idkor`),
  ADD KEY `fk_ucenik_korisnik1_idx` (`idkor`);

--
-- Indexes for table `zahtev`
--
ALTER TABLE `zahtev`
  ADD PRIMARY KEY (`idzahtev`),
  ADD KEY `fk_individualni_ucenik1_idx` (`ucenik_idkor`),
  ADD KEY `fk_individualni_trener1_idx` (`trener_idkor`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cenovnik`
--
ALTER TABLE `cenovnik`
  MODIFY `idcena` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `grupa`
--
ALTER TABLE `grupa`
  MODIFY `idgru` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `korisnik`
--
ALTER TABLE `korisnik`
  MODIFY `idkor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `rezervacija`
--
ALTER TABLE `rezervacija`
  MODIFY `idrez` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `rezervacija_grupa`
--
ALTER TABLE `rezervacija_grupa`
  MODIFY `idrez` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `teren`
--
ALTER TABLE `teren`
  MODIFY `idteren` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `termin`
--
ALTER TABLE `termin`
  MODIFY `idtermin` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `zahtev`
--
ALTER TABLE `zahtev`
  MODIFY `idzahtev` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `administrator`
--
ALTER TABLE `administrator`
  ADD CONSTRAINT `fk_administrator_korisnik1` FOREIGN KEY (`idkor`) REFERENCES `korisnik` (`idkor`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `clan`
--
ALTER TABLE `clan`
  ADD CONSTRAINT `fk_clan_ucenik1` FOREIGN KEY (`ucenik_idkor`) REFERENCES `ucenik` (`idkor`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_ucenik_has_grupa_grupa1` FOREIGN KEY (`grupa_idgru`) REFERENCES `grupa` (`idgru`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `grupa`
--
ALTER TABLE `grupa`
  ADD CONSTRAINT `fk_grupa_trener1` FOREIGN KEY (`trener_idkor`) REFERENCES `trener` (`idkor`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `rezervacija`
--
ALTER TABLE `rezervacija`
  ADD CONSTRAINT `fk_rezervacija_korisnik1` FOREIGN KEY (`korisnik_idkor`) REFERENCES `korisnik` (`idkor`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_rezervacija_teren1` FOREIGN KEY (`idteren`) REFERENCES `teren` (`idteren`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_rezervacija_termin1` FOREIGN KEY (`idtermin`) REFERENCES `termin` (`idtermin`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_rezervacija_trener1` FOREIGN KEY (`trener_idkor`) REFERENCES `trener` (`idkor`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `rezervacija_grupa`
--
ALTER TABLE `rezervacija_grupa`
  ADD CONSTRAINT `fk_rezervacija_grupa_grupa1` FOREIGN KEY (`idgru`) REFERENCES `grupa` (`idgru`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_rezervacija_grupa_teren1` FOREIGN KEY (`idteren`) REFERENCES `teren` (`idteren`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_rezervacija_grupa_termin1` FOREIGN KEY (`idtermin`) REFERENCES `termin` (`idtermin`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_rezervacija_grupa_trener1` FOREIGN KEY (`trener_idkor`) REFERENCES `trener` (`idkor`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `trener`
--
ALTER TABLE `trener`
  ADD CONSTRAINT `fk_trener_korisnik1` FOREIGN KEY (`idkor`) REFERENCES `korisnik` (`idkor`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `ucenik`
--
ALTER TABLE `ucenik`
  ADD CONSTRAINT `fk_ucenik_korisnik1` FOREIGN KEY (`idkor`) REFERENCES `korisnik` (`idkor`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `zahtev`
--
ALTER TABLE `zahtev`
  ADD CONSTRAINT `fk_individualni_trener1` FOREIGN KEY (`trener_idkor`) REFERENCES `trener` (`idkor`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_individualni_ucenik1` FOREIGN KEY (`ucenik_idkor`) REFERENCES `ucenik` (`idkor`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
