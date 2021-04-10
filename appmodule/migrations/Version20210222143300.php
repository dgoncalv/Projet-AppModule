<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210222143300 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE csvfile (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE enseignant (id INT AUTO_INCREMENT NOT NULL, trigramme VARCHAR(4) NOT NULL, prenom VARCHAR(30) NOT NULL, nom VARCHAR(50) NOT NULL, service_du DOUBLE PRECISION NOT NULL, statut VARCHAR(8) NOT NULL, contact VARCHAR(12) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE module (id INT AUTO_INCREMENT NOT NULL, ppn VARCHAR(8) NOT NULL, intitule VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE module_enseignant (module_id INT NOT NULL, enseignant_id INT NOT NULL, INDEX IDX_1442043CAFC2B591 (module_id), INDEX IDX_1442043CE455FCC0 (enseignant_id), PRIMARY KEY(module_id, enseignant_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE module_details (id INT AUTO_INCREMENT NOT NULL, module_id INT DEFAULT NULL, enseignant_id INT DEFAULT NULL, semaine_id INT DEFAULT NULL, nb_groupes INT NOT NULL, type_cours VARCHAR(2) NOT NULL, INDEX IDX_D95D3593AFC2B591 (module_id), INDEX IDX_D95D3593E455FCC0 (enseignant_id), INDEX IDX_D95D3593122EEC90 (semaine_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE semaine (id INT AUTO_INCREMENT NOT NULL, module_id INT NOT NULL, semaine DOUBLE PRECISION NOT NULL, cm DOUBLE PRECISION NOT NULL, td DOUBLE PRECISION NOT NULL, tp DOUBLE PRECISION NOT NULL, surveillances DOUBLE PRECISION NOT NULL, charges DOUBLE PRECISION NOT NULL, commentaires LONGTEXT DEFAULT NULL, INDEX IDX_7B4D8BEAAFC2B591 (module_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE module_enseignant ADD CONSTRAINT FK_1442043CAFC2B591 FOREIGN KEY (module_id) REFERENCES module (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE module_enseignant ADD CONSTRAINT FK_1442043CE455FCC0 FOREIGN KEY (enseignant_id) REFERENCES enseignant (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE module_details ADD CONSTRAINT FK_D95D3593AFC2B591 FOREIGN KEY (module_id) REFERENCES module (id)');
        $this->addSql('ALTER TABLE module_details ADD CONSTRAINT FK_D95D3593E455FCC0 FOREIGN KEY (enseignant_id) REFERENCES enseignant (id)');
        $this->addSql('ALTER TABLE module_details ADD CONSTRAINT FK_D95D3593122EEC90 FOREIGN KEY (semaine_id) REFERENCES semaine (id)');
        $this->addSql('ALTER TABLE semaine ADD CONSTRAINT FK_7B4D8BEAAFC2B591 FOREIGN KEY (module_id) REFERENCES module (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE module_enseignant DROP FOREIGN KEY FK_1442043CE455FCC0');
        $this->addSql('ALTER TABLE module_details DROP FOREIGN KEY FK_D95D3593E455FCC0');
        $this->addSql('ALTER TABLE module_enseignant DROP FOREIGN KEY FK_1442043CAFC2B591');
        $this->addSql('ALTER TABLE module_details DROP FOREIGN KEY FK_D95D3593AFC2B591');
        $this->addSql('ALTER TABLE semaine DROP FOREIGN KEY FK_7B4D8BEAAFC2B591');
        $this->addSql('ALTER TABLE module_details DROP FOREIGN KEY FK_D95D3593122EEC90');
        $this->addSql('DROP TABLE csvfile');
        $this->addSql('DROP TABLE enseignant');
        $this->addSql('DROP TABLE module');
        $this->addSql('DROP TABLE module_enseignant');
        $this->addSql('DROP TABLE module_details');
        $this->addSql('DROP TABLE semaine');
    }
}
