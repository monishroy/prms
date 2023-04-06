        <?php
          $title = 'Add Student';
          require ('header.php');
        ?>
        <!-- partial -->
        <div class="main-panel">
          <div class="content-wrapper">
            <div class="row">
              <div class="col-md-12 grid-margin">
                <div class="row">
                  <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                    <h3 class="font-weight-bold">Add Student</h3>
                  </div>
                  <div class="col-12 col-xl-4">
                    <div class="justify-content-end d-flex">
                      <div class="dropdown flex-md-grow-1 flex-xl-grow-0">
                        <button
                          class="btn btn-sm btn-light bg-white"
                          type="button"
                        >
                          <i class="mdi mdi-calendar"></i> Today (<?= date('d M Y') ?>)
                        </button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <?php
              if(isset($_POST['add_student'])){
                $fname = trim($_POST['fname']);
                $lname = trim($_POST['lname']);
                $email = trim($_POST['email']);
                $department = trim($_POST['department']);
                $roll = trim($_POST['roll']);
                $reg = trim($_POST['reg']);
                $session = trim($_POST['session']);
                $phone = trim($_POST['phone']);
                $company = trim($_POST['company']);

                $input_errors = array();

                if(empty($fname)) {
                  $input_errors['fname'] = "field is required!";
                }
                if(empty($lname)) {
                  $input_errors['lname'] = "field is required!";
                }
                if(empty($email)) {
                  $input_errors['email'] = "field is required!";
                }
                if(empty($department)) {
                  $input_errors['department'] = "field is required!";
                }
                if(empty($roll)) {
                  $input_errors['roll'] = "field is required!";
                }
                if(empty($reg)) {
                  $input_errors['reg'] = "field is required!";
                }
                if(empty($session)) {
                  $input_errors['session'] = "field is required!";
                }
                if(empty($phone)) {
                  $input_errors['phone'] = "field is required!";
                }
                if(empty($company)) {
                  $input_errors['company'] = " field is required!";
                }


                if (count($input_errors) == 0) {
                  $email_check = mysqli_query($con, "SELECT * FROM `students` WHERE `email` = '$email'");
                  $email_check_row = mysqli_num_rows($email_check);

                  if($email_check_row == 0){
                    $roll_check = mysqli_query($con, "SELECT * FROM `students` WHERE `roll` = '$roll'");
                    $roll_check_row = mysqli_num_rows($roll_check);

                    if($roll_check_row == 0){
                      $reg_check = mysqli_query($con, "SELECT * FROM `students` WHERE `roll` = '$reg'");
                      $reg_check_row = mysqli_num_rows($reg_check);

                      if($reg_check_row == 0){
                        $phone_check = mysqli_query($con, "SELECT * FROM `students` WHERE `phone` = '$phone'");
                        $phone_check_row = mysqli_num_rows($phone_check);

                        if($phone_check_row == 0) {
                          $result = mysqli_query($con, "INSERT INTO `students`(`fname`, `lname`, `email`, `phone`, `roll`, `registration`, `session`, `department`, `job_status`, `status`) VALUES ('$fname','$lname','$email','$phone','$roll','$reg','$session','$department','$company','1')");
                          if($result){
                            $success = "Registration Successfully !";
                          }else{
                            $error = "Something Wrong !";
                          }
                        }else{
                          $phone_exists = "Phone Already Exists !";
                        }
                      }else{
                        $reg_exists = "Registration Already Exists !";
                      }
                    }else{
                      $roll_exists = "Roll Already Exists !";
                    }
                  }else{
                    $email_exists = "Email Already Exists !";
                  }
                }
              }
            ?>
            <div class="row">
              <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <form class="forms-sample" action="" method="POST">
                      <div class="row">
                        <div class="col-12 col-lg-4">
                          <div class="form-group">
                            <label for="first-name">First Name</label>
                            <input
                              type="text"
                              class="form-control <?php if(isset($input_errors['fname'])){ echo 'border-danger'; } ?>"
                              id="first-name"
                              name="fname"
                              placeholder="First Name"
                              value="<?= isset($fname) ? $fname:'' ?>"
                            />
                          </div>
                        </div>
                        <div class="col-12 col-lg-4">
                          <div class="form-group">
                            <label for="last-name">Last Name</label>
                            <input
                              type="text"
                              class="form-control <?php if(isset($input_errors['lname'])){ echo 'border-danger'; } ?>"
                              id="last-name"
                              name="lname"
                              placeholder="Last Name"
                              value="<?= isset($lname) ? $lname:'' ?>"
                            />
                          </div>
                        </div>
                        <div class="col-12 col-lg-4">
                          <div class="form-group">
                            <label for="email">Email address</label>
                            <input
                              type="email"
                              class="form-control <?php if(isset($input_errors['email'])){ echo 'border-danger'; } ?>"
                              id="email"
                              name="email"
                              placeholder="Email"
                              value="<?= isset($email) ? $email:'' ?>"
                            />
                            <?php if(isset($email_exists)){ ?><span class="text-danger"><?= $email_exists ?></span><?php } ?>
                          </div>
                        </div>
                        <div class="col-12 col-lg-4">
                          <div class="form-group">
                            <label for="department">Department</label>
                            <select
                              class="form-control <?php if(isset($input_errors['department'])){ echo 'border-danger'; } ?>"
                              id="department"
                              name="department"
                            >
                              <?php
                              $data = mysqli_query($con, "SELECT * FROM `department`");
                              while($row=mysqli_fetch_assoc($data)){
                                ?>
                                <option value="<?= $row['id'] ?>"><?= $row['name'] ?></option>
                                <?php
                              }
                              ?>
                            </select>
                          </div>
                        </div>

                        <div class="col-12 col-lg-4">
                          <div class="form-group">
                            <label for="roll">Roll</label>
                            <input
                              type="number"
                              class="form-control <?php if(isset($input_errors['roll'])){ echo 'border-danger'; } ?>"
                              id="roll"
                              name="roll"
                              placeholder="Roll"
                              value="<?= isset($roll) ? $roll:'' ?>"
                            />
                            <?php if(isset($roll_exists)){ ?><span class="text-danger"><?= $roll_exists ?></span><?php } ?>
                          </div>
                        </div>
                        <div class="col-12 col-lg-4">
                          <div class="form-group">
                            <label for="registration">Registration</label>
                            <input
                              type="number"
                              class="form-control <?php if(isset($input_errors['reg'])){ echo 'border-danger'; } ?>"
                              id="registration"
                              name="reg"
                              placeholder="Registration"
                              value="<?= isset($reg) ? $reg:'' ?>"
                            />
                            <?php if(isset($reg_exists)){ ?><span class="text-danger"><?= $reg_exists ?></span><?php } ?>
                          </div>
                        </div>
                        <div class="col-12 col-lg-4">
                          <div class="form-group">
                            <label for="session">Session</label>
                            <select
                              class="form-control <?php if(isset($input_errors['session'])){ echo 'border-danger'; } ?>"
                              id="session"
                              name="session"
                            >
                              <?php
                              $data = mysqli_query($con, "SELECT * FROM `session`");
                              while($row=mysqli_fetch_assoc($data)){
                                ?>
                                <option value="<?= $row['id'] ?>"><?= $row['name'] ?></option>
                                <?php
                              }
                              ?>
                            </select>
                          </div>
                        </div>
                        <div class="col-12 col-lg-4">
                          <div class="form-group">
                            <label for="phone-number">Phone Number</label>
                            <input
                              type="number"
                              class="form-control <?php if(isset($input_errors['phone'])){ echo 'border-danger'; } ?>"
                              id="phone-number"
                              name="phone"
                              placeholder="Phone Number"
                              value="<?= isset($phone) ? $phone:'' ?>"
                            />
                            <?php if(isset($phone_exists)){ ?><span class="text-danger"><?= $phone_exists ?></span><?php } ?>
                          </div>
                        </div>
                        <div class="col-12 col-lg-4">
                          <div class="form-group">
                            <label for="company-name">Company Name</label>
                            <select
                              class="form-control <?php if(isset($input_errors['company'])){ echo 'border-danger'; } ?>"
                              id="company-name"
                              name="company"
                            >
                              <?php
                              $data = mysqli_query($con, "SELECT * FROM `company`");
                              while($row=mysqli_fetch_assoc($data)){
                                ?>
                                <option value="<?= $row['id'] ?>"><?= $row['name'] ?></option>
                                <?php
                              }
                              ?>
                            </select>
                          </div>
                        </div>
                      </div>

                      <button type="submit" name="add_student" class="btn btn-primary mr-2">
                        Submit
                      </button>
                      <button type="reset" class="btn btn-light">Cancel</button>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- content-wrapper ends -->
          <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
          <?php
          if(isset($success)){
            ?>
            <script>
            swal({
              title: "Student Add Successfully",
              text: "Thank you",
              icon: "success",
            });
          </script>
            <?php
          }
          ?>

          <?php
          require ('footer.php');
          ?>