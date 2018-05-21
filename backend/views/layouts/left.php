<?
use yii\bootstrap\Nav;
use mdm\admin\components\MenuHelper;

?>
<aside class="main-sidebar">

    <section class="sidebar">

        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?= \backend\models\Adminuser::getadmininfo(Yii::$app->user->getId())->admin_picture  ?>" class="img-circle" alt="User Image"/>
            </div>
            <div class="pull-left info">
                <p><?=Yii::$app->user->identity->adminname?></p>

                <a href="#"><i class="fa fa-circle text-success"></i>已登录</a>
            </div>
        </div>

        <!-- search form -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search..."/>
              <span class="input-group-btn">
                <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
            </div>
        </form>
        <!-- /.search form -->

        <?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu tree', 'data-widget'=> 'tree'],
                'items' => [
                    ['label' => '菜单选项', 'options' => ['class' => 'header']],
                    ['label' => 'Gii', 'icon' => 'file-code-o', 'url' => ['/gii']],
                    ['label' => '日志', 'icon' => 'dashboard', 'url' => ['/debug']],
                    ['label' => '登录', 'url' => ['site/login'], 'visible' => Yii::$app->user->isGuest],



                    [
                        'label' => '用户管理',
                        'icon' => 'share',
                        'url' => '#',
                        'items' => [
                            ['label' => '普通用户', 'icon' => 'circle-o', 'url' => ['/user/index'],],
                            ['label' => '管理员', 'icon' => 'circle-o', 'url' => ['/adminuser/index'],],
                        ],
                    ],
                    [
                        'label' => '合租管理',
                        'icon' => 'share',
                        'url' => '#',
                        'items' => [
                            ['label' => '合租管理', 'icon' => 'circle-o', 'url' => ['/room/index'],],
                            ['label' => '合租故事', 'icon' => 'circle-o', 'url' => ['/rent-story/index'],],
                        ],
                    ],
                    [
                        'label' => '反馈管理',
                        'icon' => 'share',
                        'url' => ['/feedback/index'],
                    ],
                    [
                        'label' => '论坛管理',
                        'icon' => 'share',
                        'url' => ['/rent-forum/index'],
                    ],
                    [
                        'label' => '队列监控',
                        'icon' => 'share',
                        'url' => ['/redis/index'],
                    ],
                    [
                        'label' => '权限设置',
                        'icon' => 'share',
                        'url' => '#',
                        'items' => [
                            ['label' => '路由', 'icon' => 'circle-o', 'url' => ['/admin/route'],],
                            ['label' => '权限', 'icon' => 'circle-o', 'url' => ['/admin/permission'],],
                            ['label' => '角色', 'icon' => 'circle-o', 'url' => ['/admin/role'],],
                            ['label' => '分配', 'icon' => 'circle-o', 'url' => ['/admin/assignment'],],
                            ['label' => '菜单', 'icon' => 'circle-o', 'url' => ['/admin/menu'],],
                        ],
                    ],

                ],
            ]
        ) ?>

    </section>

</aside>
