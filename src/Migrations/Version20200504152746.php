<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200504152746 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE aspecto (id INT AUTO_INCREMENT NOT NULL, favorable TINYINT(1) NOT NULL, interno TINYINT(1) NOT NULL, descripcion VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE aspecto_cuestion (aspecto_id INT NOT NULL, cuestion_id INT NOT NULL, INDEX IDX_E47BD33C1928CA76 (aspecto_id), INDEX IDX_E47BD33CE8BD8BB5 (cuestion_id), PRIMARY KEY(aspecto_id, cuestion_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE aspecto_cuestion ADD CONSTRAINT FK_E47BD33C1928CA76 FOREIGN KEY (aspecto_id) REFERENCES aspecto (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE aspecto_cuestion ADD CONSTRAINT FK_E47BD33CE8BD8BB5 FOREIGN KEY (cuestion_id) REFERENCES cuestion (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE contrato CHANGE fecha_baja fecha_baja DATE DEFAULT NULL');
        $this->addSql('ALTER TABLE unidad_de_gestion CHANGE unidad_de_gestion_id unidad_de_gestion_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE usuario CHANGE roles roles JSON NOT NULL, CHANGE fecha_baja fecha_baja DATE DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE aspecto_cuestion DROP FOREIGN KEY FK_E47BD33C1928CA76');
        $this->addSql('DROP TABLE aspecto');
        $this->addSql('DROP TABLE aspecto_cuestion');
        $this->addSql('ALTER TABLE contrato CHANGE fecha_baja fecha_baja DATE DEFAULT \'NULL\'');
        $this->addSql('ALTER TABLE unidad_de_gestion CHANGE unidad_de_gestion_id unidad_de_gestion_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE usuario CHANGE roles roles LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_bin`, CHANGE fecha_baja fecha_baja DATE DEFAULT \'NULL\'');
    }
}
