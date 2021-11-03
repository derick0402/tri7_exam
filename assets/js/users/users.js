$(document).ready(function(){

	//declare variable for datatable
	var userListDatatable;

	//fetch all user
	get_user_list();
	var total_user_count = 0;
	function get_user_list(){
		$.ajax({
			url : base_url + "users_controller/getUserList",
			type:"GET",
			dataType:"json",
			success: function(response){
				
				user_list_datatable = $("#userList").DataTable({
					"data" : response.user_list,
					"columns" : [
						{"data":"",
							"render":function(data, type, full, meta){
								total_user_count++;
								
								return total_user_count;
							}
						},
						{"data" : "first_name"},
						{"data" : "last_name"},
						{"data" : "position"},
						{"data" : "create_date"},
						{"data":"",
							"render":function(data, type, full, meta){
								var html = ""

								html += "<button class='btn btn-success btn-sm open-update-modal'>Edit</button>"
								html += "&nbsp;<button class='btn btn-danger btn-sm delete-btn'>Delete</button>"

								return html;
							}
						},
					],
					"bDestroy": true
				})
			},
			error: function(error){

			}
		})
	}

	//show delete confirmation
	$(document).on("click", ".delete-btn", function(){
		var data = user_list_datatable.row( $(this).parents('tr') ).data();
		var tr = user_list_datatable.row($(this).closest('tr'))

		var id = data.id;
		var last_name = data.last_name;
		var first_name = data.first_name;

		Swal.fire({
            html: 'Are you sure you want to remove <strong>'+first_name.toUpperCase()+' '+last_name.toUpperCase()+'</strong>?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes'
        }).then((result) => {
            if(result.value){
            	$(".response-warning").empty();
            	$.ajax({
            		url : base_url + "users_controller/deleteUser",
            		type:"POST",
            		dataType:"json",
            		data:{
            			id : id
            		},
            		success:function(response){
            			if(response.status == "success"){
            				tr.remove().draw()
            				render_response(".response-warning", response.msg, "success");
            			}
            			else{

            			}
            		},
            		error:function(error){

            		}
            	})
			}
        })
	})


	//for adding user
	var loading_submit = false;
	$(".submit-btn").on("click", function(){
		$(".add-user-warning").empty();

		var add_firstname = $(".add-firstname").val();
		var add_lastname = $(".add-lastname").val();
		var add_position = $(".add-position").val();

		//check if submit is still processing to prevent multiple insert at once
		if(!loading_submit){
			loading_submit = true;

			var data_params = {
				"first_name" : add_firstname,
				"last_name" : add_lastname,
				"position" : add_position
			}

			$.ajax({
				url : base_url + "users_controller/addUser",
				type : "POST",
				dataType : "json",
				data : data_params,
				success:function(response){
					loading_submit = false
					if(response.status == "success"){
						$("#addUserModal").modal("hide")

						render_response(".response-warning", response.msg, "success");

						$(".add-firstname").val("");
						$(".add-lastname").val("");
						$(".add-position").val("");

						total_user_count = 0;

						var table = $('#userList').DataTable();
    					user_list_datatable.row.add(response.user_details).invalidate().draw(false);

					}
					else{
						render_response('.add-user-warning',response.msg, "danger")
					}
				},
				error:function(error){
					loading_submit = false;
					render_response('.add-user-warning',"A problem has occured.", "danger")
				}
			})

		}
	})

	//for updating user
	var user_id = null;
	var tmp_stored_table = null;
	$(document).on("click", ".open-update-modal", function(){
		var data = user_list_datatable.row( $(this).parents('tr') ).data();

		tmp_stored_table = data;
		user_id = data.id;
		var last_name = data.last_name;
		var first_name = data.first_name;
		var position = data.position;

		$("#updateUserModal").modal("show")
		$(".update-firstname").val(first_name)
		$(".update-lastname").val(last_name)
		$(".update-position").val(position)
	})

	var loading_update = false;
	$(".update-btn").on("click", function(){
		console.log(user_id)

		$(".update-user-warning").empty();

		var update_firstname = $(".update-firstname").val();
		var update_lastname = $(".update-lastname").val();
		var update_position = $(".update-position").val();

		if(!loading_update){
			loading_update = true;

			var data_params = {
				"first_name" : update_firstname,
				"last_name" : update_lastname,
				"position" : update_position,
				"id" : user_id
			}

			$.ajax({
				url : base_url + "users_controller/updateUser",
				type:"POST",
				dataType:"json",
				data:data_params,
				success: function(response){
					loading_update = false;
					if(response.status == "success"){
						$("#updateUserModal").modal("hide")

						render_response(".response-warning", response.msg, "success");

						$(".update-firstname").val("");
						$(".update-lastname").val("");
						$(".update-position").val("");

						total_user_count = 0;
						
						tmp_stored_table.first_name = response.user_details.first_name;
						tmp_stored_table.last_name = response.user_details.last_name;
						tmp_stored_table.position = response.user_details.position;
						user_list_datatable.rows().invalidate().draw();
					}
					else{
						
						render_response('.update-user-warning',response.msg, "danger")
					}
				},
				error: function(response){
					loading_update = false;
					render_response('.update-user-warning',"A problem has occured.", "danger")
				}
			})
		}
	})


	//for rendering server reponse
	function render_response(div,msg, status){
        $(div).empty();
        $(div).append(
            '<div class="alert alert-'+status+' alert-dismissible fade show">'+
            msg+
            '<button type="button" class="close" data-dismiss="alert">&times;</button>'+
            '</div>'
        );
    }
})