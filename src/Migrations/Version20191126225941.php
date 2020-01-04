<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191126225941 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE pizzas (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, price INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE pizzas_films (pizzas_id INT NOT NULL, films_id INT NOT NULL, INDEX IDX_C4375EC17F778084 (pizzas_id), INDEX IDX_C4375EC1939610EE (films_id), PRIMARY KEY(pizzas_id, films_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE pizzas_films ADD CONSTRAINT FK_C4375EC17F778084 FOREIGN KEY (pizzas_id) REFERENCES pizzas (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE pizzas_films ADD CONSTRAINT FK_C4375EC1939610EE FOREIGN KEY (films_id) REFERENCES films (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE pizzas_films DROP FOREIGN KEY FK_C4375EC17F778084');
        $this->addSql('DROP TABLE pizzas');
        $this->addSql('DROP TABLE pizzas_films');
    }
}
