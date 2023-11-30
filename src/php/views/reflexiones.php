<div id='panelCentro'>
    <div>
        <p> <?php echo $_GET['nombrepais']; ?> </p>
        <a href='index.php?action=aniadirReflexiones&controller=reflexiones'>
            <button id='aniadirreflexiones'><p>+</p></button>
        </a>

    </div>
    <div>
        <?php
        foreach ($dataToView['data'] as $reflexion) {
            ?>
            <div>
                <p><?php echo $reflexion['titulo']; ?></p>
            </div>
            <?php
        }
        ?>
    </div>
</div>
