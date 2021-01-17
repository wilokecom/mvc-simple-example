<?php
    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    echo 'Return This Variable';

    echo '<hr />';

require_once 'src/Core/Boostrap.php';
//    class MyClass
//    {
//        private $firstName;
//        private $lastName;
//
//        public function setFirstName($firstName)
//        {
//            $this->firstName = $firstName;
//
//            return $this;
//        }
//
//        public function setLastName($lastName)
//        {
//            $this->lastName = $lastName;
//
//            return $this;
//        }
//
//        public function getFullName()
//        {
//            return sprintf('My fullname is %s %s', $this->firstName, $this->lastName);
//        }
//    }
//
//    $oMyClass = new MyClass();
//    echo $oMyClass->setFirstName("Wiloke")
//        ->setLastName("WordPress")
//        ->getFullName();
