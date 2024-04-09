<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230725190825 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE access_token (id INT AUTO_INCREMENT NOT NULL, client_id INT DEFAULT NULL, token VARCHAR(255) NOT NULL, expiry_date_time DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', scope VARCHAR(255) NOT NULL, one_to_many VARCHAR(255) NOT NULL, INDEX IDX_B6A2DD6819EB6921 (client_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE client (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, redirect_uri VARCHAR(255) DEFAULT NULL, allowed_grant_types LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\', scopes LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\', secret VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE access_token ADD CONSTRAINT FK_B6A2DD6819EB6921 FOREIGN KEY (client_id) REFERENCES client (id)');
        $this->addSql('ALTER TABLE user ADD access_token_id INT NOT NULL');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D6492CCB2688 FOREIGN KEY (access_token_id) REFERENCES access_token (id)');
        $this->addSql('CREATE INDEX IDX_8D93D6492CCB2688 ON user (access_token_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE `user` DROP FOREIGN KEY FK_8D93D6492CCB2688');
        $this->addSql('ALTER TABLE access_token DROP FOREIGN KEY FK_B6A2DD6819EB6921');
        $this->addSql('DROP TABLE access_token');
        $this->addSql('DROP TABLE client');
        $this->addSql('DROP INDEX IDX_8D93D6492CCB2688 ON `user`');
        $this->addSql('ALTER TABLE `user` DROP access_token_id');
    }
}
