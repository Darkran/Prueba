<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210402092941 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE empresas (id INT AUTO_INCREMENT NOT NULL, sector_id INT NOT NULL, nombre VARCHAR(20) NOT NULL, telefono INT DEFAULT NULL, email VARCHAR(50) DEFAULT NULL, INDEX IDX_70DD49A5DE95C867 (sector_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE sectores (id INT AUTO_INCREMENT NOT NULL, nombre VARCHAR(20) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE empresas ADD CONSTRAINT FK_70DD49A5DE95C867 FOREIGN KEY (sector_id) REFERENCES sectores (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE empresas DROP FOREIGN KEY FK_70DD49A5DE95C867');
        $this->addSql('DROP TABLE empresas');
        $this->addSql('DROP TABLE sectores');
    }
}
