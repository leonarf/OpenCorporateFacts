<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190120184916 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE shareholding (id INT AUTO_INCREMENT NOT NULL, owning_corporate_id INT NOT NULL, owned_corporate_id INT NOT NULL, owning_percentage DOUBLE PRECISION NOT NULL, owning_date DATE NOT NULL, INDEX IDX_7CBECFBCD2C055CB (owning_corporate_id), INDEX IDX_7CBECFBC57B9CBFF (owned_corporate_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE shareholding ADD CONSTRAINT FK_7CBECFBCD2C055CB FOREIGN KEY (owning_corporate_id) REFERENCES corporate (id)');
        $this->addSql('ALTER TABLE shareholding ADD CONSTRAINT FK_7CBECFBC57B9CBFF FOREIGN KEY (owned_corporate_id) REFERENCES corporate (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE shareholding');
    }
}
