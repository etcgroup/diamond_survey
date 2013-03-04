<?php

class UI {

    public static function likert($prefix, $questions, $scale, $min, $max) {
        $out = "<table>";
        foreach ($questions as $q => $question) {
            $out .= "<tr>";
            $out .= "<td>" . $question . "</td>";
            if (isset($min))
                $out .= "<td>$min</td>";
            for ($i = 1; $i < $scale; $i++) {
                $out .= "<td><input type='radio' name='$prefix-$q' value=$i></td>";
            }
            if (isset($max))
                $out .= "<td>$max</td>";
            $out .= "</tr>\n";
        }
        $out .= "</table>";
        return $out;
    }
    
    public static function orderlist($name, $options) {
        $out = "<ul id='sortable'>";
        foreach($options as $id=>$option){
            $out.="<li class='ui-state-default' id='$name-$id' value='$id'>";
            $out.="<span class='ui-icon ui-icon-arrowthick-2-n-s'></span>";
            $out.=$option."</li>\n";
        }
        $out.="</ul>";
        return $out;
    }

}

?>
