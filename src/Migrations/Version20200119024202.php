<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200119024202 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE comments (id INT AUTO_INCREMENT NOT NULL, film_id INT NOT NULL, serie_id INT NOT NULL, book_id INT NOT NULL, author_id INT NOT NULL, created_at DATETIME NOT NULL, rate INT NOT NULL, content LONGTEXT NOT NULL, INDEX IDX_5F9E962A567F5183 (film_id), INDEX IDX_5F9E962AD94388BD (serie_id), INDEX IDX_5F9E962A16A2B381 (book_id), INDEX IDX_5F9E962AF675F31B (author_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE comments ADD CONSTRAINT FK_5F9E962A567F5183 FOREIGN KEY (film_id) REFERENCES films (id)');
        $this->addSql('ALTER TABLE comments ADD CONSTRAINT FK_5F9E962AD94388BD FOREIGN KEY (serie_id) REFERENCES series (id)');
        $this->addSql('ALTER TABLE comments ADD CONSTRAINT FK_5F9E962A16A2B381 FOREIGN KEY (book_id) REFERENCES books (id)');
        $this->addSql('ALTER TABLE comments ADD CONSTRAINT FK_5F9E962AF675F31B FOREIGN KEY (author_id) REFERENCES user (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE comments');
    }
}
