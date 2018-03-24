<nav aria-label="Page navigation">
    <ul class="pagination pagination-sm">
        <?php

        $this->Paginator->templates([
            'first' => '<li class="page-item"><a class="page-link" href="{{url}}">{{text}}</a></li>'
        ]);

        $this->Paginator->templates([
            'last' => '<li class="page-item"><a class="page-link" href="{{url}}">{{text}}</a></li>'
        ]);

        $this->Paginator->templates([
            'number' => '<li class="page-item"><a class="page-link" href="{{url}}">{{text}}</a></li>'
        ]);

        $this->Paginator->templates([
            'current' => '<li class="page-item active"><a class="page-link" href="{{url}}">{{text}}</a></li>'
        ]);

        $this->Paginator->templates([
            'ellipsis' => '<li class="page-item disabled"><a class="page-link" href="{{url}}">...</a></li>'
        ]);

        $this->Paginator->templates([
            'prevActive' => '<li class="page-item"><a class="page-link" href="{{url}}">{{text}}</a></li>'
        ]);

        $this->Paginator->templates([
            'prevDisabled' => '<li class="page-item disabled"><a class="page-link" href="{{url}}">{{text}}</a></li>'
        ]);

        $this->Paginator->templates([
            'nextActive' => '<li class="page-item"><a class="page-link" href="{{url}}">{{text}}</a></li>'
        ]);

        $this->Paginator->templates([
            'nextDisabled' => '<li class="page-item disabled"><a class="page-link" href="{{url}}">{{text}}</a></li>'
        ]);

        ?>

        <?php echo $this->Paginator->first('<< First'); ?>
        <?php echo $this->Paginator->prev('< Prev'); ?>
        <?php echo $this->Paginator->numbers(['last' => 1]); ?>
        <?php echo $this->Paginator->next('Next >'); ?>
        <?php echo $this->Paginator->last('Last >>'); ?>

    </ul>
</nav>

<p><?= $this->Paginator->counter('P&aacute;g. {{page}} de {{pages}}, mostrando {{current}} elementos de {{count}} en total, empezando desde el nro. {{start}}, y terminando en el nro. {{end}}'); ?></p>
