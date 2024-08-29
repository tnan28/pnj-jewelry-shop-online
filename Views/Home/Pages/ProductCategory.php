<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
<!-- Google Fonts -->
<link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
<!-- MDB -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.2.0/mdb.min.css" rel="stylesheet" />
<?php

if (!$data['Products']) : ?>
    <p style="text-align: center;color:red; font-weight: 500; font-size: 1.6rem; ">Không có sản phẩm nào</p>
<?php else : ?>

    <div class="product row">
        <?php
        foreach ($data['Products'] as $product) :
        ?>
            <div class="item col-sm-3">
                <div class="img">
                    <a href="../../Detail/ProductId/<?php echo $product['PRODUCTID']; ?>">
                        <img width="300px" src="../../Public/Image/Products/<?php echo $product['IMAGE_1'] ?>" alt="">
                    </a>
                </div>
                <div>
                    <div>
                        <a style="color: black;" href="#"><?php echo $product['PRODUCTNAME']; ?></a>
                    </div>
                    <div>
                        <p class="price"><?php echo number_format($product['PRICE']) . ' ' . "VNĐ"; ?></p>
                    </div>
                </div>
            </div>
        <?php
        endforeach;
        ?>

        <div style="display: flex;
        justify-content: center; margin-top: 10px;">
            <nav aria-label="...">
                <ul class="pagination pagination-circle">
                    <li class="page-item">
                        <a class="page-link  <?php echo $data['CurrentPage'] == 1 ? "disabled" : "" ?>">Previous</a>
                    </li>
                    <?php for ($i = 1; $i <= $data["Pagination"]; $i++) : ?>
                        <li class="page-item <?php echo $i == $data['CurrentPage'] ? "active" : "" ?>"><a class="page-link" href="../../Home/CategoryPage/<?php echo $data['ID'] ?>?page=<?php echo  $i ?>"><?php echo $i ?> </a></li>
                    <?php endfor; ?>
                    <li class="page-item">
                        <a class="page-link <?php echo $data['CurrentPage'] == $data['Pagination'] ? "disabled" : "" ?>" href="../../Home/CategoryPage/<?php echo $data['ID'] ?>?page=<?php echo (int) $data['CurrentPage'] + 1 ?>">Next</a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
<?php endif; ?>