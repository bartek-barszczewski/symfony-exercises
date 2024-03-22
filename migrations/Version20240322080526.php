<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240322080526 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE forecast (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, location_id INTEGER NOT NULL, date DATE NOT NULL, celsius INTEGER NOT NULL, CONSTRAINT FK_2A9C784464D218E FOREIGN KEY (location_id) REFERENCES location (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_2A9C784464D218E ON forecast (location_id)');

        $this->addSQL('INSERT INTO forecast (location_id, date, celsius) VALUES(1, "2024-01-02", 10) ');
        $this->addSQL('INSERT INTO forecast (location_id, date, celsius) VALUES(1, "2024-01-03", 11) ');
        $this->addSQL('INSERT INTO forecast (location_id, date, celsius) VALUES(1, "2024-01-04", 12) ');
        $this->addSQL('INSERT INTO forecast (location_id, date, celsius) VALUES(1, "2024-01-05", 13) ');
        $this->addSQL('INSERT INTO forecast (location_id, date, celsius) VALUES(2, "2024-01-02", 0) ');
        $this->addSQL('INSERT INTO forecast (location_id, date, celsius) VALUES(2, "2024-01-03", 1) ');
        $this->addSQL('INSERT INTO forecast (location_id, date, celsius) VALUES(2, "2024-01-04", 13) ');
        $this->addSQL('INSERT INTO forecast (location_id, date, celsius) VALUES(2, "2024-01-05", 2) ');
        $this->addSQL('INSERT INTO forecast (location_id, date, celsius) VALUES(3, "2024-01-02", 2) ');
        
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE forecast');
    }
}
