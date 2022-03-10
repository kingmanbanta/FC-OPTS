<!-- Modal-->

<div id="updateProfileModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
  <div role="document" class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 id="exampleModalLabel" class="modal-title">Edit Profile</h5>
        <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>
      </div>
      <div class="modal-body">
        <form id="update_ProfileForm">
          {{csrf_field()}}
          {{method_field('PUT')}}
          <div class="card-body">
            <div class="row gutters">
              <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <h6 class="mb-2 text-primary">Personal Details</h6>
              </div>
              <input type="hidden" class="form-control" id="profile_id" name="profile_id" value="{{Auth::user()->id}}">
              <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                <div class="form-group">
                  <label for="up_fname">First Name</label>
                  <input type="text" class="form-control" name="up_fname" id="up_fname" value="{{Auth::user()->name}}">
                  <span class="glyphicon glyphicon-user form-control-feedback"></span>
                  <span class="text-danger">
                    <strong id="up_fname-error"></strong>
                  </span>
                </div>
              </div>
              <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-12">
                <div class="form-group">
                  <label for="up_mname">Middle Name</label>
                  @if(empty($userr->mname))
                  <input type="text" class="form-control" name="up_mname" id="up_mname" placeholder="--">
                  @else
                  <input type="text" class="form-control" name="up_mname" id="up_mname" value="{{$userr->mname}}">
                  @endif
                  <span class="glyphicon glyphicon-user form-control-feedback"></span>
                  <span class="text-danger">
                    <strong id="up_mname-error"></strong>
                  </span>
                </div>
              </div>
              <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-12">
                <div class="form-group">
                  <label for="up_lname">Last Name</label>
                  @if(empty($userr->lname))
                  <input type="text" class="form-control" name="up_lname" id="up_lname" placeholder="--">
                  @else
                  <input type="text" class="form-control" name="up_lname" id="up_lname" value="{{$userr->lname}}">
                  @endif
                  <span class="glyphicon glyphicon-user form-control-feedback"></span>
                  <span class="text-danger">
                    <strong id="up_lname-error"></strong>
                  </span>
                </div>
              </div>
              <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
                <div class="form-group">
                  <label for="up_sex">Sex</label>
                  @if(empty($userr->sex))
                  <select name="up_sex" id="up_sex" class="form-control">
                    <option value="" disabled selected hidden>Select Sex</option>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                  </select>
                  @else
                  <select name="up_sex" id="up_sex" class="form-control">
                    <option value="{{$userr->sex}}" hidden>{{$userr->sex}}</option>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>

                  </select>
                  @endif
                  <span class="glyphicon glyphicon-user form-control-feedback"></span>
                  <span class="text-danger">
                    <strong id="up_sex-error"></strong>
                  </span>
                </div>
              </div>
              <div class="col-xl-8 col-lg-8 col-md-8 col-sm-8 col-12">
                <div class="form-group">
                  <label for="up_contact_no">Contact Number</label>
                  @if(empty($userr->contact_no))
                  <input type="text" class="form-control" name="up_contact_no" id="up_contact_no" placeholder="--">
                  @else
                  <input type="text" class="form-control" name="up_contact_no" id="up_contact_no" value="{{$userr->contact_no}}">
                  @endif
                  <span class="glyphicon glyphicon-user form-control-feedback"></span>
                  <span class="text-danger">
                    <strong id="up_contact_no-error"></strong>
                  </span>
                </div>
              </div>
              <!-- <div class="col-xl-5 col-lg-5 col-md-5 col-sm-5 col-12">
                <div class="form-group">
                  <label for="up_email">Email</label>
                  <input type="email" class="form-control" name="up_email" id="up_email" value="{{Auth::user()->email}}">
                </div>
              </div> -->
            </div>
            <div class="row gutters">
              <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <h6 class="mt-3 mb-2 text-primary">Address</h6>
              </div>
              <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                <div class="form-group">
                  <label for="up_barangay">Barangay</label>
                  @if(empty($userr->barangay))
                  <input type="text" class="form-control" name="up_barangay" id="up_barangay" placeholder="--">
                  @else
                  <input type="text" class="form-control" name="up_barangay" id="up_barangay" value="{{$userr->barangay}}">
                  @endif
                  <span class="glyphicon glyphicon-user form-control-feedback"></span>
                  <span class="text-danger">
                    <strong id="up_barangay-error"></strong>
                  </span>
                </div>
              </div>
              <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                <div class="form-group">
                  <label for="up_municipality">Municipality</label>
                  @if(empty($userr->municipality))
                  <input type="text" class="form-control" name="up_municipality" id="up_municipality" placeholder="--">
                  @else
                  <input type="text" class="form-control" name="up_municipality" id="up_municipality" value="{{$userr->municipality}}">
                  @endif
                  <span class="glyphicon glyphicon-user form-control-feedback"></span>
                  <span class="text-danger">
                    <strong id="up_municipality-error"></strong>
                  </span>
                </div>
              </div>
              <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
                <div class="form-group">
                  <label for="up_city">City</label>
                  @if(empty($userr->city))
                  <input type="text" class="form-control" name="up_city" id="up_city" placeholder="--">
                  @else
                  <input type="text" class="form-control" name="up_city" id="up_city" value="{{$userr->city}}">
                  @endif
                  <span class="glyphicon glyphicon-user form-control-feedback"></span>
                  <span class="text-danger">
                    <strong id="up_city-error"></strong>
                  </span>
                </div>
              </div>
              <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
                <div class="form-group">
                  <label for="up_province">Province</label>
                  @if(empty($userr->province))
                  <input type="text" class="form-control" name="up_province" id="up_province" placeholder="--">
                  @else
                  <input type="text" class="form-control" name="up_province" id="up_province" value="{{$userr->province}}">
                  @endif
                  <span class="glyphicon glyphicon-user form-control-feedback"></span>
                  <span class="text-danger">
                    <strong id="up_province-error"></strong>
                  </span>
                </div>
              </div>
              <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
                <div class="form-group">
                  <label for="up_zipcode">Zip Code</label>
                  @if(empty($userr->zipcode))
                  <input type="text" class="form-control" name="up_zipcode" id="up_zipcode" placeholder="--">
                  @else
                  <input type="text" class="form-control" name="up_zipcode" id="up_zipcode" value="{{$userr->zipcode}}">
                  @endif
                  <span class="glyphicon glyphicon-user form-control-feedback"></span>
                  <span class="text-danger">
                    <strong id="up_zipcode-error"></strong>
                  </span>
                </div>
              </div>
            </div>
            <div class="row gutters">
              <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <h6 class="mt-3 mb-2 text-primary">Account</h6>
              </div>
              <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
                <div class="form-group">
                  <label for="Dept_name">Department</label>
                  <label>Department</label>
                  @if(empty($userr->Dept_name))
                  <select name="up_department_id" id="up_department_id" class="form-control">
                    <option value="" disabled selected hidden>Select Department</option>
                    @foreach($department as $departments)
                    <option value="{{$departments->id}}">{{$departments->Dept_name}}</option>
                    @endforeach
                  </select>
                  @else
                  <select name="up_department_id" id="up_department_id" class="form-control">
                    <option value="{{$userr->id}}" hidden>{{$userr->Dept_name}}</option>
                    @foreach($department as $departments)
                    <option value="{{$departments->id}}">{{$departments->Dept_name}}</option>
                    @endforeach
                  </select>
                  @endif
                  <span class="glyphicon glyphicon-user form-control-feedback"></span>
                  <span class="text-danger">
                    <strong id="Dept_name-error"></strong>
                  </span>
                </div>
              </div>
              <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
                <div class="form-group">
                  <label for="position">Position</label>
                  @if(empty($userr->position))
                  <input type="text" class="form-control" name="up_position" id="up_position" value="--">
                  @else
                  <input type="text" class="form-control" name="up_position" id="up_position" value="{{$userr->position}}">
                  @endif
                  <span class="glyphicon glyphicon-user form-control-feedback"></span>
                  <span class="text-danger">
                    <strong id="up_position-error"></strong>
                  </span>
                </div>
              </div>
              <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
                <div class="form-group">
                  <label for="email">Email</label>
                  <input type="email" class="form-control" name="email" id="email" value="{{Auth::user()->email}}">
                  <span class="glyphicon glyphicon-user form-control-feedback"></span>
                  <span class="text-danger">
                    <strong id="email-error"></strong>
                  </span>
                </div>
              </div>
            </div>
            <div class="row gutters">
              <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="text-right">
                  <!-- <button type="button" id="submit" name="submit" class="btn btn-secondary">Cancel</button> -->
                  <button type="submit" class="btn btn-primary ">Save changes</button>
                </div>
              </div>
            </div>
          </div>
      </div>
      </form>
    </div>
  </div>
</div>

<script type="text/javascript">
  $().ready(function() {
    $('.update_edit_btn').on('click', function() {
      // var fname = $('#fname').val();
      // var mname = $('#mname').val();
      $('#updateProfileModal').modal('show');
      // $('#up_fname').val(fname);
      // $('#up_mname').val(mname);

    });
  });
</script>

<script type="text/javascript">
  $().ready(function() {
    $('#update_ProfileForm').on('submit', function(e) {

      e.preventDefault();
      var id = $("#profile_id").val();
      
          //$('#logout-form').submit() // this submits the form 
          $.ajax({
            type: "PATCH",
            url: "profile/update/" + id,
            data: $('#update_ProfileForm').serialize(),
            success: function(response) {
              console.log(response);
              if (response.errors) {
                if (response.errors.up_fname) {
                  $('#up_fname-error').html(response.errors.up_fname[0]);
                }
                if (response.errors.up_mname) {
                  $('#up_mname-error').html(response.errors.up_mname[0]);
                }
                if (response.errors.up_lname) {
                  $('#up_lname-error').html(response.errors.up_lname[0]);
                }
                if (response.errors.up_sex) {
                  $('#up_sex-error').html(response.errors.up_sex[0]);
                }
                if (response.errors.up_contact_no) {
                  $('#up_contact_no-error').html(response.errors.up_contact_no[0]);
                }
                if (response.errors.up_barangay) {
                  $('#up_barangay-error').html(response.errors.up_barangay[0]);
                }
                if (response.errors.up_municipality) {
                  $('#up_municipality-error').html(response.errors.up_municipality[0]);
                }
                if (response.errors.up_city) {
                  $('#up_city-error').html(response.errors.up_city[0]);
                }
                if (response.errors.up_province) {
                  $('#up_province-error').html(response.errors.up_province[0]);
                }
                if (response.errors.up_zipcode) {
                  $('#up_zipcode-error').html(response.errors.up_zipcode[0]);
                }
                if (response.errors.up_position) {
                  $('#up_position-error').html(response.errors.up_position[0]);
                }
                if (response.errors.up_department_id) {
                  $('#up_department_id-error').html(response.errors.up_department_id[0]);
                }
                if (response.errors.email) {
                  $('#email-error').html(response.errors.email[0]);
                }
              }
              if(response.success){
              $('#updateProfileModal').modal('hide');
              //alert("data updated");
              Swal.fire({
                icon: 'success',
                title: 'Data Have been updated!',
                showConfirmButton: false,
                timer: 3500
              });
              setTimeout(function() {
                location.reload();
              }, 3000);
            }
            }
          });
    });
  });
</script>