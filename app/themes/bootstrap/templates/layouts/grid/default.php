<div class="container">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-xs-12">
            <?php
                $item = array(
                'size' => $data['columns'],
                'details' => array(
                'name' => "Example Item",
                'image' => "http://placehold.it/300x300/BBBBBB/EEEEEE&text=Grid+Item",
                'url' => "#")
                );

                for ($i=0; $i<$data['count']; $i++) {
                    echo Erdiko::getView('examples/grid/item', $item);
                }
            ?>
        </div>
    </div>
</div>

