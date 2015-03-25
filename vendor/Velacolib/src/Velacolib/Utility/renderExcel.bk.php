<?php
/**
 * Created by PhpStorm.
 * User: tristria
 * Date: 11/12/2014
 * Time: 2:33 PM
 */

namespace Velacolib\Utility;
use Admin\Model\reportModel;
use PHPExcel_IOFactory;
use Zend\Mvc\Controller\AbstractActionController;


class renderExcel extends AbstractActionController
{
    public static  function renderReportMenu($reportMenu){
        $row = $beginRow = 2;
        $objPHPExcel = new \PHPExcel();
        // Set document properties
        // Add static table left-header some data
        //render_header
        if(count($reportMenu)<1 || !isset($reportMenu)){
            return '';
        }
        $header = array();
        $i=0;
        foreach($reportMenu[0] as $k=>$val){
            $header[self::getNameFromNumber($i)] = $k;
            $i++;
        }
        echo '<pre>';
        print_r($header);
        echo '</pre>';
        die;
        //render header
        foreach($header as $k => $val){
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue($k.'1', $val);
            $objPHPExcel->getActiveSheet()->getColumnDimension($k)->setWidth(20);
        }
        //end render header


//
//
//        foreach($reportMenu as $menu){
//
//            $objPHPExcel->setActiveSheetIndex(0)
//                ->setCellValue('A'.$row, $menu['menuName'])
//                ->setCellValue('B'.$row, $menu['count_menu'])
//                ->setCellValue('C'.$row, str_replace(',','',$menu['realCost']));
//            $row ++;
//        }
//        $sumTextBCol = '=SUM(B'.$beginRow.':B'.($row-1).')';
//        $sumTextCCol = '=SUM(C'.$beginRow.':C'.($row-1).')';
//
//
//        $objPHPExcel->setActiveSheetIndex(0)
//            ->setCellValue('A'.$row, 'Tổng cộng')
//            ->setCellValue('B'.$row, $sumTextBCol)
//            ->setCellValue('C'.$row ,$sumTextCCol);

        $strLink = 'public/export/export_'.time().'.xls';
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        $objWriter->save($strLink);
        return str_replace('public/','',$strLink);
    }

    private static  function getNameFromNumber($num) {
        $numeric = $num % 26;
        $letter = chr(65 + $numeric);
        $num2 = intval($num / 26);
        if ($num2 > 0) {
            return self::getNameFromNumber($num2 - 1) . $letter;
        } else {
            return $letter;
        }
    }
}