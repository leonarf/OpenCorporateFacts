<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181226161929 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE compte_de_resultat ADD produits_financiers_participations INT NOT NULL, ADD produits_autres_valeurs_mobiliere_et_creances_actif_immobilise INT NOT NULL, ADD reprise_depreciation_et_provision_transferts_charges INT NOT NULL, ADD differences_positives_change INT NOT NULL, ADD dotations_financieres_amortissement_depreciation_provision INT NOT NULL, ADD interet_et_charge_assimilees INT NOT NULL, ADD difference_negative_change INT NOT NULL, ADD charges_nette_cession_valeur_mobiliere_de_placement INT NOT NULL, ADD produit_exceptionnel_operation_gestion INT NOT NULL, ADD produit_exceptionnel_operation_capital INT NOT NULL, ADD reprise_depreciation_provision_transfert_charge INT NOT NULL, ADD charges_exceptionnelle_operation_gestion INT NOT NULL, ADD charges_exceptionnelle_operation_capital INT NOT NULL, ADD dotation_exceptionnelle_amortissement_depreciation_provision INT NOT NULL');
        $this->addSql('ALTER TABLE corporate CHANGE country country VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE compte_de_resultat DROP produits_financiers_participations, DROP produits_autres_valeurs_mobiliere_et_creances_actif_immobilise, DROP reprise_depreciation_et_provision_transferts_charges, DROP differences_positives_change, DROP dotations_financieres_amortissement_depreciation_provision, DROP interet_et_charge_assimilees, DROP difference_negative_change, DROP charges_nette_cession_valeur_mobiliere_de_placement, DROP produit_exceptionnel_operation_gestion, DROP produit_exceptionnel_operation_capital, DROP reprise_depreciation_provision_transfert_charge, DROP charges_exceptionnelle_operation_gestion, DROP charges_exceptionnelle_operation_capital, DROP dotation_exceptionnelle_amortissement_depreciation_provision');
        $this->addSql('ALTER TABLE corporate CHANGE country country VARCHAR(255) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci');
    }
}
