<?php

require_once dirname(__FILE__)."/BaseDao.class.php";

class EmployeeDao extends BaseDao
{
    public function __construct()
    {
        parent::__construct("employees");
    }

    public function getEmployeesById($id)
    {
        return $this->queryUnique("SELECT * FROM employees WHERE id = :id", ["id" => $id]);
    }

    public function insertEmployee($employee)
    {
        $this->insert("employees", $employee);
    }

    public function getAllEmployees()
    {
        return $this->getAll("employees");
    }

    public function searchEmployeesByName($search, $offset = 0, $limit = 30)
    {
        return $this->query("SELECT * FROM employees
                             WHERE name LIKE CONCAT('%', :name, '%') LIMIT ${limit} OFFSET ${offset}",
                             ["name" => $search]);
    }

    public function getAllEmployeesPaginated($offset = 0, $limit = 30)
    {
      return $this->getAllPaginated("employees", $offset, $limit);
    }
    
    public function getEmployeesByEmail($email)
    {
      return $this->queryUnique("SELECT * FROM employees WHERE email = :email", ["email" => $email]);
    }

}
