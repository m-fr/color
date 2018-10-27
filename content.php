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

        if (array_key_exists("sets", $json))
        foreach ( $json["sets"] as $set )
        {
            printf("<h2>%s</h2>", $set["name"]);
            if (array_key_exists("colors", $set))
            foreach ( $set["colors"] as $color )
            {
                printf("<div class='color' style='background:%s;color:%s'>
                        <div class='value'>%s</div>
                        <div class='name%s'>%s</div>
                    </div>", $color["value"],$color["light"]?"#fff":"#000",
                    $color["value"],
                    (array_key_exists("name", $color))?"":" hide", (array_key_exists("name", $color))?$color["name"]:"");
            }
        }

        if (array_key_exists("colors", $json))
        foreach ( $json["colors"] as $color )
        {
            printf("<div class='color' style='background:%s'>
                        <div class='value'>%s</div>
                        <div class='name%s'>%s</div>
                    </div>", $color["value"],
                    $color["value"],
                    (array_key_exists("name", $color))?"":" hide", (array_key_exists("name", $color))?$color["name"]:"");
        }
    }
}
?>