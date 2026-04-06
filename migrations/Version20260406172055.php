<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260406172055 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE add_product_history (id INT AUTO_INCREMENT NOT NULL, quantité INT NOT NULL, created_at DATETIME NOT NULL, product_id INT NOT NULL, INDEX IDX_EDEB7BDE4584665A (product_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('ALTER TABLE add_product_history ADD CONSTRAINT FK_EDEB7BDE4584665A FOREIGN KEY (product_id) REFERENCES product (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_D34A04AD6C6E55B5 ON product (nom)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE add_product_history DROP FOREIGN KEY FK_EDEB7BDE4584665A');
        $this->addSql('DROP TABLE add_product_history');
        $this->addSql('DROP INDEX UNIQ_D34A04AD6C6E55B5 ON product');
    }
}
