<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181101152413 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE compte_de_resultat ADD impot_taxes_et_versements_assimiles INT NOT NULL, ADD subventions_exploitation INT NOT NULL, ADD achats_de_marchandises INT NOT NULL, ADD resultat_exploitation INT NOT NULL, ADD resultat_financier INT NOT NULL, ADD resultat_exceptionnel INT NOT NULL, ADD participation_salaries_aux_resultats INT NOT NULL, ADD impots_sur_les_benefices INT NOT NULL');
        $this->addSql('ALTER TABLE corporate CHANGE country country VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE compte_de_resultat DROP impot_taxes_et_versements_assimiles, DROP subventions_exploitation, DROP achats_de_marchandises, DROP resultat_exploitation, DROP resultat_financier, DROP resultat_exceptionnel, DROP participation_salaries_aux_resultats, DROP impots_sur_les_benefices');
        $this->addSql('ALTER TABLE corporate CHANGE country country VARCHAR(255) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci');
    }
}
