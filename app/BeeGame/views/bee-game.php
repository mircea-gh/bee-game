<!DOCTYPE html>
<html>
    <head>
        <title>The Bee Game</title>
    </head>
    <body>
        <form method="get">
            <input type="hidden" name="action" value="hit" />
            <button type="submit">
                <?php if (array_sum($aliveBees) > 0) { ?>
                    Hit
                <?php } else { ?>
                    Game over
                <?php } ?>
            </button>
        </form>
        <div>Name: <?=$playerName?></div>
        <br/>
        <div>Alive bees: 
            <?php foreach($aliveBees as $type => $count) { ?>
                <div><?=$type?>: <?=$count?></div>
            <?php } ?>
        </div>
        <br/>
        <div>Latest hit: 
            <?php if (isset($latestHitBeeIndex)) { ?>
                <div>Bee index: <?=$latestHitBeeIndex?></div>
                <div>Bee type: <?=$swarm->getBee($latestHitBeeIndex)->type()?></div>
                <div>Damage: <?=$swarm->getBee($latestHitBeeIndex)->defaultDamage()?></div>
                <div>Remaining health: <?=$swarm->getBee($latestHitBeeIndex)->getHealthPoints()?></div>
            <?php } else { ?>
                none
            <?php } ?>
        </div>
        <br/>
        <div>Swarm's health:
            <?php foreach ($swarm->getBees() as $beeIndex => $bee) { ?>
                <div><?=$beeIndex?> | <?=$bee->type()?> | <?=$bee->getHealthPoints()?></div>
            <?php } ?>
        </div>
        <if
    </body>
</html>