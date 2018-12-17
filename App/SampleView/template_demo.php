<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <?= $vars['demovar']; // This was set in the controller. ?>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                    This page is a demonstration of templates.
                </div>
                <div class="col-md-6 offset-md-2">
                    This is a more advanced example that uses basic templates with the <code>AbstractController::pullView</code> and <code>AbstractController::printToLayout</code> functions rather than <code>print_r</code>.
                </div>
            </div>
            <div class="row" style="height:1em;"></div>
            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <p>The default layout is <code>App/Layouts/default.php</code>.  Examples of using these are probably best understood by looking at the code in action in the templateDemo action.</p>
                    <p>ASPR comes with Bootstrap 4 in the <code>static/vendor</code> directory and the CSS (but not the JS) is sourced in the default layout.</p>
                    <p>All of this is very customizable and it's easy to change the source code directly to fit your needs.  ASPR is designed to be more of a skeleton application than a "You must do this thing this way" framework.  You don't need to use the template functions at all if you don't want to.</p>
                </div>
            </div>
        </div>
    </div>
</div>
