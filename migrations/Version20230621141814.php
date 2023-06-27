<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use App\Helper\PasswordHasher;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 *
 * It is create a basic record for the super user
 *
 */
final class Version20230621141814 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $user = 'admin';
        $hashedPassowrd = (new PasswordHasher('password'))->getHashedPassword();

        $this->addSql('INSERT INTO users (username, roles, password) VALUES ( "' . $user . '", \'["ROLE_ROOT_ADMIN"]\', "' . $hashedPassowrd . '" )');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
    }
}
