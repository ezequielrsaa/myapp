<?php
$title_for_layout = $product->name;
$description = $product->name;
$keywords = $product->name;
$this->set(compact('title_for_layout', 'description', 'keywords'));
?>

<?php $this->Html->addCrumb('Shop', ['controller' => 'products', 'action' => 'index', '_full' => true]); ?>
<?php $this->Html->addCrumb($product->category->name, ['controller' => 'categories', 'action' => 'view', $product->category->slug, '_full' => true]); ?>
<?php $this->Html->addCrumb($product->name, ['controller' => 'products', 'action' => 'view', $product->slug, '_full' => true]); ?>

<br />
<br />

<div itemscope itemtype="http://schema.org/Product">
    <h1 itemprop="name"><?php echo $product->name; ?></h1>
    <div class="row">
        <div class="col-md-6 col-sm-12">
            <?php echo $this->Html->image('/images/large/' . $product->image, ['class' => 'img-fluid img-thumbnail', 'alt' => $product->name, 'itemprop' => 'image']); ?>
            <br />
            <br />
        </div>
        <div class="col-md-6 col-sm-12">

            <?php echo $this->Form->create(NULL, ['url' => ['controller' => 'products', 'action' => 'add']]); ?>
            <?php echo $this->Form->input('id', ['type' => 'hidden', 'value' => $product->id]); ?>

            <?php // print_r($productoptions); ?>

            <?php if(!empty($productoptionlists)): ?>
                <div class="row">
                    <div class="col-sm-12">
                        <?php if(!empty($productoptions)): ?>
                            <?php echo $this->Form->input('productoptionlist', ['label' => false, 'class' => 'form-control']); ?>
                        <?php endif; ?>
                    </div>
                </div>
                <br />
                <input type="hidden" id="modselected" value="" />

            <?php endif;?>

            <div itemprop="offers" itemscope itemtype="http://schema.org/Offer">

            <strong><span itemprop="priceCurrency" id="pricecurrency" content="USD">$</span><span id="price" itemprop="price" content="<?php echo number_format($product->price, 2); ?>"><?php echo number_format($product->price, 2); ?></span></strong>

            <link itemprop="availability" href="http://schema.org/InStock" />

            </div>

            <br />

            <?php echo $this->Form->button('<i class="fa fa-cart-plus"></i> &nbsp; Add to Cart', ['class' => 'btn btn-success btn-sm', 'id' => 'addtocart', 'escape' => false]);?>
            <?php echo $this->Form->end(); ?>

            <br />

            <span itemprop="description"><?php echo $product->description; ?></span>

            <br />
            <br />

            <small>Category: <?php echo $this->Html->link($product->category->name, ['controller' => 'categories',  'action' => 'view', $product->category->slug]); ?></small>

            <br />
            <br />

            <small><?php echo $product->name; ?></small>

            <br />
            <br />

        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <small>

            <?php if(!empty($productoptionlists)): ?>

            <table class="table-bordered table-condensed table-hover">
            <?php foreach($productoptionlists as $key => $value): ?>
            <tr>
                <td>
                    <?php echo $this->Form->create(NULL, ['url' => ['controller' => 'products', 'action' => 'add']]); ?>
                    <?php echo $this->Form->input('id', ['type' => 'hidden', 'value' => $product->id]); ?>
                    <?php echo $this->Form->input('productoptionlist', ['type' => 'hidden', 'value' => $key]); ?>
                    <?php echo $value; ?>
                </td>
                <td>
                    <?php echo $this->Form->button('<i class="fa fa-cart-plus"></i> &nbsp; Add to Cart', ['class' => 'btn btn-success btn-xs', 'id' => 'addtocart', 'escape' => false]);?>
                    <?php echo $this->Form->end(); ?>
                </td>
            </tr>
            <?php endforeach; ?>
            </table>
            <?php endif; ?>

            </small>
        </div>
    </div>
</div>

<input type="hidden" id="product_price" name="product_price" value="<?php echo sprintf('%01.2f', $product->price); ?>" />

<br />