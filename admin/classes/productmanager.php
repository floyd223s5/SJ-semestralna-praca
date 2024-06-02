<?php
class ProductManager {
    private $db;

    public function __construct(Database $db) {
        $this->db = $db;
    }

    public function handlePostRequest() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (isset($_POST['edit_submit'])) {
                $this->editProduct();
            } elseif (isset($_POST['delete_id'])) {
                $this->deleteProduct();
            } elseif (isset($_POST['add_submit'])) {
                $this->addProduct();
            }
        }
    }

    private function editProduct() {
        $id = $_POST['id'];
        $name = $_POST['name'];
        $img_path = $_POST['img_path'];
        $price = isset($_POST['price']) && trim($_POST['price']) !== '' ? number_format(floatval($_POST['price']), 2) : null;
        $download_link = $_POST['download_link'];
        $sale_price = isset($_POST['sale_price']) && trim($_POST['sale_price']) !== '' ? number_format(floatval($_POST['sale_price']), 2) : null;

        $updateSql = "UPDATE products SET name=?, img_path=?, price=?, sale_price=?, download_link=? WHERE id=?";
        $stmt = $this->db->getConn()->prepare($updateSql);
        $stmt->bind_param("ssddsi", $name, $img_path, $price, $sale_price, $download_link, $id);

        if ($stmt->execute()) {
            echo "Record updated successfully";
        } else {
            echo "Error updating record: " . $stmt->error;
        }

        $stmt->close();
    }

    private function deleteProduct() {
        $delete_id = $_POST['delete_id'];
        $deleteSql = "DELETE FROM products WHERE id=?";
        $stmt = $this->db->getConn()->prepare($deleteSql);
        $stmt->bind_param("i", $delete_id);

        if ($stmt->execute()) {
            echo "Record deleted successfully";
        } else {
            echo "Error deleting record: " . $stmt->error;
        }

        $stmt->close();
    }

    private function addProduct() {
        $name = $_POST['add_name'];
        $img_path = $_POST['add_img_path'];
        $price = $_POST['add_price'];
        $sale_price = isset($_POST['add_sale_price']) ? $_POST['add_sale_price'] : null;

        $insertSql = "INSERT INTO products (name, img_path, price, sale_price) VALUES (?, ?, ?, ?)";
        $stmt = $this->db->getConn()->prepare($insertSql);
        $stmt->bind_param("ssdd", $name, $img_path, $price, $sale_price);

        if ($stmt->execute()) {
            echo "Record added successfully";
        } else {
            echo "Error adding record: " . $stmt->error;
        }

        header("Location: products.php");
        exit();
    }

    public function renderProductList() {
        $sql = "SELECT * FROM products";
        $result = $this->db->query($sql);

        echo '<div class="container">
            <table class="table table-bordered shadow">
                <tr>
                    <th>ID</th>
                    <th>Názov</th>
                    <th>Cesta k obrázku</th>
                    <th>Cena</th>
                    <th>Zľavnená cena</th>
                </tr>';

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>{$row['id']}</td>
                        <td>{$row['name']}</td>
                        <td>{$row['img_path']}</td>
                        <td>{$row['price']} €</td>
                        <td>{$row['sale_price']} €</td>
                        <td>
                            <button type='button' class='btn btn-primary' data-bs-toggle='modal' data-bs-target='#editModal{$row['id']}'>
                                <i class='fa-solid fa-pen-to-square'></i>
                            </button>
                            
                            <div class='modal fade' id='editModal{$row['id']}' tabindex='-1' role='dialog' aria-labelledby='editModalLabel' aria-hidden='true'>
                                <div class='modal-dialog' role='document'>
                                    <div class='modal-content'>
                                        <div class='modal-header'>
                                            <h5 class='modal-title' id='editModalLabel'>Upraviť produkt - {$row['name']}</h5>
                                        </div>
                                        <div class='modal-body'>
                                            <form method='post' action=''>
                                                <input type='hidden' name='id' value='{$row['id']}'>
                                                <div class='form-group'>
                                                    <label for='name'>Názov:</label>
                                                    <input type='text' class='form-control' name='name' value='{$row['name']}'>
                                                </div>
                                                <div class='form-group'>
                                                    <label for='img_path'>Cesta k obrázku:</label>
                                                    <input type='text' class='form-control' name='img_path' value='{$row['img_path']}'>
                                                </div>
                                                <div class='form-group'>
                                                    <label for='price'>Cena:</label>
                                                    <input type='number' class='form-control' name='price' step='any' value='{$row['price']}'>
                                                </div>
                                                <div class='form-group'>
                                                    <label for='sale_price'>Zľavnená cena:</label>
                                                    <input type='number' class='form-control' name='sale_price' step='any' value='{$row['sale_price']}'>
                                                </div>
                                                <div class='form-group'>
                                                    <label for='download_link'>Download Link:</label>
                                                    <input type='text' class='form-control' name='download_link' value='{$row['download_link']}'>
                                                </div>
                                                <br>
                                                <button type='submit' class='btn btn-primary' name='edit_submit'><i class='fa-solid fa-floppy-disk'></i></button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button type='button' class='btn btn-danger' data-bs-toggle='modal' data-bs-target='#deleteModal{$row['id']}'>
                                <i class='fa-solid fa-trash'></i>
                            </button>

                            <div class='modal fade' id='deleteModal{$row['id']}' tabindex='-1' role='dialog' aria-labelledby='deleteModalLabel' aria-hidden='true'>
                                <div class='modal-dialog' role='document'>
                                    <div class='modal-content'>
                                        <div class='modal-header'>
                                            <h5 class='modal-title' id='deleteModalLabel'>Vymazať</h5>
                                        </div>
                                        <div class='modal-body'>
                                            <form method='post' action='' id='deleteForm{$row['id']}'>
                                                <input type='hidden' name='delete_id' value='{$row['id']}'>
                                                <p>Chcete vymazať túto položku ?</p>
                                                <br>
                                                <button type='button' class='btn btn-danger' onclick='document.getElementById(\"deleteForm{$row['id']}\").submit();'>Delete</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                      </tr>";
            }
        } else {
            echo "<tr><td colspan='6'>Žiadne data sa nenašli</tr>";
        }

        echo '<tr>
            <td colspan="6">
                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addModal">
                    <i class="fa-solid fa-plus"></i>
                </button>
            </td>
        </tr>
        </table>
        </div>
        <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addModalLabel">Pridať</h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="post" action="">
                            <div class="form-group">
                                <label for="add_name">Názov:</label>
                                <input type="text" class="form-control" name="add_name" required>
                            </div>
                            <div class="form-group">
                                <label for="add_img_path">Cesta k obrázku:</label>
                                <input type="text" class="form-control" name="add_img_path" required>
                            </div>
                            <div class="form-group">
                                <label for="add_price">Cena:</label>
                                <input type="number" class="form-control" name="add_price" required>
                            </div>
                            <div class="form-group">
                                <label for="add_sale_price">Zľavnená cena:</label>
                                <input type="number" class="form-control" name="add_sale_price">
                            </div>
                            <br>
                            <button type="submit" class="btn btn-success" name="add_submit">Pridať</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>';
    }
}
?>
