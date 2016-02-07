<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Number'), ['action' => 'edit', $number->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Number'), ['action' => 'delete', $number->id], ['confirm' => __('Are you sure you want to delete # {0}?', $number->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Numbers'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Number'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="numbers view large-9 medium-8 columns content">
    <h3><?= h($number->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Who') ?></th>
            <td><?= h($number->who) ?></td>
        </tr>
        <tr>
            <th><?= __('Content') ?></th>
            <td><?= h($number->comment) ?></td>
        </tr>
        <tr>
            <th><?= __('User') ?></th>
            <td><?= $number->has('user') ? $this->Html->link($number->user->id, ['controller' => 'Users', 'action' => 'view', $number->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Photo') ?></th>
            <td><?= h($number->photo) ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($number->id) ?></td>
        </tr>
        <tr>
            <th><?= __('Number') ?></th>
            <td><?= h($number->number) ?></td>
        </tr>
        <tr>
            <th><?= __('Status') ?></th>
            <td><?= $number->status ? __('Yes') : __('No'); ?></td>
        </tr>
    </table>
</div>
