<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211009164713 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE author_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE stack_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE stack_item_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE vote_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE work_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE author (id INT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE stack (id INT NOT NULL, owner_id INT NOT NULL, type VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_41A87B6A7E3C61F9 ON stack (owner_id)');
        $this->addSql('CREATE TABLE stack_item (id INT NOT NULL, work_id INT NOT NULL, stack_id INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_138B6FE8BB3453DB ON stack_item (work_id)');
        $this->addSql('CREATE INDEX IDX_138B6FE837C70060 ON stack_item (stack_id)');
        $this->addSql('CREATE TABLE vote (id INT NOT NULL, item_id INT NOT NULL, voter_id INT NOT NULL, value INT NOT NULL, comment TEXT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_5A108564126F525E ON vote (item_id)');
        $this->addSql('CREATE INDEX IDX_5A108564EBB4B8AD ON vote (voter_id)');
        $this->addSql('CREATE TABLE work (id INT NOT NULL, title VARCHAR(255) NOT NULL, type VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE work_author (work_id INT NOT NULL, author_id INT NOT NULL, PRIMARY KEY(work_id, author_id))');
        $this->addSql('CREATE INDEX IDX_16561EEABB3453DB ON work_author (work_id)');
        $this->addSql('CREATE INDEX IDX_16561EEAF675F31B ON work_author (author_id)');
        $this->addSql('ALTER TABLE stack ADD CONSTRAINT FK_41A87B6A7E3C61F9 FOREIGN KEY (owner_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE stack_item ADD CONSTRAINT FK_138B6FE8BB3453DB FOREIGN KEY (work_id) REFERENCES work (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE stack_item ADD CONSTRAINT FK_138B6FE837C70060 FOREIGN KEY (stack_id) REFERENCES stack (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE vote ADD CONSTRAINT FK_5A108564126F525E FOREIGN KEY (item_id) REFERENCES stack_item (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE vote ADD CONSTRAINT FK_5A108564EBB4B8AD FOREIGN KEY (voter_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE work_author ADD CONSTRAINT FK_16561EEABB3453DB FOREIGN KEY (work_id) REFERENCES work (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE work_author ADD CONSTRAINT FK_16561EEAF675F31B FOREIGN KEY (author_id) REFERENCES author (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE work_author DROP CONSTRAINT FK_16561EEAF675F31B');
        $this->addSql('ALTER TABLE stack_item DROP CONSTRAINT FK_138B6FE837C70060');
        $this->addSql('ALTER TABLE vote DROP CONSTRAINT FK_5A108564126F525E');
        $this->addSql('ALTER TABLE stack_item DROP CONSTRAINT FK_138B6FE8BB3453DB');
        $this->addSql('ALTER TABLE work_author DROP CONSTRAINT FK_16561EEABB3453DB');
        $this->addSql('DROP SEQUENCE author_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE stack_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE stack_item_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE vote_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE work_id_seq CASCADE');
        $this->addSql('DROP TABLE author');
        $this->addSql('DROP TABLE stack');
        $this->addSql('DROP TABLE stack_item');
        $this->addSql('DROP TABLE vote');
        $this->addSql('DROP TABLE work');
        $this->addSql('DROP TABLE work_author');
    }
}
