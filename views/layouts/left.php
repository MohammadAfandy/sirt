<?php
use mdm\admin\components\Helper;
?>

<aside class="main-sidebar">

    <section class="sidebar">

        <!-- Sidebar user panel -->
        <ul class="sidebar-menu">
            <li class="header">MAIN MENU</li>
        </ul>
        <!-- /.search form -->
        <?php
        $menuItems = [
            ['label' => 'Home', 'url' => ['/site/index'], 'icon' => 'home'],
            ['label' => 'Warga', 'url' => ['/warga/index'], 'icon' => 'user'],
            // ['label' => 'Alternatif', 'url' => ['/alternatif/index'], 'icon' => 'user'],
            // ['label' => 'Kriteria', 'url' => ['/kriteria/index'], 'icon' => 'random'],
            // ['label' => 'Penilaian', 'url' => ['/penilaian/index'], 'icon' => 'bar-chart'],
            // ['label' => 'Hasil', 'url' => ['/hasil/index'], 'icon' => 'pie-chart'],
            ['label' => 'User Management', 'url' => ['/admin/assignment/index'], 'icon' => 'users'],
            ['label' => 'About', 'url' => ['/site/about'], 'icon' => 'info'],
            ['label' => 'Contact', 'url' => ['/site/contact'], 'icon' => 'contact'],
        ];

        $menuItems = Helper::filter($menuItems);
        if (Yii::$app->user->isGuest) {
            $menuItems = [
                 ['label' => 'Home', 'url' => ['/site/index'], 'icon' => 'home'],
                 ['label' => 'About', 'url' => ['/site/about'], 'icon' => 'info'],
                 ['label' => 'Contact', 'url' => ['/site/contact'], 'icon' => 'book'],
                 // ['label' => 'User Management', 'url' => ['/admin/assignment/index'], 'icon' => 'users'],
            ];
        }
        ?>
        <?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu tree', 'data-widget'=> 'tree'],
                'items' => $menuItems,
            ]
        ) ?>

    </section>

</aside>
