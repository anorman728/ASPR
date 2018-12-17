<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title><?= getSetting('pagename'); ?></title>
        <link rel="stylesheet" href="/static/vendor/bootstrap/css/bootstrap.min.css" />
        <link rel="stylesheet" href="/static/css/main.css" />
    </head>
    <body>
        <div class="container-fluid main">
            <div class="row">
                <div class="col-md-10 offset-md-1 text-center heading">
                    <?= $vars['page-heading']; // This was set in the controller. ?>
                </div>
            </div>
            <div class="row">
                <?= $vars['body']; ?>
            </div>
        </div>
    </body>
</html>
