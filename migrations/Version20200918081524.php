<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200918081524 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE child (id INT AUTO_INCREMENT NOT NULL, firstname VARCHAR(50) NOT NULL, lastname VARCHAR(50) NOT NULL, date_bith DATE NOT NULL, firstname_father VARCHAR(50) NOT NULL, lastname_father VARCHAR(50) NOT NULL, firstname_mother VARCHAR(50) NOT NULL, lastname_mother VARCHAR(50) NOT NULL, place_of_birth VARCHAR(255) DEFAULT NULL, commune_of_birth VARCHAR(50) DEFAULT NULL, province_of_birth VARCHAR(50) DEFAULT NULL, adresse_commune VARCHAR(50) NOT NULL, adresse_zone VARCHAR(50) NOT NULL, adresse_province VARCHAR(50) NOT NULL, description VARCHAR(255) DEFAULT NULL, photo VARCHAR(255) DEFAULT NULL, class VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE child');
    }
}
