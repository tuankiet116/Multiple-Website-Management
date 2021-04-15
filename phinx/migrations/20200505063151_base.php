<?php

use Phinx\Db\Adapter\MysqlAdapter;

class Base extends Phinx\Migration\AbstractMigration
{
    public function change()
    {
        $this->execute("ALTER DATABASE CHARACTER SET 'utf8';");
        $this->execute("ALTER DATABASE COLLATE='utf8_vietnamese_ci';");
        $this->table('admin_menu_order', [
                'id' => false,
                'primary_key' => ['amo_admin', 'amo_module'],
                'engine' => 'MyISAM',
                'encoding' => 'utf8',
                'collation' => 'utf8_general_ci',
                'comment' => '',
                'row_format' => 'FIXED',
            ])
            ->addColumn('amo_admin', 'integer', [
                'null' => false,
                'default' => '0',
                'limit' => MysqlAdapter::INT_REGULAR,
            ])
            ->addColumn('amo_module', 'integer', [
                'null' => false,
                'default' => '0',
                'limit' => MysqlAdapter::INT_REGULAR,
                'after' => 'amo_admin',
            ])
            ->addColumn('amo_order', 'integer', [
                'null' => true,
                'default' => '0',
                'limit' => MysqlAdapter::INT_REGULAR,
                'after' => 'amo_module',
            ])
            ->addIndex(['amo_order'], [
                'name' => 'amo_order',
                'unique' => false,
            ])
            ->create();
        $this->table('admin_translate', [
                'id' => false,
                'primary_key' => ['tra_keyword'],
                'engine' => 'MyISAM',
                'encoding' => 'utf8',
                'collation' => 'utf8_general_ci',
                'comment' => '',
                'row_format' => 'DYNAMIC',
            ])
            ->addColumn('tra_keyword', 'string', [
                'null' => false,
                'limit' => 255,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
            ])
            ->addColumn('tra_text', 'string', [
                'null' => true,
                'default' => null,
                'limit' => 255,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'tra_keyword',
            ])
            ->addColumn('lang_id', 'integer', [
                'null' => true,
                'default' => null,
                'limit' => MysqlAdapter::INT_REGULAR,
                'after' => 'tra_text',
            ])
            ->addColumn('tra_source', 'string', [
                'null' => true,
                'default' => null,
                'limit' => 255,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'lang_id',
            ])
            ->create();
        $this->table('admin_user', [
                'id' => false,
                'primary_key' => ['adm_id'],
                'engine' => 'MyISAM',
                'encoding' => 'utf8',
                'collation' => 'utf8_general_ci',
                'comment' => '',
                'row_format' => 'DYNAMIC',
            ])
            ->addColumn('adm_id', 'integer', [
                'null' => false,
                'limit' => MysqlAdapter::INT_REGULAR,
                'identity' => 'enable',
            ])
            ->addColumn('adm_loginname', 'string', [
                'null' => true,
                'default' => null,
                'limit' => 100,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'adm_id',
            ])
            ->addColumn('adm_password', 'string', [
                'null' => true,
                'default' => null,
                'limit' => 100,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'adm_loginname',
            ])
            ->addColumn('adm_name', 'string', [
                'null' => true,
                'default' => null,
                'limit' => 255,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'adm_password',
            ])
            ->addColumn('adm_email', 'string', [
                'null' => true,
                'default' => null,
                'limit' => 255,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'adm_name',
            ])
            ->addColumn('adm_address', 'string', [
                'null' => true,
                'default' => null,
                'limit' => 255,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'adm_email',
            ])
            ->addColumn('adm_phone', 'string', [
                'null' => true,
                'default' => null,
                'limit' => 255,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'adm_address',
            ])
            ->addColumn('adm_mobile', 'string', [
                'null' => true,
                'default' => null,
                'limit' => 255,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'adm_phone',
            ])
            ->addColumn('adm_cskh', 'integer', [
                'null' => true,
                'default' => '0',
                'limit' => MysqlAdapter::INT_TINY,
                'after' => 'adm_mobile',
            ])
            ->addColumn('adm_job', 'integer', [
                'null' => false,
                'default' => '0',
                'limit' => MysqlAdapter::INT_TINY,
                'after' => 'adm_cskh',
            ])
            ->addColumn('adm_access_module', 'string', [
                'null' => true,
                'default' => null,
                'limit' => 255,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'adm_job',
            ])
            ->addColumn('adm_access_category', 'text', [
                'null' => true,
                'default' => null,
                'limit' => 65535,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'adm_access_module',
            ])
            ->addColumn('adm_date', 'integer', [
                'null' => true,
                'default' => '0',
                'limit' => MysqlAdapter::INT_REGULAR,
                'after' => 'adm_access_category',
            ])
            ->addColumn('adm_isadmin', 'boolean', [
                'null' => true,
                'default' => '0',
                'limit' => MysqlAdapter::INT_TINY,
                'after' => 'adm_date',
            ])
            ->addColumn('adm_active', 'boolean', [
                'null' => true,
                'default' => '1',
                'limit' => MysqlAdapter::INT_TINY,
                'after' => 'adm_isadmin',
            ])
            ->addColumn('lang_id', 'boolean', [
                'null' => true,
                'default' => '1',
                'limit' => MysqlAdapter::INT_TINY,
                'after' => 'adm_active',
            ])
            ->addColumn('adm_delete', 'integer', [
                'null' => true,
                'default' => '0',
                'limit' => MysqlAdapter::INT_REGULAR,
                'after' => 'lang_id',
            ])
            ->addColumn('adm_all_category', 'integer', [
                'null' => true,
                'default' => null,
                'limit' => '1',
                'after' => 'adm_delete',
            ])
            ->addColumn('adm_edit_all', 'integer', [
                'null' => true,
                'default' => '0',
                'limit' => '1',
                'after' => 'adm_all_category',
            ])
            ->addColumn('admin_id', 'integer', [
                'null' => true,
                'default' => '0',
                'limit' => '1',
                'after' => 'adm_edit_all',
            ])
            ->addIndex(['adm_date'], [
                'name' => 'adm_date',
                'unique' => false,
            ])
            ->addIndex(['admin_id'], [
                'name' => 'admin_id',
                'unique' => false,
            ])
            ->addIndex(['lang_id'], [
                'name' => 'lang_id',
                'unique' => false,
            ])
            ->addIndex(['adm_isadmin'], [
                'name' => 'adm_isadmin',
                'unique' => false,
            ])
            ->addIndex(['adm_active'], [
                'name' => 'adm_active',
                'unique' => false,
            ])
            ->addIndex(['adm_cskh'], [
                'name' => 'adm_cskh',
                'unique' => false,
            ])
            ->create();
        $this->table('admin_user_category', [
                'id' => false,
                'engine' => 'MyISAM',
                'encoding' => 'utf8',
                'collation' => 'utf8_general_ci',
                'comment' => '',
                'row_format' => 'FIXED',
            ])
            ->addColumn('auc_admin_id', 'integer', [
                'null' => false,
                'default' => '0',
                'limit' => MysqlAdapter::INT_REGULAR,
            ])
            ->addColumn('auc_category_id', 'integer', [
                'null' => false,
                'default' => '0',
                'limit' => MysqlAdapter::INT_REGULAR,
                'after' => 'auc_admin_id',
            ])
            ->create();
        $this->table('admin_user_language', [
                'id' => false,
                'primary_key' => ['aul_admin_id', 'aul_lang_id'],
                'engine' => 'MyISAM',
                'encoding' => 'utf8',
                'collation' => 'utf8_general_ci',
                'comment' => '',
                'row_format' => 'FIXED',
            ])
            ->addColumn('aul_admin_id', 'integer', [
                'null' => false,
                'default' => '0',
                'limit' => MysqlAdapter::INT_REGULAR,
            ])
            ->addColumn('aul_lang_id', 'integer', [
                'null' => false,
                'default' => '0',
                'limit' => MysqlAdapter::INT_REGULAR,
                'after' => 'aul_admin_id',
            ])
            ->addIndex(['aul_lang_id'], [
                'name' => 'aul_lang_id',
                'unique' => false,
            ])
            ->create();
        $this->table('admin_user_right', [
                'id' => false,
                'primary_key' => ['adu_admin_id', 'adu_admin_module_id'],
                'engine' => 'MyISAM',
                'encoding' => 'utf8',
                'collation' => 'utf8_general_ci',
                'comment' => '',
                'row_format' => 'FIXED',
            ])
            ->addColumn('adu_admin_id', 'integer', [
                'null' => false,
                'limit' => MysqlAdapter::INT_REGULAR,
                'identity' => 'enable',
            ])
            ->addColumn('adu_admin_module_id', 'integer', [
                'null' => false,
                'default' => '0',
                'limit' => MysqlAdapter::INT_REGULAR,
                'after' => 'adu_admin_id',
            ])
            ->addColumn('adu_add', 'integer', [
                'null' => true,
                'default' => '0',
                'limit' => '1',
                'after' => 'adu_admin_module_id',
            ])
            ->addColumn('adu_edit', 'integer', [
                'null' => true,
                'default' => '0',
                'limit' => '1',
                'after' => 'adu_add',
            ])
            ->addColumn('adu_delete', 'integer', [
                'null' => true,
                'default' => '0',
                'limit' => '1',
                'after' => 'adu_edit',
            ])
            ->create();
        $this->table('categories_multi', [
                'id' => false,
                'primary_key' => ['cat_id'],
                'engine' => 'MyISAM',
                'encoding' => 'utf8',
                'collation' => 'utf8_general_ci',
                'comment' => '',
                'row_format' => 'DYNAMIC',
            ])
            ->addColumn('cat_id', 'integer', [
                'null' => false,
                'limit' => MysqlAdapter::INT_REGULAR,
                'identity' => 'enable',
            ])
            ->addColumn('cat_name', 'string', [
                'null' => true,
                'default' => null,
                'limit' => 255,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'cat_id',
            ])
            ->addColumn('cat_name_rewrite', 'string', [
                'null' => true,
                'default' => null,
                'limit' => 266,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'cat_name',
            ])
            ->addColumn('cat_order', 'integer', [
                'null' => true,
                'default' => null,
                'limit' => '5',
                'after' => 'cat_name_rewrite',
            ])
            ->addColumn('cat_picture', 'string', [
                'null' => true,
                'default' => null,
                'limit' => 255,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'cat_order',
            ])
            ->addColumn('cat_banner', 'string', [
                'null' => true,
                'default' => null,
                'limit' => 255,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'cat_picture',
            ])
            ->addColumn('cat_banner_link', 'text', [
                'null' => true,
                'default' => null,
                'limit' => 65535,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'cat_banner',
            ])
            ->addColumn('cat_background', 'string', [
                'null' => true,
                'default' => null,
                'limit' => 255,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'cat_banner_link',
            ])
            ->addColumn('cat_title', 'text', [
                'null' => true,
                'default' => null,
                'limit' => 65535,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'cat_background',
            ])
            ->addColumn('cat_description', 'text', [
                'null' => true,
                'default' => null,
                'limit' => 65535,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'cat_title',
            ])
            ->addColumn('cat_meta_keyword', 'text', [
                'null' => true,
                'default' => null,
                'limit' => 65535,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'cat_description',
            ])
            ->addColumn('cat_meta_title', 'text', [
                'null' => true,
                'default' => null,
                'limit' => 65535,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'cat_meta_keyword',
            ])
            ->addColumn('cat_meta_description', 'text', [
                'null' => true,
                'default' => null,
                'limit' => 65535,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'cat_meta_title',
            ])
            ->addColumn('cat_active', 'integer', [
                'null' => true,
                'default' => '1',
                'limit' => '1',
                'after' => 'cat_meta_description',
            ])
            ->addColumn('lang_id', 'integer', [
                'null' => true,
                'default' => '1',
                'limit' => '1',
                'after' => 'cat_active',
            ])
            ->addColumn('cat_parent_id', 'integer', [
                'null' => false,
                'default' => '0',
                'limit' => MysqlAdapter::INT_REGULAR,
                'after' => 'lang_id',
            ])
            ->addColumn('cat_has_child', 'integer', [
                'null' => false,
                'default' => '1',
                'limit' => MysqlAdapter::INT_REGULAR,
                'after' => 'cat_parent_id',
            ])
            ->addColumn('cat_all_child', 'string', [
                'null' => true,
                'default' => null,
                'limit' => 255,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'cat_has_child',
            ])
            ->addColumn('cat_type', 'string', [
                'null' => true,
                'default' => null,
                'limit' => 100,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'cat_all_child',
            ])
            ->addColumn('cat_hot', 'integer', [
                'null' => true,
                'default' => '0',
                'limit' => MysqlAdapter::INT_TINY,
                'after' => 'cat_type',
            ])
            ->addColumn('admin_id', 'integer', [
                'null' => true,
                'default' => '0',
                'limit' => MysqlAdapter::INT_REGULAR,
                'after' => 'cat_hot',
            ])
            ->addColumn('cat_show_mob', 'boolean', [
                'null' => true,
                'default' => '0',
                'limit' => MysqlAdapter::INT_TINY,
                'after' => 'admin_id',
            ])
            ->addColumn('cat_show', 'integer', [
                'null' => true,
                'default' => '0',
                'limit' => '1',
                'after' => 'cat_show_mob',
            ])
            ->addColumn('cat_create_time', 'integer', [
                'null' => true,
                'default' => '0',
                'limit' => MysqlAdapter::INT_REGULAR,
                'after' => 'cat_show',
            ])
            ->addColumn('cat_update_at', 'integer', [
                'null' => true,
                'default' => '0',
                'limit' => MysqlAdapter::INT_REGULAR,
                'after' => 'cat_create_time',
            ])
            ->addIndex(['cat_parent_id'], [
                'name' => 'cat_parent_id',
                'unique' => false,
            ])
            ->addIndex(['cat_order'], [
                'name' => 'cat_order',
                'unique' => false,
            ])
            ->create();
        $this->table('classes', [
                'id' => false,
                'primary_key' => ['cls_id'],
                'engine' => 'InnoDB',
                'encoding' => 'utf8',
                'collation' => 'utf8_general_ci',
                'comment' => '',
                'row_format' => 'COMPACT',
            ])
            ->addColumn('cls_id', 'integer', [
                'null' => false,
                'limit' => MysqlAdapter::INT_REGULAR,
                'identity' => 'enable',
            ])
            ->addColumn('cls_code', 'string', [
                'null' => true,
                'default' => null,
                'limit' => 50,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'cls_id',
            ])
            ->addColumn('cls_name', 'string', [
                'null' => true,
                'default' => null,
                'limit' => 255,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'cls_code',
            ])
            ->addColumn('cls_faculty_id', 'integer', [
                'null' => false,
                'limit' => MysqlAdapter::INT_REGULAR,
                'after' => 'cls_name',
            ])
            ->addColumn('cls_school_id', 'integer', [
                'null' => false,
                'limit' => MysqlAdapter::INT_REGULAR,
                'after' => 'cls_faculty_id',
            ])
            ->addColumn('cls_active', 'boolean', [
                'null' => true,
                'default' => '0',
                'limit' => MysqlAdapter::INT_TINY,
                'after' => 'cls_school_id',
            ])
            ->addColumn('cls_create_time', 'integer', [
                'null' => true,
                'default' => null,
                'limit' => MysqlAdapter::INT_REGULAR,
                'after' => 'cls_active',
            ])
            ->addColumn('cls_update_time', 'integer', [
                'null' => true,
                'default' => null,
                'limit' => MysqlAdapter::INT_REGULAR,
                'after' => 'cls_create_time',
            ])
            ->addColumn('admin_id', 'integer', [
                'null' => true,
                'default' => null,
                'limit' => MysqlAdapter::INT_REGULAR,
                'after' => 'cls_update_time',
            ])
            ->addIndex(['cls_faculty_id'], [
                'name' => 'cls_faculty_id',
                'unique' => false,
            ])
            ->addIndex(['cls_school_id'], [
                'name' => 'cls_school_id',
                'unique' => false,
            ])
            ->addIndex(['cls_active'], [
                'name' => 'cls_active',
                'unique' => false,
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
            ->addColumn('con_id', 'integer', [
                'null' => false,
                'limit' => MysqlAdapter::INT_REGULAR,
                'identity' => 'enable',
            ])
            ->addColumn('con_page_size', 'string', [
                'null' => true,
                'default' => null,
                'limit' => 10,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'con_id',
            ])
            ->addColumn('con_left_size', 'string', [
                'null' => true,
                'default' => null,
                'limit' => 10,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'con_page_size',
            ])
            ->addColumn('con_right_size', 'string', [
                'null' => true,
                'default' => null,
                'limit' => 10,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'con_left_size',
            ])
            ->addColumn('con_admin_email', 'string', [
                'null' => true,
                'default' => null,
                'limit' => 255,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'con_right_size',
            ])
            ->addColumn('con_site_title', 'string', [
                'null' => true,
                'default' => null,
                'limit' => 255,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'con_admin_email',
            ])
            ->addColumn('con_meta_description', 'text', [
                'null' => true,
                'default' => null,
                'limit' => 65535,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'con_site_title',
            ])
            ->addColumn('con_meta_keywords', 'text', [
                'null' => true,
                'default' => null,
                'limit' => 65535,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'con_meta_description',
            ])
            ->addColumn('con_currency', 'string', [
                'null' => true,
                'default' => null,
                'limit' => 20,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'con_meta_keywords',
            ])
            ->addColumn('con_mod_rewrite', 'boolean', [
                'null' => true,
                'default' => '0',
                'limit' => MysqlAdapter::INT_TINY,
                'after' => 'con_currency',
            ])
            ->addColumn('con_lang_id', 'integer', [
                'null' => true,
                'default' => '1',
                'limit' => MysqlAdapter::INT_REGULAR,
                'after' => 'con_mod_rewrite',
            ])
            ->addColumn('con_extenstion', 'string', [
                'null' => true,
                'default' => '\'\'\'html\'\'\'',
                'limit' => 20,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'con_lang_id',
            ])
            ->addColumn('lang_id', 'integer', [
                'null' => true,
                'default' => '1',
                'limit' => MysqlAdapter::INT_REGULAR,
                'after' => 'con_extenstion',
            ])
            ->addColumn('con_contact', 'integer', [
                'null' => true,
                'default' => '0',
                'limit' => MysqlAdapter::INT_REGULAR,
                'after' => 'lang_id',
            ])
            ->addColumn('con_hotline', 'string', [
                'null' => true,
                'default' => null,
                'limit' => 255,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'con_contact',
            ])
            ->addColumn('con_hotline_banhang', 'string', [
                'null' => true,
                'default' => null,
                'limit' => 255,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'con_hotline',
            ])
            ->addColumn('con_hotline_hotro_kythuat', 'string', [
                'null' => true,
                'default' => null,
                'limit' => 255,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'con_hotline_banhang',
            ])
            ->addColumn('con_background_img', 'string', [
                'null' => true,
                'default' => null,
                'limit' => 255,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'con_hotline_hotro_kythuat',
            ])
            ->addColumn('con_background_color', 'string', [
                'null' => true,
                'default' => null,
                'limit' => 50,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'con_background_img',
            ])
            ->addColumn('con_address', 'text', [
                'null' => true,
                'default' => null,
                'limit' => 65535,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'con_background_color',
            ])
            ->addColumn('con_image_path', 'string', [
                'null' => true,
                'default' => null,
                'limit' => 255,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'con_address',
            ])
            ->addColumn('con_picture_path', 'string', [
                'null' => true,
                'default' => null,
                'limit' => 255,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'con_image_path',
            ])
            ->addColumn('con_background_homepage', 'string', [
                'null' => true,
                'default' => null,
                'limit' => 255,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'con_picture_path',
            ])
            ->addColumn('con_theme_path', 'string', [
                'null' => true,
                'default' => null,
                'limit' => 255,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'con_background_homepage',
            ])
            ->addColumn('con_info_payment', 'text', [
                'null' => true,
                'default' => null,
                'limit' => 65535,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'con_theme_path',
            ])
            ->addColumn('con_fee_transport', 'text', [
                'null' => true,
                'default' => null,
                'limit' => 65535,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'con_info_payment',
            ])
            ->addColumn('con_buy_shop', 'text', [
                'null' => true,
                'default' => null,
                'limit' => 65535,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'con_fee_transport',
            ])
            ->addColumn('con_contact_sale', 'text', [
                'null' => true,
                'default' => null,
                'limit' => 65535,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'con_buy_shop',
            ])
            ->addColumn('con_info_company', 'text', [
                'null' => true,
                'default' => null,
                'limit' => 65535,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'con_contact_sale',
            ])
            ->addColumn('con_logo_top', 'string', [
                'null' => true,
                'default' => null,
                'limit' => 255,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'con_info_company',
            ])
            ->addColumn('con_logo_bottom', 'string', [
                'null' => true,
                'default' => null,
                'limit' => 255,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'con_logo_top',
            ])
            ->addColumn('con_page_fb', 'text', [
                'null' => true,
                'default' => null,
                'limit' => 65535,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'con_logo_bottom',
            ])
            ->addColumn('con_link_fb', 'string', [
                'null' => true,
                'default' => null,
                'limit' => 255,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'con_page_fb',
            ])
            ->addColumn('con_link_twiter', 'string', [
                'null' => true,
                'default' => null,
                'limit' => 255,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'con_link_fb',
            ])
            ->addColumn('con_link_insta', 'string', [
                'null' => true,
                'default' => null,
                'limit' => 255,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'con_link_twiter',
            ])
            ->addColumn('con_map', 'text', [
                'null' => true,
                'default' => null,
                'limit' => 65535,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'con_link_insta',
            ])
            ->addColumn('con_footer', 'text', [
                'null' => true,
                'default' => null,
                'limit' => 65535,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'con_map',
            ])
            ->addColumn('con_content_ship', 'text', [
                'null' => true,
                'default' => null,
                'limit' => 65535,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'con_footer',
            ])
            ->create();
        $this->table('faculties', [
                'id' => false,
                'primary_key' => ['fac_id'],
                'engine' => 'InnoDB',
                'encoding' => 'utf8',
                'collation' => 'utf8_general_ci',
                'comment' => '',
                'row_format' => 'COMPACT',
            ])
            ->addColumn('fac_id', 'integer', [
                'null' => false,
                'limit' => MysqlAdapter::INT_REGULAR,
                'identity' => 'enable',
            ])
            ->addColumn('fac_school_id', 'integer', [
                'null' => false,
                'limit' => MysqlAdapter::INT_REGULAR,
                'after' => 'fac_id',
            ])
            ->addColumn('fac_name', 'string', [
                'null' => true,
                'default' => null,
                'limit' => 255,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'fac_school_id',
            ])
            ->addColumn('fac_active', 'integer', [
                'null' => true,
                'default' => '0',
                'limit' => MysqlAdapter::INT_TINY,
                'after' => 'fac_name',
            ])
            ->addColumn('fac_create_time', 'integer', [
                'null' => true,
                'default' => null,
                'limit' => MysqlAdapter::INT_REGULAR,
                'after' => 'fac_active',
            ])
            ->addColumn('fac_update_time', 'integer', [
                'null' => true,
                'default' => null,
                'limit' => MysqlAdapter::INT_REGULAR,
                'after' => 'fac_create_time',
            ])
            ->addColumn('admin_id', 'integer', [
                'null' => true,
                'default' => null,
                'limit' => MysqlAdapter::INT_REGULAR,
                'after' => 'fac_update_time',
            ])
            ->addIndex(['fac_school_id'], [
                'name' => 'fac_school_id',
                'unique' => false,
            ])
            ->addIndex(['fac_active'], [
                'name' => 'fac_active',
                'unique' => false,
            ])
            ->create();
        $this->table('modules', [
                'id' => false,
                'primary_key' => ['mod_id'],
                'engine' => 'MyISAM',
                'encoding' => 'utf8',
                'collation' => 'utf8_general_ci',
                'comment' => '',
                'row_format' => 'DYNAMIC',
            ])
            ->addColumn('mod_id', 'integer', [
                'null' => false,
                'limit' => MysqlAdapter::INT_REGULAR,
                'identity' => 'enable',
            ])
            ->addColumn('mod_name', 'string', [
                'null' => true,
                'default' => null,
                'limit' => 100,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'mod_id',
            ])
            ->addColumn('mod_path', 'string', [
                'null' => true,
                'default' => null,
                'limit' => 255,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'mod_name',
            ])
            ->addColumn('mod_listname', 'string', [
                'null' => true,
                'default' => null,
                'limit' => 100,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'mod_path',
            ])
            ->addColumn('mod_listfile', 'string', [
                'null' => true,
                'default' => null,
                'limit' => 100,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'mod_listname',
            ])
            ->addColumn('mod_order', 'integer', [
                'null' => true,
                'default' => '0',
                'limit' => MysqlAdapter::INT_REGULAR,
                'after' => 'mod_listfile',
            ])
            ->addColumn('mod_help', 'text', [
                'null' => true,
                'default' => null,
                'limit' => MysqlAdapter::TEXT_MEDIUM,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'mod_order',
            ])
            ->create();
        $this->table('schools', [
                'id' => false,
                'primary_key' => ['sch_id'],
                'engine' => 'InnoDB',
                'encoding' => 'utf8',
                'collation' => 'utf8_general_ci',
                'comment' => '',
                'row_format' => 'COMPACT',
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
                'null' => true,
                'default' => null,
                'limit' => MysqlAdapter::INT_REGULAR,
                'after' => 'sch_update_time',
            ])
            ->create();
        $this->table('user_translate', [
                'id' => false,
                'primary_key' => ['ust_keyword'],
                'engine' => 'MyISAM',
                'encoding' => 'utf8',
                'collation' => 'utf8_general_ci',
                'comment' => '',
                'row_format' => 'DYNAMIC',
            ])
            ->addColumn('ust_keyword', 'string', [
                'null' => false,
                'limit' => 255,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
            ])
            ->addColumn('ust_text', 'string', [
                'null' => true,
                'default' => null,
                'limit' => 255,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'ust_keyword',
            ])
            ->addColumn('lang_id', 'integer', [
                'null' => false,
                'default' => '1',
                'limit' => MysqlAdapter::INT_REGULAR,
                'after' => 'ust_text',
            ])
            ->addColumn('ust_source', 'string', [
                'null' => true,
                'default' => null,
                'limit' => 255,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'lang_id',
            ])
            ->addColumn('ust_date', 'integer', [
                'null' => false,
                'default' => '0',
                'limit' => MysqlAdapter::INT_REGULAR,
                'after' => 'ust_source',
            ])
            ->create();
        $this->table('users', [
                'id' => false,
                'primary_key' => ['use_id'],
                'engine' => 'MyISAM',
                'encoding' => 'utf8',
                'collation' => 'utf8_general_ci',
                'comment' => '',
                'row_format' => 'DYNAMIC',
            ])
            ->addColumn('use_id', 'integer', [
                'null' => false,
                'limit' => MysqlAdapter::INT_REGULAR,
                'identity' => 'enable',
            ])
            ->addColumn('use_class_id', 'integer', [
                'null' => true,
                'default' => '-1',
                'limit' => MysqlAdapter::INT_REGULAR,
                'after' => 'use_id',
            ])
            ->addColumn('use_faculty_id', 'integer', [
                'null' => true,
                'default' => '0',
                'limit' => MysqlAdapter::INT_REGULAR,
                'after' => 'use_class_id',
            ])
            ->addColumn('use_school_id', 'integer', [
                'null' => true,
                'default' => '0',
                'limit' => MysqlAdapter::INT_REGULAR,
                'after' => 'use_faculty_id',
            ])
            ->addColumn('use_password', 'string', [
                'null' => false,
                'limit' => 35,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'use_school_id',
            ])
            ->addColumn('use_salt', 'string', [
                'null' => false,
                'limit' => 35,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'use_password',
            ])
            ->addColumn('use_birthdays', 'integer', [
                'null' => true,
                'default' => '0',
                'limit' => MysqlAdapter::INT_REGULAR,
                'signed' => false,
                'after' => 'use_salt',
            ])
            ->addColumn('use_gender', 'boolean', [
                'null' => true,
                'default' => '0',
                'limit' => MysqlAdapter::INT_TINY,
                'after' => 'use_birthdays',
            ])
            ->addColumn('use_code', 'string', [
                'null' => false,
                'limit' => 50,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'use_gender',
            ])
            ->addColumn('use_code_md5', 'string', [
                'null' => false,
                'limit' => 32,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'use_code',
            ])
            ->addColumn('use_idnumber', 'string', [
                'null' => false,
                'limit' => 50,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'use_code_md5',
            ])
            ->addColumn('use_idnumber_md5', 'string', [
                'null' => false,
                'limit' => 32,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'use_idnumber',
            ])
            ->addColumn('use_name', 'string', [
                'null' => true,
                'default' => null,
                'limit' => 255,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'use_idnumber_md5',
            ])
            ->addColumn('use_type', 'boolean', [
                'null' => true,
                'default' => '1',
                'limit' => MysqlAdapter::INT_TINY,
                'after' => 'use_name',
            ])
            ->addColumn('use_created_time', 'integer', [
                'null' => true,
                'default' => '0',
                'limit' => MysqlAdapter::INT_REGULAR,
                'after' => 'use_type',
            ])
            ->addColumn('use_updated_time', 'integer', [
                'null' => true,
                'default' => '0',
                'limit' => MysqlAdapter::INT_REGULAR,
                'after' => 'use_created_time',
            ])
            ->addColumn('admin_id', 'integer', [
                'null' => true,
                'default' => '0',
                'limit' => MysqlAdapter::INT_REGULAR,
                'after' => 'use_updated_time',
            ])
            ->addColumn('use_active', 'boolean', [
                'null' => true,
                'default' => '0',
                'limit' => MysqlAdapter::INT_TINY,
                'after' => 'admin_id',
            ])
            ->addIndex(['use_code_md5'], [
                'name' => 'use_code_md5',
                'unique' => true,
            ])
            ->addIndex(['use_idnumber_md5'], [
                'name' => 'use_idnumber_md5',
                'unique' => true,
            ])
            ->addIndex(['use_class_id'], [
                'name' => 'use_class_id',
                'unique' => false,
            ])
            ->addIndex(['use_faculty_id'], [
                'name' => 'use_faculty_id',
                'unique' => false,
            ])
            ->addIndex(['use_school_id'], [
                'name' => 'use_school_id',
                'unique' => false,
            ])
            ->addIndex(['use_gender'], [
                'name' => 'use_gender',
                'unique' => false,
            ])
            ->addIndex(['use_type'], [
                'name' => 'use_type',
                'unique' => false,
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
            ->addColumn('lang_id', 'integer', [
                'null' => false,
                'default' => '0',
                'limit' => MysqlAdapter::INT_REGULAR,
            ])
            ->addColumn('lang_name', 'string', [
                'null' => true,
                'default' => null,
                'limit' => 50,
                'collation' => 'utf8_unicode_ci',
                'encoding' => 'utf8',
                'after' => 'lang_id',
            ])
            ->addColumn('lang_path', 'string', [
                'null' => true,
                'default' => '\'\'\'home\'\'\'',
                'limit' => 15,
                'collation' => 'utf8_unicode_ci',
                'encoding' => 'utf8',
                'after' => 'lang_name',
            ])
            ->addColumn('lang_image', 'string', [
                'null' => true,
                'default' => null,
                'limit' => 255,
                'collation' => 'utf8_unicode_ci',
                'encoding' => 'utf8',
                'after' => 'lang_path',
            ])
            ->addColumn('lang_domain', 'string', [
                'null' => true,
                'default' => null,
                'limit' => 255,
                'collation' => 'utf8_unicode_ci',
                'encoding' => 'utf8',
                'after' => 'lang_image',
            ])
            ->create();
        $this->table('languages_copy1', [
                'id' => false,
                'primary_key' => ['lang_id'],
                'engine' => 'MyISAM',
                'encoding' => 'utf8',
                'collation' => 'utf8_unicode_ci',
                'comment' => '',
                'row_format' => 'DYNAMIC',
            ])
            ->addColumn('lang_id', 'integer', [
                'null' => false,
                'default' => '0',
                'limit' => MysqlAdapter::INT_REGULAR,
            ])
            ->addColumn('lang_name', 'string', [
                'null' => true,
                'default' => null,
                'limit' => 50,
                'collation' => 'utf8_unicode_ci',
                'encoding' => 'utf8',
                'after' => 'lang_id',
            ])
            ->addColumn('lang_path', 'string', [
                'null' => true,
                'default' => '\'\'\'home\'\'\'',
                'limit' => 15,
                'collation' => 'utf8_unicode_ci',
                'encoding' => 'utf8',
                'after' => 'lang_name',
            ])
            ->addColumn('lang_image', 'string', [
                'null' => true,
                'default' => null,
                'limit' => 255,
                'collation' => 'utf8_unicode_ci',
                'encoding' => 'utf8',
                'after' => 'lang_path',
            ])
            ->addColumn('lang_domain', 'string', [
                'null' => true,
                'default' => null,
                'limit' => 255,
                'collation' => 'utf8_unicode_ci',
                'encoding' => 'utf8',
                'after' => 'lang_image',
            ])
            ->create();
        $this->table('questions', [
                'id' => false,
                'primary_key' => ['que_id'],
                'engine' => 'InnoDB',
                'encoding' => 'utf8',
                'collation' => 'utf8_vietnamese_ci',
                'comment' => '',
                'row_format' => 'COMPACT',
            ])
            ->addColumn('que_id', 'integer', [
                'null' => false,
                'limit' => MysqlAdapter::INT_REGULAR,
                'identity' => 'enable',
            ])
            ->addColumn('que_stt', 'integer', [
                'null' => true,
                'default' => '1',
                'limit' => '2',
                'after' => 'que_id',
            ])
            ->addColumn('que_content', 'text', [
                'null' => true,
                'default' => null,
                'limit' => 65535,
                'collation' => 'utf8_general_ci',
                'encoding' => 'utf8',
                'after' => 'que_stt',
            ])
            ->addColumn('que_required', 'boolean', [
                'null' => true,
                'default' => '1',
                'limit' => MysqlAdapter::INT_TINY,
                'after' => 'que_content',
            ])
            ->addColumn('que_img_example', 'string', [
                'null' => true,
                'default' => null,
                'limit' => 255,
                'collation' => 'utf8_vietnamese_ci',
                'encoding' => 'utf8',
                'after' => 'que_required',
            ])
            ->addColumn('que_active', 'boolean', [
                'null' => true,
                'default' => '1',
                'limit' => MysqlAdapter::INT_TINY,
                'after' => 'que_img_example',
            ])
            ->addColumn('que_created_at', 'integer', [
                'null' => true,
                'default' => null,
                'limit' => MysqlAdapter::INT_REGULAR,
                'after' => 'que_active',
            ])
            ->addColumn('que_updated_at', 'integer', [
                'null' => true,
                'default' => null,
                'limit' => MysqlAdapter::INT_REGULAR,
                'after' => 'que_created_at',
            ])
            ->create();
    }
}
