-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  lun. 28 oct. 2019 à 10:36
-- Version du serveur :  5.7.26
-- Version de PHP :  7.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `blog`
--

DELIMITER $$
--
-- Fonctions
--
DROP FUNCTION IF EXISTS `creation_redacteur`$$
CREATE FUNCTION `creation_redacteur` (`nom` VARCHAR(50) CHARSET utf16, `prenom` VARCHAR(50) CHARSET utf16, `mail_in` VARCHAR(50) CHARSET utf16, `mdp` VARCHAR(50) CHARSET utf16, `pseudo_in` VARCHAR(50) CHARSET utf16) RETURNS INT(2) MODIFIES SQL DATA
BEGIN
DECLARE pb INT DEFAULT 0;
DECLARE pseudo_bdd Varchar(50);
DECLARE mail_bdd Varchar(50);

DECLARE fincurs1 BOOLEAN DEFAULT 0;
DECLARE curs1 CURSOR FOR
    Select pseudo, mail From redacteur;
DECLARE CONTINUE HANDLER FOR NOT FOUND SET fincurs1:=1;

OPEN curs1;
FETCH curs1 into pseudo_bdd, mail_bdd;
WHILE NOT fincurs1 DO
    
   
   IF pseudo_bdd = pseudo_in AND mail_bdd = mail_in
   THEN Set pb:=1;
         SET fincurs1 :=1;   
    
    ELSEIF pseudo_bdd = pseudo_in
    THEN Set pb:=2;
         SET fincurs1 :=1;
    
    ELSEIF mail_bdd = mail_in
    THEN Set pb:=3;
         SET fincurs1 :=1;
    END IF;
    
    
FETCH curs1 into pseudo_bdd, mail_bdd;
END WHILE;

IF pb=0
THEN 
INSERT INTO redacteur(nom,prenom,mail,motdepasse,pseudo) VALUES(nom,prenom,mail_in,mdp,pseudo_in);
END IF;
return pb;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Structure de la table `redacteur`
--

DROP TABLE IF EXISTS `redacteur`;
CREATE TABLE IF NOT EXISTS `redacteur` (
  `idredacteur` int(10) NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `mail` varchar(50) NOT NULL,
  `motdepasse` varchar(50) NOT NULL,
  `pseudo` varchar(50) NOT NULL,
  PRIMARY KEY (`idredacteur`),
  UNIQUE KEY `pseudo` (`pseudo`),
  UNIQUE KEY `adressemail` (`mail`)
) ENGINE=MyISAM AUTO_INCREMENT=28 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `redacteur`
--

INSERT INTO `redacteur` (`idredacteur`, `nom`, `prenom`, `mail`, `motdepasse`, `pseudo`) VALUES
(8, 'Tac', 'Tic', 'Leticattac@gmail.com', '8779a3418377f0190bcebbd92983a9dd', 'TasLeShiba'),
(6, 'Roger', 'Nils', 'nilsroger@hotmail.fr', 'e547a42a6154d39141690c545b7909eb', 'Ashela'),
(7, 'Levis', 'Lucas', 'lucaslevis@orange.fr', 'c5ad09dafed96c3812b6563f03282b9e', 'Kookie'),
(5, 'Ledeux', 'Flavien', 'Ledeux@gmail.com', 'bcb86835ec80131d1058b6d9790ef93b', 'FLedeux');

-- --------------------------------------------------------

--
-- Structure de la table `reponse`
--

DROP TABLE IF EXISTS `reponse`;
CREATE TABLE IF NOT EXISTS `reponse` (
  `idreponse` int(10) NOT NULL AUTO_INCREMENT,
  `idsujet` int(10) NOT NULL,
  `idredacteur` int(10) NOT NULL,
  `daterep` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `textereponse` varchar(1000) NOT NULL,
  PRIMARY KEY (`idreponse`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `reponse`
--

INSERT INTO `reponse` (`idreponse`, `idsujet`, `idredacteur`, `daterep`, `textereponse`) VALUES
(6, 8, 8, '2019-10-25 11:21:39', 'woof'),
(5, 7, 5, '2019-10-25 10:56:28', 'Ã§a ce voit que t\'es breton');

-- --------------------------------------------------------

--
-- Structure de la table `sujet`
--

DROP TABLE IF EXISTS `sujet`;
CREATE TABLE IF NOT EXISTS `sujet` (
  `idsujet` int(10) NOT NULL AUTO_INCREMENT,
  `idredacteur` int(10) NOT NULL,
  `titresujet` varchar(100) NOT NULL,
  `textesujet` varchar(5000) NOT NULL,
  `datesujet` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`idsujet`),
  KEY `idredacteur` (`idredacteur`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `sujet`
--

INSERT INTO `sujet` (`idsujet`, `idredacteur`, `titresujet`, `textesujet`, `datesujet`) VALUES
(7, 6, 'La Bretagne', 'Bonjour Ã  tous, aujourd\'hui, je vais vous parler d\'un sujet qui me tient Ã  cÅ“ur : la Bretagne.\r\nCe magnifique pays, ses lÃ©gendes et ses mythes tels que Merlin l\'enchanteur, ses monuments tel que le Mont Saint Michel(les rageux diront qu\'il est en Normandie).', '2019-10-24 08:46:44'),
(8, 5, 'Le Chien', 'Le Chien (Canis lupus familiaris) est la sous-espÃ¨ce domestique de Canis lupus, un mammifÃ¨re de la famille des CanidÃ©s (Canidae), laquelle comprend Ã©galement le Loup gris et le dingo, chien domestique retournÃ© Ã  l\'Ã©tat sauvage.\r\n\r\nLe Loup est la premiÃ¨re espÃ¨ce animale Ã  avoir Ã©tÃ© domestiquÃ©e par l\'Homme pour l\'usage de la chasse dans une sociÃ©tÃ© humaine palÃ©olithique qui ne maÃ®trise alors ni l\'agriculture ni l\'Ã©levage. La lignÃ©e du chien s\'est diffÃ©renciÃ©e gÃ©nÃ©tiquement de celle du Loup gris il y a environ 100 000 ans, et les plus anciens restes confirmÃ©s de canidÃ© diffÃ©renciÃ© de la lignÃ©e du Loup sont vieux, selon les sources, de 33 000 ans ou de 12 000 ans, donc antÃ©rieurs d\'au moins douze mille ans Ã  ceux de toute autre espÃ¨ce domestique connue. Depuis la PrÃ©histoire, le chien a accompagnÃ© l\'Ãªtre humain durant toute sa phase de sÃ©dentarisation, marquÃ©e par l\'apparition des premiÃ¨res civilisations agricoles. C\'est Ã  ce moment qu\'il a acquis la capacitÃ© de digÃ©rer l\'amidon, et que ses fonctions d\'auxiliaire d\'Homo sapiens se sont Ã©tendues. Ces nouvelles fonctions ont entraÃ®nÃ© une diffÃ©renciation accrue de la sous-espÃ¨ce et l\'apparition progressive de races canines identifiables. Le chien est aujourd\'hui utilisÃ© Ã  la fois comme animal de travail et comme animal de compagnie. Son instinct de meute, sa domestication prÃ©coce et les caractÃ©ristiques comportementales qui en dÃ©coulent lui valent familiÃ¨rement le surnom de Â« meilleur ami de l\'Homme Â».\r\n\r\nCette place particuliÃ¨re dans la sociÃ©tÃ© humaine a conduit Ã  l\'Ã©laboration d\'une rÃ¨glementation spÃ©cifique. Ainsi, lÃ  oÃ¹ les critÃ¨res de la FÃ©dÃ©ration cynologique internationale ont une reconnaissance lÃ©gale, l\'appellation chien de race est conditionnÃ©e Ã  l\'enregistrement du chien dans les livres des origines de son pays de naissance. Selon le pays, des vaccins peuvent Ãªtre obligatoires et certains types de chien, jugÃ©s dangereux, sont soumis Ã  des restrictions. Le chien est gÃ©nÃ©ralement soumis aux diffÃ©rentes lÃ©gislations sur les carnivores domestiques. C\'est notamment le cas en Europe, oÃ¹ sa circulation est facilitÃ©e grÃ¢ce Ã  l\'instauration du passeport europÃ©en pour animal de compagnie.', '2019-10-25 11:13:15');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
