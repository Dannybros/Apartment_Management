    <div class="col-sm-9 main_box" style="box-sizing: border-box;">
       <div class="bg-white mx-3 my-4 p-3" style="margin-top: 20px;">
           <div class="staffNav p-3 d-flex justify-content-between">
               <button class="btn btn-primary py-2" data-toggle="modal" data-target="#AddNewStaff">Add New Employee</button>
               <form class="form-inline">
                    <div class="input-group">
                        <input class="form-control ml-sm-2" type="search" placeholder="Search" aria-label="Search">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                            <i class="fas fa-search"></i>
                            </span>
                        </div>
                    </div>
                </form>
           </div>

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
                    if($_GET['success'] == "shiftTime"){
                        $msg="Staff shift has been successfully edited!";
                    } 
                    echo"
                        <div class='alert alert-success mt-2' role='alert'>
                           <b> $msg </b>
                        </div>
                    ";
                }
           ?>
           
           <!-- table of staff list -->
           <div class="staff_page mt-4 mb-2">
               <ul class="staff_table">
                   <li class="d-flex justify-content-between" style="height:60px">
                       <span class="col-1 staff_list"><b>Staff No.</b></span>
                       <span class="col-2 staff_list"><b>Staff Name</b></span>
                       <span class="col-2 staff_list"><b>Work</b></span>
                       <span class="col-3 staff_list"><b>Shift</b></span>
                       <span class="col-1 staff_list"><b>Salary</b></span>
                       <span class="col-1 staff_list"><b>Swap Shift</b></span>
                       <span class="col-2 staff_list"><b>Action</b></span>
                   </li>
                   <?php
                        $sql = "SELECT * FROM `staff` NATURAL JOIN shift";
                        $result = mysqli_query($conn, $sql);
                        while($staff = mysqli_fetch_array($result)){ ?>
                            <li class="d-flex justify-content-between">
                                <span class="col-1 staff_list">
                                    <?php echo $staff["Staff_ID"]?>
                                </span>
                                <span class="col-2 staff_list">
                                    <?php echo $staff["Staff_Name"]?>
                                </span>
                                <span class="col-2 staff_list">
                                    <?php echo $staff["Staff_Job"]?>
                                </span>
                                <span class="col-3 staff_list">
                                    <?php echo $staff["Shift_Name"], " ",$staff["Shift_Time"]?>
                                </span>
                                <span class="col-1 staff_list">
                                    <?php echo $staff["Salary"]?> $
                                </span>
                                <span class="col-1 staff_list">
                                    <button class="btn_staff_shift" data-toggle="modal" data-target="#ChangeShift<?php echo $staff['Staff_ID']?>">
                                        Change
                                    </button>
                                </span>
                                <span class="col-2 staff_list justify-content-around">
                                        <i class="fas fa-pen btn btn-primary staff_icon" data-toggle="modal" data-target="#EditStaff<?php echo $staff['Staff_ID']?>"></i>
                                        <i class="fas fa-trash btn btn-danger staff_icon"></i>
                                        <i class="fas fa-eye btn btn-success staff_icon"></i>
                                </span>
                            </li>
                    <?php }?>
               </ul>
           </div>

            <!-- Add New Staff Modal -->
            <div class="modal fade" id="AddNewStaff" tabindex="-1" role="dialog" aria-labelledby="AddNewStaffLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            ...
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary">Save</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        </div>
                    </div>
                </div>
            </div>

            <?php
              $sql = "SELECT * FROM `staff` NATURAL JOIN shift";
              $result = mysqli_query($conn, $sql);
              while($staff = mysqli_fetch_array($result)){ ?>
            
                <!-- Change Shift -->
                <div class="modal fade" id="ChangeShift<?php echo $staff['Staff_ID']?>" tabindex="-1" role="dialog" aria-labelledby="ChangeShiftLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form action="includes/staffDB/dbGetAllShift.php" method="POST">
                                <div class="modal-body row" style="height: auto;">
                                    <input type="text" name="staff_id" value="<?php echo $staff['Staff_ID']?>" hidden/>

                                    <label class="color:grey"> Staff Shift Time</label>
                                    <select name="staff_shift_cb" class="form-control" style="color:black" id="">
                                        <?php
                                            $sql ="SELECT * FROM `shift`";
                                            $result = mysqli_query($conn, $sql);
                                            while($shift = mysqli_fetch_array($result)){?>
                                                <option value=<?php echo $shift['Shift_Id']?> <?php if($shift['Shift_Id']==$staff['Shift_Id']) echo 'selected="selected"'?> >
                                                    <?php echo $shift['Shift_Name'], " ", $shift['Shift_Time']?>
                                                </option>
                                        <?php }?>
                                    </select>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary">Save</button>
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                
                <!-- Edit Staff Info -->
                <div class="modal fade" id="EditStaff<?php echo $staff['Staff_ID']?>" tabindex="-1" role="dialog" aria-labelledby="EditStaffLabel<?php echo $staff['Staff_ID']?>" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                ...
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-primary">Save</button>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                            </div>
                        </div>
                    </div>
                </div>

            <?php  }?>

       </div>
    </div>
</div>
