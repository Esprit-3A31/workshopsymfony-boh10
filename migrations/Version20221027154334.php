<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221027154334 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE class_room (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, nbr_student INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE student (nce VARCHAR(255) NOT NULL, class_room_id INT DEFAULT NULL, username VARCHAR(255) NOT NULL, INDEX IDX_B723AF339162176F (class_room_id), PRIMARY KEY(nce)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE student ADD CONSTRAINT FK_B723AF339162176F FOREIGN KEY (class_room_id) REFERENCES class_room (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE classroom');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE classroom (id VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, name VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE student DROP FOREIGN KEY FK_B723AF339162176F');
        $this->addSql('DROP TABLE class_room');
        $this->addSql('DROP TABLE student');
    }
}
