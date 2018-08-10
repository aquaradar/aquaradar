<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180810165455 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE maintenance CHANGE status status SMALLINT DEFAULT NULL COMMENT \'0 - pendente 1 - resolvido 2 - fechado\'');
        $this->addSql('ALTER TABLE notification CHANGE status status SMALLINT NOT NULL COMMENT \'0 - pendente 1 - resolvido 2 - fechado\'');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE maintenance CHANGE status status TINYINT(1) DEFAULT \'0\' COMMENT \'0 - pendente 1 - resolvido 2 - fechado\'');
        $this->addSql('ALTER TABLE notification CHANGE status status TINYINT(1) DEFAULT \'0\' COMMENT \'0 - pendente 1 - resolvido 2 - fechado\'');
    }
}
