<?php
if ( empty($_POST['c']) ) {
    print file_get_contents("home.html", FILE_USE_INCLUDE_PATH);
}
else {
    $file = './content/'.$_POST['c'].'.json';
    if (is_file($file))
    {
        $json = json_decode(file_get_contents($file, FILE_USE_INCLUDE_PATH), true);
        print "<h1>".$json["name"]."</h1>";
        if (array_key_exists("description", $json))
            print "<p>".$json["description"]."</p>";

        if (array_key_exists("sets", $json))
            foreach ( $json["sets"] as $set )
            {
                printf("<h2>%s</h2>", $set["name"]);
                if (array_key_exists("colors", $set))
                    foreach ( $set["colors"] as $color )
                        printColor($color);
            }

        if (array_key_exists("colors", $json))
            foreach ( $json["colors"] as $color )
            {
                printColor($color);
            }
    }
}

function printColor(array $c) {
    printf("<div class='color' style='background:%s;color:%s'>
                <div class='name%s'>%s</div>
                <div class='value'>%s</div>
                <div class='value'>rgb(%s)</div>
            </div>", $c["value"],$c["light"]?"#fff":"#000",
            (array_key_exists("name", $c))?"":" hide", (array_key_exists("name", $c))?$c["name"]:"",
            $c["value"],
            hex2RGB($c["value"], true, ', '));
}

function hex2RGB($hexStr, $returnAsString = false, $seperator = ',') {
    $hexStr = preg_replace("/[^0-9A-Fa-f]/", '', $hexStr); // Gets a proper hex string
    $rgbArray = array();
    if (strlen($hexStr) == 6) { //If a proper hex code, convert using bitwise operation. No overhead... faster
        $colorVal = hexdec($hexStr);
        $rgbArray['red'] = 0xFF & ($colorVal >> 0x10);
        $rgbArray['green'] = 0xFF & ($colorVal >> 0x8);
        $rgbArray['blue'] = 0xFF & $colorVal;
    } elseif (strlen($hexStr) == 3) { //if shorthand notation, need some string manipulations
        $rgbArray['red'] = hexdec(str_repeat(substr($hexStr, 0, 1), 2));
        $rgbArray['green'] = hexdec(str_repeat(substr($hexStr, 1, 1), 2));
        $rgbArray['blue'] = hexdec(str_repeat(substr($hexStr, 2, 1), 2));
    } else {
        return false; //Invalid hex color code
    }
    return $returnAsString ? implode($seperator, $rgbArray) : $rgbArray; // returns the rgb string or the associative array
}
?>