<!-- Footer -->
<div id ="footer">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <?php
				include "config.php";

				$sql = mysqli_query($con,"SELECT * FROM settings");

				if(mysqli_num_rows($sql) > 0){
					while($row = mysqli_fetch_assoc($sql)) {
						?>
						<span><?php echo $row['footerdesc']; ?></span>
						<?php
					}
				}
				?>
            </div>
        </div>
    </div>
</div>
<!-- /Footer -->
</body>
</html>
