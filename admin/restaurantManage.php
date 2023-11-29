<div class="container-fluid" style="margin-top:98px">
    <div class="col-lg-12">
        <div class="row">

            <!-- FORM Panel -->
            <div class="col-md-4">
                <form action="pageComponents/_restaurantManage.php" method="post" enctype="multipart/form-data">
                    <div class="card">
                        <div class="card-header" style="background-color: rgb(111 202 203);">
                            Add New Restaurant
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <b><label class="control-label">Restaurant Name: </label></b>
                                <input type="text" class="form-control" name="name" required>
                            </div>

                            <div class="form-group">
                                <b><label class="control-label">Restaurant Type: </label></b>
                                <select name="rest_type" class="form-control mb-3">
                                    <option value="fastfood">Fast Food</option>
                                    <option value="continental">Continental</option>
                                    <option value="asian">Asian</option>
                                    <option value="indian">Indian</option>
                                    <option value="bangla">Bangla</option>
                                    <option value="streetside">Street Side</option>
                                    <option value="finedinding">Fine Dining</option>

                                </select>
                            </div>

                            <div class="form-group">
                                <b><label class="control-label">Restaurant Full Address: </label></b>
                                <input type="text" class="form-control" name="address" required>
                            </div>

                            <div class="form-group">
                                <b><label for="email" class="form-label">Your Restaurant Email:</label></b>
                                <input type="email" class="form-control" id="email" name="email" placeholder="Enter Restaurant Email" required>
                            </div>

                            
                            <div class="form-group">
                                <b><label for="phone" class="form-label">Contact No:</label></b>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon">+880</span>
                                    </div>
                                    <input type="tel" class="form-control" id="phone" name="phone" placeholder="Enter a Contact Number" required pattern="[0-9]{11}" maxlength="11">
                                </div>
                            </div>

                            <div class="form-group">
                                <b><label class="control-label">Description: </label></b>
                                <input type="text" class="form-control" name="description" required>
                            </div>
                        

                            <div class="form-group">
                                <div class="text-left mb-3">
                                    <b><label for="password" class="form-label">Password:</label></b>
                                    <input class="form-control" id="password" name="password" placeholder="Enter Password" type="password" required data-toggle="password" minlength="6" maxlength="21">
                                </div>
                                
                                <div class="text-left mb-3">
                                    <b><label for="cpassword" class="form-label">Confirm Password:</label></b>
                                    <input class="form-control" id="cpassword" name="cpassword" placeholder="Re-enter Password" type="password" required data-toggle="password" minlength="6" maxlength="21"> 
                                </div>
                            </div>

                            <div class="form-group">
                                <b><label for="image" class="control-label">Cover Image</label></b>
                                <input type="file" name="image" id="image" accept=".jpg" class="form-control" required style="border:none;">
                                <small id="Info" class="form-text text-muted mx-3">Please Upload .jpg file only</small>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="row">
                                <div class="col-md-12">
                                    <button type="submit" name="addRestaurant" class="btn btn-sm btn-primary d-flex justify-content-center w-100"> Add Restaurant </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <!-- FORM Panel -->

            <!-- Table Panel -->
            <div class="col-md-8 mb-3">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover mb-0">
                                <thead style="background-color: rgb(111 202 203);">
                                    <tr>
                                        <th class="text-center" style="width:7%;">Id</th>
                                        <th class="text-center">Img</th>
                                        <th class="text-center" style="width:58%;">Restaurant Detail</th>
                                        <th class="text-center" style="width:18%;">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $sql = "SELECT * FROM `rest_reg`";
                                    $result = mysqli_query($conn, $sql);
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        $restaurantId = $row['id'];
                                        $restname = $row['restaurant_name'];
                                        $restype = $row['type'];
                                        $restlocation = $row['location'];
                                        $restemail = $row['email'];
                                        $restcontact = $row['contact_no'];
                                        $restDesc = $row['description'];



                                        echo '<tr>
                                             <td class="text-center"><b>' . $restaurantId . '</b></td>
                                             <td><img src="/anao_main/images/card-' . $restaurantId . '.jpg" alt="image for this Category" width="120px" height="120px"></td>
                                             <td>
                                                 <p>Name : <b>' . $restname . '</b></p>
                                                 <p>Type : <b class="truncate">' . $restype . '</b></p>
                                                 <p>Address : <b class="truncate">' . $restlocation . '</b></p>
                                                 <p>Email : <b class="truncate">' . $restemail . '</b></p>
                                                 <p>Contact : <b class="truncate">' . $restcontact . '</b></p>
                                                 <p>Description : <b class="truncate">' . $restDesc . '</b></p>
                                                 
                                             </td>
                                             <td class="text-center">
                                                 <div class="row mx-auto" style="width:112px">
                         
                                                 <form action="pageComponents/_restaurantManage.php" method="POST">
                                                     <button name="removeRestaurant" class="btn btn-sm btn-danger" style="margin-left:9px;">Remove</button>
                                                     <input type="hidden" name="restId" value="' . $restaurantId . '">
                                                 </form></div>
                                             </td>
                                         </tr>';
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