<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200415162044 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE devis ADD partie_corp_id INT DEFAULT NULL, ADD commentaire LONGTEXT DEFAULT NULL');
        $this->addSql('ALTER TABLE devis ADD CONSTRAINT FK_8B27C52BEBEA199E FOREIGN KEY (partie_corp_id) REFERENCES corp (id)');
        $this->addSql('CREATE INDEX IDX_8B27C52BEBEA199E ON devis (partie_corp_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE devis DROP FOREIGN KEY FK_8B27C52BEBEA199E');
        $this->addSql('DROP INDEX IDX_8B27C52BEBEA199E ON devis');
        $this->addSql('ALTER TABLE devis DROP partie_corp_id, DROP commentaire');
    }
}
