<?php
use backend\assets\AppAsset;
use yii\UrlAsset\component\UrlAsset;
use yii\helpers\Html;
use yii\adminUi\widget\Header;
use yii\adminUi\widget\Nav;
use yii\adminUi\widget\NavBar;
use yii\adminUi\widget\NavBarUser;
use yii\adminUi\widget\NavBarMessage;
use yii\adminUi\widget\NavBarNotification;
use yii\adminUi\widget\NavBarTask;
use yii\adminUi\widget\Breadcrumbs;

/**
 * @var \yii\web\View $this
 * @var string $content
 */
AppAsset::register($this);
$urls = new UrlAsset();
$urls->registerAll($this);
$urls->setParams($this);
$this->beginPage()
?><!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>"/>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body class="skin-blue">
<?php 
    $this->beginBody();
    Header::begin([
        'brandLabel' => 'My Company',
                'brandLabel' => Yii::$app->name,
                'brandUrl' => Yii::$app->homeUrl,
                'options' => [
                    'tag'   => 'header',
                    'class' => 'header',
                ],
        ]);
        NavBar::begin([                
                'options' => [                   
                    'class' => 'navbar-static-top',
                ],
            ]);
            
            $menuItems = [];
            if (Yii::$app->user->isGuest) {
                $menuItems[] = ['content'=> NavBarUser::Widget(),'options'=>['class'=>'']];
            }else{
                $menuItems[] = ['content'=> NavBarMessage::Widget(),'options'=>['class'=>'dropdown messages-menu']];
                $menuItems[] = ['content'=> NavBarNotification::Widget(),'options'=>['class'=>'dropdown notifications-menu']];
                $menuItems[] = ['content'=> NavBarTask::Widget(),'options'=>['class'=>'dropdown tasks-menu']];
                $menuItems[] = ['content'=> NavBarUser::Widget(),'options'=>['class'=>'dropdown user user-menu']];
            }
            
            echo Nav::widget([
                'options' => ['class' => 'nav navbar-nav'],
                'items' => $menuItems,
            ]);        
        NavBar::end();
     Header::end();
?>    
        <div class="wrapper row-offcanvas row-offcanvas-left">
            <!-- Left side column. contains the logo and sidebar -->
            <aside class="left-side sidebar-offcanvas">                
                <!-- sidebar: style can be found in sidebar.less -->
                <section class="sidebar">
                    <!-- Sidebar user panel -->
                    <?php 
                    echo NavBarUser::Widget(['type' =>'sidebar']);
                    
                    
                    $menuitems = [
                        [
                            'label' => 'Dashboard', 
                            'url' => ['/adminuidemo'],
                            'linkOptions'=>[
                                'class' => 'fa fa-dashboard',
                            ]
                        ],
                        [
                            'label' => 'Widgets', 
                            'url' => ['/adminuidemo/default/widget'],
                            'linkOptions'=>[
                                'class' => 'fa fa-th',                                
                            ],
                            'badgeOptions' => [
                                'type' => 'new',
                                'text' => 'new',
                            ],
                        ],
                        [
                            'label' => 'Charts', 
                            #'url' => ['/site/chart'],
                            'linkOptions'=>[
                                'class' => 'fa fa-bar-chart-o',
                            ],
                            'items' => [
                                [
                                    'label' => 'Morris', 
                                    'url' => ['/adminuidemo/default/morris'],
                                    'linkOptions'=>[
                                        'class' => 'fa fa-angle-double-right',
                                    ]
                                ],
                                [
                                    'label' => 'Flot', 
                                    'url' => ['/adminuidemo/default/flot'],
                                    'linkOptions'=>[
                                        'class' => 'fa fa-angle-double-right',
                                    ]
                                ],
                                [
                                    'label' => 'Inline charts', 
                                    'url' => ['/adminuidemo/default/inline'],
                                    'linkOptions'=>[
                                        'class' => 'fa fa-angle-double-right',
                                    ]
                                ],
                            ],
                        ],
                        [
                            'label' => 'Calendar', 
                            'url' => ['/adminuidemo/default/calendar'],
                            'linkOptions'=>[
                                'class' => 'fa fa-calendar',                                
                            ],
                            'badgeOptions' => [
                                'type' => 'notification1',
                                'text' => '3',
                            ],
                        ],
                        [
                            'label' => 'Mailbox', 
                            'url' => ['/adminuidemo/default/mailbox'],
                            'linkOptions'=>[
                                'class' => 'fa fa-envelope',                                
                            ],
                            'badgeOptions' => [
                                'type' => 'notification2',
                                'text' => '13',
                            ],
                        ],
                    ];
                    
					if($this->params['urls']){
						$menuitems = $this->params['urls'];
					}
                    echo Nav::widget([
                        'options' => ['class' => 'sidebar-menu'],
                        'items' => $menuitems,
                    ]);
                    ?>
                </section>
            </aside>

            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">                
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        <?php echo $this->title;?>
                        <small>
                            <?php
                            if($this->params['pagelabel']){
                                echo $this->params['pagelabel'];
                            }else{ ?>
                            Control panel
                            <?php } ?>
                        </small>
                    </h1>
                    <?php                     
                    echo Breadcrumbs::widget([
                        'tag'   => 'ol',
                        'options'=>['class'=>'breadcrumb'],
                        'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                    ])?>
                </section>

                <!-- Main content -->
                <section class="content">
                    <?= $content ?>
                </section><!-- /.content -->
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->
    
    
   <?php /*/?> 
    <div class="wrap">
        <?php
            
        NavBar::begin([
                'brandLabel' => 'My Company',
                'brandUrl' => Yii::$app->homeUrl,
                'options' => [
                    'class' => 'navbar-inverse navbar-fixed-top',
                ],
            ]);
            
            $menuItems = [
                ['label' => 'Home', 'url' => ['/site/index']],
            ];
            if (Yii::$app->user->isGuest) {
                $menuItems[] = ['label' => 'Login', 'url' => ['/site/login']];
            } else {
                $menuItems[] = [
                    'label' => 'Logout (' . Yii::$app->user->identity->username . ')',
                    'url' => ['/site/logout'],
                    'linkOptions' => ['data-method' => 'post']
                ];
            }
            
            echo Nav::widget([
                'options' => ['class' => 'navbar-nav navbar-right'],
                'items' => $menuItems,
            ]);
            NavBar::end();
            
        ?>

        <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= $content ?>
        </div>
    </div>

    <footer class="footer">
        <div class="container">
        <p class="pull-left">&copy; My Company <?= date('Y') ?></p>
        <p class="pull-right"><?= Yii::powered() ?></p>
        </div>
    </footer>
<?php //*/?>
    <?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
