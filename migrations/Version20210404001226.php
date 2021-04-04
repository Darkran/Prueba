<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210404001226 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE empresas DROP FOREIGN KEY FK_70DD49A5DE95C867');
        $this->addSql('ALTER TABLE empresas CHANGE sector_id sector_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE empresas ADD CONSTRAINT FK_70DD49A5DE95C867 FOREIGN KEY (sector_id) REFERENCES sectores (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE empresas DROP FOREIGN KEY FK_70DD49A5DE95C867');
        $this->addSql('ALTER TABLE empresas CHANGE sector_id sector_id INT NOT NULL');
        $this->addSql('ALTER TABLE empresas ADD CONSTRAINT FK_70DD49A5DE95C867 FOREIGN KEY (sector_id) REFERENCES sectores (id)');
    }
}
