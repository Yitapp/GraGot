<nav class="navbar navbar-dark bg-dark" style="background-color: #2196F3">
    <style>
        .a {
            border: 2px solid transparent;
            border-color: #28a745;
            padding: .375rem .75rem;
            font-size: 1rem;
            line-height: 1.5;
            border-radius: .25rem;
        }
        .b {
            border: 2px solid transparent;
            border-top-color: transparent;
            border-right-color: transparent;
            border-bottom-color: transparent;
            border-left-color: transparent;
            border-color: #28a745;
            padding: .375rem .75rem;
            font-size: 1rem;
            line-height: 1.5;
            border-radius: .25rem;
background-color: transparent;
        }
    </style>
    <div class="row " style="width: 100%; margin: 10px">
        <div class="col-12" style="display: flex;">


<!--<button style="display: table-cell" class="b">asd</button>-->
            <div style="display: table-cell" >
                <a class="navbar-brand a" href="<?= get_home_url(); ?>">GraGot</a>
            </div>
            <div style="display: table-cell" >
                <a class="navbar-brand a" href="<?= get_home_url().'/wp-admin'; ?>">
                    <?= is_user_logged_in() ? 'Admin' : 'Login' ?>
                </a>
            </div>

        <!--</div>
        <div class="col-10">-->
            <div style="display: table-cell; width: 100%" >
                <form style=" width: 100%" method="get" action="<?= get_home_url(); ?>">
                    <input style="width: 100%" name="s" class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" value="<?= array_key_exists('s', $_GET) ? $_GET['s'] : '' ?>">
                </form>
            </div>
        </div>
    </div>
</nav>
