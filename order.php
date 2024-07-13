<?php
include "proses/connect.php";
date_default_timezone_set('Asia/Jakarta');
$query = mysqli_query($conn, "SELECT *, SUM(harga*jumlah) AS harganya FROM tb_order 
LEFT JOIN tb_list_order on tb_list_order.order = tb_order.id_order 
LEFT JOIN tb_menu on tb_menu.id = tb_list_order.menu 
GROUP BY id_order ");
while ($record = mysqli_fetch_array($query)) {
  $result[] = $record;
}
?>
<div class="col-lg-9 mt-1">
  <div class="card">
    <div class="card-header">
      Halaman order
    </div>
    <div class="card-body">
      <div class="row">
        <div class="col d-flex justify-content-end ">
          <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#ModalTambahorder"> Tambah order
          </button>
        </div>
      </div>

      <!-- Modal awal tabah oeder baru -->
      <div class="modal fade" id="ModalTambahorder" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-xl modal-fullscreen-md-down">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah order</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <form class="needs-validation" novalidate action="proses/proses_input_order.php" method="post">
                <div class="row">
                  <div class="col">
                    <div class="form-floating mb-3">
                      <input type="text" class="form-control" id="kode_order" name="kode_order" value="<?php echo date('ymdHi').rand(100,999)  ?>" readonly>
                      <label  for="uploadfoto">kode order</label>
                      <div class="invalid-feedback">
                        silahkan masukan kode order.
                      </div>
                    </div>
                  </div>
                  <div class="col">
                    <div class="form-floating mb-3">
                      <input type="text" class="form-control" id="pelanggan" placeholder="nama pelanggan"
                        name="pelanggan" required>
                      <label for="pelanggan">Pelanggan</label>
                      <div class="invalid-feedback">
                        silahkan masukan nama pelanggan.
                      </div>
                    </div>
                  </div>
                </div>
                <div class="form-floating mb-3">
                  <input type="text" class="form-control" id="catatan" placeholder="catatan" name="catatan">
                  <label for="catatan">catatan</label>
                </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary" name="input_order_validate" value="1234">buat order</button>
            </div>
            </form>
          </div>

        </div>
      </div>
    </div>
    <!-- Modal akhir tabah order baru -->


    <?php
    if (empty($result)) {
      echo "Data menu tidak ada";
    } else {
      foreach ($result as $row) {
        ?>
        <!-- Modal view -->
        <div class="modal fade" id="ModalView<?php echo $row['id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel"
          aria-hidden="true">
          <div class="modal-dialog modal-xl modal-fullscreen-md-down">
            <div class="modal-content">
              <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Detail Data menu</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <form class="needs-validation" novalidate action="proses/proses_input_menu.php" method="post">
                  <div class="row">
                    <div class="col-lg-12">
                      <div class="form-floating mb-3">
                        <input disabled type="text" class="form-control" id="floatingInput" placeholder="nama menu"
                          name="nama_menu" value="<?php echo $row['nama_menu'] ?>">
                        <label for="floatingInput">nama menu</label>
                        <div class="invalid-feedback">
                          silahkan masukan nama menu.
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="form-floating mb-3">
                    <input disabled type="text" class="form-control" id="floatingInput" placeholder="keterangan"
                      name="keterangan" value="<?php echo $row['keterangan'] ?>">
                    <label for="floatingInput">keterangan</label>
                  </div>
                  <div class="row">
                    <div class="col-4">
                      <div class="form-floating mb-3">
                        <input disabled type="email" class="form-control" id="floatingInput" placeholder="name@example.com"
                          name="kategori" value="
                    <?php
                    if ($row['kategori'] == 1) {
                      echo "mie";
                    } elseif ($row['kategori'] == 2) {
                      echo "ramen";
                    } elseif ($row['kategori'] == 3) {
                      echo "pasta";
                    } elseif ($row['kategori'] == 4) {
                      echo "minuman";
                    }
                    ?>">
                        <label for="floatingInput">kategori menu</label>
                        <div class="invalid-feedback">
                          silahkan pilih kategori menu.
                        </div>
                      </div>
                    </div>
                    <div class="col-4">
                      <div class="form-floating mb-3">
                        <input disabled type="number" class="form-control" id="floatingInput" placeholder="harga"
                          name="harga" value="<?php echo $row['harga'] ?>">
                        <label for="floatingInput">Harga</label>
                        <div class="invalid-feedback">
                          silahkan masukan harga menu.
                        </div>
                      </div>
                    </div>
                    <div class="col-4">
                      <div class="form-floating mb-3">
                        <input disabled type="number" class="form-control" id="floatingInput" placeholder="stok" name="stok"
                          value="<?php echo $row['stok'] ?>">
                        <label for="floatingInput">stok</label>
                        <div class="invalid-feedback">
                          silahkan masukan stok menu.
                        </div>
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
        <div class="modal fade" id="ModalEdit<?php echo $row['id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel"
          aria-hidden="true">
          <div class="modal-dialog modal-xl modal-fullscreen-md-down">
            <div class="modal-content">
              <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Data menu</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <form class="needs-validation" novalidate action="proses/proses_edit_menu.php" method="post"
                  enctype="multipart/form-data">
                  <input type="hidden" value="<?php echo $row['id'] ?>" name="id">
                  <div class="row">
                    <div class="col">
                      <div class="input-group mb-3">
                        <input type="file" class="form-control py-3" id="uploadfoto" placeholder="Your Name" name="foto">
                        <label class="input-group-text" for="uploadfoto">upload foto menu</label>
                        <div class="invalid-feedback">
                          silahkan masukan file foto menu.
                        </div>
                      </div>
                    </div>
                    <div class="col">
                      <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="floatingInput" placeholder="nama menu" name="nama_menu"
                          value="<?php echo $row['nama_menu'] ?>">
                        <label for="floatingInput">nama menu</label>
                        <div class="invalid-feedback">
                          silahkan masukan nama menu.
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="floatingInput" placeholder="keterangan" name="keterangan"
                      value="<?php echo $row['keterangan'] ?>">
                    <label for="floatingInput">keterangan</label>
                  </div>
                  <div class="row">
                    <div class="col-4">
                      <div class="form-floating mb-3">
                        <select class="form-select" aria-label="Default select example" name="kategori" required>
                          <?php
                          $data = array("mie", "ramen", "pata", "minuman");
                          foreach ($data as $key => $value) {
                            if ($row['kategori'] == $key + 1) {
                              echo "<option selected value=" . ($key + 1) . ">$value</option>";
                            } else {
                              echo "<option  value=" . ($key + 1) . ">$value</option>";
                            }
                          }
                          ?>
                        </select>
                        <label for="floatingInput">kategori menu</label>
                        <div class="invalid-feedback">
                          silahkan eidt kategori.
                        </div>
                      </div>
                    </div>
                    <div class="col-4">
                      <div class="form-floating mb-3">
                        <input type="number" class="form-control" id="floatingInput" placeholder="harga" name="harga"
                          value="<?php echo $row['harga'] ?>" required>
                        <label for="floatingInput">Harga</label>
                        <div class="invalid-feedback">
                          silahkan masukan harga menu.
                        </div>
                      </div>
                    </div>
                    <div class="col-4">
                      <div class="form-floating mb-3">
                        <input type="number" class="form-control" id="floatingInput" placeholder="stok" name="stok"
                          value="<?php echo $row['stok'] ?>" required>
                        <label for="floatingInput">stok</label>
                        <div class="invalid-feedback">
                          silahkan masukan stok menu.
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" name="input_menu_validate" value="1234">Save
                      changes</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
        <!-- akhir Modal edit -->

        <!-- Modal delete -->
        <div class="modal fade" id="ModalDelete<?php echo $row['id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel"
          aria-hidden="true">
          <div class="modal-dialog modal-md modal-fullscreen-md-down">
            <div class="modal-content">
              <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Data User</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">

                <form class="needs-validation" novalidate action="proses/proses_delete_menu.php" method="post">
                  <input type="hidden" value="<?php echo $row['id'] ?>" name="id">
                  <input type="hidden" value="<?php echo $row['foto'] ?>" name="foto">
                  <div class="col-lg-12">
                    apakah anda yakin ingin menghapus menu <b><?php echo $row['nama_menu'] ?></b>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-danger" name="input_menu_validate" value="1234">Hapus </button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
        <!-- akhir Modal delete -->
        <?php
      }

      ?>

      <div class="table-responsive">
        <table class="table table-hover">
          <thead>
            <tr>
              <th scope="col">No</th>
              <th scope="col">Kode Order</th>
              <th scope="col">Pelanggan</th>
              <th scope="col">Total Harga</th>
              <th scope="col">Status</th>
              <th scope="col">Waktu Order</th>
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
                <td><?php echo $row['id_order'] ?></td>
                <td><?php echo $row['pelanggan'] ?></td>
                <td><?php echo $row['harganya'] ?></td>
                <td><?php echo $row['status'] ?></td>
                <td><?php echo $row['waktu_order'] ?></td>
                <td>
                  <div class="d-flex">
                   <!-- <button class="btn btn-info btn-sm me-2" data-bs-toggle="modal"
                      data-bs-target="#ModalView<?php echo $row['id_order'] ?>"><i class="bi bi-eye"></i> </button>-->
                    <button class="btn btn-warning btn-sm me-2" data-bs-toggle="modal"
                      data-bs-target="#ModalEdit<?php echo $row['id_order'] ?> "><i
                        class="bi bi-pencil-square"></i></i></button>
                    <button class="btn btn-danger btn-sm" data-bs-toggle="modal"
                      data-bs-target="#ModalDelete<?php echo $row['id_order'] ?>"><i class="bi bi-trash"></i></button>
                  </div>
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
        s
        if (!form.checkValidity()) {
          event.preventDefault()
          event.stopPropagation()
        }

        form.classList.add('was-validated')
      }, false)
    })
  })()
</script>