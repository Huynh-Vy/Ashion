<div class="product_list_new">
    <div class="row">
        <?php while ($row = $products->fetch_assoc()) { ?>
        <div class="col-md-3">
            <div class="item">
                <?=$row['price_sale'] != 0 ? '<div class="sale-info">Sale</div>' : ''?>
                <div class="image">
                    <a href="/san-pham/<?=$row['id']?>/<?=toSlug($row['name'])?>.html" title="<?=$row['name']?>" target="_blank">
                        <img src="<?=$row['thumb']?>" alt="<?=$row['name']?>">
                    </a>
                </div>

                <div class="info">
                    <div class="name">
                        <a href="/san-pham/<?=$row['id']?>/<?=toSlug($row['name'])?>.html" title="<?=$row['name']?>" target="_blank">
                            <?=$row['name']?>
                        </a>
                    </div>

                    <div class="price">
                        <?=Helper::price($row['price'], $row['price_sale'])?>
                    </div>
                </div>
            </div>
        </div>
        <?php } ?>
    </div>
</div>

