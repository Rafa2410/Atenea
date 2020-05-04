<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200504102242 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE usuario_unidad_permiso (id INT AUTO_INCREMENT NOT NULL, permiso_id INT NOT NULL, usuario_id INT NOT NULL, unidad_id INT NOT NULL, INDEX IDX_ACB3A7836CEFAD37 (permiso_id), INDEX IDX_ACB3A783DB38439E (usuario_id), INDEX IDX_ACB3A7839D01464C (unidad_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE permisos (id INT AUTO_INCREMENT NOT NULL, tipo VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE usuario_unidad_permiso ADD CONSTRAINT FK_ACB3A7836CEFAD37 FOREIGN KEY (permiso_id) REFERENCES permisos (id)');
        $this->addSql('ALTER TABLE usuario_unidad_permiso ADD CONSTRAINT FK_ACB3A783DB38439E FOREIGN KEY (usuario_id) REFERENCES usuario (id)');
        $this->addSql('ALTER TABLE usuario_unidad_permiso ADD CONSTRAINT FK_ACB3A7839D01464C FOREIGN KEY (unidad_id) REFERENCES unidad_de_gestion (id)');
        $this->addSql('ALTER TABLE usuario CHANGE roles roles JSON NOT NULL, CHANGE fecha_baja fecha_baja DATE DEFAULT NULL');
        $this->addSql('ALTER TABLE unidad_de_gestion CHANGE unidad_de_gestion_id unidad_de_gestion_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE contrato CHANGE fecha_baja fecha_baja DATE DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE usuario_unidad_permiso DROP FOREIGN KEY FK_ACB3A7836CEFAD37');
        $this->addSql('DROP TABLE usuario_unidad_permiso');
        $this->addSql('DROP TABLE permisos');
        $this->addSql('ALTER TABLE contrato CHANGE fecha_baja fecha_baja DATE DEFAULT \'NULL\'');
        $this->addSql('ALTER TABLE unidad_de_gestion CHANGE unidad_de_gestion_id unidad_de_gestion_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE usuario CHANGE roles roles LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_bin`, CHANGE fecha_baja fecha_baja DATE DEFAULT \'NULL\'');
    }
}
