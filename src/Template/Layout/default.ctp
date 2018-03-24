<!doctype html>
<html dir="ltr" lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title><?php echo !isset($title_for_layout) ? '' : $title_for_layout ; ?></title>
<meta name="description" content="<?php echo empty($description) ? '' : $description ; ?>" />
<meta name="keywords" content="<?php echo empty($keywords) ? '' : $keywords ; ?>" />
<meta property="og:title" content="<?php echo !isset($title_for_layout) ? '' : $title_for_layout ; ?>">
<meta property="og:description" content="<?php echo !isset($description) ? '' : $description ; ?>">
<meta property="og:url" content="<?php //echo Router::url( $this->here, true ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
<link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="/css/bootstrap.min.css" />
<link rel="stylesheet" href="/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="/css/css.css" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="/js/bootstrap.bundle.min.js"></script>
<script type="text/javascript" src="/js/js.js"></script>
<?php echo $this->fetch('css'); ?>
<?php echo $this->fetch('script'); ?>

</head>
<body>

    <nav class="navbar navbar-expand-md navbar-dark bg-dark1" style="background-color: #333;">
        <div class="container">
            <a class="navbar-brand" href="#">CakePHP 3 Shopping Cart</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarsExampleDefault">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item"><?php echo $this->Html->link('Home', ['controller' => 'products', 'action' => 'index', '_full' => true], ['class' => 'nav-link']); ?></li>
                    <li class="nav-item"><?php echo $this->Html->link('Categories', ['controller' => 'categories', 'action' => 'index', '_full' => true], ['class' => 'nav-link']); ?></li>
                </ul>
                <form class="form-inline my-2 my-lg-0">
                <?php if($this->request->session()->read('Shop')) : ?>
                    <a href="/cart" class="btn btn-secondary btn-sm my-2 my-sm-0""><i class="fa fa-cart-plus"></i> &nbsp; Shopping Cart (<span id="quantitybutton"><?php echo $this->request->session()->read('Shop.Order.quantity'); ?></span>)</a>
                <?php endif; ?>
                </form>
            </div>
        </div>
    </nav>

    <div class="main">
        <div class="container">
            <?= $this->Flash->render(); ?>
            <?php echo $this->Html->getCrumbs('&nbsp;/&nbsp;', '', ['class' => 'breadcr1umb']); ?>
            <?php echo $this->fetch('content'); ?>
            <br />
            <br />
        </div>
    </div>

    <div class="red py-1">
        <div class="container">
            <div class="whitetext">
                <small>CakePHP 3 Shopping Cart</small>
            </div>
        </div>
    </div>

    <div class="footer">
        <div class="container">
            <div class="row">
                <div class="col-sm-4">
                    CakePHP 3 Shopping Cart
                    <br />
                </div>
                <div class="col-sm-4">
                    <br />
                    <br />
                </div>
                <div class="col-sm-4">
                    <div class="pull-right text-right">
                    &copy; <?php echo date('Y'); ?> <?php echo env('HTTP_HOST'); ?></small>
                    <br />
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
</html>