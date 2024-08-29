<?php
session_start();
class CartModel extends ModelBase
{
    public function GetCartItems()
    {
        $result =  isset($_SESSION['cart']) ? $_SESSION['cart'] : [];
        $cartItems = [];
        foreach ($result as $key => $quantity) {
            $query = "SELECT ps.PRICE, s.SizeName, p.IMAGE_1, p.PRODUCTNAME 
                  FROM product_size ps
                  JOIN products p ON ps.PRODUCTID = p.PRODUCTID
                  JOIN size s ON ps.SIZEID = s.SIZEID
                  WHERE ps.PRODUCT_SIZEID = ?";
            $items = $this->Query($query, [$key])->fetchAll(PDO::FETCH_ASSOC);
            foreach ($items as $item) {
                $item['QUANTITY'] = $quantity;
                $item['PRODUCTSIZE'] = $key;
                $cartItems[] = $item;
            }
        }
        return $cartItems;
    }
    public function AddToCart($productSizeId, $quantity = 1)
    {
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }
        if (isset($_SESSION['cart'][$productSizeId])) {
            $_SESSION['cart'][$productSizeId] += $quantity;
        } else {
            $_SESSION['cart'][$productSizeId] = $quantity;
        }
    }
    public function RemoveFromCart($productId)
    {
        if (isset($_SESSION['cart'][$productId])) {
            unset($_SESSION['cart'][$productId]);
        }
    }
    public function UpdateCartItemQuantity($productId, $quantity)
    {
        if (isset($_SESSION['cart'][$productId])) {
            $_SESSION['cart'][$productId] = $quantity;
        }
    }
}
