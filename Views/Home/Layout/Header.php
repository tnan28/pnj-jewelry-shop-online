<?php
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "pnj_shop";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "SELECT c.CATEGORYID, c.CATEGORYNAME, cad.CATEGORY_ATTRIBUTES_DETAILID, cad.CATEGORY_ATTRIBUTES_DETAILNAME, cad.CATEGORY_ATTRIBUTEID, ca.CATEGORY_ATTRIBUTENAME 
            FROM category_attributes_detail AS cad 
            JOIN category_attributes AS ca ON ca.CATEGORY_ATTRIBUTEID = cad.CATEGORY_ATTRIBUTEID 
            JOIN category AS c ON c.CATEGORYID = ca.CATEGORYID";

    $stmt = $conn->query($sql);
    $groupedData = array();

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        if (!isset($groupedData[$row['CATEGORYNAME']])) {
            $groupedData[$row['CATEGORYNAME']] = array(
                'CATEGORYNAME' => $row['CATEGORYNAME'],
                'attributes' => array()
            );
        }
        if (!isset($groupedData[$row['CATEGORYNAME']]['attributes'][$row['CATEGORY_ATTRIBUTENAME']])) {
            $groupedData[$row['CATEGORYNAME']]['attributes'][$row['CATEGORY_ATTRIBUTENAME']] = array(
                'CATEGORY_ATTRIBUTENAME' => $row['CATEGORY_ATTRIBUTENAME'],
                'items' => array()
            );
        }
        $groupedData[$row['CATEGORYNAME']]['attributes'][$row['CATEGORY_ATTRIBUTENAME']]['items'][] = array(
            'CATEGORY_ATTRIBUTES_DETAILID' => $row['CATEGORY_ATTRIBUTES_DETAILID'],
            'CATEGORY_ATTRIBUTES_DETAILNAME' => $row['CATEGORY_ATTRIBUTES_DETAILNAME']
        );
    }
} catch (PDOException $e) {
    echo "Lỗi kết nối: " . $e->getMessage();
}
?>
<header class="header_home-main">
    <div class="container">
        <div class="header_top">
            <div class="header_top-left">
                <div>
                    <span><i class="fa-solid fa-headphones"></i></span>
                    <span>0971758902</span>
                </div>
            </div>
            <div class="header_top-middle">
                <div>
                    <a href="../../Home/index/"><img src="../../Public/Image/Common/logo.png" alt="abc" /></a>
                </div>
            </div>
            <div class="header_top-right">
                <div>
                    <span><i class="fa-regular fa-user"></i></span>
                    <a href="../../Customer/Login/">
                        <span style="color: black;">Tài khoản của tôi</span>
                    </a>
                </div>
                <div>
                    <a href="../../Cart/index/">
                        <span style="color: black;"><i class="fa-solid fa-cart-shopping"></i></span>
                        <span style="color: black;">Giỏ hàng</span>
                    </a>
                </div>
            </div>
        </div>
        <div class="header_bot">
            <?php
            foreach ($groupedData as $category) : ?>
                <div class='Category'>
                    <p><?php echo ($category['CATEGORYNAME']) ?></p>
                    <div>
                        <?php
                        foreach ($category['attributes'] as $attribute) :
                        ?>
                            <ul style="padding-left: 0;">
                                <li><?php echo ($attribute['CATEGORY_ATTRIBUTENAME']) ?></li>
                                <?php
                                foreach ($attribute['items'] as $item) : ?>
                                    <a style="color: black;" href="../Category/<?php echo $item['CATEGORY_ATTRIBUTES_DETAILID'] ?>">
                                        <li class="choiceHeader"><?php echo ($item['CATEGORY_ATTRIBUTES_DETAILNAME']) ?></li>
                                    </a>
                                <?php endforeach; ?>
                            </ul>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endforeach; ?>
            <div class="search">
                <input id="Search_input" pattern="[a-zA-Z]+" title="Chỉ chấp nhận ký tự chữ" type="text" placeholder="Tìm kiếm trang sức" />
            </div>

        </div>
    </div>
</header>
<style>
    .choiceHeader:hover {
        color: red;
    }
</style>