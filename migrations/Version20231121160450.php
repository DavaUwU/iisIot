<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231121160450 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE system_account (system_id INT NOT NULL, account_id INT NOT NULL, INDEX IDX_91452A37D0952FA5 (system_id), INDEX IDX_91452A379B6B5FBA (account_id), PRIMARY KEY(system_id, account_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE system_account ADD CONSTRAINT FK_91452A37D0952FA5 FOREIGN KEY (system_id) REFERENCES `system` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE system_account ADD CONSTRAINT FK_91452A379B6B5FBA FOREIGN KEY (account_id) REFERENCES account (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE device ADD system_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE device ADD CONSTRAINT FK_92FB68ED0952FA5 FOREIGN KEY (system_id) REFERENCES `system` (id)');
        $this->addSql('CREATE INDEX IDX_92FB68ED0952FA5 ON device (system_id)');
        $this->addSql('ALTER TABLE kpi ADD device_id INT NOT NULL, ADD parameter_id INT NOT NULL');
        $this->addSql('ALTER TABLE kpi ADD CONSTRAINT FK_A0925DD994A4C7D4 FOREIGN KEY (device_id) REFERENCES device (id)');
        $this->addSql('ALTER TABLE kpi ADD CONSTRAINT FK_A0925DD97C56DBD6 FOREIGN KEY (parameter_id) REFERENCES parameter (id)');
        $this->addSql('CREATE INDEX IDX_A0925DD994A4C7D4 ON kpi (device_id)');
        $this->addSql('CREATE INDEX IDX_A0925DD97C56DBD6 ON kpi (parameter_id)');
        $this->addSql('ALTER TABLE parameter ADD device_id INT NOT NULL');
        $this->addSql('ALTER TABLE parameter ADD CONSTRAINT FK_2A97911094A4C7D4 FOREIGN KEY (device_id) REFERENCES device (id)');
        $this->addSql('CREATE INDEX IDX_2A97911094A4C7D4 ON parameter (device_id)');
        $this->addSql('ALTER TABLE system ADD owner_id INT NOT NULL');
        $this->addSql('ALTER TABLE system ADD CONSTRAINT FK_C94D118B7E3C61F9 FOREIGN KEY (owner_id) REFERENCES account (id)');
        $this->addSql('CREATE INDEX IDX_C94D118B7E3C61F9 ON system (owner_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE system_account DROP FOREIGN KEY FK_91452A37D0952FA5');
        $this->addSql('ALTER TABLE system_account DROP FOREIGN KEY FK_91452A379B6B5FBA');
        $this->addSql('DROP TABLE system_account');
        $this->addSql('ALTER TABLE device DROP FOREIGN KEY FK_92FB68ED0952FA5');
        $this->addSql('DROP INDEX IDX_92FB68ED0952FA5 ON device');
        $this->addSql('ALTER TABLE device DROP system_id');
        $this->addSql('ALTER TABLE kpi DROP FOREIGN KEY FK_A0925DD994A4C7D4');
        $this->addSql('ALTER TABLE kpi DROP FOREIGN KEY FK_A0925DD97C56DBD6');
        $this->addSql('DROP INDEX IDX_A0925DD994A4C7D4 ON kpi');
        $this->addSql('DROP INDEX IDX_A0925DD97C56DBD6 ON kpi');
        $this->addSql('ALTER TABLE kpi DROP device_id, DROP parameter_id');
        $this->addSql('ALTER TABLE parameter DROP FOREIGN KEY FK_2A97911094A4C7D4');
        $this->addSql('DROP INDEX IDX_2A97911094A4C7D4 ON parameter');
        $this->addSql('ALTER TABLE parameter DROP device_id');
        $this->addSql('ALTER TABLE `system` DROP FOREIGN KEY FK_C94D118B7E3C61F9');
        $this->addSql('DROP INDEX IDX_C94D118B7E3C61F9 ON `system`');
        $this->addSql('ALTER TABLE `system` DROP owner_id');
    }
}
