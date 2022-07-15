<ul class="theme-sidebar-section-features-list">
    <?php
    $result = $db->query("SELECT * FROM corporate_sidebar WHERE active = 1 ORDER BY so ASC");
    while ($row = mysqli_fetch_assoc($result)) {
        ?>
        <li>
            <h5 class="theme-sidebar-section-features-list-title"><?php echo $row['title'];?></h5>
            <p class="theme-sidebar-section-features-list-body black-text"><?php echo $row['summary'];?></p>
        </li>
        <?php
    }
    ?>
</ul>