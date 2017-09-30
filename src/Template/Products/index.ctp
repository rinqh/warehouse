<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Product[]|\Cake\Collection\CollectionInterface $products
 */
?>
<div class="products index large-12 medium-12 columns content">
    <h3><?= __('Products') ?></h3>
    <div class="products form large-9 medium-8 columns content">
        <?= $this->Form->create($search) ?>
            <fieldset>
                <?php
                    echo $this->Form->control('category_id', ['options' => $categories]);
                    echo $this->Form->control('name');
                ?>
            </fieldset>
        <?= $this->Form->button(__('Search'), ['action' => 'add']) ?>
        <?= $this->Form->end() ?>
        <button ><?= $this->Html->link(__('New Product'), ['action' => 'add']) ?></button>
    </div>
    <p><i><?= $this->Paginator->counter(['format' => __('Found {{count}} records')]) ?></i></p>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('code') ?></th>
                <th scope="col"><?= $this->Paginator->sort('name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('category_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('price') ?></th>
                <th scope="col"><?= $this->Paginator->sort('unit_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('quantity') ?></th>
                <th scope="col"><?= $this->Paginator->sort('status') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($products as $product): ?>
            <tr>
                <td><?= h($product->code) ?></td>
                <td><?= h($product->name) ?></td>
                <td><?= $product->has('category') ? $this->Html->link($product->category->name, ['controller' => 'Categories', 'action' => 'view', $product->category->id]) : '' ?></td>
                <td><?= $this->Number->format($product->price) ?></td>
                <td><?= $product->has('unit') ? $this->Html->link($product->unit->name, ['controller' => 'Units', 'action' => 'view', $product->unit->id]) : '' ?></td>
                <td><?= $this->Number->format($product->quantity) ?></td>
                <td><input type="checkbox" onclick="return false;" <?php if ($product->status == 1){?> checked="checked" <?php } ?>/></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $product->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $product->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $product->id], ['confirm' => __('Are you sure you want to delete # {0}?', $product->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
    </div>
</div>
