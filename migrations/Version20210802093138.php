<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210802093138 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SEQUENCE contract_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE organization_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE road_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE road_part_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE "user_id_seq" INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE video_station_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE contract (id INT NOT NULL, customer_id INT NOT NULL, executor_id INT NOT NULL, title VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_E98F28599395C3F3 ON contract (customer_id)');
        $this->addSql('CREATE INDEX IDX_E98F28598ABD09BB ON contract (executor_id)');
        $this->addSql('CREATE TABLE contract_road_part (contract_id INT NOT NULL, road_part_id INT NOT NULL, PRIMARY KEY(contract_id, road_part_id))');
        $this->addSql('CREATE INDEX IDX_70ACE8A12576E0FD ON contract_road_part (contract_id)');
        $this->addSql('CREATE INDEX IDX_70ACE8A112AB71E4 ON contract_road_part (road_part_id)');
        $this->addSql('CREATE TABLE organization (id INT NOT NULL, title VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE road (id INT NOT NULL, title VARCHAR(255) NOT NULL, code VARCHAR(255) NOT NULL, order_rank INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE road_part (id INT NOT NULL, road_id INT NOT NULL, owner_id INT NOT NULL, start INT NOT NULL, finish INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_5D3BB037962F8178 ON road_part (road_id)');
        $this->addSql('CREATE INDEX IDX_5D3BB0377E3C61F9 ON road_part (owner_id)');
        $this->addSql('CREATE TABLE "user" (id INT NOT NULL, organization_id INT NOT NULL, title VARCHAR(255) NOT NULL, is_root BOOLEAN NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_8D93D64932C8A3DE ON "user" (organization_id)');
        $this->addSql('CREATE TABLE video_station (id INT NOT NULL, road_id INT NOT NULL, address INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_7AD4111C962F8178 ON video_station (road_id)');
        $this->addSql('ALTER TABLE contract ADD CONSTRAINT FK_E98F28599395C3F3 FOREIGN KEY (customer_id) REFERENCES organization (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE contract ADD CONSTRAINT FK_E98F28598ABD09BB FOREIGN KEY (executor_id) REFERENCES organization (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE contract_road_part ADD CONSTRAINT FK_70ACE8A12576E0FD FOREIGN KEY (contract_id) REFERENCES contract (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE contract_road_part ADD CONSTRAINT FK_70ACE8A112AB71E4 FOREIGN KEY (road_part_id) REFERENCES road_part (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE road_part ADD CONSTRAINT FK_5D3BB037962F8178 FOREIGN KEY (road_id) REFERENCES road (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE road_part ADD CONSTRAINT FK_5D3BB0377E3C61F9 FOREIGN KEY (owner_id) REFERENCES organization (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE "user" ADD CONSTRAINT FK_8D93D64932C8A3DE FOREIGN KEY (organization_id) REFERENCES organization (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE video_station ADD CONSTRAINT FK_7AD4111C962F8178 FOREIGN KEY (road_id) REFERENCES road (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

//        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE contract_road_part DROP CONSTRAINT FK_70ACE8A12576E0FD');
        $this->addSql('ALTER TABLE contract DROP CONSTRAINT FK_E98F28599395C3F3');
        $this->addSql('ALTER TABLE contract DROP CONSTRAINT FK_E98F28598ABD09BB');
        $this->addSql('ALTER TABLE road_part DROP CONSTRAINT FK_5D3BB0377E3C61F9');
        $this->addSql('ALTER TABLE "user" DROP CONSTRAINT FK_8D93D64932C8A3DE');
        $this->addSql('ALTER TABLE road_part DROP CONSTRAINT FK_5D3BB037962F8178');
        $this->addSql('ALTER TABLE video_station DROP CONSTRAINT FK_7AD4111C962F8178');
        $this->addSql('ALTER TABLE contract_road_part DROP CONSTRAINT FK_70ACE8A112AB71E4');
        $this->addSql('DROP SEQUENCE contract_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE organization_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE road_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE road_part_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE "user_id_seq" CASCADE');
        $this->addSql('DROP SEQUENCE video_station_id_seq CASCADE');
        $this->addSql('DROP TABLE contract');
        $this->addSql('DROP TABLE contract_road_part');
        $this->addSql('DROP TABLE organization');
        $this->addSql('DROP TABLE road');
        $this->addSql('DROP TABLE road_part');
        $this->addSql('DROP TABLE "user"');
        $this->addSql('DROP TABLE video_station');
    }
}
