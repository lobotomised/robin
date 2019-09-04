<?php

declare(strict_types=1);

namespace Database\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

class Version20150915130401 extends AbstractMigration
{
    /**
     * Run the migrations.
     *
     * @param \Doctrine\DBAL\Schema\Schema $schema
     *
     * @return void
     */
    public function up(Schema $schema): void
    {
        $this->addSql(
            'create table pasts (
                id char(36) not null,
                encrypted longtext not null,
                created_at timestamp default current_timestamp() not null on update current_timestamp(),
                expire_at datetime not null,
                primary key(id)
            )
            ENGINE = InnoDB
        '
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(Schema $schema): void
    {
        $this->addSql('DROP TABLE IF EXISTS pasts');
    }
}
