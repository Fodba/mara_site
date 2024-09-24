<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240823070646 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE header (id INT AUTO_INCREMENT NOT NULL, medium_id INT NOT NULL, texte1 VARCHAR(255) NOT NULL, texte2 VARCHAR(255) NOT NULL, INDEX IDX_6E72A8C1E252B6A5 (medium_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE header ADD CONSTRAINT FK_6E72A8C1E252B6A5 FOREIGN KEY (medium_id) REFERENCES medium (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE header DROP FOREIGN KEY FK_6E72A8C1E252B6A5');
        $this->addSql('DROP TABLE header');
    }
}
