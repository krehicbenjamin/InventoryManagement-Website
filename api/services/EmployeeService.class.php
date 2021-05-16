<?php

require_once dirname(__FILE__)."/../dao/BaseDao.class.php";
require_once dirname(__FILE__)."/../dao/EmployeeDao.class.php";

class EmployeeService extends BaseService
{
    public function __construct()
    {
        $this->dao=new EmployeeDao();
    }

    public function getEmployees($search, $offset, $limit)
    {
        if($search)
        {
            return $this->dao->searchEmployeesByName($search, $offset, $limit);
        }else
        {
            return $this->dao->getAllEmployeesPaginated($offset, $limit);
        }
    }

    public function add($employee)
    {
        if(!isset($employee['name'])) throw new \Exception("Name is missing", 1);
        return parent::add($employee);
    }

    public function update($id, $employee)
    {
        return parent::update($id, $employee);
    }

    public function getById($id)
    {
        return parent::getById($id);
    }

    public function login($customer){
        $db_user = $this->dao->getEmployeesByEmail($customer['email']);
        if (!isset($db_user['id'])) throw new Exception("User doesn't exists", 400);
        if ($db_user['password'] != md5($user['password'])) throw new Exception("Invalid password", 400);
        return $db_user;
      }
    
    public function register($user){
        try {
          $user = parent::add([
            "name" => $user['name'],
            "surname" => $user['surname'],
            "email" => $user['email'],
            "password" => md5($user['password']),
            "role" => $user['role'],
            "registered_at" => date(Config::DATE_FORMAT)
          ]);
        } catch (\Exception $e) {
            throw $e;
        }
        return $user;
    }
}
