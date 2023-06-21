<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;
use Doctrine\DBAL\Types\Types;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230619094046 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    /**/
    public function up(Schema $schema): void
    {
        $table = $schema->createTable('contact');
        $table->addColumn('id', Types::BIGINT, ['autoincrement' => true, 'notnull' => true]);
        $table->addColumn('name', Types::STRING, ['length' => 64, 'notnull' => true]);
        $table->addColumn('email', Types::STRING, ['length' => 125, 'notnull' => true]);
        $table->addColumn('question', Types::TEXT, ['notnull' => true]);
        $table->setPrimaryKey(['id']);


        // this up() migration is auto-generated, please modify it to your needs
        //$this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    }

    /**/
    public function down(Schema $schema): void
    {
        $schema->dropTable('contact');
        // this down() migration is auto-generated, please modify it to your needs
        //$this->addSql('DROP TABLE messenger_messages');
    }
}
