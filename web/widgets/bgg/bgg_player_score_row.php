<div class="bgg-play-player">
    <div class="row">
        <div class="col-md-4 col-sm-3 align-right">
            <?= $player->name ?>
        </div>

        <div class="col-md-4 col-sm-4">
            <div class="tick align-center" data-value="0" data-total="<?= $player->playCount() ?>" data-did-init="setupFlip">
                <div data-repeat="true" aria-hidden="true" data-transform="arrive(9, .001) -> round -> pad('   ') -> split -> delay(rtl, 100, 150)">
                    <span data-view="flip"></span>
                </div>
            </div>
        </div>

        <div class="col-md-4 col-sm-4">
            <div class="tick align-center" data-value="0" data-total="<?= $player->winAverage() ?>" data-did-init="setupFlip">
                <div data-repeat="true" aria-hidden="true" data-transform="arrive(9, .001) -> round -> pad('   ') -> split -> delay(rtl, 100, 150)">
                    <span data-view="flip"></span>
                </div>
            </div>
        </div>

    </div>
</div>