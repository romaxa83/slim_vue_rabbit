<?php declare(strict_types=1);

namespace Api\Data\Migration;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190202133835 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE TABLE user_users (id UUID NOT NULL, date TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, email VARCHAR(255) NOT NULL, password_hash VARCHAR(255) NOT NULL, status VARCHAR(16) NOT NULL, confirm_token_token VARCHAR(255) DEFAULT NULL, confirm_token_expires TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_F6415EB1E7927C74 ON user_users (email)');
        $this->addSql('COMMENT ON COLUMN user_users.date IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN user_users.confirm_token_expires IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE oauth_auth_codes (identifier VARCHAR(80) NOT NULL, expiry_date_time TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, user_identifier UUID NOT NULL, client VARCHAR(255) NOT NULL, scopes JSON NOT NULL, redirectUri VARCHAR(255) NOT NULL, PRIMARY KEY(identifier, redirectUri))');
        $this->addSql('CREATE TABLE oauth_access_tokens (identifier VARCHAR(80) NOT NULL, expiry_date_time TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, user_identifier UUID NOT NULL, client VARCHAR(255) NOT NULL, scopes JSON NOT NULL, PRIMARY KEY(identifier))');
        $this->addSql('CREATE TABLE oauth_refresh_tokens (identifier VARCHAR(80) NOT NULL, access_token_identifier VARCHAR(80) NOT NULL, expiry_date_time TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(identifier))');
        $this->addSql('CREATE INDEX IDX_5AB6878E5675DC ON oauth_refresh_tokens (access_token_identifier)');
        $this->addSql('CREATE TABLE video_videos (id UUID NOT NULL, author_id UUID NOT NULL, create_date TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, name VARCHAR(255) NOT NULL, origin VARCHAR(255) NOT NULL, status VARCHAR(16) NOT NULL, publish_date TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, thumbnail_path VARCHAR(255) DEFAULT NULL, thumbnail_size_width INT DEFAULT NULL, thumbnail_size_height INT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_11FDC4FFF675F31B ON video_videos (author_id)');
        $this->addSql('COMMENT ON COLUMN video_videos.create_date IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN video_videos.publish_date IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE video_video_files (id UUID NOT NULL, video_id UUID NOT NULL, path VARCHAR(255) NOT NULL, format VARCHAR(255) NOT NULL, size_width INT DEFAULT NULL, size_height INT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_ABD5F85A29C1004E ON video_video_files (video_id)');
        $this->addSql('CREATE TABLE video_authors (id UUID NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE oauth_refresh_tokens ADD CONSTRAINT FK_5AB6878E5675DC FOREIGN KEY (access_token_identifier) REFERENCES oauth_access_tokens (identifier) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE video_videos ADD CONSTRAINT FK_11FDC4FFF675F31B FOREIGN KEY (author_id) REFERENCES video_authors (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE video_video_files ADD CONSTRAINT FK_ABD5F85A29C1004E FOREIGN KEY (video_id) REFERENCES video_videos (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE oauth_refresh_tokens DROP CONSTRAINT FK_5AB6878E5675DC');
        $this->addSql('ALTER TABLE video_video_files DROP CONSTRAINT FK_ABD5F85A29C1004E');
        $this->addSql('ALTER TABLE video_videos DROP CONSTRAINT FK_11FDC4FFF675F31B');
        $this->addSql('DROP TABLE user_users');
        $this->addSql('DROP TABLE oauth_auth_codes');
        $this->addSql('DROP TABLE oauth_access_tokens');
        $this->addSql('DROP TABLE oauth_refresh_tokens');
        $this->addSql('DROP TABLE video_videos');
        $this->addSql('DROP TABLE video_video_files');
        $this->addSql('DROP TABLE video_authors');
    }
}
