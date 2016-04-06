<?php
namespace Model;

/**
 * Class PageRepository
 * @author Yann Le Scouarnec <yann.le-scouarnec@hetic.net>
 * @package Model
 */
class PageRepository extends Repository
{
    /**
     * @return array
     */
    public function get()
    {
        $sql = "SELECT
    `id`, 
    `slug`, 
    `h1`, 
    `body`, 
    `title`, 
    `img`, 
    `span_text`, 
    `span_class` 
FROM 
  `page` 
WHERE 
  1
";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        $data = [];
        while($row = $stmt->fetchObject()){
            $data[] = $row;
        }
        
        return $data;
    }
}