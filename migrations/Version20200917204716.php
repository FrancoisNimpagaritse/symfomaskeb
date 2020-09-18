<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200917204716 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE category_expense (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE category_income (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, description VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE donor (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, type VARCHAR(255) NOT NULL, adresse VARCHAR(255) NOT NULL, phone VARCHAR(255) DEFAULT NULL, email VARCHAR(255) DEFAULT NULL, date_joined DATE NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE expense (id INT AUTO_INCREMENT NOT NULL, category_expense_id INT NOT NULL, date_expense DATE NOT NULL, description VARCHAR(255) NOT NULL, amount DOUBLE PRECISION NOT NULL, INDEX IDX_2D3A8DA6D58B8B05 (category_expense_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE income (id INT AUTO_INCREMENT NOT NULL, category_income_id INT NOT NULL, donor_id INT NOT NULL, date_expense DATE NOT NULL, description VARCHAR(255) NOT NULL, amount DOUBLE PRECISION NOT NULL, INDEX IDX_3FA862D0A36E00F0 (category_income_id), INDEX IDX_3FA862D03DD7B7A7 (donor_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE expense ADD CONSTRAINT FK_2D3A8DA6D58B8B05 FOREIGN KEY (category_expense_id) REFERENCES category_expense (id)');
        $this->addSql('ALTER TABLE income ADD CONSTRAINT FK_3FA862D0A36E00F0 FOREIGN KEY (category_income_id) REFERENCES category_income (id)');
        $this->addSql('ALTER TABLE income ADD CONSTRAINT FK_3FA862D03DD7B7A7 FOREIGN KEY (donor_id) REFERENCES donor (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE expense DROP FOREIGN KEY FK_2D3A8DA6D58B8B05');
        $this->addSql('ALTER TABLE income DROP FOREIGN KEY FK_3FA862D0A36E00F0');
        $this->addSql('ALTER TABLE income DROP FOREIGN KEY FK_3FA862D03DD7B7A7');
        $this->addSql('DROP TABLE category_expense');
        $this->addSql('DROP TABLE category_income');
        $this->addSql('DROP TABLE donor');
        $this->addSql('DROP TABLE expense');
        $this->addSql('DROP TABLE income');
    }
}
