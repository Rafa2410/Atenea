<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200501091232 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE usuario CHANGE roles roles JSON NOT NULL, CHANGE fecha_baja fecha_baja DATE DEFAULT NULL');
        $this->addSql('ALTER TABLE unidad_de_gestion ADD unidad_de_gestion_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE unidad_de_gestion ADD CONSTRAINT FK_F3EC8CDBD9176606 FOREIGN KEY (unidad_de_gestion_id) REFERENCES unidad_de_gestion (id)');
        $this->addSql('CREATE INDEX IDX_F3EC8CDBD9176606 ON unidad_de_gestion (unidad_de_gestion_id)');
        $this->addSql('ALTER TABLE contrato CHANGE fecha_baja fecha_baja DATE DEFAULT NULL');
        $this->addSql('ALTER TABLE contrato ADD CONSTRAINT FK_66696523CEE5691C FOREIGN KEY (unidad_id_id) REFERENCES unidad_de_gestion (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_66696523CEE5691C ON contrato (unidad_id_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE contrato DROP FOREIGN KEY FK_66696523CEE5691C');
        $this->addSql('DROP INDEX UNIQ_66696523CEE5691C ON contrato');
        $this->addSql('ALTER TABLE contrato CHANGE fecha_baja fecha_baja DATE DEFAULT \'NULL\'');
        $this->addSql('ALTER TABLE unidad_de_gestion DROP FOREIGN KEY FK_F3EC8CDBD9176606');
        $this->addSql('DROP INDEX IDX_F3EC8CDBD9176606 ON unidad_de_gestion');
        $this->addSql('ALTER TABLE unidad_de_gestion DROP unidad_de_gestion_id');
        $this->addSql('ALTER TABLE usuario CHANGE roles roles LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_bin`, CHANGE fecha_baja fecha_baja DATE DEFAULT \'NULL\'');
    }
}
