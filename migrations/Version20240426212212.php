<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240426212212 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE avis_produit (id INT AUTO_INCREMENT NOT NULL, contenu VARCHAR(255) NOT NULL, note INT NOT NULL, idPRODUIT INT DEFAULT NULL, idUSER INT DEFAULT NULL, INDEX IDX_2A67C21C9E44053 (idPRODUIT), INDEX IDX_2A67C2168C9CA5D (idUSER), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE produit (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, image VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, matiere VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE avis_produit ADD CONSTRAINT FK_2A67C21C9E44053 FOREIGN KEY (idPRODUIT) REFERENCES produit (id)');
        $this->addSql('ALTER TABLE avis_produit ADD CONSTRAINT FK_2A67C2168C9CA5D FOREIGN KEY (idUSER) REFERENCES user (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE avis_produit DROP FOREIGN KEY FK_2A67C21C9E44053');
        $this->addSql('ALTER TABLE avis_produit DROP FOREIGN KEY FK_2A67C2168C9CA5D');
        $this->addSql('DROP TABLE avis_produit');
        $this->addSql('DROP TABLE produit');
    }
}
