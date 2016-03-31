<?php
namespace Model;

class PageRepository
{
    /**
     * @var \PDO
     */
    private $pdo;

    public function __construct(\PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function get()
    {
        $sql = "SELECT `id`, `slug`, `h1`, `body`, `title`, `img`, `span_text`, `span_class` FROM `page` WHERE 1";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        $data = [];
        while($row = $stmt->fetchObject()){
            $data[] = $row;
        }
        return $data;
    }
}