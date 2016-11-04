<?php
namespace app\Entities;

use system\Entity\Entity;

class UserEntity extends Entity{

    public function getUrl(){
        return 'index.php?p=posts.category&id=' . $this->id;
    }

}
