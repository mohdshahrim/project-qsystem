<div class="w3-container">
    <h1>Sites or Offices</h1>

    <div>
        <a href="/fragment/site/new" class="w3-button w3-asphalt w3-round">new site</a>
    </div>

    <br>

    <div class="w3-grid" style="grid-template-columns: repeat(auto-fill, 250px); column-gap: 20px;">
        <?php foreach($sites as $key=>$row): ?>
            <a href="/fragment/site/<?= $row['id'] ?>" class="w3-border w3-white w3-padding w3-round text-decoration-none">
                <h3><?= $row['site_id'] ?></h3>
                <p><?= $row['site_name'] ?></p>
            </a>
        <?php endforeach ?>
    </div>
</div>