    <div class="col-sm-9 main_box">
        <div class="bg-white mx-3 my-4 p-3">

            <!-- Success and Error Messages -->
            <?php
                if(isset($_GET['error'])){
                    echo'
                        <div class="alert alert-danger" role="alert">
                            Edit change failed. Please try again!
                        </div>
                    ';
                }
                if(isset($_GET['success'])){
                    $msg = "";
                    if($_GET['success'] == "roomType"){
                        $msg="Room Type Info has been successfully edited!";
                    } 
                    if($_GET['success'] == "roomTypeNew"){
                        $msg="New Room Type has been successfully added!";
                    }
                    if($_GET['success'] == "delRoomType"){
                        $msg="Room Type has been successfully deleted!";
                    }
                    echo"
                        <div class='alert alert-success mt-2' role='alert'>
                            <b> $msg </b>
                        </div>
                    ";
                }
            ?>

            <div id="accordion">

                <!-- Room Type -->
                <section class="card">
                    <div class="card-header" id="headingOne">
                    <h5 class="mb-0">
                        <div class="setting-section-title p-2" data-toggle="collapse" data-target="#roomTypeSetting" aria-expanded="true" aria-controls="roomTypeSetting">
                            Room Type Setting
                        </div>
                    </h5>
                    </div>

                    <main id="roomTypeSetting" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                        <div class="card-body p-2">
                            <ul class="m-0 p-2" style="list-style: none;">
                                <li class="p-2 room_type_setting_table">
                                    <div class="col-3"> Room Type ID </div>
                                    <div class="col-3"> Room Type Name </div>
                                    <div class="col-3"> Room Type Price </div>
                                    <div class="col-3"> Action </div>
                                </li>   
                                <?php
                                    $sql = "SELECT * FROM `room_type` ORDER BY Room_Type_Price + 0 ASC";
                                    $result = mysqli_query($conn, $sql);

                                    while($room_type=mysqli_fetch_array($result)){
                                        $id = $room_type['Room_Type_Id'];
                                        $name = $room_type['Room_Type_Name'];
                                        $price = $room_type['Room_Type_Price']; ?>

                                        <li class="p-2 room_type_setting_table">
                                            <div class="col-3"> <?php echo $id?> </div>
                                            <div class="col-3"> <?php echo $name?> room </div>
                                            <div class="col-3"> <?php echo $price?> $</div>
                                            <div class="col-3">
                                                <i class="fas fa-pen btn btn-primary staff_icon" data-toggle="modal" data-target="#EditRoomType<?php echo $id?>"></i>
                                                <i class="fas fa-trash btn btn-danger staff_icon" onclick="delRoomType(<?php echo $id?>)"></i>
                                            </div>
                                        </li>  
                                    <?php  }
                                ?>
                            </ul>

                            <p class="mx-3 mt-3">
                                Click here to create new <a href="#" data-toggle="modal" data-target="#CreateRoomTypeModal">ROOM TYPE.</a>
                            </p>
                        </div>
                        <!-- edit room type modal -->
                        <?php
                            $sql = "SELECT * FROM room_type";
                            $result = mysqli_query($conn, $sql);
                            while($roomType = mysqli_fetch_array($result)){ ?>
                            
                                <div class="modal fade" id="EditRoomType<?php echo $roomType['Room_Type_Id']?>" tabindex="-1" role="dialog" aria-labelledby="EditRoomTypeLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="ViewStaffLabel">
                                                    Edit Room Type Info
                                                </h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form method="post" action="includes/settingDB/dbEditRoomType.php">
                                                <div class="modal-body row" style="height: auto; row-gap:20px;">
                                                    <div class="col-12">
                                                        <label>Room Type ID</label>
                                                        <input type="text" class="form-control"  name="roomType__id" readonly value="<?php echo $roomType['Room_Type_Id']?>"/>
                                                    </div>

                                                    <div class="col-6">
                                                        <label>Room Type Name</label>
                                                        <input type="text" class="form-control" name="roomType__name" value="<?php echo $roomType['Room_Type_Name']?>"/>
                                                    </div>
                                                    
                                                    <div class="col-6">
                                                        <label>Room Price</label>
                                                        <input type="text" class="form-control" name="roomType__price"  value="<?php echo $roomType['Room_Type_Price']?> $"/>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="submit" class="btn btn-success">Save</button>
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            <?php  }
                        ?>

                        <!-- new Room type create modal -->
                        <div class="modal fade" id="CreateRoomTypeModal" tabindex="-1" role="dialog" aria-labelledby="CreateRoomTypeModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="ViewStaffLabel">
                                            Edit Room Type Info
                                        </h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form method="post" action="includes/settingDB/dbAddNewRoomType.php">
                                        <div class="modal-body row" style="height: auto; row-gap:20px;">
                                            <div class="col-6">
                                                <label>Room Type Name</label>
                                                <input type="text" class="form-control" style="text-transform:capitalize" name="roomType__name" />
                                            </div>
                                            
                                            <div class="col-6">
                                                <label>Room Price</label>
                                                <input type="text" class="form-control" name="roomType__price"/>
                                            </div>
                                        </div>
                                        <div class="modal-footer d-flex justify-content-between">
                                            <button type="reset" class="btn btn-danger">Reset</button>
                                            <div>
                                                <button type="submit" class="btn btn-success">Create</button>
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </main>
                </section>

                <!-- staff type -->
                <section class="card">
                    <div class="card-header" id="headingOne">
                    <h5 class="mb-0">
                        <div class="setting-section-title p-2" data-toggle="collapse" data-target="#staffTypeSetting" aria-expanded="true" aria-controls="roomTypeSetting">
                            Staff Type Setting
                        </div>
                    </h5>
                    </div>

                    <main id="staffTypeSetting" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                        <div class="card-body p-2">
                            <ul class="m-0 p-2" style="list-style: none;">
                                <li class="p-2 room_type_setting_table">
                                    <div class="col-4"> Staff Type ID </div>
                                    <div class="col-4"> Staff Type Name </div>
                                    <div class="col-4"> Action </div>
                                </li>   
                                <?php
                                    $sql = "SELECT * FROM `staff_type`";
                                    $result = mysqli_query($conn, $sql);

                                    while($staff_type=mysqli_fetch_array($result)){
                                        $id = $staff_type['Staff_Job_Type'];
                                        $name = $staff_type['Staff_Job_Name'];?>

                                        <li class="p-2 room_type_setting_table">
                                            <div class="col-4"> <?php echo $id?> </div>
                                            <div class="col-4"> <?php echo $name?> </div>
                                            <div class="col-4">
                                                <i class="fas fa-pen btn btn-primary staff_icon" data-toggle="modal" data-target="#EditStaffTypeSetting<?php echo $id?>"></i>
                                                <i class="fas fa-trash btn btn-danger staff_icon"></i>
                                            </div>
                                        </li>  
                                    <?php  }
                                ?>
                            </ul>

                            <p class="mx-3 mt-3">
                                Click here to create new <a href="#" data-toggle="modal" data-target="#CreateStaffTypeModal">STAFF TYPE.</a>
                            </p>
                        </div>
                        <!-- edit room type modal -->
                        <?php
                            $sql = "SELECT * FROM staff_type";
                            $result = mysqli_query($conn, $sql);
                            while($roomType = mysqli_fetch_array($result)){ ?>
                            
                                <div class="modal fade" id="EditStaffTypeSetting<?php echo $roomType['Staff_Job_Type']?>" tabindex="-1" role="dialog" aria-labelledby="EditStaffTypeSettingLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="ViewStaffLabel">
                                                    Edit Staff Type Info Modal
                                                </h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form method="post" action="">
                                                <div class="modal-body row" style="height: auto; row-gap:20px;">
                                                    <div class="col-6">
                                                        <label>Staff Type ID</label>
                                                        <input type="text" class="form-control"  name="staffType__id" readonly value="<?php echo $roomType['Staff_Job_Type']?>"/>
                                                    </div>

                                                    <div class="col-6">
                                                        <label>Staff Type Name</label>
                                                        <input type="text" class="form-control" name="staffType__name" value="<?php echo $roomType['Staff_Job_Name']?>"/>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="submit" class="btn btn-success">Save</button>
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            <?php  }
                        ?>

                        <!-- new Room type create modal -->
                        <div class="modal fade" id="CreateStaffTypeModal" tabindex="-1" role="dialog" aria-labelledby="CreateStaffTypeModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="ViewStaffLabel">
                                            Edit Room Type Info
                                        </h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form method="post" action="">
                                        <div class="modal-body row" style="height: auto; row-gap:20px;">
                                            <div class="col-12">
                                                <label>Staff Type Name</label>
                                                <input type="text" class="form-control" style="text-transform:capitalize" name="staffType__name" />
                                            </div>
                                        </div>
                                        <div class="modal-footer d-flex justify-content-between">
                                            <button type="reset" class="btn btn-danger">Reset</button>
                                            <div>
                                                <button type="submit" class="btn btn-success">Create</button>
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </main>
                </section>
            </div>
        </div>
    </div>
</div>