<?php
include '../lib/database.php';
include '../helpers/format.php';

?>

<?php
class category
{

    private $db;
    private $fm;

    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
    }
    public function insert_category($categoryName)
    {
        $categoryName = $this->fm->validation($categoryName);

        $categoryName = mysqli_real_escape_string($this->db->link, $categoryName);

        if (empty($categoryName)) {
            $alert = "<span class='error'>category name must be not empty</span>";
            return $alert;
        } else {
            $query = "INSERT INTO tbl_category (categoryName) VALUE ('$categoryName') ";
            $result = $this->db->insert($query);
            if ($result) {
                $alert = "<span class='success'>Insert category successfully</span>";
                return $alert;
            } else {
                $alert = "<span class='error'>Insert category not success</span>";
                return $alert;
            }
        }
    }
    public function show_category()
    {
        $query = "SELECT * FROM tbl_category ORDER BY categoryId DESC ";
        $result = $this->db->select($query);
        return $result;
    }

    public function getcategorybyid($id)
    {
        $query = "SELECT * FROM tbl_category WHERE categoryId = '$id' ";
        $result = $this->db->select($query);
        return $result;
    }
    public function deletecategory($id)
    {
        $query = "DELETE  FROM tbl_category WHERE categoryId = '$id' ";
        $result = $this->db->delete($query);
        return $result;
        if ($result) {
            $alert = "<span class='success'>delete category successfully</span>";
            return $alert;
        } else {
            $alert = "<span class='error'>delete category not success</span>";
            return $alert;
        }
    }
    public function update_category($id,$categoryName)
    {
        $categoryName = $this->fm->validation($categoryName);
        $categoryName = mysqli_real_escape_string($this->db->link, $categoryName);
        $id = mysqli_real_escape_string($this->db->link, $id);

        if (empty($categoryName)) {
            $alert = "<span class='error'>category name must be not empty</span>";
            return $alert;
        } else {
            $query = "UPDATE tbl_category SET categoryName = '$categoryName' WHERE categoryId = '$id'";
            $result = $this->db->update($query);
            if ($result) {
                $alert = "<span class='success'>update category successfully</span>";
                return $alert;
            } else {
                $alert = "<span class='error'>update category not success</span>";
                return $alert;
            }
        }
    }
}
?>