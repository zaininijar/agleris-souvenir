<?php require_once 'layouts/header.php' ?>
<?php

$sql = "SELECT * FROM souvenirs";
$result = $conn->query($sql);

?>
<section>
  <h2 class="title-section">Poppular Products</h2>
  <div class="grid-poppular-product">
    <?php if ($result->num_rows > 0) : ?>
      <?php while ($row = $result->fetch_assoc()) : ?>
        <div class="card">
          <div class="card-body">
            <img src="<?= $base_url . 'images/souvenir/' . $row['picture_path'] ?>" alt="" />
          </div>
          <div class="card-footer">
            <div>
              <div class="card-title"><?= $row["name"] ?></div>
              <div class="card-desc">
                <?= $row["description"] ?>
              </div>
            </div>
            <div class="card-price">Rp<?= $row['price'] ?></div>
            <a class="card-button" href="souvenir?id=<?= $row['id'] ?>">Get Now</a>
          </div>
        </div>
      <?php endwhile; ?>
    <?php endif; ?>
  </div>
  <div class="button-container">
    <a class="btn btn-primary" href="souvenir.html">Show More</a>
  </div>
</section>
<?php $conn->close(); ?>
<?php require_once 'layouts/footer.php' ?>