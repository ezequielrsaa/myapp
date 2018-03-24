

<h3></h3> 

<?php //echo $this->element('pagination'); ?>

<div class="search_bar">
    <?= $this->Form->create(NULL, ['url' => ['controller' => 'products', 'action' => 'index'], 'type' => 'get']);  ?>
    <?= $this->Form->text('q',['value' => isset($_GET["q"]) ? $_GET["q"]: '']);  ?>
    <?= $this->Form->button('Buscar', ['escape' => false,'class' => 'btn btn-primary']);  ?>
	<?= $this->Form->button('Limpiar',['type'=>'reset' ,'class' => 'btn btn-primary']); ?>
    <?= $this->Form->end();  ?>
    
</div>

<table class="table-striped table-bordered table-sm table-hover">
    <thead>
        <tr>
            <th><?= $this->Paginator->sort('id') ?></th>
            <th><?= $this->Paginator->sort('category_id') ?></th>
            <th><?= $this->Paginator->sort('name') ?></th>
            <th><?= $this->Paginator->sort('slug') ?></th>
            <th><?= $this->Paginator->sort('image') ?></th>
            <th><?= $this->Paginator->sort('price') ?></th>
            <th class="actions">Pedir<?php if($this->request->session()->read('Shop')) { echo '&nbsp;(Pedidas)'; } ?> <?php //$this->Paginator->sort('active') ?>
			</th>
            <th class="actions"></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($products as $product): ?>
            <tr>
                <td><?= $this->Number->format($product->id) ?></td>
                <td><span class="category_id" data-value="<?php echo $product->category_id; ?>" data-pk="<?php echo $product->id; ?>"><?php echo $product->category->name; ?></span></td>
                <td><span class="name" data-value="<?php echo $product->name; ?>" data-pk="<?php echo $product->id; ?>"><?php echo $product->name; ?></span></td>
                <td><span class="slug" data-value="<?php echo $product->slug; ?>" data-pk="<?php echo $product->id; ?>"><?php echo $product->slug; ?></span></td>
                <td><?= h($product->image) ?></td>
                <td><span class="price" data-value="<?php echo $product->price; ?>" data-pk="<?php echo $product->id; ?>"><?php echo $product->price; ?></span></td>
                <td class="actions"><span class="actions" data-value="" data-pk=""><?php //echo $this->Html->link($this->Html->image('icon_' . $product->active . '.png'), ['controller' => 'products', 'action' => 'toggle', 'active', $product->id], ['class' => 'toggle', 'escape' => false]); ?>
					<?php echo $this->Form->create(NULL, ['url' => ['controller' => 'products', 'action' => 'add']]); ?>
                    <?php echo $this->Form->text('cantidad', ['class' => 'input_cant' ]); ?>
					<?php if($this->request->session()->read('Shop.Orderproducts.' . $product->id . '_0'.'.quantity')) :   ?>
					<?php echo '(' . $this->request->session()->read('Shop.Orderproducts.' . $product->id . '_0'.'.quantity' ).')'; ?>
					<?php endif; ?>
					</span></td>
                <td class="actions">
                    <?php echo '<div>'; ?>
					<?php echo $this->Form->input('id', ['type' => 'hidden', 'value' => $product->id , 'div' => false]); ?>
					<?php echo $this->Form->button('<i class="fa fa-cart-plus"></i> &nbsp; Agregar al carro', ['class' => 'btn btn-success btn-sm', 'id' => 'addtocart', 'escape' => false, 'div' => false]);?>
					<?php echo '</div>'; ?>
					<?php echo $this->Form->end(); ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<br />

<?php echo $this->element('pagination'); ?>

<br />
<br />


<br />
<br />