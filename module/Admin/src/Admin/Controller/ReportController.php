<?php
/**
 * Created by PhpStorm.
 * User: trisatria
 * Date: 1/6/14
 * Time: 1:17 PM
 */
namespace Admin\Controller;
use Admin\Entity\Categories;
use Admin\Entity\Table;
use Admin\Entity\Payment;
use Admin\Entity\MenuItem;
use Admin\Model\categoryModel;
use Admin\Model\orderdetailModel;
use Admin\Model\orderModel;
use Admin\Model\reportModel;
use Admin\Model\paymentModel;
use Admin\Model\MenuItemModel;
use Velacolib\Utility\Utility;
use Velacolib\Utility\renderExcel;
use Zend\View\Model\ViewModel;
use Zend\Mvc\Controller\AbstractActionController;


class ReportController extends AbstractActionController
{
    protected   $modelCategories;
    protected   $modelOrder;
    protected   $modelOrderDetail;
    protected  $modelPayment;
    protected  $translator;
    protected  $menuItem;
    public function onDispatch(\Zend\Mvc\MvcEvent $e){

        $service_locator_str = 'doctrine';
        $this->sm = $this->getServiceLocator();
        $doctrine = $this->sm->get($service_locator_str);
        $this->modelCategories = new categoryModel($doctrine);
        $this->modelOrder = new orderModel($doctrine);
        $this->modelOrderDetail = new orderdetailModel($doctrine);
        $this->translator = Utility::translate();

        //check login
        $user = Utility::checkLogin($this);
        if(! is_object($user) && $user == 0){
            $this->redirect()->toRoute('admin/child',array('controller'=>'login'));
        }else{
            $isPermission = Utility::checkRole($user->userType,ROLE_ADMIN);
            if( $isPermission == false)
                $this->redirect()->toRoute('admin/child',array('controller'=>'login'));
        }
        //end check login

        return parent::onDispatch($e);
    }
    public function indexAction()
    {
        $message = '';

        if(!(is_executable('public/export') &&  is_writable('public/export'))){

            $message = '<div class="alert alert-dismissable alert-success">
                <h3 style="text-align:center">Make "public/export" writeable</h3></div>';
            echo $message;
            return true;
        }



        $str = '';
        $strOrder = '';
        $fromDate = '';
        $toDate = '';
        $strUser = '';
        if($this->getRequest()->isPost()){
            $params = $this->params()->fromPost();
            $fromDate = $params['formDate'];
            $toDate = $params['toDate'];
            $user = $params['user'];
            $strUserOrder = '';
            if($fromDate){
                $fromDateTime = strtotime($fromDate.' 00:00:00');
                $str .= ' AND table.createDate >= '.$fromDateTime;
                $strOrder .= ' AND o.createDate >= '.$fromDateTime;
            }

            if($toDate){
                $toDateTime = strtotime($toDate.' 23:59:00');
                $str .= ' AND table.createDate <= '.$toDateTime;
                $strOrder .= ' AND o.createDate <= '.$toDateTime;

            }
            if(isset($params['user']) && $params['user'] != 0){
                $strUserOrder .= ' AND table.userId = '.$user;
                $strUser .= ' AND table.userId = '.$user;
            }

        }
        $year = date('Y');
        if($this->params()->fromQuery('year')){
            $year = $this->params()->fromQuery('year');
        }

        $reportMonth =  $this->modelOrder->reportAllMonth($year);

        //$categories = $this->modelCategories->findBy(array('isdelete'=>'0'));
        $reportUser = $this->modelOrder->createQuery('table.isdelete = 0 '.$str.$strUser);
        $reportUser = reportModel::convertUserReportArray($reportUser);


        $reportTable = $this->modelOrder->createQueryTable('table.isdelete = 0 '.$str.$strUser);
        $reportTable = reportModel::convertTableReportArray($reportTable);


        $reportMenu = $this->modelOrderDetail->createQueryMenu('table.isdelete = 0 '.$strOrder);
        $reportMenu = reportModel::convertMenuReportArray($reportMenu);




        $reporAllOrder = $this->modelOrder->createQueryAllMenu('table.isdelete = 0 '.$str.$strUser);


        $reportMenuType = $this->modelOrderDetail->createQueryMenuType('table.isdelete = 0 '.$strOrder);
        $reportMenuType = reportModel::convertMenuTypeReportArray($reportMenuType);

        //linkEcel
        $link = renderExcel::renderMenuOrder($reportMenu);



        //tableTitle = table heading
        //datarow row of table... render by heading key
        //heading key = table column name
        //$dataRow = $this->modelCategories->convertToArray($categories);

        //setup data user table
        $dataUser =  array(
            'tableTitle'=> $this->translator->translate('Report user'),
            'link' => 'admin/order',
            'data' =>$reportUser,
            'heading' => array(
                'userId' => $this->translator->translate('User create'),
                'count_user' => $this->translator->translate('Count number'),

            ),
            'hideEditButton' => 1,
            'hideDeleteButton' => 1,
            'hideDetailButton' => 1
        );

        //setup data table
        $dataTable =  array(
            'tableTitle'=> $this->translator->translate('Report table'),
            'link' => 'admin/order',
            'data' =>$reportTable,
            'heading' => array(
                'tableId' => $this->translator->translate('Table name'),
                'count_table' => $this->translator->translate('Count number'),
            ),
            'hideEditButton' => 1,
            'hideDeleteButton' => 1,
            'hideDetailButton' => 1
        );

        //setup data menu
        $dataMenu =  array(
            'tableTitle'=> $this->translator->translate('Report By Menu Item'),
            'link' => 'admin/order',
            'data' =>$reportMenu,
            'heading' => array(
                'orderDetailId' => $this->translator->translate('Order Detail Id'),
                'OrderId' => $this->translator->translate('Order Id'),
                'menuId' => $this->translator->translate('Name'),
                'menuName' => $this->translator->translate('Menu'),
                'count_menu' => $this->translator->translate('Count number'),
                'realCost' => $this->translator->translate('Real cost'),
            ),
            'hideEditButton' => 1,
            'hideDeleteButton' => 1,
            'hideDetailButton' => 1
        );

        //setup data cost type menu
        $dataMenuCostType =  array(
            'tableTitle'=> $this->translator->translate('Report By Type ( Stay Here Take Away )'),
            'link' => 'admin/order',
            'data' =>$reportMenuType,
            'heading' => array(
                'costType' => $this->translator->translate('Cost type'),
                'cost_type_quantity' => $this->translator->translate('Count number'),
                'realCost' => $this->translator->translate('Real cost'),
            ),
            'hideEditButton' => 1,
            'hideDeleteButton' => 1,
            'hideDetailButton' => 1
        );

        //setup data Payment table



        return new ViewModel(array(
            'data_table'=>$dataTable,
            'data_user'=>$dataUser,
            'data_menu'=>$dataMenu,
            'data_menu_costtype'=>$dataMenuCostType,
            'title'=> $this->translator->translate('Report'),
            'report_table_box' => $this->translator->translate('Report table'),
            'report_user_box' => $this->translator->translate('Report user'),
            'report_menu_box' => $this->translator->translate('Report By Menu Item'),
            'report_menu_cost_type' => $this->translator->translate('Report menu cost type'),
            'payment_menu_box' => $this->translator->translate('Report payment'),
            'allOrder' =>$reporAllOrder,
            'allOrderText' =>$this->translator->translate('You have total:'),
            'allOrderTotalCostText' =>$this->translator->translate('Total cost'),
            'allOrderTotalRealCostText' =>$this->translator->translate('Total real cost'),
            'datetimeReport' =>$this->translator->translate('Date time report'),
            'fromDateText' =>$this->translator->translate('From date'),
            'allMonthInYearText' =>$this->translator->translate('All month in year'),
            'toDateText' =>$this->translator->translate('To date'),
            'submitText' =>$this->translator->translate('Report'),
            'reportMonth' =>$reportMonth,
            'fromDate' => $fromDate,
            'toDate' => $toDate,
            'excelLink' => $link
            )
        );
    }
    public function addAction()
    {
        $request = $this->getRequest();
        $id = $this->params()->fromRoute('id');
        //insert
        if($id == ''){
            if($request->isPost()) {
                $cat = new Categories();
                $cat->setName($this->params()->fromPost('name'));
                $catInserted = $this->modelCategories->insert($cat);
            }
            //insert new user
            //$this->redirect()->toRoute('admin/child',array('controller'=>'category'));
            return new ViewModel(array('title'=> $this->translator->translate('Add new category')));
        }
        else{

            $cat = $this->modelCategories->findOneBy(array('id'=>$id));
            if($request->isPost()){
                $idFormPost = $this->params()->fromPost('id');
                $cat = $this->modelCategories->findOneBy(array('id'=>$idFormPost));
                $cat->setName($this->params()->fromPost('name'));
                $this->modelCategories->edit($cat);
            }
            return new ViewModel(array(
                'data' =>$cat,
                'title' => $this->translator->translate('Edit Category').': '.$cat->getName()
            ));
        }
    }
    public function deleteAction()
    {
        //get user by id
        $request = $this->getRequest();
        if($request->isPost()){
            $id = $this->params()->fromPost('id');
            $menu = $this->modelCategories->findOneBy(array('id'=>$id));
            $menu->setIsdelete(1);
            $this->modelCategories->edit($menu);
            //$this->model->delete(array('id'=>$id));
            echo 1;
        }
        die;

    }
    public function editAction()
    {
        //get user by id
        $id = $this->params()->fromRoute('id');
        $user = $this->model->findOneBy(array('id'=>$id));
        $user->setFullName('tri 1234');
        $this->model->edit($user);
        //update user

    }
    public function exportAction(){
        $reportOrder = $this->modelOrderDetail->createQuery();
        $link = renderExcel::renderReportMenu($reportOrder);
        echo '<a href="/'.$link.'">Download</a>';
        die;
    }
    public function exportMenuAction(){
        $str = '';
        $strOrder = '';
        $fromDate = '';
        $toDate = '';
        if($this->getRequest()->isPost()){
            $params = $this->params()->fromPost();
            $fromDate = $params['formDate'];
            $toDate = $params['toDate'];
            if($fromDate){
                $fromDateTime = strtotime($fromDate.' 00:00:00');
                $strOrder .= ' AND o.createDate >= '.$fromDateTime;
            }

            if($toDate){
                $toDateTime = strtotime($toDate.' 23:59:00');
                $strOrder .= ' AND o.createDate <= '.$toDateTime;
            }
        }
        $str .= 'o.isdelete = 0';
        $reportMenus = $this->modelOrderDetail->createQueryMenu($str.$strOrder);
        $link = renderExcel::renderMenuOrder($reportMenus);
        echo '<a href="/'.$link.'">Download</a>';
        die;
    }
    public function userReportAction(){



    }
    public function menuAction(){

         if($this->getRequest()->isPost()){

            $menuId = $this->params()->fromPost('menu');
            $menuItem = $this->menuItem->findBy(array(
                'menuStoreId'=>$menuId
            ));


             return new ViewModel(array(
                 'menuId'=>$menuId,
                'menuItem'=>$menuItem
             ));
         }



    }


}