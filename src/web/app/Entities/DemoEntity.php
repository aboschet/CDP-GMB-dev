<?php
namespace app\Entities;

use system\Entity\Entity;

class DemoEntity extends Entity{

    public function getUrl(){
        return 'index.php?p=posts.category&id=' . $this->id;
    }

}