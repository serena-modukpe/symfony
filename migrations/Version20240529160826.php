<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240529160826 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE roles_habilitations ADD role_id INT NOT NULL, ADD habilitation_id INT NOT NULL, DROP role, DROP habilitation');
        $this->addSql('ALTER TABLE roles_habilitations ADD CONSTRAINT FK_53297E24D60322AC FOREIGN KEY (role_id) REFERENCES roles (id)');
        $this->addSql('ALTER TABLE roles_habilitations ADD CONSTRAINT FK_53297E24389712CD FOREIGN KEY (habilitation_id) REFERENCES habilitations (id)');
        $this->addSql('CREATE INDEX IDX_53297E24D60322AC ON roles_habilitations (role_id)');
        $this->addSql('CREATE INDEX IDX_53297E24389712CD ON roles_habilitations (habilitation_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE roles_habilitations DROP FOREIGN KEY FK_53297E24D60322AC');
        $this->addSql('ALTER TABLE roles_habilitations DROP FOREIGN KEY FK_53297E24389712CD');
        $this->addSql('DROP INDEX IDX_53297E24D60322AC ON roles_habilitations');
        $this->addSql('DROP INDEX IDX_53297E24389712CD ON roles_habilitations');
        $this->addSql('ALTER TABLE roles_habilitations ADD role INT NOT NULL, ADD habilitation INT NOT NULL, DROP role_id, DROP habilitation_id');
    }
}
