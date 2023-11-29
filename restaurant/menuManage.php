<div class="container-fluid" style="margin-top:98px">
	<div class="col-lg-12">
		<div class="row">

			<!-- FORM Panel -->
			<div class="col-md-4">
				<form action="pageComponents/_menu.php" method="post" enctype="multipart/form-data">
					<div class="card mb-3">
						<div class="card-header" style="background-color: rgb(111 202 203);">
							Add New Food
						</div>
						<div class="card-body">

							<div class="form-group">
								<b><label class="control-label">Food Name: </label></b>
								<input type="text" class="form-control" name="name" required>
							</div>

							<div class="form-group mb-3">
								<b><label for="foodType" class="form-label">Food Type:</label></b>
								<select name="foodType" class="form-control mb-3">
								<optgroup label="Food Type">

    									<optgroup label="Drinks & Complementary">
    										<option value="drinks">Drinks</option>
    										<option value="shakes">Shakes</option>
    										<option value="complements">Complements</option>
										</optgroup>
    
    									<optgroup label="Fast Food">
    										<option value="burger">Burger</option>
    										<option value="pizza">Pizza</option>
    										<option value="fries">Fries</option>
    										<option value="wings">Wings</option>
										</optgroup>
    
    
    									<optgroup label="Continental">
    										<option value="french">French Cuisine</option>
    										<option value="spanish">Spanish Cuisine</option>
    										<option value="italian">Italian Cuisine</option>
										</optgroup>
    
    									<optgroup label="Asian">
    										<option value="rice">Rice</option>
    										<option value="meat">Meat Dish</option>
    										<option value="noodles">Noodle</option>
    										<option value="salad">Salad</option>
										</optgroup>
    
    
    									<optgroup label="Indian">
    										<option value="biryani">Biryani</option>
    										<option value="chicken">Chicken</option>
    										<option value="mutton">Mutton</option>
    										<option value="fish">Fish</option>
    										<option value="rice">Rice</option>
    										<option value="bread">Bread</option>
										</optgroup>
    
    									<optgroup label="Bangla">
    										<option value="Rice">Rice</option>
    										<option value="chicken">Chicken</option>
    										<option value="beef">Beef</option>
    										<option value="mutton">Mutton</option>
    										<option value="fish">Fish</option>
    										<option value="bread">Bread</option>
    										<option value="biryani">Biryani</option>
    										<option value="complements">Complements</option>
										</optgroup>
    
    									<optgroup label="Others">
    										<option value="streetside">Street Side</option>
    										<option value="buffet">Buffet</option>
    					
										</optgroup>
									</optgroup>
								</select>
							</div>


							<div class="form-group">
								<b><label class="control-label">Price</label></b>
								<input type="number" class="form-control" name="price" required min="1">
							</div>

							<div class="form-group">
								<b><label class="control-label">Description: </label></b>
								<textarea cols="30" rows="3" class="form-control" name="description" required></textarea>
							</div>



							<div class="form-group">
								<b><label for="image" class="control-label">Image</label></b>
								<input type="file" name="image" id="image" accept=".jpg" class="form-control" required style="border:none;">
								<small id="Info" class="form-text text-muted mx-3">Please Upload .jpg file</small>
							</div>
						</div>

						<div class="card-footer">
							<div class="row">
								<div class="mx-auto">
									<button type="submit" name="addtoMenu" class="btn btn-sm btn-primary d-flex w-100 justify-content-center"> Add to Menu </button>
								</div>
							</div>
						</div>
					</div>
				</form>
			</div>
			<!-- FORM Panel -->

			<!-- Table Panel -->

			<div class="col-md-8">
				<div class="card">
					<div class="card-body">
						<div class="table-responsive">
							<table class="table table-bordered table-hover mb-0">
								<thead style="background-color: rgb(111 202 203);">
									<tr>
										
										<th class="text-center">Food Image</th>
										<th class="text-center">Food Details</th>
										<th class="text-center">Food Description</th>
										<th class="text-center">Action</th>
									</tr>
								</thead>
								<tbody>
									<?php
									if (isset($_SESSION['rest_id'])) {
										
									$restaurantId = $_SESSION['rest_id'];

									$sql = "SELECT * FROM `menu` WHERE ResId = '$restaurantId'";
									$result = mysqli_query($conn, $sql);
									while ($row = mysqli_fetch_assoc($result)) {
										$foodId = $row['food_Id'];
										$foodName = $row['food_name'];
										$foodCat = $row['category'];
										$foodPrice = $row['price'];
										$foodDesc = $row['description'];

										echo '<tr>
										         <td><img src="/anao_main/restaurant/images/food-' . $foodId . '.jpg" alt="image for this food" class="img-fluid" style="max-width: 150px; height: 150px;"></td>
                                                  
												  <td>
                                                      <p>Food Name : <b>' . $foodName . '</b></p>
                                                      <p class="text-capitalize">Category : <b class="truncate">' . $foodCat . '</b></p>
                                                      <p>Price : <b class="truncate">' . $foodPrice . '</b></p>       
                                                 </td>
												 
	
                                                  <td><p><b>Description:</b> ' . $foodDesc . '</p></td>
                                                      
												  <td class="text-center">
												  <div class="row mx-auto" justify-content-center align-foods-center style="width:120px">
													  <button class="btn btn-sm btn-primary m-0" type="button" data-toggle="modal" data-target="#updateFood' . $foodId . '">Edit</button>
													  <form action="pageComponents/_menu.php" class="m-0" method="POST">
														  <button name="removeFood" class="btn btn-sm btn-danger" style="margin-left:9px;">Delete</button>
														  <input type="hidden" name="foodId" value="' . $foodId . '">
													  </form>
												  </div>
											  </td>';
									}
								}
									?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>

			<!-- Table Panel -->
		</div>
	</div>
</div>



<?php


$restaurantId = $_SESSION['rest_id'];

$menusql = "SELECT * FROM `menu` WHERE ResId = '$restaurantId'";

$menuResult = mysqli_query($conn, $menusql);
while ($menuRow = mysqli_fetch_assoc($menuResult)) {
	$foodId = $menuRow['food_Id'];
	$foodName = $menuRow['food_name'];
	$foodCat = $menuRow['category'];
	$foodPrice = $menuRow['price'];
	$foodDesc = $menuRow['description'];
?>

	<!-- Modal -->
	<div class="modal fade" id="updateFood<?php echo $foodId; ?>" tabindex="-1" role="dialog" aria-labelledby="updateFood<?php echo $foodId; ?>" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header" style="background-color: rgb(111 202 203);">
					<h5 class="modal-title" id="updateFood<?php echo $foodId; ?>">food: <?php echo $foodName; ?></h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>

				<div class="modal-body">
					<form action="pageComponents/_menu.php" method="post" enctype="multipart/form-data">
						<div class="text-left my-2 row" style="border-bottom: 2px solid #dee2e6;">
							<div class="form-group col-md-8">
								<b><label for="image">Image</label></b>
								<input type="file" name="foodImage" id="foodImage" accept=".jpg" class="form-control" required style="border:none;" onchange="document.getElementById('foodPhoto').src = window.URL.createObjectURL(this.files[0])">
								<small id="Info" class="form-text text-muted mx-3">Please upload .jpg file.</small>
								<input type="hidden" id="foodId" name="foodId" value="<?php echo $foodId; ?>">
								<button type="submit" class="btn btn-success my-1" name="updateFoodPhoto">Update Img</button>
							</div>

							<div class="form-group col-md-4">
								<img src="/anao_main/restaurant/images/food-<?php echo $foodId; ?>.jpg" id="foodPhoto" name="foodPhoto" alt="food image" width="100" height="100">
							</div>
						</div>
					</form>
					<form action="pageComponents/_menu.php" method="post">
						<div class="text-left my-2">
							<b><label for="name">Name</label></b>
							<input class="form-control" id="name" name="name" value="<?php echo $foodName; ?>" type="text" required>
						</div>


						<div class="form-group mb-3">
								<b><label for="foodType" class="form-label">Food Type:</label></b>
								<select id="foodType" name="foodType" value="<?php echo $type; ?>" class="form-control mb-3" required>
								<optgroup label="Food Type">

    									<optgroup label="Drinks & Complementary">
    										<option value="drinks">Drinks</option>
    										<option value="shakes">Shakes</option>
    										<option value="complements">Complements</option>
										</optgroup>
    
    									<optgroup label="Fast Food">
    										<option value="burger">Burger</option>
    										<option value="pizza">Pizza</option>
    										<option value="fries">Fries</option>
    										<option value="wings">Wings</option>
										</optgroup>
    
    
    									<optgroup label="Continental">
    										<option value="french">French Cuisine</option>
    										<option value="spanish">Spanish Cuisine</option>
    										<option value="italian">Italian Cuisine</option>
										</optgroup>
    
    									<optgroup label="Asian">
    										<option value="rice">Rice</option>
    										<option value="meat">Meat Dish</option>
    										<option value="noodles">Noodle</option>
    										<option value="salad">Salad</option>
										</optgroup>
    
    
    									<optgroup label="Indian">
    										<option value="biryani">Biryani</option>
    										<option value="chicken">Chicken</option>
    										<option value="mutton">Mutton</option>
    										<option value="fish">Fish</option>
    										<option value="rice">Rice</option>
    										<option value="bread">Bread</option>
										</optgroup>
    
    									<optgroup label="Bangla">
    										<option value="Rice">Rice</option>
    										<option value="chicken">Chicken</option>
    										<option value="beef">Beef</option>
    										<option value="mutton">Mutton</option>
    										<option value="fish">Fish</option>
    										<option value="bread">Bread</option>
    										<option value="biryani">Biryani</option>
    										<option value="complements">Complements</option>
										</optgroup>
    
    									<optgroup label="Others">
    										<option value="streetside">Street Side</option>
    										<option value="buffet">Buffet</option>
    										<option value="finedining">Fine Dining</option>
										</optgroup>
									</optgroup>
								</select>
							</div>


						
						<div class="text-left my-2 row">
							<div class="form-group col-md-6">
								<b><label for="price">Price</label></b>
								<input class="form-control" id="price" name="price" value="<?php echo $foodPrice; ?>" type="number" min="1" required>
							</div>
						</div>
						<div class="text-left my-2">
							<b><label for="description">Description</label></b>
							<textarea class="form-control" id="description" name="description" rows="2" required minlength="6"><?php echo $foodDesc; ?></textarea>
						</div>
						<input type="hidden" id="foodId" name="foodId" value="<?php echo $foodId; ?>">
						<button type="submit" class="btn btn-success" name="updateFood">Update</button>
					</form>
				</div>
			</div>
		</div>
	</div>

<?php
}
?>