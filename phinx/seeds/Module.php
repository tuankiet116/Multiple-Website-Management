<?php


use Phinx\Seed\AbstractSeed;

class Module extends AbstractSeed
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
        $this->execute("INSERT INTO `modules` VALUES (1, 'Quản lý TK Admin', 'admin_user', 'Add|Listing', 'add.php|listing.php', 0, NULL);");
        $this->execute("INSERT INTO `modules` VALUES (3, 'Quản lý Sinh viên', 'student', 'Thêm mới | Danh sách', 'add.php|listing.php', 0, NULL);");
        $this->execute("INSERT INTO `modules` VALUES (4, 'Quản lý Câu hỏi', 'questions', 'Thêm mới | Danh sách', 'add.php|listing.php', 0, NULL);");
        $this->execute("INSERT INTO `modules` VALUES (5, 'Quản lý Câu lớp', 'class_manager', 'Thêm mới | Danh sách', 'add.php|listing.php', 0, NULL);");
        $this->execute("INSERT INTO `modules` VALUES (6, 'Quản lý Câu trường', 'schools_manager', 'Thêm mới | Danh sách', 'add.php|listing.php', 0, NULL);");
        $this->execute("INSERT INTO `modules` VALUES (7, 'Quản lý Câu khoa', 'scientific_manager', 'Thêm mới | Danh sách', 'add.php|listing.php', 0, NULL);");
    }
}
