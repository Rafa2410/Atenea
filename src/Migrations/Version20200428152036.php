<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200428152036 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE contrato (id INT AUTO_INCREMENT NOT NULL, corporacion_id INT NOT NULL, fecha_alta DATE NOT NULL, fecha_baja DATE DEFAULT NULL, descripcion VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_666965231011F129 (corporacion_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE contrato ADD CONSTRAINT FK_666965231011F129 FOREIGN KEY (corporacion_id) REFERENCES corporacion (id)');
        $this->addSql('ALTER TABLE usuario CHANGE roles roles JSON NOT NULL, CHANGE fecha_baja fecha_baja DATE DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE contrato');
        $this->addSql('ALTER TABLE usuario CHANGE roles roles LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_bin`, CHANGE fecha_baja fecha_baja DATE DEFAULT \'NULL\'');
    }
}
