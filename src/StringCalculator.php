<?php
class StringCalculator {

    static public function add($num) {
        if(substr($num, 0, 2) == "*/") {
            $split = explode("\n", $num, 2);
            $delim = [];
            preg_match_all("/\[([^\]]*)\]/", $split[0], $delim);
            $num = $split[1];
        }
        else
            $delim = ["\n"];

        $negativesCaught = [];

        for ($i=0;$i<count($delim);$i++)
            $num = str_replace($delim[$i], ",", $num);
        $arrNum = explode(",", $num);
        $sum = 0;

        for ($i=0;$i<count($arrNum);$i++) {
            if ($arrNum[$i] >= 0 && $arrNum[$i] <= 1000)
                $sum += $arrNum[$i];
            else if ($arrNum[$i] < 0)
                $negativesCaught[] = $arrNum[$i];
        }

        $numNeg = count($negativesCaught);
        if ($numNeg > 0) {
            $msg = "negatives non allowed: ";
            for ($i=0;$i<$numNeg;$i++) {
                $msg = $msg . $negativesCaught[$i];
                if ($i < $numNeg - 1)
                    $msg = $msg . ", ";
            }
            throw new Exception($msg);
        } else
            return $sum;
    }

}
    ?>
