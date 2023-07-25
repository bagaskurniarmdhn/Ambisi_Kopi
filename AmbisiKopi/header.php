<?php
include "process/connect.php";
$query = mysqli_query($conn, "SELECT * FROM tb_user WHERE username = '$_SESSION[username_ambisikopi]'");
$record = mysqli_fetch_array($query);
?>

<nav class="navbar navbar-expand bg-dark navbar-dark">
    <div class="container-lg">
        <a class="navbar-brand" href="."><i class="bi bi-cup-hot-fill"></i><b> Ambisi Kopi</b></a>
        <div class="collapse navbar-collapse justify-content-end" id="navbarNavDropdown">
            <ul class="navbar-nav">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        <?php echo $hasil['name']; ?>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end mt-2">
                        <li><a class="dropdown-item" href="#" data-bs-toggle="modal"
                                data-bs-target="#ModalChangeProfile"><i class="bi bi-person"></i> Profile</a></li>
                        <li><a class="dropdown-item" href="#" data-bs-toggle="modal"
                                data-bs-target="#ModalChangePassword"><i class="bi bi-key"></i> Ubah Password</a></li>
                        <li><a class="dropdown-item" href="logout"><i class="bi bi-box-arrow-right"></i> Logout</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- Modal Change Password-->
<div class="modal fade" id="ModalChangePassword" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-fullscreen-md-down">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Ubah Password</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="needs-validation" novalidate action="process/process-change-password.php" method="POST">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-floating mb-3">
                                <input disabled type="email" class="form-control" id="floatingInput"
                                    placeholder="name@example.com" name="username" required
                                    value="<?php echo $_SESSION['username_ambisikopi'] ?>">
                                <label for="floatingInput">Username</label>
                                <div class="invalid-feedback">Masukkan Username</div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-floating mb-3">
                                <input type="password" class="form-control" id="floatingPassword" name="oldpassword"
                                    required>
                                <label for="floatingInput">Password Lama</label>
                                <div class="invalid-feedback">Masukkan Password Lama</div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-floating mb-3">
                                <input type="password" class="form-control" id="floatingInput"
                                    placeholder="name@example.com" name="newpassword" required>
                                <label for="floatingInput">Password Baru</label>
                                <div class="invalid-feedback">Masukkan Password Baru</div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-floating mb-3">
                                <input type="password" class="form-control" id="floatingPassword" name="repasswordnew"
                                    required>
                                <label for="floatingInput">Ulang Password Baru</label>
                                <div class="invalid-feedback">Masukkan Ulang Password Baru</div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" name="change_password_validate" value="1234">Save
                            Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- End Modal Change Password-->

<!-- Modal Change Profile-->
<div class="modal fade" id="ModalChangeProfile" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-fullscreen-md-down">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Ubah Profile</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="needs-validation" novalidate action="process/process-change-profile.php" method="POST">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-floating mb-3">
                                <input disabled type="email" class="form-control" id="floatingInput"
                                    placeholder="name@example.com" name="username" required
                                    value="<?php echo $_SESSION['username_ambisikopi'] ?>">
                                <label for="floatingInput">Username</label>
                                <div class="invalid-feedback">Masukkan Username</div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="floatingName" name="name" required value="<?php echo $record['name'] ?>" >
                                <label for="floatingInput">Nama</label>
                                <div class="invalid-feedback">Masukkan Nama</div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-floating mb-3">
                                <input type="number" class="form-control" id="floatingInput" placeholder="notlpn" name="notlpn" required value="<?php echo $record['notlpn'] ?>">
                                <label for="floatingInput">No Hp</label>
                                <div class="invalid-feedback">Masukkan No Hp</div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" name="change_profile_validate" value="1234">Save
                            changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- End Modal Change Profile-->