<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200430153444 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE cuestion (id INT AUTO_INCREMENT NOT NULL, subtipo_id INT NOT NULL, interno TINYINT(1) NOT NULL, descripcion VARCHAR(255) NOT NULL, INDEX IDX_88697F18E245C6A3 (subtipo_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tipo_cuestion (id INT AUTO_INCREMENT NOT NULL, interno TINYINT(1) NOT NULL, descripcion VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE subtipo_cuestion (id INT AUTO_INCREMENT NOT NULL, tipo_id INT NOT NULL, interno TINYINT(1) NOT NULL, descripcion VARCHAR(255) NOT NULL, INDEX IDX_13A5004EA9276E6C (tipo_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE cuestion ADD CONSTRAINT FK_88697F18E245C6A3 FOREIGN KEY (subtipo_id) REFERENCES subtipo_cuestion (id)');
        $this->addSql('ALTER TABLE subtipo_cuestion ADD CONSTRAINT FK_13A5004EA9276E6C FOREIGN KEY (tipo_id) REFERENCES tipo_cuestion (id)');
        $this->addSql('ALTER TABLE contrato CHANGE fecha_baja fecha_baja DATE DEFAULT NULL');
        $this->addSql('ALTER TABLE usuario CHANGE roles roles JSON NOT NULL, CHANGE fecha_baja fecha_baja DATE DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE subtipo_cuestion DROP FOREIGN KEY FK_13A5004EA9276E6C');
        $this->addSql('ALTER TABLE cuestion DROP FOREIGN KEY FK_88697F18E245C6A3');
        $this->addSql('DROP TABLE cuestion');
        $this->addSql('DROP TABLE tipo_cuestion');
        $this->addSql('DROP TABLE subtipo_cuestion');
        $this->addSql('ALTER TABLE contrato CHANGE fecha_baja fecha_baja DATE DEFAULT \'NULL\'');
        $this->addSql('ALTER TABLE usuario CHANGE roles roles LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_bin`, CHANGE fecha_baja fecha_baja DATE DEFAULT \'NULL\'');
    }
}
