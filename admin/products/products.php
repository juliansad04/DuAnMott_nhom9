<?php

class Product
{
    var $id = null;
    var $name = null;
    var $description = null;
    var $price = null;
    var $image = null;

    var $category = null;

    function getProducts()
    {
        $db = new connect();
        $select = "SELECT * FROM products";
        return $db->pdo_query($select);
    }

    public function checkProduct($id, $name)
    {
        $db = new connect();
        $select = "SELECT * FROM products WHERE id='$id' AND name='$name'";
        $result = $db->pdo_query_one($select);
        return $result !== null;
    }

    public function getProductById($productId)
    {
        $db = new connect();
        $select = "SELECT * FROM products WHERE id=?";
        $result = $db->pdo_query_one($select, $productId);
        return $result;
    }
    function insertProduct($name, $description, $price, $image, $categoryId)
    {
        $db = new connect();
        $query = "INSERT INTO products (name, description, price, image, category_id) VALUES (?, ?, ?, ?, ?)";
        $newProductId = $db->pdo_execute($query, $name, $description, $price, $image, $categoryId);
        echo "Inserted product with ID: " . $newProductId;
    }

    function updateProduct($tmpId, $tmpName, $tmpDescription, $tmpPrice, $tmpImage, $categoryId)
    {
        $db = new connect();

        if (!empty($tmpImage)) {
            $query = "UPDATE products SET name=?, description=?, price=?, image=?, category_id=? WHERE id=?";
            $db->pdo_execute($query, $tmpName, $tmpDescription, $tmpPrice, $tmpImage, $categoryId, $tmpId);

            $upload_dir = './uploads/';
            move_uploaded_file($tmpImage, $upload_dir . $tmpImage);
        } else {
            $query = "UPDATE products SET name=?, description=?, price=?, category_id=? WHERE id=?";
            $db->pdo_execute($query, $tmpName, $tmpDescription, $tmpPrice, $categoryId, $tmpId);
        }
    }

    public function calculateTotalPrice($quantity, $price)
    {
        return $quantity * $price;
    }

    public function getProductsByCategory($categoryId)
    {
        $db = new connect();
        $select = "SELECT * FROM products WHERE category_id=?";
        return $db->pdo_query($select, $categoryId);
    }


    function deleteProduct($id)
    {
        $db = new connect();
        $query = "DELETE FROM products WHERE id=?";
        $db->pdo_execute($query, $id);
    }

    public function getProductCount()
    {
        $db = new Connect();
        $select = "SELECT COUNT(*) as product_count FROM products";
        $result = $db->pdo_query_one($select);

        return $result ? $result['product_count'] : 0;
    }

    public function searchProductByName($partialName)
    {
        $db = new connect();
        $select = "SELECT * FROM products WHERE name LIKE ?";
        $partialName = '%' . $partialName . '%';
        return $db->pdo_query($select, $partialName);
    }
}
?>