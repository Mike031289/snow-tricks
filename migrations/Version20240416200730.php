<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240416200730 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE media ADD trick_id INT NOT NULL, ADD created_at DATETIME NOT NULL, ADD updated_at DATETIME NOT NULL');
        $this->addSql('ALTER TABLE media ADD CONSTRAINT FK_6A2CA10CB281BE2E FOREIGN KEY (trick_id) REFERENCES trick (id)');
        $this->addSql('CREATE INDEX IDX_6A2CA10CB281BE2E ON media (trick_id)');
        $this->addSql('ALTER TABLE picture DROP FOREIGN KEY FK_16DB4F89B281BE2E');
        $this->addSql('DROP INDEX IDX_16DB4F89B281BE2E ON picture');
        $this->addSql('ALTER TABLE picture DROP trick_id');
        $this->addSql('ALTER TABLE trick ADD created_at DATETIME NOT NULL, ADD updated_at DATETIME NOT NULL, DROP createdAt, DROP updatedAt');
        $this->addSql('ALTER TABLE user CHANGE createdAt created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\'');
        $this->addSql('ALTER TABLE video DROP FOREIGN KEY FK_7CC7DA2CB281BE2E');
        $this->addSql('DROP INDEX IDX_7CC7DA2CB281BE2E ON video');
        $this->addSql('ALTER TABLE video DROP trick_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE media DROP FOREIGN KEY FK_6A2CA10CB281BE2E');
        $this->addSql('DROP INDEX IDX_6A2CA10CB281BE2E ON media');
        $this->addSql('ALTER TABLE media DROP trick_id, DROP created_at, DROP updated_at');
        $this->addSql('ALTER TABLE picture ADD trick_id INT NOT NULL');
        $this->addSql('ALTER TABLE picture ADD CONSTRAINT FK_16DB4F89B281BE2E FOREIGN KEY (trick_id) REFERENCES trick (id)');
        $this->addSql('CREATE INDEX IDX_16DB4F89B281BE2E ON picture (trick_id)');
        $this->addSql('ALTER TABLE trick ADD createdAt DATETIME NOT NULL, ADD updatedAt DATETIME NOT NULL, DROP created_at, DROP updated_at');
        $this->addSql('ALTER TABLE user CHANGE created_at createdAt DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\'');
        $this->addSql('ALTER TABLE video ADD trick_id INT NOT NULL');
        $this->addSql('ALTER TABLE video ADD CONSTRAINT FK_7CC7DA2CB281BE2E FOREIGN KEY (trick_id) REFERENCES trick (id)');
        $this->addSql('CREATE INDEX IDX_7CC7DA2CB281BE2E ON video (trick_id)');
    }
}
