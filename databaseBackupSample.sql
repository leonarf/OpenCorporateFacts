-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le :  Dim 06 jan. 2019 à 19:04
-- Version du serveur :  10.3.11-MariaDB
-- Version de PHP :  7.2.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `capitalism`
--

-- --------------------------------------------------------

--
-- Structure de la table `compte_de_resultat`
--

CREATE TABLE `compte_de_resultat` (
  `id` int(11) NOT NULL,
  `corporate_id` int(11) NOT NULL,
  `chiffres_affaires_net` int(11) NOT NULL,
  `produits_exploitation` int(11) NOT NULL,
  `salaires_et_traitements` int(11) NOT NULL,
  `charges_sociales` int(11) NOT NULL,
  `charges_exploitation` int(11) NOT NULL,
  `charges_financieres` int(11) NOT NULL,
  `produits_financiers` int(11) NOT NULL,
  `year` int(11) NOT NULL,
  `impot_taxes_et_versements_assimiles` int(11) NOT NULL,
  `subventions_exploitation` int(11) NOT NULL,
  `achats_de_marchandises` int(11) NOT NULL,
  `resultat_exploitation` int(11) NOT NULL,
  `resultat_financier` int(11) NOT NULL,
  `resultat_exceptionnel` int(11) NOT NULL,
  `participation_salaries_aux_resultats` int(11) NOT NULL,
  `impots_sur_les_benefices` int(11) NOT NULL,
  `vente_marchandises` int(11) NOT NULL,
  `production_vendue_de_services` int(11) NOT NULL,
  `production_immobilisee` int(11) NOT NULL,
  `reprise_depreciation_provisions_transfert_charges` int(11) NOT NULL,
  `autres_produits` int(11) NOT NULL,
  `autres_achat_et_charges_externes` int(11) NOT NULL,
  `dotation_amortissement_immobilisations` int(11) NOT NULL,
  `dotation_depreciation_immobilisations` int(11) NOT NULL,
  `dotation_depreciation_actif_circulant` int(11) NOT NULL,
  `dotation_provisions` int(11) NOT NULL,
  `autres_charges` int(11) NOT NULL,
  `produits_financiers_participations` int(11) NOT NULL,
  `produits_autres_valeurs_mobiliere_et_creances_actif_immobilise` int(11) NOT NULL,
  `reprise_depreciation_et_provision_transferts_charges` int(11) NOT NULL,
  `differences_positives_change` int(11) NOT NULL,
  `dotations_financieres_amortissement_depreciation_provision` int(11) NOT NULL,
  `interet_et_charge_assimilees` int(11) NOT NULL,
  `difference_negative_change` int(11) NOT NULL,
  `charges_nette_cession_valeur_mobiliere_de_placement` int(11) NOT NULL,
  `produit_exceptionnel_operation_gestion` int(11) NOT NULL,
  `produit_exceptionnel_operation_capital` int(11) NOT NULL,
  `reprise_depreciation_provision_transfert_charge` int(11) NOT NULL,
  `charges_exceptionnelle_operation_gestion` int(11) NOT NULL,
  `charges_exceptionnelle_operation_capital` int(11) NOT NULL,
  `dotation_exceptionnelle_amortissement_depreciation_provision` int(11) NOT NULL,
  `benefice` int(11) NOT NULL,
  `autre_interet_et_produit_assimile` int(11) NOT NULL,
  `achat_matiere_premiere_autre_appro` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `compte_de_resultat`
--

INSERT INTO `compte_de_resultat` (`id`, `corporate_id`, `chiffres_affaires_net`, `produits_exploitation`, `salaires_et_traitements`, `charges_sociales`, `charges_exploitation`, `charges_financieres`, `produits_financiers`, `year`, `impot_taxes_et_versements_assimiles`, `subventions_exploitation`, `achats_de_marchandises`, `resultat_exploitation`, `resultat_financier`, `resultat_exceptionnel`, `participation_salaries_aux_resultats`, `impots_sur_les_benefices`, `vente_marchandises`, `production_vendue_de_services`, `production_immobilisee`, `reprise_depreciation_provisions_transfert_charges`, `autres_produits`, `autres_achat_et_charges_externes`, `dotation_amortissement_immobilisations`, `dotation_depreciation_immobilisations`, `dotation_depreciation_actif_circulant`, `dotation_provisions`, `autres_charges`, `produits_financiers_participations`, `produits_autres_valeurs_mobiliere_et_creances_actif_immobilise`, `reprise_depreciation_et_provision_transferts_charges`, `differences_positives_change`, `dotations_financieres_amortissement_depreciation_provision`, `interet_et_charge_assimilees`, `difference_negative_change`, `charges_nette_cession_valeur_mobiliere_de_placement`, `produit_exceptionnel_operation_gestion`, `produit_exceptionnel_operation_capital`, `reprise_depreciation_provision_transfert_charge`, `charges_exceptionnelle_operation_gestion`, `charges_exceptionnelle_operation_capital`, `dotation_exceptionnelle_amortissement_depreciation_provision`, `benefice`, `autre_interet_et_produit_assimile`, `achat_matiere_premiere_autre_appro`) VALUES
(6, 12, 78407680, 80067993, 34603821, 14626372, 74861765, 450500, 46660, 2017, 2559874, 689572, 2573310, 5206228, -403840, -525251, 404823, -22933, 2271368, 76136312, 119855, 850836, 50, 19140045, 599432, 0, 463473, 169115, 126323, 239, 34930, 0, 6345, 376000, 72893, 1607, 0, 2783, 2300, 576957, 205838, 426669, 474784, 3895247, 5146, 0),
(7, 13, 58728047, 59386873, 3549728, 1687565, 61575346, 126129, 20885, 2017, 1291653, 136823, 37160508, -2188473, -105244, -38374, 0, -201809, 57443719, 1284328, 311923, 200949, 9131, 4435607, 244364, 0, 572755, 25304, 139059, 0, 0, 0, 0, 0, 126129, 0, 0, 16293, 277364, 0, 35901, 277364, 18766, -2130282, 20885, 12468803),
(8, 13, 39266390, 39847893, 2699236, 1288773, 40903981, 15846, 21276, 2016, 983642, 102255, 22288284, -1056088, 5430, -7555, 0, -195678, 37492508, 1773882, 216368, 259215, 3665, 3321543, 214467, 0, 431809, 37200, 77702, 0, 0, 0, 0, 0, 15846, 0, 0, 14474, 0, 0, 0, 80, 21949, -862535, 21276, 9561325),
(9, 12, 62558567, 64072734, 26848144, 11501475, 60270754, 2159588, 2424936, 2016, 1952157, 550732, 1167079, 3801980, 265348, -524084, 176618, -160261, 1844728, 60713839, 126856, 835639, 940, 17032284, 629815, 0, 500069, 370193, 269538, 0, 24543, 2392598, 4593, 170000, 1978452, 9793, 1343, 815, 210478, 285102, 358819, 565670, 95990, 3526887, 3202, 0),
(10, 12, 50981594, 51695285, 22659168, 9893988, 49220308, 397626, 50353, 2015, 1678025, -42, 1172456, 2474977, -347273, -538145, 111480, -160680, 1497844, 49483750, 101055, 612628, 50, 12540980, 620632, 0, 323853, 105384, 225822, 8739, 38159, 0, 176, 325984, 47922, 5457, 18263, 473, 148, 184923, 237036, 21290, 465363, 1638759, 3279, 0),
(11, 12, 48351240, 48877203, 21145677, 9265452, 44613189, 650257, 249896, 2014, 1606106, 31469, 1045595, 4264014, -400361, -1779781, 103212, -144540, 1320731, 47030509, 90886, 403523, 85, 10508273, 500432, 0, 495261, 32622, 13771, 0, 32790, 173244, 9, 428670, 220672, 915, 0, 2905, 746, 31520, 111974, 1227895, 475083, 2125200, 43853, 0),
(12, 12, 43251815, 43825555, 20652632, 9870437, 41818463, 2968924, 120999, 2013, 1503401, 5883, 1095762, 2007092, -2847925, -133495, 0, -177325, 1402852, 41848963, 95530, 472285, 42, 7657498, 534353, 0, 350256, 23467, 130657, 0, 54987, 5405, 2104, 2844659, 124173, 92, 0, 42103, 162182, 541731, 458016, 80729, 340766, -797003, 58503, 0);

-- --------------------------------------------------------

--
-- Structure de la table `corporate`
--

CREATE TABLE `corporate` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `open_corporate_url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `company_number` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `corporate`
--

INSERT INTO `corporate` (`id`, `name`, `open_corporate_url`, `company_number`) VALUES
(11, 'SMILE CORP.', 'https://opencorporates.com/companies/fr/829681634', '829681634'),
(12, 'SMILE', 'https://opencorporates.com/companies/fr/378615363', '378615363'),
(13, 'ENERCOOP', 'https://opencorporates.com/companies/fr/484223094', '484223094');

-- --------------------------------------------------------

--
-- Structure de la table `migration_versions`
--

CREATE TABLE `migration_versions` (
  `version` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `migration_versions`
--

INSERT INTO `migration_versions` (`version`) VALUES
('20181013131446'),
('20181013164543'),
('20181101152413'),
('20181225213459'),
('20181226161929'),
('20181226163054'),
('20181226171023'),
('20181228172150'),
('20181228172232'),
('20181229115231');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `compte_de_resultat`
--
ALTER TABLE `compte_de_resultat`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_BF471D1ACD147EEF` (`corporate_id`);

--
-- Index pour la table `corporate`
--
ALTER TABLE `corporate`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `migration_versions`
--
ALTER TABLE `migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `compte_de_resultat`
--
ALTER TABLE `compte_de_resultat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT pour la table `corporate`
--
ALTER TABLE `corporate`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `compte_de_resultat`
--
ALTER TABLE `compte_de_resultat`
  ADD CONSTRAINT `FK_BF471D1ACD147EEF` FOREIGN KEY (`corporate_id`) REFERENCES `corporate` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
