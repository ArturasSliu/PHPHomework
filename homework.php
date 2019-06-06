<?php
  class Company{
    var $id;
    var $name;
    var $registration_code;
    var $email;
    var $phone;
    var $comment;

    function __construct($id, $name, $registration_code, $email, $phone, $comment){
      $this->id = $id;
      $this->name = $name;
      $this->registration_code = $registration_code;
      $this->email = $email;
      $this->phone = $phone;
      $this->comment = $comment;
    }

    function editCompany($id, $name, $registration_code, $email, $phone, $comment){        //Function for editing data in existing company
      if(!filter_var($email, FILTER_VALIDATE_EMAIL) || !preg_match("/^[0-9]{9}$/", $phone)){
        echo "Invalid format, please re-enter valid parameters";
        return;
      }
      $this->id = $id;
      $this->name = $name;
      $this->registration_code = $registration_code;
      $this->email = $email;
      $this->phone = $phone;
      $this->comment = $comment;
    }

    function deleteCompany(){                                                               //Function for deleting existing company
      unset($this->id);
      unset($this->name);
      unset($this->registration_code);
      unset($this->email);
      unset($this->phone);
      unset($this->comment);
    }
  }

  function addCompanycsv(){                                                                 //Function for adding new company from .csv file
    $temp = array();
    $row = 1;
    if (($handle = fopen("company.csv", "r")) !== FALSE){
      while (($data = fgetcsv($handle, 1000, ",")) !== FALSE){
        $num = count($data);
        $row++;
        for($c=0; $c < $num; $c++){
          $temp[$c] = $data[$c];
        }
      }
      return addcompany($temp[0], $temp[1], $temp[2], $temp[3], $temp[4], $temp[5]);
      fclose($handle);
    }
  }

  function addCompany($id, $name, $registration_code, $email, $phone, $comment){            //Function for adding new company
    if(!filter_var($email, FILTER_VALIDATE_EMAIL) ||!preg_match("/^[0-9]{9}$/", $phone) ){
      echo "Invalid format, please re-enter valid parameters";
      return;
    }
    return new company($id, $name, $registration_code, $email, $phone, $comment);
  }

 ?>
