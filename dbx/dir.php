<?php
    require_once '../pages.php';
    require_once '../dbxlib/Dropbox/autoload.php';
    use \Dropbox as dbx;

    enforceDbx();
    startContent();
    $dbxClient = new dbx\Client($_SESSION['dbx']['token'], "PHP-Example/1.0");
    if (strlen(urldecode($_SERVER['REQUEST_URI'])) > strlen('/dev/dkit/dbx/dir')) {
        $path = substr(urldecode($_SERVER['REQUEST_URI']),strlen('/dev/dkit/dbx/dir'));
    } else {
        $path = "/";
    }
    $dir = $dbxClient->getMetadataWithChildren($path);
    //echo(json_encode($dir));
?>
<h3>
<?php
    $folders = explode("/", $path);
    $pos = -1;
    foreach ($folders as $folder) {
        $pos += strlen($folder) + 1;
        if ($pos == 0) {
            echo '<a href="/dev/dkit/dbx/dir/">Dropbox</a>';
        } else {
            echo ' / <a href="/dev/dkit/dbx/dir' . substr($path,0,$pos) . '">' . $folder . '</a>';
        }
    }
?>
</h3>

<ul data-role="listview">
    <li data-role="list-divider">
        Files in '<?= $dir['path']; ?>'
        <span class="ui-li-count">
            <?= count($dir['contents']); ?> items
        </span>
    </li>
    <?php
        foreach ($dir['contents'] as $item) {
            echo '<li><a href="/dev/dkit/dbx/dir' . $item['path'] . '"><p>';
            if ($item['is_dir']) {
                echo "> ";
            }
            echo $item['path'];
            echo '</p></a></li>';
        }
    ?>
</ul>

<?php
    endContent();