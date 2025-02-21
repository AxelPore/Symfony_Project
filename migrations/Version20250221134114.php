<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250221134114 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__user AS SELECT id, email, roles, password, is_verified, pseudo, profile_picture, biography, location, birth_date, social_media_links, money FROM user');
        $this->addSql('DROP TABLE user');
        $this->addSql('CREATE TABLE user (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles CLOB NOT NULL --(DC2Type:json)
        , password VARCHAR(255) NOT NULL, is_verified BOOLEAN NOT NULL, pseudo VARCHAR(255) NOT NULL, profile_picture VARCHAR(255) DEFAULT NULL, biography CLOB DEFAULT NULL, location VARCHAR(255) DEFAULT NULL, birth_date DATETIME DEFAULT NULL, social_media_links VARCHAR(255) DEFAULT NULL, money INTEGER DEFAULT 0 NOT NULL)');
        $this->addSql('INSERT INTO user (id, email, roles, password, is_verified, pseudo, profile_picture, biography, location, birth_date, social_media_links, money) SELECT id, email, roles, password, is_verified, pseudo, profile_picture, biography, location, birth_date, social_media_links, money FROM __temp__user');
        $this->addSql('DROP TABLE __temp__user');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_IDENTIFIER_EMAIL ON user (email)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__user AS SELECT id, email, money, roles, password, is_verified, pseudo, profile_picture, biography, location, birth_date, social_media_links FROM user');
        $this->addSql('DROP TABLE user');
        $this->addSql('CREATE TABLE user (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, email VARCHAR(180) NOT NULL, money NUMERIC(2, 5) NOT NULL, roles CLOB NOT NULL --(DC2Type:json)
        , password VARCHAR(255) NOT NULL, is_verified BOOLEAN NOT NULL, pseudo VARCHAR(255) NOT NULL, profile_picture VARCHAR(255) DEFAULT NULL, biography CLOB DEFAULT NULL, location VARCHAR(255) DEFAULT NULL, birth_date DATETIME DEFAULT NULL, social_media_links VARCHAR(255) DEFAULT NULL)');
        $this->addSql('INSERT INTO user (id, email, money, roles, password, is_verified, pseudo, profile_picture, biography, location, birth_date, social_media_links) SELECT id, email, money, roles, password, is_verified, pseudo, profile_picture, biography, location, birth_date, social_media_links FROM __temp__user');
        $this->addSql('DROP TABLE __temp__user');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_IDENTIFIER_EMAIL ON user (email)');
    }
}
