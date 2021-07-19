<?php 
    $title = 'Data Anggota';
    include '../../konfigurasi/config.php';
    include '../../konfigurasi/function.php'; 
    session_start();
    $con = connect_db();
?>
    
    <?php 
        include '../../layouts/header.php';
    ?>

    <div class="page-content-wrapper ">

        <div class="container-fluid">

            <div class="row">
                <div class="col-sm-12">
                    <div class="page-title-box">
                        <div class="btn-group float-right">
                            <ol class="breadcrumb hide-phone p-0 m-0">
                                <li class="breadcrumb-item"><a href="<?=BASEPATH?>" class="active">Menu Utama</a></li>
                                <li class="breadcrumb-item"><a href="#" class="active">Data Pengguna</a></li>
                                <li class="breadcrumb-item"><a href="#" class="active">Data Anggota</a></li>
                            </ol>
                        </div>
                        <h4 class="page-title">Data Anggota</h4>
                    </div>
                </div>
            </div>
            <!-- end page title end breadcrumb -->

            <div class="row">
                <div class="col-12">
                    <div class="card m-b-30">
                        <div class="card-body">
                            <!-- Alert buat notifikasi berhasil hapus -->
                            <?php
                                if (isset($_SESSION["suksestambah"])){
                                    echo "
                                    <div class='alert alert-success alert-dismissible fade show' role='alert'>
                                        <strong>".$_SESSION['suksestambah']."</strong>
                                        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                            <span aria-hidden='true'>&times;</span>
                                        </button>
                                    </div>
                                    ";
                                    unset($_SESSION['suksestambah']);
                                }else if (isset($_SESSION["suksesedit"])){
                                    echo "
                                    <div class='alert alert-warning alert-dismissible fade show' role='alert'>
                                        <strong>".$_SESSION['suksesedit']."</strong>
                                        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                            <span aria-hidden='true'>&times;</span>
                                        </button>
                                    </div>
                                    ";
                                    unset($_SESSION['suksesedit']);
                                }else if (isset($_SESSION["sukseshapus"])){
                                    echo "
                                    <div class='alert alert-danger alert-dismissible fade show' role='alert'>
                                        <strong>".$_SESSION['sukseshapus']."</strong>
                                        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                            <span aria-hidden='true'>&times;</span>
                                        </button>
                                    </div>
                                    ";
                                    unset($_SESSION['sukseshapus']);
                                }
                            ?>
                            <div class="row m-b-20">
                                <div class="col-sm-12">
                                    <a href="tambah.php" class="float-left btn btn-primary m-b-10 waves-effect waves-light">
                                        <span><i class="fa fa-user-plus"></i>  Tambah Data</span>
                                    </a>
                                </div>
                            </div>
                            

                            <div class="table-rep-plugin">
                                <div class="table-responsive b-0" data-pattern="priority-columns">
                                    <table id="tabel_buku" class="table table-hover">
                                        <thead class="text-white text-center bg-primary">
                                        <tr>
                                            <th>No.</th>
                                            <th>Kode Anggota</th>
                                            <th>Nama</th>
                                            <th>Jenis Kelamin</th>
                                            <th>No. Telpon</th>
                                            <th>Alamat</th>
                                            <th>Aksi</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                      
                                        <?php
                                            $query = "SELECT * FROM tb_anggota ORDER BY id DESC";
                                            $result = execute_query($con, $query);
                                            $no = 1;
                                            while ($data = mysqli_fetch_array($result)){
                                        ?>
                                        <tr>
                                            <td class="text-center"><b><?= $no."." ?></b></td>
                                            <td><?= $data['kode_anggota'] ?></td>
                                            <td><?= $data['nama'] ?></td>
                                            <td><?= $data['jenkel']=='L' ? 'Laki-Laki' : 'Perempuan'; ?></td>
                                            <td><?= $data['no_telp'] ?></td>
                                            <td><?= $data['alamat'] ?></td>
                                            <td>
                                                <div class="row text-center">
                                                    <div class="col-sm-4">
                                                        <a href="detail.php?anggota=<?= $data['kode_anggota'] ?>" class="btn btn-lg btn-success waves-effect waves-light" data-toggle="tooltip" title="Lihat data <?= $data['kode_anggota'] ?>">
                                                            <i class="mdi mdi-account-card-details"></i></a>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <a href="edit.php?anggota=<?= $data['kode_anggota'] ?>" class="btn btn-info waves-effect waves-light" data-toggle="tooltip" title="Edit data <?= $data['kode_anggota'] ?>">
                                                            <i class="mdi mdi-pencil-box"></i></a>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <a href="hapus.php?anggota=<?= $data['kode_anggota'] ?>" onclick="return confirm('Yakin Hapus Data?')" class="btn btn-danger waves-effect waves-light" data-toggle="tooltip" title="Hapus data <?= $data['kode_anggota'] ?>">
                                                            <i class="mdi mdi-delete-forever"></i></a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <?php
                                            $no++;
                                            }
                                        ?>
                                        </tbody>
                                    </table>
                                </div>

                            </div>

                        </div>
                    </div>
                </div> <!-- end col -->
            </div>
                                                            
        </div><!-- container -->


    </div> <!-- Page content Wrapper -->

</div> <!-- content -->

<?php include '../../layouts/footer.php';?>
<script>
    $(document).ready(function(){
        $('#tabel_buku').DataTable({
            lengthMenu: [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]],
            // dom: 'Blfrtip',
            dom:"<'row'<'col-sm-12 col-md-3'l><'col-sm-12 col-md-5 text-center'B><'col-sm-12 col-md-4'f>>" +
                "<'row'<'col-sm-12'tr>>" +
                "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
            buttons: [
                {
                    extend: 'csv', 
                    className: 'btn-primary',
                    text: '<i class="mdi mdi-file-excel"></i> CSV',
                },
                { 
                    extend: 'excel', 
                    className: 'btn-primary',
                    text: '<i class="mdi mdi-file-excel"></i> Excel', },
                { 
                    extend: 'pdf', 
                    className: 'btn-primary',
                    text: '<i class="mdi mdi-file-pdf"></i> Pdf', },
                { 
                    extend: 'print', 
                    className: 'btn-primary',
                    text: '<i class="mdi mdi-printer"></i> Print', },
            ]
        });
    });
</script>
