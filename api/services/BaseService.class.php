<?php

include_once dirname(__FILE__)."/../dao/BaseDao.class.php";
class BaseService {

    protected $dao;

    public function getById($id){
        return $this->dao->getById($id);
    }

    public function add($data){
        return $this->dao->add($data);
    }

    public function update($id, $data){
        $this->dao->update($id, $data);
        return $this->dao->getById($id);
    }
}
 ?>
