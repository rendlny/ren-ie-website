<div class="army-banner-border"></div>
<div class="army-banner">
    <div class="army-title"><?=$armyName?></div>
</div>
<div class="army-banner-border"></div>
<br/>
<div class="row">
<?php
    foreach($army->units as $unit) {
        if($unit->img){
            echo '
            <div class="col-md-2 text-center character-icon" >
                <img 
                    style="height:80px"
                    src="web/assets/images/army-images/'.$army->img_folder.'/'.$unit->img.'.svg" 
                />
                <br/>
                '.$unit->name.'
            </div>';
        }
    }
?>
</div>
<br/>