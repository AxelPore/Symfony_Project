<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250221123149 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE cart (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, product_id INTEGER NOT NULL, CONSTRAINT FK_BA388B74584665A FOREIGN KEY (product_id) REFERENCES product (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_BA388B74584665A ON cart (product_id)');
        $this->addSql('CREATE TABLE interactions (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, initiator_id INTEGER NOT NULL, interaction_to_id INTEGER DEFAULT NULL, product_concerned_id INTEGER NOT NULL, interaction_type VARCHAR(255) NOT NULL, CONSTRAINT FK_538B74BD7DB3B714 FOREIGN KEY (initiator_id) REFERENCES user (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_538B74BD30A78EB0 FOREIGN KEY (interaction_to_id) REFERENCES user (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_538B74BD6DC5341C FOREIGN KEY (product_concerned_id) REFERENCES product (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_538B74BD7DB3B714 ON interactions (initiator_id)');
        $this->addSql('CREATE INDEX IDX_538B74BD30A78EB0 ON interactions (interaction_to_id)');
        $this->addSql('CREATE INDEX IDX_538B74BD6DC5341C ON interactions (product_concerned_id)');
        $this->addSql('CREATE TABLE product (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(255) NOT NULL, price NUMERIC(2, 2) NOT NULL, stock INTEGER NOT NULL, description VARCHAR(255) DEFAULT NULL)');
        $this->addSql('CREATE TABLE product_user (product_id INTEGER NOT NULL, user_id INTEGER NOT NULL, PRIMARY KEY(product_id, user_id), CONSTRAINT FK_7BF4E84584665A FOREIGN KEY (product_id) REFERENCES product (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_7BF4E8A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_7BF4E84584665A ON product_user (product_id)');
        $this->addSql('CREATE INDEX IDX_7BF4E8A76ED395 ON product_user (user_id)');
        $this->addSql('CREATE TABLE user (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles CLOB NOT NULL --(DC2Type:json)
        , password VARCHAR(255) NOT NULL, is_verified BOOLEAN NOT NULL, pseudo VARCHAR(255) NOT NULL, profile_picture VARCHAR(255) DEFAULT NULL, biography CLOB DEFAULT NULL, location VARCHAR(255) DEFAULT NULL, birth_date DATETIME DEFAULT NULL, social_media_links VARCHAR(255) DEFAULT NULL)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_IDENTIFIER_EMAIL ON user (email)');
        $this->addSql('CREATE TABLE messenger_messages (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, body CLOB NOT NULL, headers CLOB NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL --(DC2Type:datetime_immutable)
        , available_at DATETIME NOT NULL --(DC2Type:datetime_immutable)
        , delivered_at DATETIME DEFAULT NULL --(DC2Type:datetime_immutable)
        )');
        $this->addSql('CREATE INDEX IDX_75EA56E0FB7336F0 ON messenger_messages (queue_name)');
        $this->addSql('CREATE INDEX IDX_75EA56E0E3BD61CE ON messenger_messages (available_at)');
        $this->addSql('CREATE INDEX IDX_75EA56E016BA31DB ON messenger_messages (delivered_at)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE cart');
        $this->addSql('DROP TABLE interactions');
        $this->addSql('DROP TABLE product');
        $this->addSql('DROP TABLE product_user');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
