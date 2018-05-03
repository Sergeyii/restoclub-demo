<?php declare(strict_types = 1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

class Version20180503114121 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE `article_author` (
			  `id` INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
			  `article_id` INT(11) NOT NULL,
			  `site_url` varchar(255) DEFAULT "",
			  `fio` varchar(255) DEFAULT ""
			) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;');

        $this->addSql('ALTER TABLE `article_author` ADD CONSTRAINT `fk-article_author-article_id` FOREIGN KEY (article_id) REFERENCES article(id) ON DELETE CASCADE');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE `article_author`');
    }
}
