<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190629104903 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE compte_de_resultat CHANGE effectifs_moyens effectifs_moyens INT DEFAULT NULL, CHANGE dividende dividende INT DEFAULT NULL');
        $this->addSql('CREATE UNIQUE INDEX uniqueComptesPerYearPerCorporate ON compte_de_resultat (corporate_id, year)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP INDEX uniqueComptesPerYearPerCorporate ON compte_de_resultat');
        $this->addSql('ALTER TABLE compte_de_resultat CHANGE effectifs_moyens effectifs_moyens INT DEFAULT NULL, CHANGE dividende dividende INT DEFAULT NULL');
    }
}
