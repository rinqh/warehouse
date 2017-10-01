<?php
/**
 * @var \App\View\AppView $this
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
</nav>
<div class="users form large-9 medium-8 columns content">
    <?= $this->Form->create($user) ?>
    <fieldset>
        <legend><?= __('Edit User') ?></legend>
        <?php
            echo $this->Form->control('username' , ['readonly']);
            echo $this->Form->control('password');
            echo $this->Form->control('fullname');
            echo $this->Form->control('avatar');
            echo $this->Form->control('birthday', ['empty' => true]);
            echo $this->Form->control('nationality');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
