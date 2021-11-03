<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/users/users.css">

<div class="users-container">
	<div class="users-content">
		<div class="response-warning" style="width: 50%;"></div>
		<div class="table-responsive-sm">
			<table class="table table-striped" id="userList">
		        <thead >
		            <tr>
		                <th>#</th>
		                <th>First name</th>
		                <th>Last name</th>
		                <th>Position</th>
		                <th>Create Date</th>
		                <th><button class="btn btn-primary btn-sm" data-target="#addUserModal" data-toggle="modal">Add</button></th>
		            </tr>
		        </thead>
		        <tbody>
		        
		        </tbody>
		    </table>
        </div>
	</div>
</div>

<div class="modal fade" id="addUserModal" tabindex="-1" role="dialog" aria-labelledby="disapproveOtModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="disapproveOtModalLongTitle">Add User</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="row">
            	<div class="col-lg-12">
            		<small>Firstname <span class="text-danger">*</span></small>
            		<input type="text" class="form-control add-firstname" placeholder="Enter firstname">
            	</div>
            	<div class="col-lg-12">
            		<small>Lastname <span class="text-danger">*</span></small>
            		<input type="text" class="form-control add-lastname" placeholder="Enter lastname">
            	</div>
            	<div class="col-lg-12">
            		<small>Position <span class="text-danger">*</span></small>
            		<input type="text" class="form-control add-position" placeholder="Enter position">
            	</div>
            </div>
            <br>
            <div class="add-user-warning"></div>
        </div>
        <div class="modal-footer">
            <button class="btn btn-sm btn-primary submit-btn">submit</button>
        </div>
        </div>
    </div>
</div>

<div class="modal fade" id="updateUserModal" tabindex="-1" role="dialog" aria-labelledby="disapproveOtModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="disapproveOtModalLongTitle">Update User</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="row">
            	<div class="col-lg-12">
            		<small>Firstname <span class="text-danger">*</span></small>
            		<input type="text" class="form-control update-firstname" placeholder="Enter firstname">
            	</div>
            	<div class="col-lg-12">
            		<small>Lastname <span class="text-danger">*</span></small>
            		<input type="text" class="form-control update-lastname" placeholder="Enter lastname">
            	</div>
            	<div class="col-lg-12">
            		<small>Position <span class="text-danger">*</span></small>
            		<input type="text" class="form-control update-position" placeholder="Enter position">
            	</div>
            </div>
            <br>
            <div class="update-user-warning"></div>
        </div>
        <div class="modal-footer">
            <button class="btn btn-sm btn-primary update-btn">submit</button>
        </div>
        </div>
    </div>
</div>

<script src="<?php echo base_url();?>assets/js/users/users.js"></script>