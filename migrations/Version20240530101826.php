<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240530101826 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE utilisateurs ADD user_id_id INT NOT NULL, ADD role_id INT NOT NULL, DROP user_id, DROP role');
        $this->addSql('ALTER TABLE utilisateurs ADD CONSTRAINT FK_497B315E9D86650F FOREIGN KEY (user_id_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE utilisateurs ADD CONSTRAINT FK_497B315ED60322AC FOREIGN KEY (role_id) REFERENCES roles_habilitations (id)');
        $this->addSql('CREATE INDEX IDX_497B315E9D86650F ON utilisateurs (user_id_id)');
        $this->addSql('CREATE INDEX IDX_497B315ED60322AC ON utilisateurs (role_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE utilisateurs DROP FOREIGN KEY FK_497B315E9D86650F');
        $this->addSql('ALTER TABLE utilisateurs DROP FOREIGN KEY FK_497B315ED60322AC');
        $this->addSql('DROP INDEX IDX_497B315E9D86650F ON utilisateurs');
        $this->addSql('DROP INDEX IDX_497B315ED60322AC ON utilisateurs');
        $this->addSql('ALTER TABLE utilisateurs ADD user_id INT NOT NULL, ADD role INT NOT NULL, DROP user_id_id, DROP role_id');
    }
}
