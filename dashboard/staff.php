    <div class="col-sm-9 main_box" style="box-sizing: border-box;">
       <div class="container" style="height: 100%;">
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
           
           <div class="staff_page my-4">
               <ul class="staff_table">
                   <li class="d-flex justify-content-between">
                       <span class="col-3 staff_list">Name</span>
                       <span class="col-2 staff_list">Occupation</span>
                       <span class="col-2 staff_list">Contact</span>
                       <span class="col-2 staff_list">Salary</span>
                       <span class="col-3 staff_list">Edit</span>
                   </li>
                   <li class="d-flex justify-content-between">
                       <span class="col-3 staff_list">Name</span>
                       <span class="col-2 staff_list">Occupation</span>
                       <span class="col-2 staff_list">Contact</span>
                       <span class="col-2 staff_list">Salary</span>
                       <span class="col-3 staff_list">Edit</span>
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
       </div>
    </div>
</div>
