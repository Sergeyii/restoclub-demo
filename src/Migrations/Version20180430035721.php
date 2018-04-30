<?php declare(strict_types = 1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180430035721 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE `tag` (
			  `id` INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
			  `title` varchar(255) NOT NULL,
			  `slug` varchar(255) NOT NULL,
			  `created_at` datetime NOT NULL
			) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;');

        $this->addSql('ALTER TABLE `tag` ADD INDEX `idx-tag-slug` (`slug`)');

        //----
        $this->addSql('CREATE TABLE `article_tag_assigments` (
			  `id` INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
			  `article_id` INT(11) NOT NULL,
			  `tag_id` INT(11) NOT NULL
			) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;');

        $this->addSql('ALTER TABLE `article_tag_assigments` ADD CONSTRAINT `fk-article_tag_assigments-article_id` FOREIGN KEY (article_id) REFERENCES article(id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE `article_tag_assigments` ADD CONSTRAINT `fk-article_tag_assigments-tag_id` FOREIGN KEY (tag_id) REFERENCES tag(id) ON DELETE CASCADE');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE `tag`');
        $this->addSql('DROP TABLE `article_tag_assigments`');
    }
}
