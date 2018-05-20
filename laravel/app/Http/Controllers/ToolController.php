<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ToolController extends Controller
{
    public function ViewGPACalc()
    {
        return view('gpacalc');
    }
    public function CalculateGPA(Request $request)
    {
        $Class = array($request['class1'],$request['class2'],$request['class3'],$request['class4'],$request['class5'],$request['class6']);
       
        $PrevCredits = $request['prevcrdts'];
        $PrevGPA = $request['prevGPA'];
        $Credits1 = $request['credits1'];
        $Credits2 = $request['credits2'];
        $Credits3 = $request['credits3'];
        $Credits4 = $request['credits4'];
        $Credits5 = $request['credits5'];
        $Credits6 = $request['credits6'];
        $den = $PrevCredits + $Credits1 + $Credits2 + $Credits3 + $Credits4 + $Credits5 + $Credits6;
       for( $i=0 ; $i<6 ; $i++)
       {
           if($Class[$i]=="A+" || $Class[$i]=='A')
           {
                $Class[$i]=4;
           }
           else if($Class[$i]=="A-")
           {
            $Class[$i]=3.7;
           }
           else if($Class[$i]=="B+")
           {
            $Class[$i]=3.3;
           }
           else if($Class[$i]=="B")
           {
            $Class[$i]=3.0;
           }
           else if($Class[$i]=="B-")
           {
            $Class[$i]=2.7;
           }
           else if($Class[$i]=="C+")
           {
            $Class[$i]=2.3;
           }
           else if($Class[$i]=="C")
           {
            $Class[$i]=2.0;
           }
           else if($Class[$i]=="C-")
           {
            $Class[$i]=1.7;
           }
           else if($Class[$i]=="D+")
           {
            $Class[$i]=1.3;
           }
           else if($Class[$i]=="D")
           {
            $Class[$i]=1.0;
           }
           else if($Class[$i]=="F")
           {
            $Class[$i]=0;
           }
        }
       $num = $Credits1 * $Class[0] +  $Credits2 * $Class[1] +  $Credits3 * $Class[2] +  $Credits4 * $Class[3] +  $Credits5 * $Class[4] +  $Credits6 * $Class[5] + $PrevCredits * $PrevGPA;
       $GPA = $num / $den; 
       $AccGPA = number_format((float)$GPA, 2, '.', '');
       $LTGPA = ($num - ($PrevCredits * $PrevGPA)) / ($den - $PrevCredits);
       $LasttermGPA = number_format((float)$LTGPA, 2, '.', '');
       return view('gparesult')->with('AccGPA',$AccGPA)->with('LasttermGPA', $LasttermGPA);

    }

    public function CreateNote(Request $request)
    {
        $user_id = Auth::user()->id;
        $rDate=request['date'];
        $rNote=request['note'];
        
    
        $rnote = new note();
    
        $rnote->student_id = $user_id;
        $rnote->note=$rNote;
        $rnote->Date=$rDate;
        $rnote->save();


    }
    public function ViewCalender()
    {
        $Month = date("M");
        $Day = date("D");
        $Day_Num = date("d");
        $Day_name = date("l");
        $Year = date("Y");
        $Month_Days = array(34); // array of days number 5*7
        $UsePreviousMonth=false; //  boolen variables to determine which divisible will be used
        if($Day == "Sun")
        { $Day_Num-=1;}
        if($Day == "Mon")
        {$Day_Num-=2;}
        if($Day == "Tue")
        {$Day_Num-=3;}
        if($Day == "Wed")
        {$Day_Num-=4;}
        if($Day == "Thr")
        {$Day_Num-=5;}
        if($Day == "Fri")
        {$Day_Num-=6;}
        if($Day_Num<=0) // in case the number is negative
        {
            $UsePreviousMonth=true;
             if($Month == "September"|| $Month == "April" || $Month == "June"||$Month == "Novemeber") 
            {
                // Months with 30 Days
                $MonthNumber=30; 
                $Day_Num +=30;
                $PrevoiousMonthNumber=31; // for sure the previous month must be 31 
                
            }
            else if ($Month == "February")
             {
                $Day_Num+=30;
                $MonthNumber=28;
                $PrevoiousMonthNumber=31;

            }
            else if ($Month == "March") // the previous month is February 
            {
                $Day_Num+=27;
                $MonthNumber=31;
                $PrevoiousMonthNumber=28;
            }
            else {
                $MonthNumber=31;
                $Day_Num+=29;
                $PrevoiousMonthNumber=30;
            }
         }
         
         for ($i = 0; $i < 35 ; $i++)
         {
             if($UsePreviousMonth==true)
             {
             $dummyy=(($Day_Num+$i)%$PrevoiousMonthNumber);
             $Month_Days[$i]=$dummyy +1;
             if($dummyy==0)
             {
                $Day_Num+=1;
                $UsePreviousMonth=false;
             }
             }
             else
             {
                $dummyy=(($Day_Num+$i)%$MonthNumber);
                $Month_Days[$i]=$dummyy +1;
             }

         }

       return view('calender')->with('Month',$Month)->with('Day',$Day)->with('Day_name',$Day_name)->with('Year',$Year)->with('Month_Days',$Month_Days); 
    }

}
