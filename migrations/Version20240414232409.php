<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240414232409 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE etudiant (id INT AUTO_INCREMENT NOT NULL, serie_id INT DEFAULT NULL, village_id INT DEFAULT NULL, universite_id INT DEFAULT NULL, filiere_id INT DEFAULT NULL, annee_universitaire_id INT DEFAULT NULL, categorie_universite_id INT DEFAULT NULL, nom VARCHAR(255) NOT NULL, prenoms VARCHAR(255) NOT NULL, date_naissance DATE NOT NULL, lieu_naissance VARCHAR(255) NOT NULL, sexe VARCHAR(255) NOT NULL, contact_parent VARCHAR(255) NOT NULL, annee_obtention_bac INT NOT NULL, maison VARCHAR(255) NOT NULL, contact VARCHAR(255) NOT NULL, INDEX IDX_717E22E3D94388BD (serie_id), INDEX IDX_717E22E35E0D5582 (village_id), INDEX IDX_717E22E32A52F05F (universite_id), INDEX IDX_717E22E3180AA129 (filiere_id), INDEX IDX_717E22E3544BFD58 (annee_universitaire_id), INDEX IDX_717E22E3299D1115 (categorie_universite_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE etudiant ADD CONSTRAINT FK_717E22E3D94388BD FOREIGN KEY (serie_id) REFERENCES serie (id)');
        $this->addSql('ALTER TABLE etudiant ADD CONSTRAINT FK_717E22E35E0D5582 FOREIGN KEY (village_id) REFERENCES village (id)');
        $this->addSql('ALTER TABLE etudiant ADD CONSTRAINT FK_717E22E32A52F05F FOREIGN KEY (universite_id) REFERENCES universite (id)');
        $this->addSql('ALTER TABLE etudiant ADD CONSTRAINT FK_717E22E3180AA129 FOREIGN KEY (filiere_id) REFERENCES filiere (id)');
        $this->addSql('ALTER TABLE etudiant ADD CONSTRAINT FK_717E22E3544BFD58 FOREIGN KEY (annee_universitaire_id) REFERENCES annee_universitaire (id)');
        $this->addSql('ALTER TABLE etudiant ADD CONSTRAINT FK_717E22E3299D1115 FOREIGN KEY (categorie_universite_id) REFERENCES categorie_universite (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE etudiant DROP FOREIGN KEY FK_717E22E3D94388BD');
        $this->addSql('ALTER TABLE etudiant DROP FOREIGN KEY FK_717E22E35E0D5582');
        $this->addSql('ALTER TABLE etudiant DROP FOREIGN KEY FK_717E22E32A52F05F');
        $this->addSql('ALTER TABLE etudiant DROP FOREIGN KEY FK_717E22E3180AA129');
        $this->addSql('ALTER TABLE etudiant DROP FOREIGN KEY FK_717E22E3544BFD58');
        $this->addSql('ALTER TABLE etudiant DROP FOREIGN KEY FK_717E22E3299D1115');
        $this->addSql('DROP TABLE etudiant');
    }
}
