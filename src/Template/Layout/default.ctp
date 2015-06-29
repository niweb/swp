<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

$cakeDescription = 'CakePHP: the rapid development php framework';
?>
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?= $cakeDescription ?>:
        <?= $this->fetch('title') ?>
    </title>
    <?= $this->Html->meta('icon') ?>

    <?= $this->Html->css('base.css') ?>
    <?= $this->Html->css('cake.css') ?>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
</head>
<body>
    <header>
        <div class="header-title">
             <!---<span><?= $this->fetch('title') ?></span>------>
            <span>Schülerpaten</span>
        </div>
            <?php if(!isset($authUser)) : ?>
                <div class="header-help">
                    <span><a target="_parent" href="/users/login">Login</a></span>
                    <span><a target="_parent" href="/partners/register">Registrieren</a></span>
                </div>
				<?php else :
                    if(isset($admin)): ?>
                        <div class="header-menu">
							<span><?php echo $this->Html->link(__('Admins'), ['controller' => 'Users', 'action' => 'index']); ?></span>
							<span><?php echo $this->Html->link(__('Locations'), ['controller' => 'Locations', 'action' => 'index']); ?></span>
                        </div>
						<div class="header-help">
							<span><?php echo $this->Html->link(h($authUser['first_name'].' '.$authUser['last_name']), ['controller' => 'Users', 'action' => 'view', $authUser['id']]); ?></span>
                    <?php elseif(isset($locationAdmin)): ?>
                        <div class="header-menu">
							<span><?php echo $this->Html->link(__('Users'), ['controller' => 'Users', 'action' => 'index']); ?></span>
							<span><?php echo $this->Html->link(__('Partners'), ['controller' => 'Partners', 'action' => 'index', 'all']); ?></span>
							<span><?php echo $this->Html->link(__('Students'), ['controller' => 'Students', 'action' => 'index']); ?></span>
                                                        <span><?php echo $this->Html->link(__('Tandems'), ['controller' => 'Tandems', 'action' => 'index']); ?></span>
							<span><?php echo $this->Html->link(__('Schooltypes'), ['controller' => 'Schooltypes', 'action' => 'index']); ?></span>
							<span><?php echo $this->Html->link(__('Subjects'), ['controller' => 'Subjects', 'action' => 'index']); ?></span>
							<span><?php echo $this->Html->link(__('StatusTexts'), ['controller' => 'StatusTexts', 'action' => 'index']); ?></span>
                        </div>
						<div class="header-help">
							<span><?php echo $this->Html->link(h($authUser['first_name'].' '.$authUser['last_name']), ['controller' => 'Users', 'action' => 'view', $authUser['id']]); ?></span>
                    <?php elseif(isset($matchmaker)): ?>
                        <div class="header-menu">
							<span><?php echo $this->Html->link(__('Partners'), ['controller' => 'Partners', 'action' => 'index', 'waiting']); ?></span>
							<span><?php echo $this->Html->link(__('Students'), ['controller' => 'Students', 'action' => 'index', 'waiting']); ?></span>
                                                        <span><?php echo $this->Html->link(__('Tandems'), ['controller' => 'Tandems', 'action' => 'index']); ?></span>
						</div>
						<div class="header-help">
							<span><?php echo $this->Html->link(h($authUser['first_name'].' '.$authUser['last_name']), ['controller' => 'Users', 'action' => 'view', $authUser['id']]); ?></span>
                    <?php elseif(isset($vermittler)): ?>
                        <div class="header-menu">
							<span><?php echo $this->Html->link(__('Partners'), ['controller' => 'Partners', 'action' => 'index', 'active']); ?></span>
							<span><?php echo $this->Html->link(__('Students'), ['controller' => 'Students', 'action' => 'index']); ?></span>
                                                        <span><?php echo $this->Html->link(__('Tandems'), ['controller' => 'Tandems', 'action' => 'index']); ?></span>
						</div>
						<div class="header-help">
							<span><?php echo $this->Html->link(h($authUser['first_name'].' '.$authUser['last_name']), ['controller' => 'Users', 'action' => 'view', $authUser['id']]); ?></span>
                    <?php else : ?>
                        <div class="header-help">
							<span><?php echo $this->Html->link(h($authUser['first_name'].' '.$authUser['last_name']), ['controller' => 'Partners', 'action' => 'view', $authPartner['id']]); ?></span>
					<?php endif; ?>
                        <span><a target="_parent" href="/users/logout">Logout</a></span>
					</div>
            <?php endif; ?>	
        </div>
    </header>
    <div id="container">

        <div id="content">
            <?= $this->Flash->render() ?>

            <div class="row">
                <?= $this->fetch('content') ?>
            </div>
        </div>
        <footer>
        </footer>
    </div>
</body>
</html>
