<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200720080231 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, role INT DEFAULT NULL, firstname VARCHAR(20) NOT NULL, lastname VARCHAR(20) NOT NULL, email VARCHAR(180) NOT NULL, password VARCHAR(255) NOT NULL, nameCompany VARCHAR(45) NOT NULL, phoneNumber INT NOT NULL, is_verified TINYINT(1) NOT NULL, is_visible TINYINT(1) NOT NULL, languageId INT DEFAULT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), INDEX fk_users_role1_idx (role), INDEX fk_user_language1_idx (languageId), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_has_sn (social_networks_id_ INT DEFAULT NULL, user_id_ INT DEFAULT NULL, iduser_has_SN INT AUTO_INCREMENT NOT NULL, access_token VARCHAR(45) NOT NULL, name VARCHAR(45) DEFAULT NULL, lastname VARCHAR(45) DEFAULT NULL, photo VARCHAR(255) DEFAULT NULL, INDEX fk_user_has_SN_social_networks1_idx (social_networks_id_), INDEX fk_user_has_SN_user1_idx (user_id_), PRIMARY KEY(iduser_has_SN)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D64957698A6A FOREIGN KEY (role) REFERENCES role (idrole) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649940D8C7E FOREIGN KEY (languageId) REFERENCES language (id_) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_has_sn ADD CONSTRAINT FK_241769C1ACA67ACC FOREIGN KEY (social_networks_id_) REFERENCES social_networks (id_)');
        $this->addSql('ALTER TABLE user_has_sn ADD CONSTRAINT FK_241769C1A914AAF0 FOREIGN KEY (user_id_) REFERENCES user (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE user_has_sn DROP FOREIGN KEY FK_241769C1A914AAF0');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE user_has_sn');
    }
}
