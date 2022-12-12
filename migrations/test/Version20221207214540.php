<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221207214540 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->addSql(
            <<<SQL
                CREATE TABLE `user_db_test`.`user` (
                    `id` CHAR(36) PRIMARY KEY NOT NULL,
                    `name` VARCHAR(50) DEFAULT NULL,
                    `email` VARCHAR(100) DEFAULT NULL,
                    `address` VARCHAR(100) DEFAULT NULL,
                    `age` SMALLINT NOT NULL,
                    `password` VARCHAR(250) DEFAULT NULL,
                    `roles` JSON NOT NULL, 
                    INDEX IDX_user_email (`email`),
                    UNIQUE U_user_email (`email`)
                );
            SQL
        );
    }

    public function down(Schema $schema): void
    {
        $this->addSql(
            <<<SQL
                DROP TABLE `user_db_test`.`user`;
            SQL
        );
    }
}