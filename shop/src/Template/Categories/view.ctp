<?php
$title_for_layout = $category->name;
$description = $category->name;
$keywords = $category->name;
$this->set(compact('title_for_layout', 'description', 'keywords'));
?>

<?php $this->Html->addCrumb('Shop', ['controller' => 'products', 'action' => 'index', '_full' => true]); ?>
<?php $this->Html->addCrumb('Categories', ['controller' => 'categories', 'action' => 'index', '_full' => true]); ?>
<?php $this->Html->addCrumb($category->name, ['controller' => 'categories', 'action' => 'view', $category->slug, '_full' => true]); ?>

<br />

<h2><?php echo $category->name; ?></h2>

<br />

<div class="row">

    <div class="col-lg-2 col-md-3 col-sm-4 col-5">
        <?php echo $this->element('shopcategories', ['categoryslug' => $category->slug]); ?>
    </div>

    <div class="col-lg-10 col-md-9 col-sm-8 col-7">

        <?php echo $this->Html->image('/images/categories/' . $category->slug . '.jpg', ['fullBase' => true, 'alt' => $category->name, 'class' => 'img-fluid shopimage']); ?>

        <p><?php echo $category->description; ?></p>
        <br />

        <div class="row">
        <?php foreach ($products as $product): ?>
        <div class="col-lg-3 col-md-3 col-sm-4 col-12">
            <div class="card card-default">
                <div class="card-body">
                    <?php echo $this->Html->image('/images/small/' . $product->image, ['fullBase' => true, 'url' => ['controller' => 'products', 'action' => 'view', $product->slug, '_full' => true], 'alt' => $product->name, 'class' => 'img-fluid shopimage']); ?>

                </div>
                <div class="card-footer">
                    <?php echo $this->Html->link($product->name, ['controller' => 'products', 'action' => 'view', $product->slug, '_full' => true]); ?>
                </div>
            </div>
            <br />
        </div>
        <?php endforeach; ?>
        </div>
    </div>
</div>

<br />
<br />
