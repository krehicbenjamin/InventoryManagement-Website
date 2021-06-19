<?php

require_once dirname(__FILE__)."/../dao/BaseDao.class.php";
require_once dirname(__FILE__)."/../dao/EmployeeDao.class.php";
require_once dirname(__FILE__)."/BaseService.class.php";

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


    public function getAllEmployees(){
      return $this->dao->getAllEmployees();
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

    public function register($employee)
      {

          try
          {

          $u = parent::add([
            'name' => $employee['name'],
            'surname' => $employee['surname'],
            'email' => $employee['email'],
            'password' => md5($employee['password']),
            'role' => 'EMPLOYEE',
            'phone' => $employee['phone'],
            'registered_at' => date(Config::DATE_FORMAT)
          ]);
        } catch(\Exception $e) {

            throw $e;

      }

          return $u;
      }

      public function confirm($token)
      {
          $employee = $this->dao->getEmployeeByToken($token);

          if(!isset($employee['id'])){
            throw new \Exception("Invalid token");
          }

          $this->dao->update($employee['id'], ['status' => "ACTIVE", 'token' => null, 'token_created_at' => date(Config::DATE_FORMAT)]);
          return $employee;
      }

      public function login($employee)
      {
          $db_employee = $this->dao->getEmployeeByEmail($employee['email']);

          if (!isset($db_employee['id'])) throw new Exception("Employee doesn't exist", 400);
          if ($db_employee['password'] != md5($employee['password'])) throw new Exception("Invalid password", 400);

          return $db_employee;
      }

      public function forgot($employee)
      {
          $employeeDB = $this->dao->getEmployeeByEmail($data['email']);
          if(!isset($employeeDB['id']))
          {
              throw new \Exception("There's no account with that email", 400);
          }

          if((strtotime(date(Config::DATE_FORMAT)) - strtotime($employeeDB['token_created_at'])) / 60 < 5)
          {
              throw new \Exception("Maybe you should write your password down somewhere safe. Try reseting in a few minutes.", 400);
          }
          $employeeDB = $this->update($employeeDB['id'], ['token' => md5(random_bytes(16)), 'token_created_at' => date(Config::DATE_FORMAT)]);

          $message = "Hi ".$employeeDB['employeename'].", It seems like you've forgotten your password. If you haven't made this request, ignore this email. Here's your recovery token: ".$employeeDB['token'];

          $mail = new Mailer();
          $mail->mailer($employeeDB['email'], $message, "Reset password");

    }
      public function reset($employee)
      {
        $employeeDB = $this->dao->getEmployeeByToken($employee['token']);
        if(!isset($employeeDB['id']))
        {
            throw new \Exception("Invalid token", 400);
        }

        if((strtotime(date(Config::DATE_FORMAT)) - strtotime($employeeDB['token_created_at'])) / 60 > 30)
        {
            throw new \Exception("Token expired", 400);

        }

        $this->update($employeeDB['id'], ['password' => md5($employee['password']), 'token' => null]);
        return $employeeDB;
    }
}
