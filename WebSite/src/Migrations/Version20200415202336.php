<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200415202336 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE devis (id INT AUTO_INCREMENT NOT NULL, partie_corp_id INT DEFAULT NULL, tarif_horaire_id INT NOT NULL, filename VARCHAR(255) NOT NULL, temp INT NOT NULL, commentaire LONGTEXT DEFAULT NULL, updated_at DATETIME NOT NULL, INDEX IDX_8B27C52BEBEA199E (partie_corp_id), UNIQUE INDEX UNIQ_8B27C52B92840F7 (tarif_horaire_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tarif_horaire (id INT AUTO_INCREMENT NOT NULL, valeur_tarif NUMERIC(10, 2) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE devis ADD CONSTRAINT FK_8B27C52BEBEA199E FOREIGN KEY (partie_corp_id) REFERENCES corp (id)');
        $this->addSql('ALTER TABLE devis ADD CONSTRAINT FK_8B27C52B92840F7 FOREIGN KEY (tarif_horaire_id) REFERENCES tarif_horaire (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE devis DROP FOREIGN KEY FK_8B27C52B92840F7');
        $this->addSql('DROP TABLE devis');
        $this->addSql('DROP TABLE tarif_horaire');
    }
}
