<?php
//Written By: Israt Noor Kazi (40029299)
if (isset($_GET['errors'])) {
    $str_arr = unserialize(urldecode($_GET['errors']));
}

?>
<?php include 'header.php'; ?>
<div class="container">
    <div class="row">
        <div class="col-md-12  d-flex flex-column justify-content-center">
            <div class="row">
                <div class="col-lg-6 col-md-8 mx-auto">
                <?php if (isset($str_arr) && !empty($str_arr['login'])) { ?>
                    <div class="alert alert-danger">
                        <strong>Error!</strong> <?php echo $str_arr['login'] ?>
                    </div>
                <?php } ?>
                    <div class="card rounded shadow shadow-sm">
                        <div class="card-header">
                            <h3 class="mb-0">Login</h3>
                        </div>
                        <div class="card-body">
                            <form action="./login.inc.php" method="post">
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="text" class="form-control" name="email" placeholder="Email">
                                    <?php if (isset($str_arr) && !empty($str_arr['email'])) { ?>
                                        <span class="form-text text-danger"><?php echo $str_arr['email'] ?></span>
                                    <?php } ?>
                                </div>

                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input type="password" class="form-control" name="pwd" placeholder="Password">
                                    <?php if (isset($str_arr) && !empty($str_arr['password'])) { ?>
                                        <span class="form-text text-danger"><?php echo $str_arr['password'] ?></span>
                                    <?php } ?>
                                </div>

                                <button type="submit" class="btn btn-primary" name="login-submit">Login</button>
                            </form>
                        </div>
                        <?php if (isset($str_arr) && !empty($str_arr['user'])) { ?>
                            <div class="card-footer">
                                <span class="form-text text-danger"><?php echo $str_arr['user'] ?></span>
                            </div>
                         <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>