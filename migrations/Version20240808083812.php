<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240808083812 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE situation (id INT AUTO_INCREMENT NOT NULL, demande_id INT NOT NULL, texte VARCHAR(255) NOT NULL, identifiant VARCHAR(255) NOT NULL, INDEX IDX_EC2D9ACA80E95E18 (demande_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE situation ADD CONSTRAINT FK_EC2D9ACA80E95E18 FOREIGN KEY (demande_id) REFERENCES demande (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE situation DROP FOREIGN KEY FK_EC2D9ACA80E95E18');
        $this->addSql('DROP TABLE situation');
    }
}
