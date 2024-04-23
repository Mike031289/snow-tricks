<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240327213200 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE media ADD name VARCHAR(255) NOT NULL, ADD discr VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE picture DROP FOREIGN KEY FK_16DB4F89EA9FDD75');
        $this->addSql('DROP INDEX IDX_16DB4F89EA9FDD75 ON picture');
        $this->addSql('ALTER TABLE picture DROP media_id, CHANGE id id INT NOT NULL, CHANGE name path VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE picture ADD CONSTRAINT FK_16DB4F89BF396750 FOREIGN KEY (id) REFERENCES media (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE video DROP FOREIGN KEY FK_7CC7DA2CEA9FDD75');
        $this->addSql('DROP INDEX IDX_7CC7DA2CEA9FDD75 ON video');
        $this->addSql('ALTER TABLE video DROP media_id, DROP name, CHANGE id id INT NOT NULL');
        $this->addSql('ALTER TABLE video ADD CONSTRAINT FK_7CC7DA2CBF396750 FOREIGN KEY (id) REFERENCES media (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE media DROP name, DROP discr');
        $this->addSql('ALTER TABLE picture DROP FOREIGN KEY FK_16DB4F89BF396750');
        $this->addSql('ALTER TABLE picture ADD media_id INT NOT NULL, CHANGE id id INT AUTO_INCREMENT NOT NULL, CHANGE path name VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE picture ADD CONSTRAINT FK_16DB4F89EA9FDD75 FOREIGN KEY (media_id) REFERENCES media (id)');
        $this->addSql('CREATE INDEX IDX_16DB4F89EA9FDD75 ON picture (media_id)');
        $this->addSql('ALTER TABLE video DROP FOREIGN KEY FK_7CC7DA2CBF396750');
        $this->addSql('ALTER TABLE video ADD media_id INT NOT NULL, ADD name VARCHAR(255) NOT NULL, CHANGE id id INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE video ADD CONSTRAINT FK_7CC7DA2CEA9FDD75 FOREIGN KEY (media_id) REFERENCES media (id)');
        $this->addSql('CREATE INDEX IDX_7CC7DA2CEA9FDD75 ON video (media_id)');
    }
}
