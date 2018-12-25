<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181225213459 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE compte_de_resultat ADD vente_marchandises INT NOT NULL, ADD production_vendue_de_services INT NOT NULL, ADD production_immobilisee INT NOT NULL, ADD reprise_depreciation_provisions_transfert_charges INT NOT NULL, ADD autres_produits INT NOT NULL, ADD autres_achat_et_charges_externes INT NOT NULL, ADD dotation_amortissement_immobilisations INT NOT NULL, ADD dotation_depreciation_immobilisations INT NOT NULL, ADD dotation_depreciation_actif_circulant INT NOT NULL, ADD dotation_provisions INT NOT NULL, ADD autres_charges INT NOT NULL');
        $this->addSql('ALTER TABLE corporate CHANGE country country VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE compte_de_resultat DROP vente_marchandises, DROP production_vendue_de_services, DROP production_immobilisee, DROP reprise_depreciation_provisions_transfert_charges, DROP autres_produits, DROP autres_achat_et_charges_externes, DROP dotation_amortissement_immobilisations, DROP dotation_depreciation_immobilisations, DROP dotation_depreciation_actif_circulant, DROP dotation_provisions, DROP autres_charges');
        $this->addSql('ALTER TABLE corporate CHANGE country country VARCHAR(255) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci');
    }
}
