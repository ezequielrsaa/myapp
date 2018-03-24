<?php
$title_for_layout = 'Product Categories';
$description = 'Product Categories';
$keywords = 'Product Categories';
$this->set(compact('title_for_layout', 'description', 'keywords'));
?>

<h3>Categories</h3>

<div class="row">
    <?php foreach ($categories as $category): ?>
        <div class="col-lg-2 col-md-3 col-sm-4 col-6">
            <div class="card card-default">
                <div class="card-body">
                    <?php echo $this->Html->image('/images/categories/' . $category->slug . '.jpg', ['fullBase' => true, 'url' => ['controller' => 'categories', 'action' => 'view', $category->slug, '_full' => true], 'alt' => $category->name, 'class' => 'img-responsive shopimage']); ?>

                </div>
                <div class="card-footer">
                    <small>
                    <?php echo $this->Html->link($category->name, ['controller' => 'categories', 'action' => 'view', $category->slug, '_full' => true], ['title' => $category->name]); ?>
                    </small>
                </div>
            </div>
            <br />
        </div>
    <?php endforeach; ?>
</div>

<br />
<br />
