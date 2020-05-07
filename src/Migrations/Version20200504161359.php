<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200504161359 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE factores_potenciales_de_exito (id INT AUTO_INCREMENT NOT NULL, descripcion VARCHAR(255) NOT NULL, fecha_alta DATE NOT NULL, fecha_baja DATE DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE factores_potenciales_de_exito_aspecto (factores_potenciales_de_exito_id INT NOT NULL, aspecto_id INT NOT NULL, INDEX IDX_C22BD8CF3375A19F (factores_potenciales_de_exito_id), INDEX IDX_C22BD8CF1928CA76 (aspecto_id), PRIMARY KEY(factores_potenciales_de_exito_id, aspecto_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE factores_potenciales_de_exito_aspecto ADD CONSTRAINT FK_C22BD8CF3375A19F FOREIGN KEY (factores_potenciales_de_exito_id) REFERENCES factores_potenciales_de_exito (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE factores_potenciales_de_exito_aspecto ADD CONSTRAINT FK_C22BD8CF1928CA76 FOREIGN KEY (aspecto_id) REFERENCES aspecto (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE usuario CHANGE roles roles JSON NOT NULL, CHANGE fecha_baja fecha_baja DATE DEFAULT NULL');
        $this->addSql('ALTER TABLE unidad_de_gestion CHANGE unidad_de_gestion_id unidad_de_gestion_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE contrato CHANGE fecha_baja fecha_baja DATE DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE factores_potenciales_de_exito_aspecto DROP FOREIGN KEY FK_C22BD8CF3375A19F');
        $this->addSql('DROP TABLE factores_potenciales_de_exito');
        $this->addSql('DROP TABLE factores_potenciales_de_exito_aspecto');
        $this->addSql('ALTER TABLE contrato CHANGE fecha_baja fecha_baja DATE DEFAULT \'NULL\'');
        $this->addSql('ALTER TABLE unidad_de_gestion CHANGE unidad_de_gestion_id unidad_de_gestion_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE usuario CHANGE roles roles LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_bin`, CHANGE fecha_baja fecha_baja DATE DEFAULT \'NULL\'');
    }
}
