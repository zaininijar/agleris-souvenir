<?php

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add-souvenir'])) {
    $souvenir_id = mt_rand(00000000, 99999999);

    if ($_FILES["picture"]['error'] > 0) {
        echo "<script>alert('Insert Picture')</script>";
        echo "<meta http-equiv='Refresh' content='0'>";
        return false;
    }

    $targetDirectory = "images/souvenir/";
    $targetFile = basename($_FILES["picture"]["name"]);
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    if ($_FILES["picture"]["size"] > 1000000) {
        echo "<script>alert('Maaf, berkas terlalu besar.')</script>";
        echo "<meta http-equiv='Refresh' content='0'>";
        return false;
    }

    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif") {
        echo "<script>alert('Maaf, hanya tipe berkas JPG, JPEG, PNG, dan GIF yang diizinkan.')</script>";
        echo "<meta http-equiv='Refresh' content='0'>";
        return false;
    }

    if (move_uploaded_file($_FILES["picture"]["tmp_name"], $targetDirectory . $targetFile)) {

        $id = $souvenir_id;
        $name = $_POST['name'];
        $description = $_POST['description'];
        $unit = $_POST['unit'];
        $price = $_POST['price'];
        $picture_path = $targetFile;

        $sql = "INSERT INTO souvenirs (id, name, description, unit, price, picture_path) VALUES ('$id', '$name', '$description', '$unit', '$price', '$picture_path')";

        if ($conn->query($sql) === true) {
            echo "<script>alert('Souvenir berhasil ditambahkan.')</script>";
            echo "<script>alert('Berkas " . basename($_FILES["picture"]["name"]) . " berhasil diunggah.')</script>";
            echo "<meta http-equiv='Refresh' content='0'>";
            return false;
        }

    } else {
        echo "<script>alert('Terjadi kesalahan saat mengunggah berkas.')</>";
        echo "<meta http-equiv='Refresh' content='0'>";
        return false;
    }

}

?>

<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12 grid-margin">
            <div class="d-flex justify-content-between flex-wrap">
                <div class="d-flex align-items-end flex-wrap">
                    <div class="me-md-3 me-xl-5">
                        <h2>Souvenir</h2>
                        <p class="mb-md-0">List Souvenir</p>
                    </div>
                    <div class="d-flex">
                        <i class="mdi mdi-home text-muted hover-cursor"></i>
                        <p class="text-muted mb-0 hover-cursor">&nbsp;/&nbsp;Dashboard&nbsp;/&nbsp;</p>
                        <p class="text-primary mb-0 hover-cursor">Souvenir&nbsp;/&nbsp;Add</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12 stretch-card">
            <div class="card">
                <div class="card-body">
                    <p class="card-title">Form Add Souvenir</p>
                    <div class="table-responsive">
                        <form class="forms-sample" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="exampleInputName1">Name</label>
                                <input required type="text" name="name" class="form-control" id="exampleInputName1"
                                    placeholder="Name">
                            </div>
                            <div class="form-group">
                                <label for="exampleDescription1">Description</label>
                                <textarea required name="description" class="form-control" id="exampleDescription1"
                                    rows="4"></textarea>
                            </div>
                            <div class="form-group">
                                <label>Picture</label>
                                <input type="file" name="img[]" class="file-upload-default">
                                <div class="input-group col-xs-12">
                                    <input required type="file" name="picture" class="form-control file-upload-info"
                                        placeholder="Upload Image">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputUnit1">Unit</label>
                                <input required type="number" name="unit" class="form-control" id="exampleInputUnit1"
                                    placeholder="Unit">
                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">IDR</span>
                                    </div>
                                    <input required type="number" placeholder="12000" name="price" class="form-control"
                                        aria-label="Amount (to the nearest dollar)">
                                </div>
                            </div>
                            <button type="submit" name="add-souvenir" class="btn btn-primary me-2">Submit</button>
                            <button class="btn btn-light" type="reset">Cancel</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $conn->close(); ?>