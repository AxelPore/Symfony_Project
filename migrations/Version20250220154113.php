<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250220154113 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE interactions (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, initiator_id INTEGER NOT NULL, interaction_to_id INTEGER DEFAULT NULL, product_concerned_id INTEGER NOT NULL, interaction_type VARCHAR(255) NOT NULL, CONSTRAINT FK_538B74BD7DB3B714 FOREIGN KEY (initiator_id) REFERENCES user (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_538B74BD30A78EB0 FOREIGN KEY (interaction_to_id) REFERENCES user (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_538B74BD6DC5341C FOREIGN KEY (product_concerned_id) REFERENCES product (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_538B74BD7DB3B714 ON interactions (initiator_id)');
        $this->addSql('CREATE INDEX IDX_538B74BD30A78EB0 ON interactions (interaction_to_id)');
        $this->addSql('CREATE INDEX IDX_538B74BD6DC5341C ON interactions (product_concerned_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE interactions');
    }
}
