<?php
include "proses/connect.php";
$query = mysqli_query($conn, "SELECT * FROM tb_user");
while ($record = mysqli_fetch_array($query)) {
  $result[] = $record;
}
?>
<div class="col-lg-9 mt-1">
  <div class="card">
    <div class="card-header">
      Halaman user
    </div>
    <div class="card-body">
      <div class="row">
        <div class="col d-flex justify-content-end ">
          <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#ModalTambahUser"> Tambah user
          </button>
        </div>
      </div>

      <!-- Modal awal tabah user baru -->
      <div class="modal fade" id="ModalTambahUser" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-fullscreen-md-down">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah User</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <form class="needs-validation" novalidate action="proses/proses_input_user.php" method="post">
                <div class="row">
                  <div class="col">
                    <div class="form-floating mb-3">
                      <input type="text" class="form-control" id="floatingInput" placeholder="Your Name" name="nama" required>
                      <label for="floatingInput">name</label>
                      <div class="invalid-feedback">
                        silahkan masukan nama.
                      </div>
                    </div>
                  </div>
                  <div class="col">
                    <div class="form-floating mb-3">
                      <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com" name="username" required>
                      <label for="floatingInput">Username</label>
                      <div class="invalid-feedback">
                        silahkan masukan username.
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-4">
                    <div class="form-floating mb-3">
                      <select class="form-select" aria-label="Default select example" name="level" required>
                        <option selected hidden value="">Pilih level user</option>
                        <option value="1">admin</option>
                        <option value="2">kasir</option>
                        <option value="3">koki</option>
                      </select>
                      <label for="floatingInput">Level User</label>
                      <div class="invalid-feedback">
                        silahkan pilih level.
                      </div>
                    </div>
                  </div>
                  <div class="col-8">
                    <div class="form-floating mb-3" >
                      <input type="number" class="form-control" id="floatingInput" placeholder="08xxxxx" name="nohp">
                      <label for="floatingInput">No hp</label>
                    </div>
                  </div>
                </div>
                <div class="form-floating">
                  <input type="password" class="form-control" id="floatingPassword" placeholder="Password" 
                    name="password" required>
                  <label for="floatingPassword">Password</label>
                  <div class="invalid-feedback">
                        silahkan buat password
                      </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-primary" name="input_user_validate" value="1234">Save
                    changes</button>
                </div>
              </form>
            </div>

          </div>
        </div>
      </div>
      <!-- Modal akhir tabah user baru -->


        <?php 
         foreach ($result as $row){         
          ?>
      <!-- Modal view -->
        <div class="modal fade" id="ModalView<?php echo $row['id']?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-xl modal-fullscreen-md-down">
            <div class="modal-content">
              <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Detail Data User</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                
              <form class="needs-validation" novalidate action="proses/proses_input_user.php" method="post">
                <div class="row">
                  <div class="col">
                    <div class="form-floating mb-3">
                      <input disabled type="text" class="form-control" id="floatingInput" placeholder="Your Name" name="nama" value="<?php echo $row['nama'] ?>">
                      <label for="floatingInput">name</label>
                      <div class="invalid-feedback">
                        silahkan masukan nama.
                      </div>
                    </div>
                  </div>
                  <div class="col">
                    <div class="form-floating mb-3">
                      <input disabled type="email" class="form-control" id="floatingInput" placeholder="name@example.com" name="username"  value="<?php echo $row['username'] ?>">
                      <label for="floatingInput">Username</label>
                      <div class="invalid-feedback">
                        silahkan masukan username.
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-4">
                    <div class="form-floating mb-3">
                    <input disabled type="email" class="form-control" id="floatingInput" placeholder="name@example.com" name="level"  value="
                    <?php 
                    if($row['level']==1){
                      echo "admin";
                    }elseif($row['level']==2){
                      echo "kasir";
                    }elseif($row['level']==3){
                      echo "koki";
                    }
                    ?>">
                      <label for="floatingInput">Lever User</label>
                      <div class="invalid-feedback">
                        silahkan pilih level.
                      </div>
                    </div>
                  </div>
                  <div class="col-8">
                    <div class="form-floating mb-3" >
                      <input disabled type="number" class="form-control" id="floatingInput" placeholder="08xxxxx" name="nohp" value="<?php echo $row['nohp'] ?>">
                      <label for="floatingInput">No hp</label>
                    </div>
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
              </form>
              </div>
            </div>
          </div>
        </div>
        <!-- akhir Modal view -->

         <!-- Modal edit -->
         <div class="modal fade" id="ModalEdit<?php echo $row['id']?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-xl modal-fullscreen-md-down">
            <div class="modal-content">
              <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Data User</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                
              <form class="needs-validation" novalidate action="proses/proses_edit_user.php" method="post">
              <input type="hidden" value="<?php echo $row['id'] ?>" name="id">
                <div class="row">
                  <div class="col">
                    <div class="form-floating mb-3">
                      <input type="text" class="form-control" id="floatingInput" placeholder="Your Name" name="nama" required value="<?php echo $row['nama'] ?>">
                      <label for="floatingInput">name</label>
                      <div class="invalid-feedback">
                        silahkan edit nama.
                      </div>
                    </div>
                  </div>
                  <div class="col">
                    <div class="form-floating mb-3">
                      <input <?php echo($row['username']== $_SESSION['username_thenoodles']) ? 'disabled' : ''; ?> type="email" class="form-control" id="floatingInput" placeholder="name@example.com" name="username" required value="<?php echo $row['username'] ?>">
                      <label for="floatingInput">Username</label>
                      <div class="invalid-feedback">
                        silahkan edit username.
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-4">
                    <div class="form-floating mb-3">
                    <select class="form-select" aria-label="Default select example" name="level" required>
                   <?php 
                   $data = array("admin","kasir","dapur");
                   foreach( $data as $key => $value){
                    if($row['level']== $key+1){
                      echo "<option selected value=".($key+1).">$value</option>";
                    }else{
                      echo "<option  value=".($key+1).">$value</option>";
                    }
                   }
                   ?>
                   </select>
                      <label for="floatingInput">Lever User</label>
                      <div class="invalid-feedback">
                        silahkan eidt level.
                      </div>
                    </div>
                  </div>
                  <div class="col-8">
                    <div class="form-floating mb-3" >
                      <input type="number" class="form-control" id="floatingInput" placeholder="08xxxxx" name="nohp" required value="<?php echo $row['nohp'] ?>">
                      <label for="floatingInput"> edit No hp</label>
                    </div>
                  </div>
                  <div class="form-floating">
                  <input type="text" class="form-control" id="floatingPassword" placeholder="Password" 
                    name="password" required value="<?php echo $row['password'] ?>">
                  <label for="floatingPassword">Password</label>
                  <div class="invalid-feedback">
                        silahkan eidt password
                      </div>
                </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-primary" name="input_user_validate" value="1234">Save
                    changes</button>
                </div>
              </form>
              </div>
            </div>
          </div>
        </div>
        <!-- akhir Modal edit -->

        <!-- Modal delete -->
        <div class="modal fade" id="ModalDelete<?php echo $row['id']?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-md modal-fullscreen-md-down">
            <div class="modal-content">
              <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Data User</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                
              <form class="needs-validation" novalidate action="proses/proses_delete_user.php" method="post">
              <input type="hidden" value="<?php echo $row['id'] ?>" name="id">
                   <div class="col-lg-12">
                    <?php 
                    if($row['username']== $_SESSION['username_thenoodles']){
                      echo "<div class='alert alert-danger'> anda tidak bisa menghapus akun sendiri!</div>";
                    }else{
                     echo " apakah anda yakin ingin menghapus user <B> $row[username] ?</B>";
                    }
                    ?>
                    
                   </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-danger" name="input_user_validate" value="1234" <?php echo($row['username']== $_SESSION['username_thenoodles']) ? 'disabled' : ''; ?> >Hapus</button>
                </div>
              </form>
              </div>
            </div>
          </div>
        </div>
        <!-- akhir Modal delete -->
        <?php
         }
      if (empty($result)) {
        echo "Data user tidak ada";
      } else {
        ?>

        <div class="table-responsive">
          <table class="table table-hover">
            <thead>
              <tr>
                <th scope="col">No</th>
                <th scope="col">Nama</th>
                <th scope="col">Username</th>
                <th scope="col">Level</th>
                <th scope="col">No HP</th>
                <th scope="col">aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $no = 1;
              foreach ($result as $row) {
                ?>
                <tr>
                  <th scope="row"><?php echo $no++ ?></th>
                  <td><?php echo $row['nama'] ?></td>
                  <td><?php echo $row['username'] ?></td>
                  <td>
                  <?php 
                    if($row['level']==1){
                      echo "admin";
                    }elseif($row['level']==2){
                      echo "kasir";
                    }elseif($row['level']==3){
                      echo "koki";
                    }
                    ?>
                  </td>
                  <td><?php echo $row['nohp'] ?></td>
                  <td class="d-flex">
                   <!-- <button class="btn btn-info btn-sm me-2" data-bs-toggle="modal" data-bs-target="#ModalView<?php echo $row['id']?>"><i class="bi bi-eye"></i> </button>-->
                    <button class="btn btn-warning btn-sm me-2" data-bs-toggle="modal" data-bs-target="#ModalEdit<?php echo $row['id']?> "><i class="bi bi-pencil-square"></i></i></button>
                    <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#ModalDelete<?php echo $row['id']?>"><i class="bi bi-trash"></i></button>
                  </td>
                </tr>
                <?php
              }
              ?>
            </tbody>
          </table>
        </div>
        <?php

      }
      ?>
    </div>
  </div>
</div>

<script>
    // Example starter JavaScript for disabling form submissions if there are invalid fields
(() => {
  'use strict'

  // Fetch all the forms we want to apply custom Bootstrap validation styles to
  const forms = document.querySelectorAll('.needs-validation')

  // Loop over them and prevent submission
  Array.from(forms).forEach(form => {
    form.addEventListener('submit', event => {
      if (!form.checkValidity()) {
        event.preventDefault()
        event.stopPropagation()
      }

      form.classList.add('was-validated')
    }, false)
  })
})()
</script>