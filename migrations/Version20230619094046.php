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
    }

    /**/
    public function down(Schema $schema): void
    {
        $schema->dropTable('contact');
    }
}
