<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190429142607 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf('mysql' !== $this->connection->getDatabasePlatform()->getName(), 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE password CHANGE category_id category_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE password ADD CONSTRAINT FK_35C246D512469DE2 FOREIGN KEY (category_id) REFERENCES category (id)');
        $this->addSql('ALTER TABLE category ADD lft INT NOT NULL, ADD rght INT NOT NULL, ADD lvl INT NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf('mysql' !== $this->connection->getDatabasePlatform()->getName(), 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE category DROP lft, DROP rght, DROP lvl');
        $this->addSql('ALTER TABLE password DROP FOREIGN KEY FK_35C246D512469DE2');
        $this->addSql('ALTER TABLE password CHANGE category_id category_id INT DEFAULT NULL');
    }
}
