    <div class="col-sm-9 main_box" style="box-sizing: border-box;">
       <div class="bg-white mx-3 my-4 p-3" style="margin-top: 20px;">

            <!-- nav & search bar  -->
           <div class="staffNav p-3 d-flex justify-content-between">
               <button class="btn btn-primary py-2" data-toggle="modal" data-target="#AddNewStaff">Add New Employee</button>
               <form class="form-inline">
                    <div class="input-group">
                        <input class="form-control ml-sm-2" type="search" placeholder="Search" aria-label="Search" onkeyup="searchStaff(this.value)">
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
                    if($_GET['success'] == "addStaff"){
                        $msg="New staff has been successfully added!";
                    } 
                    if($_GET['success'] == "delStaff"){
                        $msg="Old Staff has been successfully deleted!";
                    } 
                    if($_GET['success'] == "updateStaff"){
                        $msg="Staff has been successfully updated!";
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
                   <li class="d-flex justify-content-between" style="height:60px; border-bottom: 1px solid grey">
                       <span class="col-1 staff_list"><b>Staff No.</b></span>
                       <span class="col-2 staff_list"><b>Staff Name</b></span>
                       <span class="col-2 staff_list"><b>Work</b></span>
                       <span class="col-3 staff_list"><b>Shift</b></span>
                       <span class="col-1 staff_list"><b>Salary</b></span>
                       <span class="col-1 staff_list"><b>Swap Shift</b></span>
                       <span class="col-2 staff_list"><b>Action</b></span>
                   </li>
                   <div id="staff_list_display">
                   <?php
                        $sql = "SELECT * FROM `staff` NATURAL JOIN shift NATURAL JOIN staff_type";
                        $result = mysqli_query($conn, $sql);
                        while($staff = mysqli_fetch_array($result)){ ?>
                            <li class="d-flex justify-content-between">
                                <span class="col-1 staff_list">
                                    <?php echo $staff["Staff_ID"]?>
                                </span>
                                <span class="col-2 staff_list" style="text-transform: capitalize;">
                                    <?php echo $staff["Staff_Name"]?>
                                </span>
                                <span class="col-2 staff_list">
                                    <?php echo $staff["Staff_Job_Name"]?>
                                </span>
                                <span class="col-3 staff_list">
                                    <?php echo $staff["Shift_Name"], " ", $staff["Shift_Time"]?>
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
                                        <i class="fas fa-trash btn btn-danger staff_icon" onclick="delStaff(<?php echo $staff['Staff_ID']?>)"></i>
                                        <i class="fas fa-eye btn btn-success staff_icon"></i>
                                </span>
                            </li>
                    <?php }?>
                    </div>
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
                        <form action="includes/staffDB/dbAddNewStaff.php" method="POST">
                            <div class="modal-body row" style="height:auto; row-gap:20px">
                                <div class="col-12" style="display: flex; flex-direction:column">
                                    <label>Staff Name</label>
                                    <input type="text" class="form-control " name="staff_name" placeholder="Staff Name..." data-error="please fill in the staff name" required/>
                                </div>
                                <div class="col-6">
                                    <label>Address</label>
                                    <input type="text" class="form-control" name="staff_address" placeholder="Address..." data-error="please fill in the staff address" required/>
                                </div>
                                <div class="col-6">
                                    <label>Contact</label>
                                    <input type="text" class="form-control" name="staff_contact" placeholder="Contact No..."  oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" data-error="please fill in the staff contact" required/>
                                </div>
                                <div class="col-6">
                                    <label>Staff Job</label>
                                    <select class="form-control" name="staff_job" data-error="please fill in the staff job" required>
                                        <?php
                                            $sql ="SELECT * FROM `staff_type`";
                                            $result = mysqli_query($conn, $sql);
                                            while($job = mysqli_fetch_array($result)){?>
                                                <option value=<?php echo $job['Staff_Job_Type']?> >
                                                    <?php echo $job['Staff_Job_Name']?>
                                                </option>
                                        <?php }?>
                                    </select>
                                </div>
                                <div class="col-6">
                                    <label>Salary</label>
                                    <input type="text" class="form-control" name="staff_salary"  oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" placeholder="Salary..." data-error="please fill in the staff salary" required/>
                                </div>
                                <div class="col-12">
                                    <label>Shift</label>
                                    <select class="form-control" name="staff_shift" data-error="please choose the room type" required>
                                        <?php
                                            $sql ="SELECT * FROM `shift`";
                                            $result = mysqli_query($conn, $sql);
                                            while($shift = mysqli_fetch_array($result)){?>
                                                <option value=<?php echo $shift['Shift_Id']?> >
                                                    <?php echo $shift['Shift_Name'], " ", $shift['Shift_Time']?>
                                                </option>
                                        <?php }?>
                                    </select>
                                </div>
                                
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Save</button>
                                <button type="reset" class="btn btn-danger">Reset</button>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            
            <!-- Change Shift -->
            <?php
              $sql = "SELECT * FROM `staff` NATURAL JOIN `shift`";
              $result = mysqli_query($conn, $sql);
              while($staff = mysqli_fetch_assoc($result)){ ?>
            
                <div class="modal fade" id="ChangeShift<?php echo $staff['Staff_ID']?>" tabindex="-1" role="dialog" aria-labelledby="ChangeShiftLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">
                                    Shift Time Change for <b><?php echo $staff['Staff_Name']?></b>
                                </h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form action="includes/staffDB/dbChangeShift.php" method="POST">
                                <div class="modal-body row" style="height: auto;">
                                    <input type="text" name="staff_id" value="<?php echo $staff['Staff_ID']?>" hidden/>

                                    <label class="color:grey"> Staff Shift Time</label>
                                    <select name="staff_shift_cb" class="form-control" style="color:black" id="">
                                        <?php
                                            $shiftSql ="SELECT * FROM `shift`";
                                            $shiftResult = mysqli_query($conn, $shiftSql);
                                            while($shift = mysqli_fetch_array($shiftResult)){?>
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

            <?php  }?>

            <!-- Edit Staff Info -->
            <?php
              $sql = "SELECT * FROM `staff` NATURAL JOIN shift";
              $result = mysqli_query($conn, $sql);
              while($staff = mysqli_fetch_array($result)){ ?>
            
                <div class="modal fade" id="EditStaff<?php echo $staff['Staff_ID']?>" tabindex="-1" role="dialog" aria-labelledby="EditStaffLabel<?php echo $staff['Staff_ID']?>" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">
                                    Edit information of staff -
                                    <b><?php echo $staff['Staff_Name']?></b>
                                </h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form action="includes/staffDB/dbEditStaff.php" method="POST">
                                <div class="modal-body row" style="height: auto; row-gap:20px;">
                                    <div class="col-6">
                                        <label>Staff ID</label>
                                        <input 
                                         type="text" 
                                         class="form-control" 
                                         style="text-align: left" 
                                         name="staff_id" 
                                         value=<?php echo $staff['Staff_ID']?> 
                                         readonly />
                                    </div>

                                    <div class="col-6">
                                        <label>Staff Name</label>
                                        <input 
                                         type="text" 
                                         class="form-control" 
                                         style="text-align: left" 
                                         name="staff_name" 
                                         placeholder="Staff Name..." 
                                         value=<?php echo $staff['Staff_Name']?> 
                                         data-error="please fill in the staff name" 
                                         required />
                                    </div>

                                    <div class="col-6">
                                        <label>Address</label>
                                        <input 
                                         type="text" 
                                         class="form-control" 
                                         style="text-align: left" 
                                         name="staff_address" 
                                         placeholder="Address..." 
                                         value=<?php echo $staff['Address']?> 
                                         data-error="please fill in the staff address" 
                                         required/>
                                    </div>

                                    <div class="col-6">
                                        <label>Contact</label>
                                        <input 
                                         type="text" 
                                         class="form-control" 
                                         style="text-align: left" 
                                         name="staff_contact" 
                                         placeholder="Contact No..." 
                                         value=<?php echo $staff['Contact']?> 
                                         oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"  data-error="please fill in the staff contact" 
                                         required/>
                                    </div>

                                    <div class="col-6">
                                        <label>Staff Job</label>
                                        <select 
                                         class="form-control" 
                                         name="staff_job" 
                                         data-error="please fill in the staff job" 
                                         required>
                                            <?php
                                                $job_sql ="SELECT * FROM `staff_type`";
                                                $job_result = mysqli_query($conn, $job_sql);

                                                while($job = mysqli_fetch_array($job_result)){?>
                                                    <option 
                                                     value=<?php echo $job['Staff_Job_Type']?> 
                                                     <?php if($job['Staff_Job_Type']==$staff['Staff_Job_Type']) echo 'selected="selected" '?> >
                                                        <?php echo $job['Staff_Job_Name']?>
                                                    </option>
                                            <?php }?>
                                        </select>
                                    </div>

                                    <div class="col-6">
                                        <label>Salary</label>
                                        <input 
                                         type="text" 
                                         class="form-control" 
                                         style="text-align: left" 
                                         name="staff_salary"
                                         value=<?php echo $staff['Salary']?> 
                                         oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" placeholder="Salary..." 
                                         data-error="please fill in the staff salary" 
                                         required/>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary">Edit</button>
                                    <button type="reset" class="btn btn-danger">Reset</button>
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            <?php  }?>
       </div>
    </div>
</div>
