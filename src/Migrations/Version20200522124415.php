<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200522124415 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE cuestion_unidad CHANGE cuestion_id cuestion_id INT DEFAULT NULL, CHANGE unidad_id unidad_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE usuario CHANGE roles roles JSON NOT NULL, CHANGE telefono telefono VARCHAR(255) NOT NULL, CHANGE fecha_baja fecha_baja DATE DEFAULT NULL');
        $this->addSql('ALTER TABLE tipo_partes_interesadas CHANGE unidad_de_gestion_id unidad_de_gestion_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE partes_interesadas CHANGE tipo_parte_interesada_id tipo_parte_interesada_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE expectativa CHANGE parte_interesada_id parte_interesada_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE factores_potenciales_de_exito CHANGE fecha_baja fecha_baja DATE DEFAULT NULL');
        $this->addSql('ALTER TABLE unidad_de_gestion CHANGE unidad_de_gestion_id unidad_de_gestion_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE contrato CHANGE fecha_baja fecha_baja DATE DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE contrato CHANGE fecha_baja fecha_baja DATE DEFAULT \'NULL\'');
        $this->addSql('ALTER TABLE cuestion_unidad CHANGE cuestion_id cuestion_id INT DEFAULT NULL, CHANGE unidad_id unidad_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE expectativa CHANGE parte_interesada_id parte_interesada_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE factores_potenciales_de_exito CHANGE fecha_baja fecha_baja DATE DEFAULT \'NULL\'');
        $this->addSql('ALTER TABLE partes_interesadas CHANGE tipo_parte_interesada_id tipo_parte_interesada_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE tipo_partes_interesadas CHANGE unidad_de_gestion_id unidad_de_gestion_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE unidad_de_gestion CHANGE unidad_de_gestion_id unidad_de_gestion_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE usuario CHANGE roles roles LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_bin`, CHANGE telefono telefono VARCHAR(9) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE fecha_baja fecha_baja DATE DEFAULT \'NULL\'');
    }
}
