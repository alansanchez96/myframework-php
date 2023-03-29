<h1>Example Registers</h1>

<ul>
    <?php

    foreach ($example as $e) { ?>

        <li>
            <p>Column1: <span><?php echo $e->column1; ?></span> </p>

            <p>Column2: <span><?php echo $e->column2; ?></span> </p>

        </li>

        <hr>

        <div>
            <a href="/example/update?id=<?php echo $e->id; ?>">Update Example</a>

            <form action="/example/delete" method="POST">
                <input type="hidden" name="id" value="<?php echo $e->id; ?>">
                <button>
                    Delete Example
                </button>
            </form>
        </div>

    <?php } ?>
</ul>