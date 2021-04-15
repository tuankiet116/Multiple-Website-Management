<?php


use Phinx\Seed\AbstractSeed;

class AdminUser extends AbstractSeed
{
    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeders is available here:
     * https://book.cakephp.org/phinx/0/en/seeding.html
     */
    public function run()
    {
        $this->execute("INSERT INTO `admin_user` VALUES (1, 'admin', 'e10adc3949ba59abbe56e057f20f883e', 'diepcd', 'diepcd@gmail.com', 'Vĩnh Hưng - Hoàng Mai - Hà Nội', '(84)987898870', '095 330 8125', 0, 0, NULL, NULL, 0, 1, 1, 1, 0, NULL, 0, 0);");
    }
}
