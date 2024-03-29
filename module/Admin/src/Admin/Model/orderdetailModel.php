<?php
/**
 * Created by PhpStorm.
 * User: tri
 * Date: 7/14/2014
 * Time: 12:12 AM
 */

namespace Admin\Model;


use Admin\Entity\OrderDetail;
use Admin\Entity\Orders;
use Admin\Entity\User;
use Admin\Entity\Menu;
use Velacolib\Utility\Utility;
use Zend\InputFilter\InputFilterInterface;

class orderdetailModel extends globalModel {

    function __construct($controller)
    {
        $this->entityName = 'Admin\Entity\OrderDetail';
        parent::__construct($controller);
    }
    public function hydrator($data = array()){

    }
    public  function convertToArray($datas){
        $return = array();
        foreach($datas as $data){
            $array = $this->convertSingleToArray($data);
            $return[] = $array;
        }
        return $return;
    }
    public function  convertSingleToArray($data){

        $menuInfo = Utility::getMenuInfo($data->getMenuId());
        $menuCostType = Utility::getMenuCostType($data->getCostType());
        $couponInfo = Utility::getCouponInfo($data->getDiscount());
        $array = array();
        $array['id'] = $data->getId();
        $array['orderid'] = 'Order #'.$data->getOrderId();
        $array['menuid'] =   '<a href="/admin/index/add/'.$data->getMenuId().'" target="_blank" >'.$menuInfo->getName().'</a>';
        $array['quantity'] = $data->getQuantity();
        $array['menucost'] = Utility::formatCost($data->getMenuCost());
        $array['menucosttype'] = $menuCostType;
        $array['discount'] = $couponInfo->getDescription();
        $array['realcost'] =  Utility::formatCost($data->getRealCost());

        return $array;
    }
    public function createQueryMenu($strQuery){
        $querybuilder = $this->objectManager->getRepository($this->entityName)->createQueryBuilder('table');
        $rs = $querybuilder
            ->select(' table, sum(table.quantity) as count_menu, table.menuId, sum(table.realCost) as realCost, o.createDate, mn.name')
            ->from(' Admin\Entity\Orders','o')
            ->from(' Admin\Entity\Menu','mn')
            ->where($strQuery.' AND o.id = table.orderId AND table.menuId = mn.id')
            ->groupBy('table.menuId')
            ->orderBy('count_menu','desc')
            ->getQuery()
            ->getResult();

        return $rs;
    }
    public function createQueryMenuType($strQuery){
        $querybuilder = $this->objectManager->getRepository($this->entityName)->createQueryBuilder('table');
        $rs = $querybuilder
            ->select(' sum(table.quantity) as cost_type_quantity, table.costType, sum(table.realCost) as realCost ')
            ->from(' Admin\Entity\Orders','o')
            ->where($strQuery.' AND o.id = table.orderId')
            ->groupBy('table.costType')
            ->getQuery()
            ->getResult();
        return $rs;
    }

    public function createQuery($strQuery = ''){

        $querybuilder = $this->objectManager->getRepository($this->entityName)
            ->createQueryBuilder('table');
        $rs = $querybuilder
            ->select('  ord.id AS orderID, ord.totalCost AS order_total_cost, ord.totalRealCost AS order_total_real_cost, ord.createDate AS order_create_date, ord.couponId AS order_coupon_id, ord.surtaxId AS order_surtax_id, table.id AS order_detail_id, usr.userName, table.menuId AS detail_menu_id, table.costType AS detail_cost_type, table.menuCost AS detail_cost, table.realCost AS detail_real_cost, table.quantity AS detail_quantity, table.discount AS detail_discout, mn.name AS menu_name  ')
            ->from('Admin\Entity\Orders', 'ord')
            ->from('Admin\Entity\User ', 'usr')
            ->from('Admin\Entity\Menu', 'mn')
            ->where('table.orderId = ord.id AND ord.userId = usr.id AND mn.id = table.menuId AND ord.isdelete = 0')
            ->orderBy('ord.id','ASC')
            ->getQuery()
            ->getResult();
        return $rs;

    }
    public function groupOrder(){
        $querybuilder = $this->objectManager->getRepository($this->entityName)->createQueryBuilder('table');
        $rs = $querybuilder
            ->select(' count(table.orderId) as count_table, table.orderId, ord.createDate, ord.totalCost, ord.totalRealCost, ord.couponId, ord.surtaxId, usr.userName')
            ->from('Admin\Entity\Orders', 'ord')
            ->from('Admin\Entity\User', 'usr')
            ->groupBy('table.orderId')
            ->where('ord.isdelete = 0 AND ord.id = table.orderId AND ord.userId = usr.id')
            ->getQuery()
            ->getResult();
        return $rs;

    }

    public function countQuantityByMenuId($id){
        $querybuilder = $this->objectManager->getRepository($this->entityName)->createQueryBuilder('table');
        $rs = $querybuilder
            ->select(' sum(table.quantity)')
            ->where('table.menuId ='.$id)
            ->getQuery()
            ->getResult();
        return $rs;
    }
}
