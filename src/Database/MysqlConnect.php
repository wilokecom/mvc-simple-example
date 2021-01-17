<?php


    namespace Basic\Database;


    use Basic\Core\App;

    class MysqlConnect
    {
        public function connect() {
            $oDb = new \mysqli(
                App::get("configs/database")["mysql"]["host"],
                App::get("configs/database")["mysql"]["user"],
                App::get("configs/database")["mysql"]["password"],
                App::get("configs/database")["mysql"]["db"]
            );

            return $oDb;
        }
    }
