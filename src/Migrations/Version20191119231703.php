<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191119231703 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE autor (id INT AUTO_INCREMENT NOT NULL, firstname VARCHAR(255) NOT NULL, middlename VARCHAR(255) DEFAULT NULL, lastname VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE books (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, slug VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, cover_image VARCHAR(255) NOT NULL, pages INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE books_writer (books_id INT NOT NULL, writer_id INT NOT NULL, INDEX IDX_536A608E7DD8AC20 (books_id), INDEX IDX_536A608E1BC7E6B6 (writer_id), PRIMARY KEY(books_id, writer_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE books_editor (books_id INT NOT NULL, editor_id INT NOT NULL, INDEX IDX_83B49B67DD8AC20 (books_id), INDEX IDX_83B49B66995AC4C (editor_id), PRIMARY KEY(books_id, editor_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE books_year (books_id INT NOT NULL, year_id INT NOT NULL, INDEX IDX_980BD3187DD8AC20 (books_id), INDEX IDX_980BD31840C1FEA7 (year_id), PRIMARY KEY(books_id, year_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE country (id INT AUTO_INCREMENT NOT NULL, countryname VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE editor (id INT AUTO_INCREMENT NOT NULL, editorname VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE films (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, slug VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, cover_image VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE films_person (films_id INT NOT NULL, person_id INT NOT NULL, INDEX IDX_83885ACF939610EE (films_id), INDEX IDX_83885ACF217BBB47 (person_id), PRIMARY KEY(films_id, person_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE films_country (films_id INT NOT NULL, country_id INT NOT NULL, INDEX IDX_E17996C5939610EE (films_id), INDEX IDX_E17996C5F92F3E70 (country_id), PRIMARY KEY(films_id, country_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE films_autor (films_id INT NOT NULL, autor_id INT NOT NULL, INDEX IDX_D8D0DCC4939610EE (films_id), INDEX IDX_D8D0DCC414D45BBE (autor_id), PRIMARY KEY(films_id, autor_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE films_year (films_id INT NOT NULL, year_id INT NOT NULL, INDEX IDX_FA53831939610EE (films_id), INDEX IDX_FA5383140C1FEA7 (year_id), PRIMARY KEY(films_id, year_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE person (id INT AUTO_INCREMENT NOT NULL, firstname VARCHAR(255) NOT NULL, middlename VARCHAR(255) DEFAULT NULL, lastname VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE series (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, slug VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, cover_image VARCHAR(255) NOT NULL, seasons INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE series_person (series_id INT NOT NULL, person_id INT NOT NULL, INDEX IDX_57AF324B5278319C (series_id), INDEX IDX_57AF324B217BBB47 (person_id), PRIMARY KEY(series_id, person_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE series_country (series_id INT NOT NULL, country_id INT NOT NULL, INDEX IDX_B78F6945278319C (series_id), INDEX IDX_B78F694F92F3E70 (country_id), PRIMARY KEY(series_id, country_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE series_autor (series_id INT NOT NULL, autor_id INT NOT NULL, INDEX IDX_4488BAA75278319C (series_id), INDEX IDX_4488BAA714D45BBE (autor_id), PRIMARY KEY(series_id, autor_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE series_year (series_id INT NOT NULL, year_id INT NOT NULL, INDEX IDX_5EC5F2F55278319C (series_id), INDEX IDX_5EC5F2F540C1FEA7 (year_id), PRIMARY KEY(series_id, year_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE writer (id INT AUTO_INCREMENT NOT NULL, firstname VARCHAR(255) NOT NULL, middlename VARCHAR(255) DEFAULT NULL, lastname VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE year (id INT AUTO_INCREMENT NOT NULL, date DATE NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE books_writer ADD CONSTRAINT FK_536A608E7DD8AC20 FOREIGN KEY (books_id) REFERENCES books (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE books_writer ADD CONSTRAINT FK_536A608E1BC7E6B6 FOREIGN KEY (writer_id) REFERENCES writer (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE books_editor ADD CONSTRAINT FK_83B49B67DD8AC20 FOREIGN KEY (books_id) REFERENCES books (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE books_editor ADD CONSTRAINT FK_83B49B66995AC4C FOREIGN KEY (editor_id) REFERENCES editor (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE books_year ADD CONSTRAINT FK_980BD3187DD8AC20 FOREIGN KEY (books_id) REFERENCES books (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE books_year ADD CONSTRAINT FK_980BD31840C1FEA7 FOREIGN KEY (year_id) REFERENCES year (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE films_person ADD CONSTRAINT FK_83885ACF939610EE FOREIGN KEY (films_id) REFERENCES films (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE films_person ADD CONSTRAINT FK_83885ACF217BBB47 FOREIGN KEY (person_id) REFERENCES person (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE films_country ADD CONSTRAINT FK_E17996C5939610EE FOREIGN KEY (films_id) REFERENCES films (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE films_country ADD CONSTRAINT FK_E17996C5F92F3E70 FOREIGN KEY (country_id) REFERENCES country (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE films_autor ADD CONSTRAINT FK_D8D0DCC4939610EE FOREIGN KEY (films_id) REFERENCES films (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE films_autor ADD CONSTRAINT FK_D8D0DCC414D45BBE FOREIGN KEY (autor_id) REFERENCES autor (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE films_year ADD CONSTRAINT FK_FA53831939610EE FOREIGN KEY (films_id) REFERENCES films (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE films_year ADD CONSTRAINT FK_FA5383140C1FEA7 FOREIGN KEY (year_id) REFERENCES year (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE series_person ADD CONSTRAINT FK_57AF324B5278319C FOREIGN KEY (series_id) REFERENCES series (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE series_person ADD CONSTRAINT FK_57AF324B217BBB47 FOREIGN KEY (person_id) REFERENCES person (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE series_country ADD CONSTRAINT FK_B78F6945278319C FOREIGN KEY (series_id) REFERENCES series (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE series_country ADD CONSTRAINT FK_B78F694F92F3E70 FOREIGN KEY (country_id) REFERENCES country (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE series_autor ADD CONSTRAINT FK_4488BAA75278319C FOREIGN KEY (series_id) REFERENCES series (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE series_autor ADD CONSTRAINT FK_4488BAA714D45BBE FOREIGN KEY (autor_id) REFERENCES autor (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE series_year ADD CONSTRAINT FK_5EC5F2F55278319C FOREIGN KEY (series_id) REFERENCES series (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE series_year ADD CONSTRAINT FK_5EC5F2F540C1FEA7 FOREIGN KEY (year_id) REFERENCES year (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE films_autor DROP FOREIGN KEY FK_D8D0DCC414D45BBE');
        $this->addSql('ALTER TABLE series_autor DROP FOREIGN KEY FK_4488BAA714D45BBE');
        $this->addSql('ALTER TABLE books_writer DROP FOREIGN KEY FK_536A608E7DD8AC20');
        $this->addSql('ALTER TABLE books_editor DROP FOREIGN KEY FK_83B49B67DD8AC20');
        $this->addSql('ALTER TABLE books_year DROP FOREIGN KEY FK_980BD3187DD8AC20');
        $this->addSql('ALTER TABLE films_country DROP FOREIGN KEY FK_E17996C5F92F3E70');
        $this->addSql('ALTER TABLE series_country DROP FOREIGN KEY FK_B78F694F92F3E70');
        $this->addSql('ALTER TABLE books_editor DROP FOREIGN KEY FK_83B49B66995AC4C');
        $this->addSql('ALTER TABLE films_person DROP FOREIGN KEY FK_83885ACF939610EE');
        $this->addSql('ALTER TABLE films_country DROP FOREIGN KEY FK_E17996C5939610EE');
        $this->addSql('ALTER TABLE films_autor DROP FOREIGN KEY FK_D8D0DCC4939610EE');
        $this->addSql('ALTER TABLE films_year DROP FOREIGN KEY FK_FA53831939610EE');
        $this->addSql('ALTER TABLE films_person DROP FOREIGN KEY FK_83885ACF217BBB47');
        $this->addSql('ALTER TABLE series_person DROP FOREIGN KEY FK_57AF324B217BBB47');
        $this->addSql('ALTER TABLE series_person DROP FOREIGN KEY FK_57AF324B5278319C');
        $this->addSql('ALTER TABLE series_country DROP FOREIGN KEY FK_B78F6945278319C');
        $this->addSql('ALTER TABLE series_autor DROP FOREIGN KEY FK_4488BAA75278319C');
        $this->addSql('ALTER TABLE series_year DROP FOREIGN KEY FK_5EC5F2F55278319C');
        $this->addSql('ALTER TABLE books_writer DROP FOREIGN KEY FK_536A608E1BC7E6B6');
        $this->addSql('ALTER TABLE books_year DROP FOREIGN KEY FK_980BD31840C1FEA7');
        $this->addSql('ALTER TABLE films_year DROP FOREIGN KEY FK_FA5383140C1FEA7');
        $this->addSql('ALTER TABLE series_year DROP FOREIGN KEY FK_5EC5F2F540C1FEA7');
        $this->addSql('DROP TABLE autor');
        $this->addSql('DROP TABLE books');
        $this->addSql('DROP TABLE books_writer');
        $this->addSql('DROP TABLE books_editor');
        $this->addSql('DROP TABLE books_year');
        $this->addSql('DROP TABLE country');
        $this->addSql('DROP TABLE editor');
        $this->addSql('DROP TABLE films');
        $this->addSql('DROP TABLE films_person');
        $this->addSql('DROP TABLE films_country');
        $this->addSql('DROP TABLE films_autor');
        $this->addSql('DROP TABLE films_year');
        $this->addSql('DROP TABLE person');
        $this->addSql('DROP TABLE series');
        $this->addSql('DROP TABLE series_person');
        $this->addSql('DROP TABLE series_country');
        $this->addSql('DROP TABLE series_autor');
        $this->addSql('DROP TABLE series_year');
        $this->addSql('DROP TABLE writer');
        $this->addSql('DROP TABLE year');
    }
}
