<?php

namespace app\admin\controller;

use app\common\controller\AuthCheck;
use think\Session;
use think\Db;

class Index extends AuthCheck{

    public function index(){
        $str = '亲爱的'. Session::get('adminInfo.username'). '，当前为：'. date('F d'). '&nbsp;' .date('D').'&nbsp;时间为：'.date('H:i:s');
        return $str;exit;
        return $this->fetch();
        return 'admin/index/index';
    }

    public function user(){
        return 'admin/index/user';
    }

    public function exExcel(){
        $arr = Db::name('admin')->select();
        import('PHPExcel.PHPExcel');
        $objPHPExcel = new \PHPExcel();
        $objPHPExcel->getProperties()
            ->setCreator("Roger");
            //->setTitle("管理员列表")
        $excel_filename = '管理员列表_' . date('Y-m-d H:i:s');
        $objPHPExcel->setActiveSheetIndex(0);
        $objPHPExcel->getActiveSheet()->setTitle('Simple');
        $objPHPExcel->getActiveSheet()->setCellValue('A1', $excel_filename);
        $objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getstyle('A1')->getAlignment()->setVertical(\PHPExcel_style_Alignment::VERTICAL_CENTER);
        $sheet_title = array('ID', '用户名', '密码', '盐值', '状态');
        $objPHPExcel->getActiveSheet()->getRowDimension('1')->setRowHeight(20);
        $objPHPExcel->getActiveSheet()->getRowDimension('2')->setRowHeight(25);
        $letter = array('A', 'B', 'C', 'D', 'E');
        $objPHPExcel->getActiveSheet()->getStyle('A2:AC2')->getBorders()->getAllBorders()->setBorderStyle(\PHPExcel_Style_Border::BORDER_THIN);
        for ($k = 0; $k < count($sheet_title); $k++) {
            $objPHPExcel->getActiveSheet()->setCellValue($letter[$k] . '2', $sheet_title[$k]);
            $objPHPExcel->getActiveSheet()->getStyle($letter[$k] . '2')->getFont()->setSize(12)->setBold(true);
            $objPHPExcel->getActiveSheet()->getStyle($letter[$k] . '2')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $objPHPExcel->getActiveSheet()->getColumnDimension($letter[$k])->setWidth(18);
            $objPHPExcel->getActiveSheet()->getColumnDimension('P')->setWidth(30);
        }
        for ($i=0;$i<count($arr);$i++) {
            $row = $i+3;
            $temp = $arr[$i];
            for ($j=0; $j<count($temp); $j++) {
                switch ($j) {
                    case 0 : $cellvalue = $temp['id']; break;
                    case 1 : $cellvalue = $temp['username']; break;
                    case 2 : $cellvalue = $temp['password']; break;
                    case 3 : $cellvalue = ' '.$temp['salt'].' '; break;
                    case 4 : $cellvalue = $temp['status']; break;
                }
                $objPHPExcel->getActiveSheet()->setCellValue($letter[$j].$row, $cellvalue);
                $objPHPExcel->getActiveSheet()->getStyle($letter[$j].$row)->getFont()->setSize(13);
                $objPHPExcel->getActiveSheet()->getStyle($letter[$j].$row)->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                /*if ((in_array($j,[15,16,17,18,19])) && "" != $cellvalue) {
                    $objPHPExcel->getActiveSheet()->getStyle($letter[$j].$row)->getAlignment()->setWrapText(true);
                    $objPHPExcel->getActiveSheet()->getStyle($letter[$j].$row)->getAlignment()->setVertical(\PHPExcel_Style_Alignment::VERTICAL_CENTER);
                }*/
            }
            $objPHPExcel->getActiveSheet()->getRowDimension($row)->setRowHeight(23);
        }
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="' . $excel_filename . '.xls"');
        header('Cache-Control: max-age=0');
        header('Cache-Control: max-age=1');
        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
        header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT');
        header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
        header('Pragma: public'); // HTTP/1.0
        $objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        $objWriter->save('php://output');
    }
}