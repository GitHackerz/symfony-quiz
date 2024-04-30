<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240427143145 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE quiz DROP FOREIGN KEY FK_A412FA9264B64DCC');
        $this->addSql('CREATE TABLE avis_produit (id INT AUTO_INCREMENT NOT NULL, contenu VARCHAR(255) NOT NULL, note INT NOT NULL, idPRODUIT INT DEFAULT NULL, idUSER INT DEFAULT NULL, INDEX IDX_2A67C21C9E44053 (idPRODUIT), INDEX IDX_2A67C2168C9CA5D (idUSER), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE quiz_participants (id INT AUTO_INCREMENT NOT NULL, quiz_id INT DEFAULT NULL, participant_id INT DEFAULT NULL, score INT NOT NULL, INDEX IDX_A790F569853CD175 (quiz_id), INDEX IDX_A790F5699D1C3019 (participant_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reset_password_request (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, selector VARCHAR(20) NOT NULL, hashed_token VARCHAR(100) NOT NULL, requested_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', expires_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_7CE748AA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, role VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, image VARCHAR(255) NOT NULL, section VARCHAR(255) NOT NULL, num_tel VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE avis_produit ADD CONSTRAINT FK_2A67C21C9E44053 FOREIGN KEY (idPRODUIT) REFERENCES produit (id)');
        $this->addSql('ALTER TABLE avis_produit ADD CONSTRAINT FK_2A67C2168C9CA5D FOREIGN KEY (idUSER) REFERENCES user (id)');
        $this->addSql('ALTER TABLE quiz_participants ADD CONSTRAINT FK_A790F569853CD175 FOREIGN KEY (quiz_id) REFERENCES quiz (id)');
        $this->addSql('ALTER TABLE quiz_participants ADD CONSTRAINT FK_A790F5699D1C3019 FOREIGN KEY (participant_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE reset_password_request ADD CONSTRAINT FK_7CE748AA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE avisproduit DROP FOREIGN KEY FK_675C9F1E68C9CA5D');
        $this->addSql('ALTER TABLE avisproduit DROP FOREIGN KEY FK_675C9F1EC9E44053');
        $this->addSql('ALTER TABLE reclamation DROP FOREIGN KEY reclamation_utilisateur_id_fk');
        $this->addSql('ALTER TABLE commentaire DROP FOREIGN KEY FK_67F068BC64B64DCC');
        $this->addSql('ALTER TABLE notification DROP FOREIGN KEY FK_BF5476CA64B64DCC');
        $this->addSql('ALTER TABLE message DROP FOREIGN KEY FK_B6BD307F56820D8D');
        $this->addSql('ALTER TABLE postsauveguardee DROP FOREIGN KEY FK_1A620F24FE6E88D7');
        $this->addSql('ALTER TABLE postsauveguardee DROP FOREIGN KEY postsauveguardee_ibfk_1');
        $this->addSql('ALTER TABLE validation DROP FOREIGN KEY FK_16AC5B6E6690C3F5');
        $this->addSql('ALTER TABLE validation DROP FOREIGN KEY FK_16AC5B6EE947C483');
        $this->addSql('ALTER TABLE post DROP FOREIGN KEY FK_5A8A6C8D64B64DCC');
        $this->addSql('ALTER TABLE uservotes DROP FOREIGN KEY FK_762F461DF8697D13');
        $this->addSql('ALTER TABLE uservotes DROP FOREIGN KEY uservotes_utilisateur_id_fk');
        $this->addSql('ALTER TABLE fichiercommentaire DROP FOREIGN KEY FK_F49007456690C3F5');
        $this->addSql('DROP TABLE avisproduit');
        $this->addSql('DROP TABLE usercode');
        $this->addSql('DROP TABLE reclamation');
        $this->addSql('DROP TABLE fichierpost');
        $this->addSql('DROP TABLE commentaire');
        $this->addSql('DROP TABLE notification');
        $this->addSql('DROP TABLE message');
        $this->addSql('DROP TABLE postsauveguardee');
        $this->addSql('DROP TABLE validation');
        $this->addSql('DROP TABLE utilisateur');
        $this->addSql('DROP TABLE post');
        $this->addSql('DROP TABLE uservotes');
        $this->addSql('DROP TABLE fichiercommentaire');
        $this->addSql('ALTER TABLE question ADD score INT NOT NULL, CHANGE reponse_correcte reponse_correcte SMALLINT NOT NULL');
        $this->addSql('ALTER TABLE question RENAME INDEX question_quiz_id_fk TO IDX_B6F7494EA412FA92');
        $this->addSql('DROP INDEX quiz_utilisateur_id_fk ON quiz');
        $this->addSql('ALTER TABLE quiz ADD dureeEnMinute INT NOT NULL, DROP score, DROP dureeEnMinutes, CHANGE dateCreation dateCreation DATETIME NOT NULL, CHANGE disponibilitee disponibilitee SMALLINT NOT NULL, CHANGE userId createur_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE quiz ADD CONSTRAINT FK_A412FA9273A201E5 FOREIGN KEY (createur_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_A412FA9273A201E5 ON quiz (createur_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE quiz DROP FOREIGN KEY FK_A412FA9273A201E5');
        $this->addSql('CREATE TABLE avisproduit (id INT AUTO_INCREMENT NOT NULL, idPRODUIT INT DEFAULT NULL, idUSER INT DEFAULT NULL, contenu VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, note INT NOT NULL, INDEX avisproduit_produit_id_fk (idPRODUIT), INDEX avisproduit_utilisateur_id_fk (idUSER), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE usercode (id INT AUTO_INCREMENT NOT NULL, code VARCHAR(256) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, email VARCHAR(256) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, INDEX userCode_utilisateur_id_fk (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE reclamation (id INT AUTO_INCREMENT NOT NULL, idUser INT DEFAULT NULL, contenu VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, objet VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, date DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, INDEX reclamation_utilisateur_id_fk (idUser), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE fichierpost (id INT AUTO_INCREMENT NOT NULL, postId INT DEFAULT NULL, fileLink VARCHAR(256) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_0900_ai_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_0900_ai_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE commentaire (id INT AUTO_INCREMENT NOT NULL, content VARCHAR(256) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_0900_ai_ci`, postId INT DEFAULT NULL, userId INT DEFAULT NULL, parentComment INT DEFAULT NULL, verified TINYINT(1) DEFAULT NULL, intOfreports INT DEFAULT NULL, createdAt DATETIME DEFAULT NULL, updatedAt DATETIME DEFAULT NULL, INDEX commentaire_utilisateur_id_fk (userId), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_0900_ai_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE notification (id INT AUTO_INCREMENT NOT NULL, content VARCHAR(256) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_0900_ai_ci`, type VARCHAR(256) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_0900_ai_ci`, userId INT DEFAULT NULL, createdAt DATETIME DEFAULT NULL, INDEX notification_utilisateur_id_fk (userId), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_0900_ai_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE message (id INT AUTO_INCREMENT NOT NULL, idEmetteur INT DEFAULT NULL, idRecepteur INT NOT NULL, date DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, contenu VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_0900_ai_ci`, INDEX idRecepteur (idRecepteur), INDEX message_utilisateur_id_fk (idEmetteur), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_0900_ai_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE postsauveguardee (id INT AUTO_INCREMENT NOT NULL, idPost INT DEFAULT NULL, idUser INT DEFAULT NULL, INDEX idPost (idPost), INDEX postsauveguardee_utilisateur_id_fk (idUser), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_0900_ai_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE validation (id INT AUTO_INCREMENT NOT NULL, teacherId INT DEFAULT NULL, commentId INT DEFAULT NULL, type INT DEFAULT NULL, postId INT DEFAULT NULL, INDEX validation_commentaire_id_fk (commentId), INDEX validation_utilisateur_id_fk (teacherId), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_0900_ai_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE utilisateur (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_0900_ai_ci`, image VARCHAR(256) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_0900_ai_ci`, section VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_0900_ai_ci`, num_tel VARCHAR(256) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_0900_ai_ci`, prenom VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_0900_ai_ci`, email VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_0900_ai_ci`, password VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_0900_ai_ci`, roles JSON NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_0900_ai_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE post (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(256) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_0900_ai_ci`, description TEXT CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_0900_ai_ci`, userId INT DEFAULT NULL, matiere VARCHAR(256) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_0900_ai_ci`, nbrOfComments INT DEFAULT NULL, createdAt DATETIME DEFAULT NULL, updatedAt DATETIME DEFAULT NULL, INDEX post_utilisateur_id_fk (userId), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_0900_ai_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE uservotes (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, comment_id INT DEFAULT NULL, created_at DATETIME DEFAULT CURRENT_TIMESTAMP, type INT DEFAULT NULL, INDEX uservotes_utilisateur_id_fk (user_id), INDEX uservotes_commentaire_id_fk (comment_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_0900_ai_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE fichiercommentaire (id INT AUTO_INCREMENT NOT NULL, commentId INT DEFAULT NULL, fileLink VARCHAR(256) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_0900_ai_ci`, INDEX fichiercommentaire_commentaire_id_fk (commentId), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_0900_ai_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE avisproduit ADD CONSTRAINT FK_675C9F1E68C9CA5D FOREIGN KEY (idUSER) REFERENCES utilisateur (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE avisproduit ADD CONSTRAINT FK_675C9F1EC9E44053 FOREIGN KEY (idPRODUIT) REFERENCES produit (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE reclamation ADD CONSTRAINT reclamation_utilisateur_id_fk FOREIGN KEY (idUser) REFERENCES utilisateur (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE commentaire ADD CONSTRAINT FK_67F068BC64B64DCC FOREIGN KEY (userId) REFERENCES utilisateur (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE notification ADD CONSTRAINT FK_BF5476CA64B64DCC FOREIGN KEY (userId) REFERENCES utilisateur (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE message ADD CONSTRAINT FK_B6BD307F56820D8D FOREIGN KEY (idEmetteur) REFERENCES utilisateur (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE postsauveguardee ADD CONSTRAINT FK_1A620F24FE6E88D7 FOREIGN KEY (idUser) REFERENCES utilisateur (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE postsauveguardee ADD CONSTRAINT postsauveguardee_ibfk_1 FOREIGN KEY (idPost) REFERENCES post (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE validation ADD CONSTRAINT FK_16AC5B6E6690C3F5 FOREIGN KEY (commentId) REFERENCES commentaire (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE validation ADD CONSTRAINT FK_16AC5B6EE947C483 FOREIGN KEY (teacherId) REFERENCES utilisateur (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE post ADD CONSTRAINT FK_5A8A6C8D64B64DCC FOREIGN KEY (userId) REFERENCES utilisateur (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE uservotes ADD CONSTRAINT FK_762F461DF8697D13 FOREIGN KEY (comment_id) REFERENCES commentaire (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE uservotes ADD CONSTRAINT uservotes_utilisateur_id_fk FOREIGN KEY (user_id) REFERENCES utilisateur (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE fichiercommentaire ADD CONSTRAINT FK_F49007456690C3F5 FOREIGN KEY (commentId) REFERENCES commentaire (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE avis_produit DROP FOREIGN KEY FK_2A67C21C9E44053');
        $this->addSql('ALTER TABLE avis_produit DROP FOREIGN KEY FK_2A67C2168C9CA5D');
        $this->addSql('ALTER TABLE quiz_participants DROP FOREIGN KEY FK_A790F569853CD175');
        $this->addSql('ALTER TABLE quiz_participants DROP FOREIGN KEY FK_A790F5699D1C3019');
        $this->addSql('ALTER TABLE reset_password_request DROP FOREIGN KEY FK_7CE748AA76ED395');
        $this->addSql('DROP TABLE avis_produit');
        $this->addSql('DROP TABLE quiz_participants');
        $this->addSql('DROP TABLE reset_password_request');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP INDEX IDX_A412FA9273A201E5 ON quiz');
        $this->addSql('ALTER TABLE quiz ADD dureeEnMinutes INT NOT NULL, CHANGE dateCreation dateCreation DATE NOT NULL, CHANGE disponibilitee disponibilitee TINYINT(1) NOT NULL, CHANGE dureeEnMinute score INT NOT NULL, CHANGE createur_id userId INT DEFAULT NULL');
        $this->addSql('ALTER TABLE quiz ADD CONSTRAINT FK_A412FA9264B64DCC FOREIGN KEY (userId) REFERENCES utilisateur (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX quiz_utilisateur_id_fk ON quiz (userId)');
        $this->addSql('ALTER TABLE question DROP score, CHANGE reponse_correcte reponse_correcte INT DEFAULT NULL');
        $this->addSql('ALTER TABLE question RENAME INDEX idx_b6f7494ea412fa92 TO question_quiz_id_fk');
    }
}
