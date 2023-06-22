<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;
use Doctrine\DBAL\Types\Types;

/**
 * Auto-generated Migration: Please modify to your needs!
 *
 * It is creates the users table
 * 
 */
final class Version20230621113556 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $table = $schema->createTable('users');
        $table->addColumn('id', Types::BIGINT, ['autoincrement' => true, 'notnull' => true]);
        $table->addColumn('username', Types::STRING, ['length' => 180, 'notnull' => true]);
        $table->addColumn('roles', Types::JSON, ['notnull' => true]);
        $table->addColumn('password', Types::STRING, ['length' => 255, 'notnull' => true]);
        $table->addUniqueIndex(['username'], 'UNIQ_1483A5E9F85E0677');
        $table->setPrimaryKey(['id']);
    }

    public function down(Schema $schema): void
    {
        $schema->dropTable('users');
    }
}
