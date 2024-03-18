<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240318190918 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE categorie CHANGE about_categorie about_categorie LONGTEXT DEFAULT NULL, CHANGE created_at created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\'');
        $this->addSql('ALTER TABLE comment DROP FOREIGN KEY comment_ibfk_1');
        $this->addSql('ALTER TABLE comment DROP FOREIGN KEY comment_ibfk_2');
        $this->addSql('DROP INDEX trick_id ON comment');
        $this->addSql('DROP INDEX user_id ON comment');
        $this->addSql('ALTER TABLE comment DROP trick_id, DROP user_id, CHANGE content content LONGTEXT DEFAULT NULL, CHANGE created_at created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\'');
        $this->addSql('ALTER TABLE media DROP FOREIGN KEY media_ibfk_1');
        $this->addSql('DROP INDEX trick_id ON media');
        $this->addSql('ALTER TABLE media DROP trick_id');
        $this->addSql('ALTER TABLE trick DROP FOREIGN KEY trick_ibfk_1');
        $this->addSql('ALTER TABLE trick DROP FOREIGN KEY trick_ibfk_2');
        $this->addSql('DROP INDEX name ON trick');
        $this->addSql('DROP INDEX user_id ON trick');
        $this->addSql('DROP INDEX group_id ON trick');
        $this->addSql('ALTER TABLE trick ADD categorie_id INT DEFAULT NULL, DROP group_id, CHANGE description description LONGTEXT NOT NULL, CHANGE picture picture VARCHAR(255) NOT NULL, CHANGE video video VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE trick ADD CONSTRAINT FK_D8F0A91EBCF5E72D FOREIGN KEY (categorie_id) REFERENCES categorie (id)');
        $this->addSql('CREATE INDEX IDX_D8F0A91EBCF5E72D ON trick (categorie_id)');
        $this->addSql('DROP INDEX pseudo ON user');
        $this->addSql('DROP INDEX email ON user');
        $this->addSql('ALTER TABLE user ADD first_name VARCHAR(255) NOT NULL, ADD last_name VARCHAR(255) NOT NULL, ADD user_name VARCHAR(255) NOT NULL, ADD user_picture VARCHAR(255) NOT NULL, ADD password_confirm VARCHAR(255) NOT NULL, DROP firstName, DROP lastName, DROP pseudo, DROP userPicture, DROP token, CHANGE created_at created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\'');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE messenger_messages');
        $this->addSql('ALTER TABLE categorie CHANGE about_categorie about_categorie TEXT DEFAULT NULL, CHANGE created_at created_at DATETIME NOT NULL');
        $this->addSql('ALTER TABLE comment ADD trick_id INT NOT NULL, ADD user_id INT NOT NULL, CHANGE content content TEXT DEFAULT NULL, CHANGE created_at created_at DATETIME NOT NULL');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT comment_ibfk_1 FOREIGN KEY (trick_id) REFERENCES trick (id)');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT comment_ibfk_2 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX trick_id ON comment (trick_id)');
        $this->addSql('CREATE INDEX user_id ON comment (user_id)');
        $this->addSql('ALTER TABLE media ADD trick_id INT NOT NULL');
        $this->addSql('ALTER TABLE media ADD CONSTRAINT media_ibfk_1 FOREIGN KEY (trick_id) REFERENCES trick (id)');
        $this->addSql('CREATE INDEX trick_id ON media (trick_id)');
        $this->addSql('ALTER TABLE trick DROP FOREIGN KEY FK_D8F0A91EBCF5E72D');
        $this->addSql('DROP INDEX IDX_D8F0A91EBCF5E72D ON trick');
        $this->addSql('ALTER TABLE trick ADD group_id INT NOT NULL, DROP categorie_id, CHANGE description description TEXT DEFAULT NULL, CHANGE picture picture VARCHAR(255) DEFAULT NULL, CHANGE video video VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE trick ADD CONSTRAINT trick_ibfk_1 FOREIGN KEY (group_id) REFERENCES categorie (id)');
        $this->addSql('ALTER TABLE trick ADD CONSTRAINT trick_ibfk_2 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE UNIQUE INDEX name ON trick (name)');
        $this->addSql('CREATE INDEX user_id ON trick (user_id)');
        $this->addSql('CREATE INDEX group_id ON trick (group_id)');
        $this->addSql('ALTER TABLE user ADD firstName VARCHAR(255) NOT NULL, ADD lastName VARCHAR(255) NOT NULL, ADD pseudo VARCHAR(255) NOT NULL, ADD userPicture VARCHAR(255) NOT NULL, ADD token VARCHAR(255) NOT NULL, DROP first_name, DROP last_name, DROP user_name, DROP user_picture, DROP password_confirm, CHANGE created_at created_at DATETIME NOT NULL');
        $this->addSql('CREATE UNIQUE INDEX pseudo ON user (pseudo)');
        $this->addSql('CREATE UNIQUE INDEX email ON user (email)');
    }
}
