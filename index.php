<?php
include_once "sqlkit.php";
$dr = query("SELECT * FROM cliente_kqi", $conn);
$lista = array();
while (($h = mysqli_fetch_assoc($dr))) {
    $lista[] = $h;
}
if (isset($_GET['id']))
    $id = $_GET['id'];
else
    $id = '1807050';
if (isset($_GET['nome']))
    $nome = $_GET['nome'];
else
    $nome = 'Z.C. SNC';
?>
<!doctype html>
<html>
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8"/>

    <title>KQI - <?= $nome ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css"
          href="https://cdn.datatables.net/v/dt/jqc-1.12.4/dt-1.10.15/b-1.3.1/b-html5-1.3.1/se-1.2.2/datatables.min.css">
    <link rel="stylesheet" type="text/css" href="css/generator-base.css">
    <link rel="stylesheet" type="text/css" href="css/editor.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="css/mycss.css">
    <link rel="stylesheet" href="css/bootstrap.css">
    <script type="text/javascript" charset="utf-8"
            src="https://cdn.datatables.net/v/dt/jqc-1.12.4/dt-1.10.15/b-1.3.1/b-html5-1.3.1/se-1.2.2/datatables.min.js"></script>
    <script type="text/javascript" charset="utf-8" src="js/dataTables.editor.min.js"></script>
    <script type="text/javascript" charset="utf-8"
            src="https://momentjs.com/downloads/moment-with-locales.min.js"></script>
    <script type="text/javascript" charset="utf-8" src="js/table.kqi.js"></script>
    <script>moment.locale('it');
        var cid = <?= $id ?>;
    </script>
</head>
<body>
<div class="container">
    <div class="row">
        <div id="datat" class="col-sm-8">
            <h2 class="titolo">
                <?= $nome ?>
            </h2>
            <table cellpadding="0" cellspacing="0" border="0" class="display" id="kqi" width="100%">
                <thead>
                <tr>
                    <th>Data</th>
                    <th>Id Cliente</th>
                    <th>Ricarica</th>
                    <th>Consumo</th>
                </tr>
                </thead>
                <tfoot>
                <tr>
                    <th colspan="3" style="text-align:right">Totale:</th>
                    <th></th>
                </tr>
                </tfoot>
            </table>
        </div>
        <div id="menu" class="col-sm-4">
            <ul class="nav nav-pills nav-stacked">
                <?php
                $out = '';
                foreach ($lista as $v) {
                    $cl = '';
                    if ($v['id'] === $id)
                        $cl = 'class="active"';
                    $out .= '<li ' . $cl . '><a href="index.php?id=' . $v['id'] . '&nome=' . $v['nome'] . '">' . $v['nome'] . '</a></li>';
                }
                echo $out;
                ?>
            </ul>
        </div>
    </div>
</div>
</body>
</html>
