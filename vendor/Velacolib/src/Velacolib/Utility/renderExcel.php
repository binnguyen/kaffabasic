<?php
/**
 * Created by PhpStorm.
 * User: tristria
 * Date: 11/12/2014
 * Time: 2:33 PM
 */

namespace Velacolib\Utility;
use Admin\Model\orderModel;
use Admin\Model\reportModel;
use PHPExcel_IOFactory;
use PHPExcel_Style_Alignment;
use PHPExcel_Style_Fill;
use Zend\Mvc\Controller\AbstractActionController;



class renderExcel extends AbstractActionController
{
    /**
     * @param array $reportMenu
     * @return mixed
     * @throws \PHPExcel_Exception
     * @throws \PHPExcel_Reader_Exception
     *
     */
    public static  function renderReportMenu($reportMenu = array()){
        $arrayOderId = Utility::groupOrderId();
        //set val for Excel
        $row = $beginRow = $countRowMerge = 2;
        $objPHPExcel = new \PHPExcel();
        if(count($reportMenu)<1 || !isset($reportMenu)){
            return '';
        }
        //get header item
        $header = array();
        $i=0;
        foreach($reportMenu[0] as $k => $item){
                $header[self::getNameFromNumber($i)] = $k;
                $i++;
        }
        //end get header item

        //render header
        foreach($header as $k => $val){
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue($k.'1', $val);
            $objPHPExcel->getActiveSheet()->getColumnDimension($k)->setWidth(25);
        }
        //end render header
        $rowId = 2;
        $i=0;
        //group by orderId excel
        foreach($arrayOderId as $OrderId => $orderIdInfo){

            $count = $orderIdInfo['count'];
            //render item in header
            foreach($header as $kHeader=>$valHeader){
                if(self::checkMerger($valHeader) == true){
                    $concat = $kHeader.$rowId.":".$kHeader.($rowId+$count-1);
                    $objPHPExcel->setActiveSheetIndex(0)->mergeCells($concat);
                    //$objPHPExcel->setActiveSheetIndex(0)->setCellValue($kHeader.$rowId,$concat);
                    $cellText = $orderIdInfo[$valHeader];
                    if($valHeader == 'order_create_date'){
                        $cellText =date('d-m-Y', $orderIdInfo[$valHeader]);
                    }
                    $objPHPExcel->setActiveSheetIndex(0)->setCellValue($kHeader.$rowId,$cellText);
                }
            }
            //end render item header
            $rowId = $rowId + $count;
            $i++;

        }

        //end group by orderId excel
        foreach($reportMenu as $orderIdInfo){
            foreach($header as $kHeader => $valHeader){
                if(self::checkMerger($valHeader) != true){
                    $cellText = $orderIdInfo[$valHeader];
                    $objPHPExcel->setActiveSheetIndex(0)->setCellValue($kHeader.$row,$cellText);
                }
            }
            $row++;
        }
//        $rowId = 2;
//        $i=0;
//        foreach($arrayOderId as $k=>$val){
//
//
//            $count = self::countOrderId($reportMenu,$k);
//
//
//            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$rowId, $reportMenu[$i]['orderID']);
//            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('C'.$rowId, $reportMenu[$i]['order_total_cost']);
//            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('D'.$rowId, $reportMenu[$i]['order_total_real_cost']);
//            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('E'.$rowId, $reportMenu[$i]['order_create_date']);
//            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('F'.$rowId, $reportMenu[$i]['order_coupon_id']);
//            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('G'.$rowId, $reportMenu[$i]['order_surtax_id']);
//
//            $concat = 'A'.$rowId.":".'A'.($rowId+$val-1);
//            $objPHPExcel->setActiveSheetIndex(0)->mergeCells($concat);
//            $concat = 'B'.$rowId.":".'B'.($rowId+$val-1);
//            $objPHPExcel->setActiveSheetIndex(0)->mergeCells($concat);
//            $concat = 'C'.$rowId.":".'C'.($rowId+$val-1);
//            $objPHPExcel->setActiveSheetIndex(0)->mergeCells($concat);
//            $concat = 'D'.$rowId.":".'D'.($rowId+$val-1);
//            $objPHPExcel->setActiveSheetIndex(0)->mergeCells($concat);
//            $concat = 'E'.$rowId.":".'E'.($rowId+$val-1);
//            $objPHPExcel->setActiveSheetIndex(0)->mergeCells($concat);
//            $concat = 'F'.$rowId.":".'F'.($rowId+$val-1);
//            $objPHPExcel->setActiveSheetIndex(0)->mergeCells($concat);
//            $concat = 'G'.$rowId.":".'G'.($rowId+$val-1);
//            $objPHPExcel->setActiveSheetIndex(0)->mergeCells($concat);
//            $rowId = $rowId + $val;
//
//            $i++;
//        }

        //render data


        $mergeBefore = 0;
//        foreach($reportMenu as $dataRow){
//            $count = self::countOrderId($reportMenu,$dataRow['orderID']);
////            foreach($header as $k=>$val){
////                //merge cell
////                if($val == 'orderID' || $val == 'order_total_cost' || $val == 'order_total_real_cost' || $val == 'order_create_date' || $val=='order_coupon_id' || $val== 'order_surtax_id'){
////                    //begin merge
//////                    if($count > 1){
//////                        $concat = $k.$row.":".$k.($row+$count-1);
//////                        if($beforeMegre == 0){
//////                            $objPHPExcel->setActiveSheetIndex(0)->mergeCells($concat);
//////                        }
//////                        $beforeMegre = 1;
//////                    }else{
//////                        $beforeMegre = 0;
//////                    }
////                    //end merge
////                }
////                //end merge cell
////                $objPHPExcel->setActiveSheetIndex(0)->setCellValue($k.$row, $dataRow[$val]);
////            }
//            if($count > 1){
//                if($mergeBefore == 0){
//                    $concat = 'A'.$row.":".'A'.($row+$count-1);
//                    $objPHPExcel->setActiveSheetIndex(0)->mergeCells($concat);
//                    $mergeBefore = 1;
//                }else{
//                    $mergeBefore = 0;
//                }
//            }
//            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$row, $dataRow['orderID']);
//            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('B'.$row, $dataRow['order_total_cost']);
//            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('C'.$row, $dataRow['order_total_real_cost']);
////            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('D'.$row, $dataRow['order_create_date']);
////            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('E'.$row, $dataRow['order_coupon_id']);
////            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('F'.$row, $dataRow['order_surtax_id']);
////            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('G'.$row, $dataRow['order_detail_id']);
////            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('H'.$row, $dataRow['userName']);
////            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('I'.$row, $dataRow['detail_menu_id']);
////            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('J'.$row, $dataRow['detail_cost_type']);
////            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('K'.$row, $dataRow['detail_cost']);
////            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('L'.$row, $dataRow['detail_real_cost']);
////            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('M'.$row, $dataRow['detail_quantity']);
////            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('N'.$row, $dataRow['detail_discout']);
////            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('O'.$row, $dataRow['menu_name']);
//            $row ++;
//        }
        //end render data

        $strLink = self::createExcelLink(time());
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        $objWriter->save($strLink);
        return str_replace('public/','',$strLink);
    }
    public  static function renderMenuOrder($data = array()){
        $link = '';
        if(!$data){
            return $link;
        }
        $objPHPExcel = new \PHPExcel();
        //render data
        ////render header
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A1', 'Thực đơn');
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('B1', 'Số lượng');
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('C1', 'giá');
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('D1', 'Ngày tạo');
        /////set style for header
        $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(30);
        $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(30);
        $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(30);
        $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(30);
        ///end render header

        ////render data
        $row = 2;
        foreach($data as $item){
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$row, $item['name']);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('B'.$row, $item['count_menu']);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('C'.$row, $item['realCost']);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('D'.$row, date('d-m-Y',$item['createDate']));
            $row++;
        }
        $sumTextQuantity = '=SUM(B2:B'.($row-1).')';
        $sumTextCost = '=SUM(C2:C'.($row-1).')';

//        echo $sumTextQuantity.'<br/>';
//        echo $sumTextCost.'<br/>';
//        die;

        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$row, 'Tổng cộng');
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('B'.$row,$sumTextQuantity);
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('C'.$row, $sumTextCost);
        //en render data
        //end render data

        $link =self::createExcelLink(time());
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        $objWriter->save($link);
        return str_replace('public/','',$link);
    }

    //create excel link
    private static  function  createExcelLink($data){
        return  'public/export/export_'.$data.'.xls';
    }
    //convert number to cell column (string)
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
    //count how many orderId row in data
    private function countOrderId($data,$orderId){
        $count = 0;
        foreach($data as $val){
            if($val['orderID'] == $orderId){
                $count ++;
            }
        }
        return $count;
    }
    //check merge
    private function  checkMerger($valHeader){
        if($valHeader == 'orderID' || $valHeader == 'order_total_cost' || $valHeader == 'order_total_real_cost' || $valHeader == 'order_create_date' || $valHeader=='order_coupon_id' || $valHeader== 'order_surtax_id'){
            return true;
        }
        return false;
    }
}