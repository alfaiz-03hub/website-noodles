<?php
include "proses/connect.php";
$query = mysqli_query($conn, "SELECT *, SUM(harga*jumlah) AS harganya FROM tb_list_order 
LEFT JOIN tb_order on tb_order.id_order = tb_list_order.order 
LEFT JOIN tb_menu on tb_menu.id = tb_list_order.menu 
GROUP BY id_list_order 
HAVING tb_list_order.order = $_GET[order]");

$kode = $_GET['order'];
$pelanggan = $_GET['pelanggan'];

while ($record = mysqli_fetch_array($query)) {
  $result[] = $record;
  //$kode = $record['id_order'];
  // $pelanggan = $record['pelanggan'];
}
?>
<div class="col-lg-9 mt-1">
  <div class="card">
    <div class="card-header">
      Halaman order item
    </div>
    <div class="card-body">
      <div class="row">
        <div class="col-lg-4">
          <div class="form-floating mb-3">
            <input type="text" disabled class="form-control" id="kodeorder" placeholder="nama menu" name="kode_order"
              value="<?php echo $kode; ?>">
            <label for="floatingInput">kode order</label>
          </div>
        </div>
        <div class="col-lg-4">
          <div class="form-floating mb-3">
            <input type="text" disabled class="form-control" id="pelanggan" placeholder="nama menu" name="pelanggan"
              value="<?php echo $pelanggan; ?>">
            <label for="floatingInput">nama pelanggan</label>
          </div>
        </div>
        <div class="col d-flex justify-content-end ">
        </div>
      </div>

      <!-- Modal awal tabah item -->
      <div class="modal fade" id="tambahitem" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-xl modal-fullscreen-md-down">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah menu</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <form class="needs-validation" novalidate action="proses/proses_input_menu.php" method="post"
                enctype="multipart/form-data">
                <div class="row">
                  <div class="col">
                    <div class="input-group mb-3">
                      <input type="file" class="form-control py-3" id="uploadfoto" placeholder="Your Name" name="foto"
                        required>
                      <label class="input-group-text" for="uploadfoto">upload foto menu</label>
                      <div class="invalid-feedback">
                        silahkan masukan file foto menu.
                      </div>
                    </div>
                  </div>
                  <div class="col">
                    <div class="form-floating mb-3">
                      <input type="text" class="form-control" id="floatingInput" placeholder="nama menu"
                        name="nama_menu" required>
                      <label for="floatingInput">nama menu</label>
                      <div class="invalid-feedback">
                        silahkan masukan nama menu.
                      </div>
                    </div>
                  </div>
                </div>
                <div class="form-floating mb-3">
                  <input type="text" class="form-control" id="floatingInput" placeholder="keterangan" name="keterangan">
                  <label for="floatingInput">keterangan</label>
                </div>
                <div class="row">
                  <div class="col-4">
                    <div class="form-floating mb-4">
                      <select class="form-select" aria-label="Default select example" name="kategori" required>
                        <option selected hidden value="">Pilih kategori menu</option>
                        <option value="1">Mie</option>
                        <option value="2">Ramen</option>
                        <option value="3">Pasta</option>
                        <option value="4">Minuman</option>
                      </select>
                      <label for="floatingInput">kategori menu</label>
                      <div class="invalid-feedback">
                        silahkan pilih Kategori menu.
                      </div>
                    </div>
                  </div>
                  <div class="col-4">
                    <div class="form-floating mb-4">
                      <input type="number" class="form-control" id="floatingInput" placeholder="harga" name="harga"
                        required>
                      <label for="floatingInput">harga</label>
                      <div class="invalid-feedback">
                        silahkan masukan harga menu.
                      </div>
                    </div>
                  </div>
                  <div class="col-4">
                    <div class="form-floating mb-4">
                      <input type="number" class="form-control" id="floatingInput" placeholder="stok" name="stok"
                        required>
                      <label for="floatingInput">stok</label>
                      <div class="invalid-feedback">
                        silahkan masukan stok menu.
                      </div>
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
    <!-- Modal akhir tabah item -->


    <?php
    if (empty($result)) {
      echo "Data item tidak ada";
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

              <th scope="col">menu</th>
              <th scope="col">harga</th>
              <th scope="col">Qty</th>
              <th scope="col">total</th>
              <th scope="col">aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $total = 0;
            foreach ($result as $row) {
              ?>
              <tr>
                <td><?php echo $row['nama_menu'] ?></td>
                <td><?php echo $row['harga'] ?></td>
                <td><?php echo $row['jumlah'] ?></td>
                <td><?php echo $row['harganya'] ?></td>
                <td>
                  <div class="d-flex">
                    <button class="btn btn-info btn-sm me-2" data-bs-toggle="modal"
                      data-bs-target="#ModalView<?php echo $row['id'] ?>"><i class="bi bi-eye"></i> </button>
                    <button class="btn btn-warning btn-sm me-2" data-bs-toggle="modal"
                      data-bs-target="#ModalEdit<?php echo $row['id'] ?> "><i class="bi bi-pencil-square"></i></i></button>
                    <button class="btn btn-danger btn-sm" data-bs-toggle="modal"
                      data-bs-target="#ModalDelete<?php echo $row['id'] ?>"><i class="bi bi-trash"></i></button>
                  </div>
                </td>
              </tr>
              <?php
              $total += $row['harganya'];
            }
            ?>
            <tr>
              <td colspan="3" class="fw-bold">
                Total harga:
              </td>
              <td class="fw-bold">
                <?php echo $total ?>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
      <?php
    }
    ?>
    <div>
      <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#tambahitem"> <i class="bi bi-cart-plus"></i> Tambah Item</button>
      <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#bayar"> <i class="bi bi-cash-coin"></i> bayar</button>
    </div>
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