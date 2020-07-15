<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200713074950 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE user_has_sn DROP FOREIGN KEY fk_user_has_SN_user1');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, role INT DEFAULT NULL, firstname VARCHAR(20) NOT NULL, lastname VARCHAR(20) NOT NULL, email VARCHAR(180) NOT NULL, password VARCHAR(255) NOT NULL, nameCompany VARCHAR(45) NOT NULL, phoneNumber INT NOT NULL, languageId INT DEFAULT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), INDEX fk_users_role1_idx (role), INDEX fk_user_language1_idx (languageId), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D64957698A6A FOREIGN KEY (role) REFERENCES role (idrole)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649940D8C7E FOREIGN KEY (languageId) REFERENCES language (id_)');
        $this->addSql('DROP TABLE user1');
        $this->addSql('ALTER TABLE user_has_sn ADD CONSTRAINT FK_241769C1A914AAF0 FOREIGN KEY (user_id_) REFERENCES user (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE user_has_sn DROP FOREIGN KEY FK_241769C1A914AAF0');
        $this->addSql('CREATE TABLE user1 (id_ INT AUTO_INCREMENT NOT NULL, role_idrole INT DEFAULT NULL, language_id_ INT DEFAULT NULL, username VARCHAR(16) CHARACTER SET utf8 NOT NULL COLLATE `utf8_general_ci`, email VARCHAR(60) CHARACTER SET utf8 NOT NULL COLLATE `utf8_general_ci`, nameCompany VARCHAR(45) CHARACTER SET utf8 NOT NULL COLLATE `utf8_general_ci`, password VARCHAR(32) CHARACTER SET utf8 NOT NULL COLLATE `utf8_general_ci`, phoneNumber INT NOT NULL, INDEX fk_users_role1_idx (role_idrole), UNIQUE INDEX idusers_UNIQUE (id_), INDEX fk_user_language1_idx (language_id_), PRIMARY KEY(id_)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE user1 ADD CONSTRAINT fk_user_language1 FOREIGN KEY (language_id_) REFERENCES language (id_) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE user1 ADD CONSTRAINT fk_users_role1 FOREIGN KEY (role_idrole) REFERENCES role (idrole) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('DROP TABLE user');
        $this->addSql('ALTER TABLE user_has_sn ADD CONSTRAINT fk_user_has_SN_user1 FOREIGN KEY (user_id_) REFERENCES user1 (id_) ON UPDATE NO ACTION ON DELETE NO ACTION');
    }
}
