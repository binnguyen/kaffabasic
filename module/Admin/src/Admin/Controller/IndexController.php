<?php
/**
 * Created by PhpStorm.
 * User: trisatria
 * Date: 1/6/14
 * Time: 1:17 PM
 */
namespace Admin\Controller;

use Admin\Entity\Menu;
use Admin\Entity\MenuCombo;
use Admin\Entity\MenuItem;
use Admin\Entity\Table;
use Admin\Model\comboModel;
use Admin\Model\couponModel;
use Velacolib\Utility\Utility;
use Admin\Model\menuModel;
use Zend\View\Model\ViewModel;
use Admin\Model\menuItemModel;
use Zend\Mvc\Controller\AbstractActionController;
use Velacolib\Utility\Table\AjaxTable;


class IndexController extends AdminGlobalController
{
    protected $modelMenu;
    protected $modelCombo;
    protected $translator;
    protected $modelMenuItem;

    public function init(){
        $this->modelMenu = new menuModel($this->doctrineService);

    }


    public function indexAction()
    {

        //config table
        /////column for table
      $columns = array(
            array('title' =>'Id', 'db' => 'id', 'dt' => 0, 'search'=>false, 'type' => 'number' ),
            array('title' =>'Name', 'db' => 'name','dt' => 1, 'search'=>true, 'type' => 'text' ),
            array('title' =>'Category', 'db' => 'catId','dt' => 2, 'search'=>false, 'type' => 'number',
                'dataSelect' => Utility::getCategoryForSelect()
            ),
            array('title' =>'Cost', 'db' => 'cost','dt' => 3, 'search'=>false, 'type' => 'number' ),
            array('title' =>'Take Away cost', 'db' => 'taCost','dt' => 4, 'search'=>false, 'type' => 'number' ),
            array('title' =>'Action', 'db' => 'id','dt' => 5, 'search'=>false, 'type' => 'number',
                'formatter' => function( $d, $row ) {
                    $actionUrl = '/admin/index';
                    return '
                        <a class="btn-xs action action-detail btn btn-success btn-default" href="'.$actionUrl.'/add/'.$d.'"><i class="icon-edit"></i></a>
                        <a data-id="'.$d.'" id="'.$d.'" data-link="'.$actionUrl.'" class="btn-xs action action-detail btn btn-danger  btn-delete " href="javascript:void(0)"><i class="icon-remove"></i></a>
                    ';
                }
            )
        );

        /////end column for table
        $table = new AjaxTable($columns, array(), 'admin/index');
        $table->setTablePrefix('m');
        $table->setExtendSQl(array(
            array('AND','m.isdelete','=','0'),
        ));
        $table->setAjaxCall('/admin/index');
        $table->setActionDeleteAll('deleteall');
        $this->tableAjaxRequest($table,$columns,$this->modelMenu);
        //end config table
        return new ViewModel(array('table' => $table,
            'title' => $this->translator->translate('Menus')));
    }

    public function addAction()
    {
        $request = $this->getRequest();
        $id = $this->params()->fromRoute('id');
        //insert
        if ($id == '') {
            if ($request->isPost()) {

                $menu = new Menu();
                $menu->setName($this->params()->fromPost('name'));
                $menu->setCost($this->params()->fromPost('cost'));
                $menu->setTakeAwayCost($this->params()->fromPost('tacost'));
                $menu->setDescription($this->params()->fromPost('desc'));
                $menu->setCatId($this->params()->fromPost('cat_id'));
                $menu->setIsdelete(0);
                $menu->setImage(' ');
                $comboInserted = $this->modelMenu->insert($menu);
                $this->flashMessenger()->addSuccessMessage("Insert success");
                $this->redirect()->toRoute('admin/child',array('controller'=>'index'));
            }
            //insert new user
            return new ViewModel(array('title' => $this->translator->translate('Add New Menu')));
        }
        else
        {
            if ($request->isPost()) {
                $idFormPost = $this->params()->fromPost('id');
                $menu = $this->modelMenu->findOneBy(array('id' => $idFormPost));
                $menu->setName($this->params()->fromPost('name'));
                $menu->setCost($this->params()->fromPost('cost'));
                $menu->setTakeAwayCost($this->params()->fromPost('tacost'));
                $menu->setDescription($this->params()->fromPost('desc'));
                $menu->setCatId($this->params()->fromPost('cat_id'));
                $menu->setImage(' ');
                $menu->setIsdelete(0);
                $this->modelMenu->edit($menu);
                //end edit menu
                $this->flashMessenger()->addSuccessMessage("Update success");
                $this->redirect()->toRoute('admin/child', array('controller' => 'index'));
            }

        }
        $menu = $this->modelMenu->findOneBy(array('id' => $id));
        return new ViewModel(array(
            'data' => $menu,
            'title' => $this->translator->translate('Edit Menu: ') . $menu->getName(),

        ));
    }

    private function addNewCombo($data, $parentId)
    {
        $combo = new MenuCombo();
        $combo->setMenuParentId($parentId);
        $combo->setMenuChildId($data['menuid']);
        $combo->setMenuQuantity($data['menuQuantity']);
        $combo->setIsdelete(0);
        $this->modelCombo->insert($combo);
    }

    private function addNewMenuItem($data, $parentId)
    {
        $menuItem = new MenuItem();
        $menuItem->setMenuId($parentId);
        $menuItem->setMenuStoreId($data['menu_store_id']);
        $menuItem->setQuantity($data['quantity']);
        $menuItem->setUnit($data['unit']);
        $this->modelMenuItem->insert($menuItem);
    }

    public function deleteAction()
    {
        //get user by id
        $request = $this->getRequest();
        if ($request->isPost()) {
            $id = $this->params()->fromPost('id');
            $menu = $this->modelMenu->findOneBy(array('id' => $id));
            $menu->setIsdelete(1);
            $this->modelMenu->edit($menu);
            //$this->model->delete(array('id'=>$id));
            echo 1;
        }
        die;

    }

    public function detailAction()
    {
        $id = $this->params()->fromRoute('id');
        $menuInfo = $this->modelMenu->findOneBy(array('id' => $id));
        $dataRow = $this->modelMenu->convertSingleToArray($menuInfo);

        $dataDetail = array(
            'title' => $this->translator->translate('Detail') . ': ' . $menuInfo->getName(),
            'link' => 'admin/index',
            'data' => $dataRow,
            'heading' => array(
                'id' => 'Id',
                'cost' => $this->translator->translate('Cost'),
                'taCost' => $this->translator->translate('Take away'),
                'name' => $this->translator->translate('Name'),
                'catId' => $this->translator->translate('Category'),
                'desc' => $this->translator->translate('Desc'),
//                'image' => 'Image',
            )
        );



        return new ViewModel(array('data' => $dataDetail));
    }


    public function addAjaxAction(){

        if($this->getRequest()->isPost()){
            $menu = new Menu();
            $menu->setName($this->params()->fromPost('name'));
            $menu->setCost($this->params()->fromPost('cost'));
            $menu->setTakeAwayCost($this->params()->fromPost('tacost'));
            $menu->setCatId($this->params()->fromPost('cat_id'));
            $menu->setIsCombo(0);
            $menu->setIsdelete(1);
            $menu->setDescription('');
            $menu->setImage(' ');
            $productInserted = $this->modelMenu->insert($menu);
            $idInserted = $productInserted->getId();
            $menu = $this->modelMenu->findOneBy(array('id'=>$idInserted));
            echo json_encode($this->modelMenu->convertSingleToArray($menu));
            die;
        }
        echo 0;
        die;
    }
}