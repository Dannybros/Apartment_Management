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
                   <li class="d-flex justify-content-between">
                       <span class="col-1 staff_list">Staff No.</span>
                       <span class="col-2 staff_list">Cleta Landon</span>
                       <span class="col-2 staff_list">Front Desk Receptionist</span>
                       <span class="col-3 staff_list">Evening 11:00 PM - 4:00 AM</span>
                       <span class="col-1 staff_list">Salary</span>
                       <span class="col-1 staff_list">
                           <button class="btn_staff_shift">Change</button>
                       </span>
                       <span class="col-2 staff_list justify-content-around">
                            <i class="fas fa-pen btn btn-primary staff_icon"></i>
                            <i class="fas fa-trash btn btn-danger staff_icon"></i>
                            <i class="fas fa-eye btn btn-success staff_icon"></i>
                       </span>
                   </li>
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

            <!-- Change Shift -->
            <div class="modal fade" id="ChangeShift" tabindex="-1" role="dialog" aria-labelledby="ChangeShiftLabel" aria-hidden="true">
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

            <!-- Edit Staff Info -->
            <div class="modal fade" id="ChangeShift" tabindex="-1" role="dialog" aria-labelledby="ChangeShiftLabel" aria-hidden="true">
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

       </div>
    </div>
</div>
