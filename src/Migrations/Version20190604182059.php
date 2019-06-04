<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190604182059 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE compte_de_resultat ADD variation_stock_marchandise INT NOT NULL, ADD produits_nets_cessions_valeurs_mobiles_placement INT NOT NULL, ADD production_vendue_de_biens INT NOT NULL, ADD production_stocked INT NOT NULL, ADD variation_stock_matiere_premiere_et_appro INT NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE compte_de_resultat DROP variation_stock_marchandise, DROP produits_nets_cessions_valeurs_mobiles_placement, DROP production_vendue_de_biens, DROP production_stocked, DROP variation_stock_matiere_premiere_et_appro');
    }
}
