<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200519183635 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE tipo_partes_interesadas (id INT AUTO_INCREMENT NOT NULL, unidad_de_gestion_id INT DEFAULT NULL, nombre VARCHAR(255) NOT NULL, INDEX IDX_631BA757D9176606 (unidad_de_gestion_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE partes_interesadas (id INT AUTO_INCREMENT NOT NULL, tipo_parte_interesada_id INT DEFAULT NULL, nombre VARCHAR(255) NOT NULL, INDEX IDX_FA9836F8483881C0 (tipo_parte_interesada_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE expectativa (id INT AUTO_INCREMENT NOT NULL, parte_interesada_id INT DEFAULT NULL, nombre VARCHAR(255) NOT NULL, INDEX IDX_A9062C78EC8BC28 (parte_interesada_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE tipo_partes_interesadas ADD CONSTRAINT FK_631BA757D9176606 FOREIGN KEY (unidad_de_gestion_id) REFERENCES unidad_de_gestion (id)');
        $this->addSql('ALTER TABLE partes_interesadas ADD CONSTRAINT FK_FA9836F8483881C0 FOREIGN KEY (tipo_parte_interesada_id) REFERENCES tipo_partes_interesadas (id)');
        $this->addSql('ALTER TABLE expectativa ADD CONSTRAINT FK_A9062C78EC8BC28 FOREIGN KEY (parte_interesada_id) REFERENCES partes_interesadas (id)');
        $this->addSql('ALTER TABLE cuestion_unidad CHANGE cuestion_id cuestion_id INT DEFAULT NULL, CHANGE unidad_id unidad_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE usuario CHANGE roles roles JSON NOT NULL, CHANGE fecha_baja fecha_baja DATE DEFAULT NULL');
        $this->addSql('ALTER TABLE usuario_unidad_permiso DROP FOREIGN KEY FK_ACB3A7836CEFAD37');
        $this->addSql('ALTER TABLE usuario_unidad_permiso DROP FOREIGN KEY FK_ACB3A7839D01464C');
        $this->addSql('ALTER TABLE usuario_unidad_permiso DROP FOREIGN KEY FK_ACB3A783DB38439E');
        $this->addSql('ALTER TABLE usuario_unidad_permiso ADD CONSTRAINT FK_ACB3A7836CEFAD37 FOREIGN KEY (permiso_id) REFERENCES permisos (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE usuario_unidad_permiso ADD CONSTRAINT FK_ACB3A7839D01464C FOREIGN KEY (unidad_id) REFERENCES unidad_de_gestion (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE usuario_unidad_permiso ADD CONSTRAINT FK_ACB3A783DB38439E FOREIGN KEY (usuario_id) REFERENCES usuario (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE factores_potenciales_de_exito CHANGE fecha_baja fecha_baja DATE DEFAULT NULL');
        $this->addSql('ALTER TABLE unidad_de_gestion CHANGE unidad_de_gestion_id unidad_de_gestion_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE contrato CHANGE fecha_baja fecha_baja DATE DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE partes_interesadas DROP FOREIGN KEY FK_FA9836F8483881C0');
        $this->addSql('ALTER TABLE expectativa DROP FOREIGN KEY FK_A9062C78EC8BC28');
        $this->addSql('DROP TABLE tipo_partes_interesadas');
        $this->addSql('DROP TABLE partes_interesadas');
        $this->addSql('DROP TABLE expectativa');
        $this->addSql('ALTER TABLE contrato CHANGE fecha_baja fecha_baja DATE DEFAULT \'NULL\'');
        $this->addSql('ALTER TABLE cuestion_unidad CHANGE cuestion_id cuestion_id INT DEFAULT NULL, CHANGE unidad_id unidad_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE factores_potenciales_de_exito CHANGE fecha_baja fecha_baja DATE DEFAULT \'NULL\'');
        $this->addSql('ALTER TABLE unidad_de_gestion CHANGE unidad_de_gestion_id unidad_de_gestion_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE usuario CHANGE roles roles LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_bin`, CHANGE fecha_baja fecha_baja DATE DEFAULT \'NULL\'');
        $this->addSql('ALTER TABLE usuario_unidad_permiso DROP FOREIGN KEY FK_ACB3A7836CEFAD37');
        $this->addSql('ALTER TABLE usuario_unidad_permiso DROP FOREIGN KEY FK_ACB3A783DB38439E');
        $this->addSql('ALTER TABLE usuario_unidad_permiso DROP FOREIGN KEY FK_ACB3A7839D01464C');
        $this->addSql('ALTER TABLE usuario_unidad_permiso ADD CONSTRAINT FK_ACB3A7836CEFAD37 FOREIGN KEY (permiso_id) REFERENCES permisos (id)');
        $this->addSql('ALTER TABLE usuario_unidad_permiso ADD CONSTRAINT FK_ACB3A783DB38439E FOREIGN KEY (usuario_id) REFERENCES usuario (id)');
        $this->addSql('ALTER TABLE usuario_unidad_permiso ADD CONSTRAINT FK_ACB3A7839D01464C FOREIGN KEY (unidad_id) REFERENCES unidad_de_gestion (id)');
    }
}
