<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200107155203 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE books ADD author_id INT NOT NULL');
        $this->addSql('ALTER TABLE books ADD CONSTRAINT FK_4A1B2A92F675F31B FOREIGN KEY (author_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_4A1B2A92F675F31B ON books (author_id)');
        $this->addSql('ALTER TABLE films ADD author_id INT NOT NULL');
        $this->addSql('ALTER TABLE films ADD CONSTRAINT FK_CEECCA51F675F31B FOREIGN KEY (author_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_CEECCA51F675F31B ON films (author_id)');
        $this->addSql('ALTER TABLE series ADD author_id INT NOT NULL');
        $this->addSql('ALTER TABLE series ADD CONSTRAINT FK_3A10012DF675F31B FOREIGN KEY (author_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_3A10012DF675F31B ON series (author_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE books DROP FOREIGN KEY FK_4A1B2A92F675F31B');
        $this->addSql('DROP INDEX IDX_4A1B2A92F675F31B ON books');
        $this->addSql('ALTER TABLE books DROP author_id');
        $this->addSql('ALTER TABLE films DROP FOREIGN KEY FK_CEECCA51F675F31B');
        $this->addSql('DROP INDEX IDX_CEECCA51F675F31B ON films');
        $this->addSql('ALTER TABLE films DROP author_id');
        $this->addSql('ALTER TABLE series DROP FOREIGN KEY FK_3A10012DF675F31B');
        $this->addSql('DROP INDEX IDX_3A10012DF675F31B ON series');
        $this->addSql('ALTER TABLE series DROP author_id');
    }
}
