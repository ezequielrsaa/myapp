<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Orders'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Orderproducts'), ['controller' => 'Orderproducts', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Orderproduct'), ['controller' => 'Orderproducts', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="orders form large-9 medium-8 columns content">
    <?= $this->Form->create($order) ?>
    <fieldset>
        <legend><?= __('Add Order') ?></legend>
        <?php
            echo $this->Form->input('first_name');
            echo $this->Form->input('last_name');
            echo $this->Form->input('email');
            echo $this->Form->input('phone');
            echo $this->Form->input('billing_address');
            echo $this->Form->input('billing_address2');
            echo $this->Form->input('billing_city');
            echo $this->Form->input('billing_zip');
            echo $this->Form->input('billing_state');
            echo $this->Form->input('billing_country');
            echo $this->Form->input('shipping_address');
            echo $this->Form->input('shipping_address2');
            echo $this->Form->input('shipping_city');
            echo $this->Form->input('shipping_zip');
            echo $this->Form->input('shipping_state');
            echo $this->Form->input('shipping_country');
            echo $this->Form->input('weight');
            echo $this->Form->input('order_item_count');
            echo $this->Form->input('subtotal');
            echo $this->Form->input('tax');
            echo $this->Form->input('shipping');
            echo $this->Form->input('total');
            echo $this->Form->input('order_type');
            echo $this->Form->input('creditcard_number');
            echo $this->Form->input('creditcard_code');
            echo $this->Form->input('creditcard_year');
            echo $this->Form->input('creditcard_month');
            echo $this->Form->input('authorization');
            echo $this->Form->input('transaction');
            echo $this->Form->input('status');
            echo $this->Form->input('ip_address');
            echo $this->Form->input('note');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
