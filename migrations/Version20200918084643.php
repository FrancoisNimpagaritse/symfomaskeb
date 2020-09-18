<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200918084643 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE expense ADD editor_id INT NOT NULL');
        $this->addSql('ALTER TABLE expense ADD CONSTRAINT FK_2D3A8DA66995AC4C FOREIGN KEY (editor_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_2D3A8DA66995AC4C ON expense (editor_id)');
        $this->addSql('ALTER TABLE income ADD editor_id INT NOT NULL');
        $this->addSql('ALTER TABLE income ADD CONSTRAINT FK_3FA862D06995AC4C FOREIGN KEY (editor_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_3FA862D06995AC4C ON income (editor_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE expense DROP FOREIGN KEY FK_2D3A8DA66995AC4C');
        $this->addSql('DROP INDEX IDX_2D3A8DA66995AC4C ON expense');
        $this->addSql('ALTER TABLE expense DROP editor_id');
        $this->addSql('ALTER TABLE income DROP FOREIGN KEY FK_3FA862D06995AC4C');
        $this->addSql('DROP INDEX IDX_3FA862D06995AC4C ON income');
        $this->addSql('ALTER TABLE income DROP editor_id');
    }
}
