<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190217181253 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE document_de_reference (id INT AUTO_INCREMENT NOT NULL, corporation_id INT NOT NULL, chiffre_affaire BIGINT NOT NULL, benefices_groupe INT NOT NULL, dividend INT NOT NULL, salaire_moyen INT NOT NULL, on_profit_tax_paid INT NOT NULL, year DATE NOT NULL, INDEX IDX_DC520A6BB2685369 (corporation_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE document_de_reference ADD CONSTRAINT FK_DC520A6BB2685369 FOREIGN KEY (corporation_id) REFERENCES corporate (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE document_de_reference');
    }
}
