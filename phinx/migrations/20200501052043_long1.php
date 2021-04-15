<?php

use Phinx\Db\Adapter\MysqlAdapter;

class Long1 extends Phinx\Migration\AbstractMigration
{
    public function change()
    {
        $this->table('class_manager', [
                'id' => false,
                'primary_key' => ['cls_id'],
                'engine' => 'InnoDB',
                'encoding' => 'utf8',
                'collation' => 'utf8_general_ci',
                'comment' => '',
                'row_format' => 'DYNAMIC',
            ])
            ->addColumn('cls_id', 'integer', [
                'null' => false,
                'limit' => MysqlAdapter::INT_REGULAR,
                'identity' => 'enable',
            ])
            ->addColumn('cls_code', 'string', [
                'null' => true,
                'default' => null,
                'limit' => 255,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'cls_id',
            ])
            ->addColumn('cls_scientific_id', 'integer', [
                'null' => true,
                'default' => null,
                'limit' => MysqlAdapter::INT_REGULAR,
                'after' => 'cls_code',
            ])
            ->addColumn('cls_school_id', 'integer', [
                'null' => true,
                'default' => null,
                'limit' => MysqlAdapter::INT_REGULAR,
                'after' => 'cls_scientific_id',
            ])
            ->addColumn('cls_create_time', 'integer', [
                'null' => true,
                'default' => null,
                'limit' => MysqlAdapter::INT_REGULAR,
                'after' => 'cls_school_id',
            ])
            ->addColumn('cls_update_time', 'integer', [
                'null' => true,
                'default' => null,
                'limit' => MysqlAdapter::INT_REGULAR,
                'after' => 'cls_create_time',
            ])
            ->addColumn('cls_admin_id', 'integer', [
                'null' => false,
                'limit' => MysqlAdapter::INT_REGULAR,
                'after' => 'cls_update_time',
            ])
            ->create();
        $this->table('configuration', [
                'id' => false,
                'primary_key' => ['con_id'],
                'engine' => 'MyISAM',
                'encoding' => 'utf8',
                'collation' => 'utf8_general_ci',
                'comment' => '',
                'row_format' => 'DYNAMIC',
            ])
            ->changeColumn('con_extenstion', 'string', [
                'null' => true,
                'default' => '\'\'\'html\'\'\'',
                'limit' => 20,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'con_lang_id',
            ])
            ->save();
        $this->table('school_manager', [
                'id' => false,
                'primary_key' => ['sch_id'],
                'engine' => 'InnoDB',
                'encoding' => 'utf8',
                'collation' => 'utf8_general_ci',
                'comment' => '',
                'row_format' => 'DYNAMIC',
            ])
            ->addColumn('sch_id', 'integer', [
                'null' => false,
                'limit' => MysqlAdapter::INT_REGULAR,
                'identity' => 'enable',
            ])
            ->addColumn('sch_code', 'string', [
                'null' => true,
                'default' => null,
                'limit' => 50,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'sch_id',
            ])
            ->addColumn('sch_name', 'string', [
                'null' => true,
                'default' => null,
                'limit' => 255,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'sch_code',
            ])
            ->addColumn('sch_active', 'integer', [
                'null' => true,
                'default' => '0',
                'limit' => MysqlAdapter::INT_TINY,
                'after' => 'sch_name',
            ])
            ->addColumn('sch_create_time', 'integer', [
                'null' => true,
                'default' => null,
                'limit' => MysqlAdapter::INT_REGULAR,
                'after' => 'sch_active',
            ])
            ->addColumn('sch_update_time', 'integer', [
                'null' => true,
                'default' => null,
                'limit' => MysqlAdapter::INT_REGULAR,
                'after' => 'sch_create_time',
            ])
            ->addColumn('sch_admin_id', 'integer', [
                'null' => false,
                'limit' => MysqlAdapter::INT_REGULAR,
                'after' => 'sch_update_time',
            ])
            ->create();
        $this->table('scientific_manager', [
                'id' => false,
                'primary_key' => ['sci_id'],
                'engine' => 'InnoDB',
                'encoding' => 'utf8',
                'collation' => 'utf8_general_ci',
                'comment' => '',
                'row_format' => 'DYNAMIC',
            ])
            ->addColumn('sci_id', 'integer', [
                'null' => false,
                'limit' => MysqlAdapter::INT_REGULAR,
                'identity' => 'enable',
            ])
            ->addColumn('sci_school_id', 'integer', [
                'null' => true,
                'default' => null,
                'limit' => MysqlAdapter::INT_REGULAR,
                'after' => 'sci_id',
            ])
            ->addColumn('sci_name', 'string', [
                'null' => true,
                'default' => null,
                'limit' => 255,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'sci_school_id',
            ])
            ->addColumn('sci_active', 'integer', [
                'null' => false,
                'default' => '0',
                'limit' => MysqlAdapter::INT_TINY,
                'after' => 'sci_name',
            ])
            ->addColumn('sci_create_time', 'integer', [
                'null' => true,
                'default' => null,
                'limit' => MysqlAdapter::INT_REGULAR,
                'after' => 'sci_active',
            ])
            ->addColumn('sci_update_time', 'integer', [
                'null' => true,
                'default' => null,
                'limit' => MysqlAdapter::INT_REGULAR,
                'after' => 'sci_create_time',
            ])
            ->addColumn('sci_admin_id', 'integer', [
                'null' => false,
                'limit' => MysqlAdapter::INT_REGULAR,
                'after' => 'sci_update_time',
            ])
            ->create();
        $this->table('languages', [
                'id' => false,
                'primary_key' => ['lang_id'],
                'engine' => 'MyISAM',
                'encoding' => 'utf8',
                'collation' => 'utf8_unicode_ci',
                'comment' => '',
                'row_format' => 'DYNAMIC',
            ])
            ->changeColumn('lang_path', 'string', [
                'null' => true,
                'default' => '\'\'\'home\'\'\'',
                'limit' => 15,
                'collation' => 'utf8_unicode_ci',
                'encoding' => 'utf8',
                'after' => 'lang_name',
            ])
            ->save();
    }
}
