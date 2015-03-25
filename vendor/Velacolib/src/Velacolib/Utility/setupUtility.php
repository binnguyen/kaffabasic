<?php
/**
 * Created by PhpStorm.
 * User: tristria
 * Date: 12/10/2014
 * Time: 4:01 PM
 */
namespace Velacolib\Utility;
use Doctrine\ORM\Query\ResultSetMapping;
use Zend\Validator\File\Sha1;

define('CONFIG_FILE_PATH', 'config/autoload/doctrine.local.php');
define('CONFIG_FILE_FOLDER','config/autoload/');
define('CONFIG_EXPORT_FOLDER','public/export/');
define('DATA_TABLE_FILE_PATH', 'public/dump/file/');
define('DATA_TABLE_CONTENT_PATH', 'public/dump/data/');
define('PUBLIC_FOLDER', 'public/');



class setupUtility extends Utility{

    public static function checkWriteable(){

        return array(
            CONFIG_FILE_FOLDER => self::checkWriteExcute(CONFIG_FILE_FOLDER),
            CONFIG_EXPORT_FOLDER => self::checkWriteExcute(CONFIG_EXPORT_FOLDER),
            PUBLIC_FOLDER => self::checkWriteExcute(PUBLIC_FOLDER)
        );
    }

    public static function checkWriteExcute($path){


        if(is_executable($path) &&  is_writable($path))
            return true;
        return false;
    }

    public static function checkConfigFile(){
        $filename = CONFIG_FILE_PATH;
        $isExistConfigFile = file_exists ($filename);
        return $isExistConfigFile;
    }
    public static function checkDataBase(){
        $dbInfo = self::getDbInfo();
        mysql_select_db($dbInfo['dbName'],$dbInfo['link']);
        //get all of the tables
        $tables = array();
        $result = mysql_query('SHOW TABLES');
        while($row = mysql_fetch_row($result))
        {
            $tables[] = $row[0];
        }
        if(count($tables) == 0)
            return false;
        return true;
    }
    public static function checkInstall(){
        if(!self::checkConfigFile())
            return true;
        if(!self::checkDataBase())
            return true;
        if(!self::checkConfigFile() && !self::checkDataBase())
            return true;
        return false;
    }
    public static function getDbInfo(){
        $conn = self::getSM();
        $conn = $conn->get('doctrine.connection.orm_default');
        $conn = $conn->getParams();
        $host = $conn['host'];
        $user =  $conn['user'];
        $pass = $conn['password'];
        $name = $conn['dbname'];
        $tables = "*";
        $return = '';

        $link = mysql_connect($host,$user,$pass);
        if($link){
        //create database
//        $createDBString = 'CREATE DATABASE  '.$name.'';
//        mysql_query($createDBString);
        //end create database

            return array('dbName'=>$name,'link'=>$link);
        }
        return null;
    }

    public static function createConfigFile($fileInfo = array()){
            @unlink(CONFIG_FILE_PATH);
            $myfile = fopen(CONFIG_FILE_PATH, "w") or die("Unable to open file!");
            $host = isset($fileInfo['host'])?$fileInfo['host']:'localhost';
            $port = isset($fileInfo['port'])?$fileInfo['port']:'3306';
            $userName = isset($fileInfo['username'])?$fileInfo['username']:'root';
            $password = isset($fileInfo['password'])?$fileInfo['password']:'123';
            $dbname = isset($fileInfo['dbname'])?$fileInfo['dbname']:'cafebasic';

            $fileContent = "
            <?php
                return array(
                    'doctrine' => array(
                        'connection' => array(
                            'orm_default' => array(
                                'driverClass' =>'Doctrine\\DBAL\\Driver\\PDOMySql\\Driver',
                                'params' => array(
                                    'host'     => '".$host."',
                                    'port'     => '".$port."',
                                    'user'     => '".$userName."',
                                    'password' => '".$password."',
                                    'dbname'   => '".$dbname."',
                                )))));
                        ";
            fwrite($myfile, $fileContent);
            fclose($myfile);
            return true;
    }
    public static function createDatabase($userInfo){

        $dbInfo = self::getDbInfo();
        if($dbInfo == null)
            return null;
        mysql_select_db($dbInfo['dbName'],$dbInfo['link']);
        $sqlTables = self::dumpTable(DATA_TABLE_FILE_PATH);

        //get all of the tables
        $tables = array();
        $result = mysql_query('SHOW TABLES');
        while($row = mysql_fetch_row($result))
        {
            $tables[] = $row[0];
        }
        if(count($tables) == 0){
            foreach($sqlTables as $table){
                $content = file_get_contents(DATA_TABLE_FILE_PATH.$table);
                mysql_query($content) or die(mysql_error());
            }
            $dataConfigContent = file_get_contents(DATA_TABLE_CONTENT_PATH.'insert-config.txt');
            mysql_query($dataConfigContent) or die(mysql_error());
            $insertUser = 'INSERT INTO `user`(user_name, password, full_name, type ,isdelete) VALUES  ("'.$userInfo['adminName'].'","'.Sha1($userInfo['adminPassword1']).'","'.$userInfo['adminName'].'",1,0)';
            mysql_query($insertUser) or die(mysql_error());
        }
    }
    public static function insertSampleData(){
        $dbInfo = self::getDbInfo();
        mysql_select_db($dbInfo['dbName'],$dbInfo['link']);
        $fileNames = self::dumpTable(DATA_TABLE_CONTENT_PATH);
        foreach($fileNames as $fileName){
            $contentFile = file_get_contents(DATA_TABLE_CONTENT_PATH.$fileName);
            mysql_query($contentFile);
        }
    }
    public static function setLang($lang){
        $dbInfo = self::getDbInfo();
        mysql_select_db($dbInfo['dbName'],$dbInfo['link']);
        $contentFile = "INSERT INTO `config` ( `name`, `value`, `type`) VALUES
('lang', '".$lang."', 'text')";
        mysql_query($contentFile);
    }
    public function checkTable($configArray){}
    public static function dumpTable($filePath){
        $files = scandir($filePath,SCANDIR_SORT_DESCENDING);
        unset($files[count($files)-1]);
        unset($files[count($files)-1]);
        return $files;

//        return array(
//            'cat.txt',
//            'config.txt',
//            'menu.txt',
//            'order.txt',
//            'orderdetail.txt',
//            'table.txt',
//            'user.txt',
//            'coupon.txt'
//        );
    }

}