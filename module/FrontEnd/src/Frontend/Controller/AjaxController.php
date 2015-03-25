<?php
/**
 * Created by PhpStorm.
 * User: MrHung
 * Date: 3/25/2015
 * Time: 2:22 PM
 */

namespace Frontend\Controller;


use Zend\Mvc\Controller\AbstractActionController;
use Velacolib\Utility\Utility;
use Admin\Entity\Categories;
use Admin\Entity\Config;
use Admin\Entity\Coupon;
use Admin\Entity\Managetable;
use Admin\Entity\Menu;
use Admin\Entity\OrderDetail;
use Admin\Entity\Orders;
use Admin\Entity\Transaction;
use Admin\Entity\User;
use Zend\View\Model\JsonModel;

class AjaxController extends FrontEndController {


    public function init(){

        parent::init();

    }

    public function checkOrderBeforeInsertAction(){

        if ($this->getRequest()->isXmlHttpRequest()){

            $param = $this->params()->fromPost();
          return new JsonModel(array(
              'param' => $param
          ));

        }

    }


}