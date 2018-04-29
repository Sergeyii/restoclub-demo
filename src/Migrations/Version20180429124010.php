<?php declare(strict_types = 1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

class Version20180429124010 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        $this->addSql('CREATE TABLE `article` (
			  `id` INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
			  `title` varchar(255) NOT NULL,
			  `slug` varchar(255) NOT NULL,
			  `author_fio` varchar(255) NOT NULL,
			  `author_site_url` varchar(255) NOT NULL,
			  `type` TINYINT(1) NOT NULL,
			  `description` TEXT NOT NULL,
			  `created_at` datetime NOT NULL,
			  `updated_at` datetime NOT NULL,
			  `publicated_at` datetime NOT NULL
			) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;');

        $this->addSql('ALTER TABLE `article` ADD INDEX `idx-article-slug` (`slug`)');

    }

    public function down(Schema $schema)
    {
        $this->addSql('DROP TABLE `article`');
    }
}
