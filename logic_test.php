<?php

class LogicTest
{
    public function number1(int $rowsCount)
    {
        $lCount = $rCount = $k = 0;

        for ($row=1; $row<=$rowsCount ; $row++) { 
            for ($space=1; $space <=$rowsCount - $row ; $space++) { 
                echo "&nbsp;&nbsp;";
                $lCount++;
            }

            while ($k != 2 * $row - 1) {
                if($lCount <= $rowsCount - 1){
                    $print = ($row + $k);
                    if($print>=10) $print = $print-10;
                    echo $print."&nbsp;";
                    $lCount++;
                }else{
                    $rCount++;
                    $print = ($row + $k) - 2 * $rCount;
                    if($print>=10) $print = $print-10;
                    echo $print."&nbsp;";
                }
                $k++;
            }
            $lCount = $rCount = $k = 0;
            echo "<br/>";
        }

    }

    public function number2($total)
    {
        $ganjil = [];
        $genap = [];
        for($i =0 ; $i <= $total; $i++){
            if($i % 2 == 0){
                $genap[] = $i;
            }else{
                $ganjil[] = $i;
            }
        }
        return "Ganjil : ".implode(',',$ganjil)."<br/>Genap : ".implode(',',$genap);
    }

    public function number3($start,$end)
    {
        $result = [];
        for($i = intVal($start); $i <= intVal($end); $i++){
            $devide = 0;
            for($j = 1; $j <= $i; $j++){
                if($i % $j == 0){
                    $devide++;
                }
            }
            if($devide == 2){
                $result[$i] = $i;
            }
        }
        return implode(',',$result);
    }
    
    public function number4($value,$column,$row)
    {
        $content='';
        for($i = 1; $i<=$row ; $i++){
            $content .= $value;
            for($j=1; $j<$column; $j++){
                $content .= $value;
            }
            $content .= "<br/>";
        }
        return $content;
    }

    public function number5(int ...$value)
    {
        return "Nilai Terbesar : ".max(...$value)."<br/>Nilai Terkecil : ".min(...$value);
    }

    public function number6(string $value)
    {
        return substr($value,1).substr($value,0,1);
    }

    public function number7(int $value)
    {
        $factorial = 1;
        for ($x=$value; $x>=1; $x--){  
            $factorial *= $x;  
        }
        return $factorial;
    }

    public function number8(int $devide,int $start,int $end)
    {
        $return = [];
        for ($i=$start; $i <=$end ; $i++) { 
            if($i % $devide == 0){
                $return[] = $i;
            }
        }
        return implode(',',$return);
    }

    public function number9(int $search,int $start,int $end)
    {
        $return = [];
        for ($i=$start; $i <=$end ; $i++) { 
            if(stripos(strval($i),strval($search))>0){
                $return[] = $i;
            }
        }
        return implode(',',$return);
    }
}

$logicTest = new LogicTest();

echo "1 => <br/>";
$logicTest->number1(10);
echo "<br/>";
echo "<br/>";
echo "2 => ".$logicTest->number2(20);
echo "<br/>";
echo "<br/>";
echo "3 => ".$logicTest->number3(1,100);
echo "<br/>";
echo "<br/>";
echo "4 => ".$logicTest->number4('A',2,3);
echo "<br/>";
echo "<br/>";
echo "5 => ".$logicTest->number5(299,3,4,5,60,7,8,9,10,100);
echo "<br/>";
echo "<br/>";
echo "6 => ".$logicTest->number6('Joko Samudro');
echo "<br/>";
echo "<br/>";
echo "7 => ".$logicTest->number7(3);
echo "<br/>";
echo "<br/>";
echo "8 => ".$logicTest->number8(3,2,40);
echo "<br/>";
echo "<br/>";
echo "9 => ".$logicTest->number9(3,2,40);