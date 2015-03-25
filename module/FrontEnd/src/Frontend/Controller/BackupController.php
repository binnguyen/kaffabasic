<?php
/**
 * Created by PhpStorm.
 * User: trisatria
 * Date: 1/6/14
 * Time: 1:17 PM
 */
namespace Frontend\Controller;
use Velacolib\Utility\Utility;

use Admin\Model\orderdetailModel;
use Admin\Model\orderModel;
use Zend\View\Model\ViewModel;
use Zend\Mvc\Controller\AbstractActionController;
use Velacolib\Utility\TransactionUtility;
use Velacolib\Utility\MailUtility;

class BackupController extends AbstractActionController
{
    protected   $modelOrder;
    protected   $modelOrderDetail;
    protected   $translator;
    protected  $userLogin;
    public function init(){

       // $service_locator_str = 'doctrine';
       // $this->sm = $this->getServiceLocator();
       // $doctrineService = $this->sm->get($service_locator_str);

        //$this->translator = Utility::translate();
//        //check login
//        $this->userLogin = Utility::checkLogin($this);
//        if(! is_object( $this->userLogin) &&  $this->userLogin == 0){
//            $this->redirect()->toRoute('admin/child',array('controller'=>'login'));
//        }

         parent::init();
    }

    public function indexAction()
    {

       $host = 'localhost';
        $user = 'root';
        $pass = 'sqlroot';
        $name = 'velacafe';
        $tables = "*";
        $return = '';
        $link = mysql_connect($host,$user,$pass);
        mysql_select_db($name,$link);

        //get all of the tables
        if($tables == '*')
        {
            $tables = array();
            $result = mysql_query('SHOW TABLES');
            while($row = mysql_fetch_row($result))
            {
                $tables[] = $row[0];
            }
        }
        else
        {
            $tables = is_array($tables) ? $tables : explode(',',$tables);
        }

        //cycle through
        foreach($tables as $table)
        {
            $result = mysql_query('SELECT * FROM '.$table);
            $num_fields = mysql_num_fields($result);

            $return.= 'DROP TABLE '.$table.';';
            $row2 = mysql_fetch_row(mysql_query('SHOW CREATE TABLE '.$table));
            $return.= "\n\n".$row2[1].";\n\n";

            for ($i = 0; $i < $num_fields; $i++)
            {
                while($row = mysql_fetch_row($result))
                {
                    $return.= 'INSERT INTO '.$table.' VALUES(';
                    for($j=0; $j<$num_fields; $j++)
                    {
                        $row[$j] = addslashes($row[$j]);
                        $row[$j] = ereg_replace("\n","\\n",$row[$j]);
                        if (isset($row[$j])) { $return.= '"'.$row[$j].'"' ; } else { $return.= '""'; }
                        if ($j<($num_fields-1)) { $return.= ','; }
                    }
                    $return.= ");\n";
                }
            }
            $return.="\n\n\n";
        }
        $backupName = 'backup'.date("d",time()).date('m',time()).date('Y',time()).'.sql';

        //save file
        $filePath = $_SERVER['DOCUMENT_ROOT'].'/backup/ '.$backupName;
        $handle = fopen($_SERVER['DOCUMENT_ROOT'].'/backup/ '.$backupName,'w+');
        fwrite($handle,$return);
        fclose($handle);
    //    $sendMail = MailUtility::sendMailAttachment($filePath,$backupName,'Kaffa DB','nguyenthanhhungbt1905@gmail.com',true);

        die;
    }

    public function mailAction(){

        TransactionUtility::checkAndSendNotifyEmail();
        die;

    }



}