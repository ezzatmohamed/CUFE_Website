<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SoapController extends Controller
{
    public static function SoapRequest($id,$pass ,$func )
    {
        $wsdl = 'http://chws.eng.cu.edu.eg/webservice1.asmx?WSDL';

        
        try
        {
            $clinet=new \SoapClient($wsdl);
    

            $ver =array("Params_CommaSeparated" => (string)$id.','.(string)$pass.','.(string)$func);
            $quates=$clinet->GetData($ver);
       
             
            $str =  ($quates->GetDataResult);  
        
            return $str;
            
        }
    
        catch(SoapFault $e)
        {
            $message =  $e->getMessage();
            return view('soap')->with('message',$message);
        }
    }

   
    public function CheckLog($id,$pass)
    {
        $str = $this->SoapRequest($id,$pass,0);

        if(strpos($str,'Wrong'))
        {
            return false;
        }
        return true;
    }
    
        public function PersonalInfo($id,$pass)
        {
    
            $str = $this->SoapRequest($id,$pass,3);
            $length = strlen($str);
            $word = '';
    
            $subjects = array();
            
            for( $i = 0; $i < $length; $i++ )
            {
                $word .= $str[$i];
                if( strpos($word,'Student_Code') !== false )
                {
                    $word = '';
                    $code =  $str[$i+5].$str[$i+6].$str[$i+7].$str[$i+8].$str[$i+9].$str[$i+10].$str[$i+11];
                    $i += 11;
                }
                else if( strpos($word,'Student_Name_EN') !== false )
                {
                    $word = '';
    
                    $name = '';
                    $i+=5;
    
                    while($str[$i] !== '"')
                    {
                        $name .= $str[$i];
                        $i++;
                    }
                }
                else if (strpos($word,'Student_Program_Name') !== false )
                {
                    $word = '';
    
                    $program = '';
                    $i+=5;
                    while($str[$i] !== '"')
                    {
                        $program .= $str[$i];
                        $i++;
                    }
    
                }
                else if (strpos($word,'Student_GPA') !== false )
                {
                    $word = '';
    
                    $gpa = '';
                    $i+=5;
                    while($str[$i] !== '"')
                    {
                        $gpa .= $str[$i];
                        $i++;
                    }
                    
                }
               
            } 
    
            return $info = array($name,$program,$gpa);
    
            
        }
    
    
        public function TimeTable($id,$pass)
        {
            $str = $this->SoapRequest($id,$pass,1);
    
            $length = strlen($str);
            $word = '';
            
            $timetable = array();
            for( $i = 0; $i < $length; $i++ )
            {
                $word .= $str[$i];
                if( strpos($word,'Day_Name') !== false )
                {
                    $word = '';
                    $i+=5;
                    $day = '';
                    
                    while($str[$i] !== '"')
                    {
                    
                            $day .= $str[$i];
                   
                        $i++;
                    }
                }
                else if( strpos($word,'Course_Name') !== false )
                {
                    $word = '';
    
                    $course_name = '';
                    $i+=5;
    
                    while($str[$i] !== '"')
                    {
                        $course_name .= $str[$i];
                        $i++;
                    }
                }
                else if (strpos($word,'Course_Code') !== false )
                {
                    $word = '';
    
                    $course_code = '';
                    $i+=5;
                    while($str[$i] !== '"')
                    {
                        $course_code .= $str[$i];
                        $i++;
                    }
    
                }
                else if (strpos($word,'Location') !== false )
                {
                    $word = '';
    
                    
                    $location = '';
                    $i+=5;
                    while($str[$i - 1] !== ']')
                    {
                           
                        $location .= $str[$i];
                        $i++;
                       
                    }
                    
                }
                else if (strpos($word,'Type') !== false )
                {
                    $word = '';
    
                    $type = '';
                    $i+=5;
                    while($str[$i] !== '"')
                    {
                        $type .= $str[$i];
                        $i++;
                    }
                    
                }
                else if (strpos($word,'From') !== false )
                {
                    $word = '';
    
                    $time = '';
                    $i+=5;
                    while($str[$i] !== '"')
                    {
                        $time .= $str[$i];
                        $i++;
                    }
                    $time .= " To ";
                    
                }
                else if (strpos($word,'To') !== false )
                {
                    $word = '';
    
                    $i+=5;
                    while($str[$i] !== '"')
                    {
                        $time .= $str[$i];
                        $i++;
                    }
    
                    $subject = array($course_name,$course_code,$type,$location,$time,$day);
                    array_push($timetable,$subject);
                    
                }
                
               
            }
            return $timetable;
        }
}
