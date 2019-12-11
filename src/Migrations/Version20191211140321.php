<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191211140321 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE book ADD publisher_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE book ADD CONSTRAINT FK_CBE5A33140C86FCE FOREIGN KEY (publisher_id) REFERENCES publisher (id)');
        $this->addSql('CREATE INDEX IDX_CBE5A33140C86FCE ON book (publisher_id)');
        $this->addSql('ALTER TABLE publisher CHANGE website website VARCHAR(180) NOT NULL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_9CE8D5465E237E06 ON publisher (name)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE book DROP FOREIGN KEY FK_CBE5A33140C86FCE');
        $this->addSql('DROP INDEX IDX_CBE5A33140C86FCE ON book');
        $this->addSql('ALTER TABLE book DROP publisher_id');
        $this->addSql('DROP INDEX UNIQ_9CE8D5465E237E06 ON publisher');
        $this->addSql('ALTER TABLE publisher CHANGE website website VARCHAR(180) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
    }
}
