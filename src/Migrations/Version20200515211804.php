<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200515211804 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE tipo_partes_interesadas (id INT AUTO_INCREMENT NOT NULL, parte_interesada_id INT DEFAULT NULL, nombre VARCHAR(255) NOT NULL, INDEX IDX_631BA757EC8BC28 (parte_interesada_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE partes_interesadas (id INT AUTO_INCREMENT NOT NULL, unidad_de_gestion_id INT NOT NULL, nombre VARCHAR(255) NOT NULL, INDEX IDX_FA9836F8D9176606 (unidad_de_gestion_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE expectativa_partes_interesadas (id INT AUTO_INCREMENT NOT NULL, parte_interesada_id INT DEFAULT NULL, nombre VARCHAR(255) NOT NULL, INDEX IDX_5B0323E0EC8BC28 (parte_interesada_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE tipo_partes_interesadas ADD CONSTRAINT FK_631BA757EC8BC28 FOREIGN KEY (parte_interesada_id) REFERENCES partes_interesadas (id)');
        $this->addSql('ALTER TABLE partes_interesadas ADD CONSTRAINT FK_FA9836F8D9176606 FOREIGN KEY (unidad_de_gestion_id) REFERENCES unidad_de_gestion (id)');
        $this->addSql('ALTER TABLE expectativa_partes_interesadas ADD CONSTRAINT FK_5B0323E0EC8BC28 FOREIGN KEY (parte_interesada_id) REFERENCES partes_interesadas (id)');
        $this->addSql('ALTER TABLE cuestion_unidad CHANGE cuestion_id cuestion_id INT DEFAULT NULL, CHANGE unidad_id unidad_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE factores_potenciales_de_exito CHANGE fecha_baja fecha_baja DATE DEFAULT NULL');
        $this->addSql('ALTER TABLE contrato CHANGE fecha_baja fecha_baja DATE DEFAULT NULL');
        $this->addSql('ALTER TABLE unidad_de_gestion CHANGE unidad_de_gestion_id unidad_de_gestion_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE usuario CHANGE roles roles JSON NOT NULL, CHANGE fecha_baja fecha_baja DATE DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE tipo_partes_interesadas DROP FOREIGN KEY FK_631BA757EC8BC28');
        $this->addSql('ALTER TABLE expectativa_partes_interesadas DROP FOREIGN KEY FK_5B0323E0EC8BC28');
        $this->addSql('DROP TABLE tipo_partes_interesadas');
        $this->addSql('DROP TABLE partes_interesadas');
        $this->addSql('DROP TABLE expectativa_partes_interesadas');
        $this->addSql('ALTER TABLE contrato CHANGE fecha_baja fecha_baja DATE DEFAULT \'NULL\'');
        $this->addSql('ALTER TABLE cuestion_unidad CHANGE cuestion_id cuestion_id INT DEFAULT NULL, CHANGE unidad_id unidad_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE factores_potenciales_de_exito CHANGE fecha_baja fecha_baja DATE DEFAULT \'NULL\'');
        $this->addSql('ALTER TABLE unidad_de_gestion CHANGE unidad_de_gestion_id unidad_de_gestion_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE usuario CHANGE roles roles LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_bin`, CHANGE fecha_baja fecha_baja DATE DEFAULT \'NULL\'');
    }
}
