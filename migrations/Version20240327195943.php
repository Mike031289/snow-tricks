<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240327195943 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE picture (id INT AUTO_INCREMENT NOT NULL, media_id INT NOT NULL, name VARCHAR(255) NOT NULL, INDEX IDX_16DB4F89EA9FDD75 (media_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE video (id INT AUTO_INCREMENT NOT NULL, media_id INT NOT NULL, name VARCHAR(255) NOT NULL, url VARCHAR(255) NOT NULL, INDEX IDX_7CC7DA2CEA9FDD75 (media_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE picture ADD CONSTRAINT FK_16DB4F89EA9FDD75 FOREIGN KEY (media_id) REFERENCES media (id)');
        $this->addSql('ALTER TABLE video ADD CONSTRAINT FK_7CC7DA2CEA9FDD75 FOREIGN KEY (media_id) REFERENCES media (id)');
        $this->addSql('ALTER TABLE comment CHANGE trick_id trick_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE media ADD trick_id INT NOT NULL, DROP type, DROP url');
        $this->addSql('ALTER TABLE media ADD CONSTRAINT FK_6A2CA10CB281BE2E FOREIGN KEY (trick_id) REFERENCES trick (id)');
        $this->addSql('CREATE INDEX IDX_6A2CA10CB281BE2E ON media (trick_id)');
        $this->addSql('ALTER TABLE trick ADD category_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE trick ADD CONSTRAINT FK_D8F0A91E12469DE2 FOREIGN KEY (category_id) REFERENCES category (id)');
        $this->addSql('CREATE INDEX IDX_D8F0A91E12469DE2 ON trick (category_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE picture DROP FOREIGN KEY FK_16DB4F89EA9FDD75');
        $this->addSql('ALTER TABLE video DROP FOREIGN KEY FK_7CC7DA2CEA9FDD75');
        $this->addSql('DROP TABLE picture');
        $this->addSql('DROP TABLE video');
        $this->addSql('ALTER TABLE comment CHANGE trick_id trick_id INT NOT NULL');
        $this->addSql('ALTER TABLE media DROP FOREIGN KEY FK_6A2CA10CB281BE2E');
        $this->addSql('DROP INDEX IDX_6A2CA10CB281BE2E ON media');
        $this->addSql('ALTER TABLE media ADD type VARCHAR(255) NOT NULL, ADD url VARCHAR(255) NOT NULL, DROP trick_id');
        $this->addSql('ALTER TABLE trick DROP FOREIGN KEY FK_D8F0A91E12469DE2');
        $this->addSql('DROP INDEX IDX_D8F0A91E12469DE2 ON trick');
        $this->addSql('ALTER TABLE trick DROP category_id');
    }
}
