<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240529152038 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE roles_habilitations_habilitations (roles_habilitations_id INT NOT NULL, habilitations_id INT NOT NULL, INDEX IDX_78E07D3AA0BE74B (roles_habilitations_id), INDEX IDX_78E07D329C943A (habilitations_id), PRIMARY KEY(roles_habilitations_id, habilitations_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE roles_habilitations_habilitations ADD CONSTRAINT FK_78E07D3AA0BE74B FOREIGN KEY (roles_habilitations_id) REFERENCES roles_habilitations (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE roles_habilitations_habilitations ADD CONSTRAINT FK_78E07D329C943A FOREIGN KEY (habilitations_id) REFERENCES habilitations (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE roles_habilitations DROP habilitation');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE roles_habilitations_habilitations DROP FOREIGN KEY FK_78E07D3AA0BE74B');
        $this->addSql('ALTER TABLE roles_habilitations_habilitations DROP FOREIGN KEY FK_78E07D329C943A');
        $this->addSql('DROP TABLE roles_habilitations_habilitations');
        $this->addSql('ALTER TABLE roles_habilitations ADD habilitation INT NOT NULL');
    }
}
