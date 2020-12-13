<?php
/* Written by: OmarHammoud(40002184),
                Israt Noor Kazi(40029299)
*/
                
if (isset($_GET['errors'])) {
    $str_arr = unserialize(urldecode($_GET['errors']));
}

include "header.php";
?>
<div class="row">
<div class="col-6">
<div class="container">
    <div class="row">
        <div class="col-md-12  d-flex flex-column justify-content-center">
            <div class="row">
                <div class="col-lg-9 col-md-12 mx-auto">
                <?php if (isset($str_arr) && !empty($str_arr['signupMember'])) { ?>
                    <div class="alert alert-danger">
                        <strong>Error!</strong> <?php echo $str_arr['signupMember'] ?>
                    </div>
                <?php } ?>
                    <div class="card rounded shadow shadow-sm">
                        <div class="card-header">
                            <h3 class="mb-0">Sign up as a member</h3>
                        </div>
                        <div class="card-body">
                            <form action="signup.inc.php" method="post">
                                
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" class="form-control" name="name" placeholder="Name">
                                    <?php if (isset($str_arr) && !empty($str_arr['name'])) { ?>
                                        <span class="form-text text-danger"><?php echo $str_arr['name'] ?></span>
                                    <?php } ?>
                                </div>

                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="text" class="form-control" name="email" placeholder="Email">
                                    <?php if (isset($str_arr) && !empty($str_arr['email'])) { ?>
                                        <span class="form-text text-danger"><?php echo $str_arr['email'] ?></span>
                                    <?php } ?>
                                </div>

                                <div class="form-group">
                                    <label for="address">Address</label>
                                    <input type="text" class="form-control" name="address" placeholder="Address">
                                    <?php if (isset($str_arr) && !empty($str_arr['address'])) { ?>
                                        <span class="form-text text-danger"><?php echo $str_arr['address'] ?></span>
                                    <?php } ?>
                                </div>

                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input type="password" class="form-control" name="pwd" placeholder="Password">
                                    <?php if (isset($str_arr) && !empty($str_arr['password'])) { ?>
                                        <span class="form-text text-danger"><?php echo $str_arr['password'] ?></span>
                                    <?php } ?>
                                </div>

                                <div class="form-group">
                                    <label for="password">Confirm Password</label>
                                    <input type="password" class="form-control" name="pwd-second" placeholder="Type Password Again">
                                    <?php if (isset($str_arr) && !empty($str_arr['password2'])) { ?>
                                        <span class="form-text text-danger"><?php echo $str_arr['password2'] ?></span>
                                    <?php } ?>
                                </div>

                                <button type="submit" class="btn btn-primary" name="signup-submit">Sign Up</button>
                            </form>
                        </div>
                        <?php if (isset($str_arr) && !empty($str_arr['userMember'])) { ?>
                            <div class="card-footer">
                                <span class="form-text text-danger"><?php echo $str_arr['userMember'] ?></span>
                            </div>
                         <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>


<!-- contractor sign up -->
<div class="col-6">

    <div class="row">
        <div class="col-md-12  d-flex flex-column justify-content-center">
            <div class="row">
                <div class="col-lg-9 col-md-12 mx-auto">
                <?php if (isset($str_arr) && !empty($str_arr['signupContractor'])) { ?>
                    <div class="alert alert-danger">
                        <strong>Error!</strong> <?php echo $str_arr['signupContractor'] ?>
                    </div>
                <?php } ?>
                    <div class="card rounded shadow shadow-sm">
                        <div class="card-header">
                            <h3 class="mb-0">Sign up as a contractor</h3>
                        </div>
                        <div class="card-body">
                            <form action="signup.inc.php" method="post">
                                
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" class="form-control" name="name" placeholder="Name">
                                    <?php if (isset($str_arr) && !empty($str_arr['nameCon'])) { ?>
                                        <span class="form-text text-danger"><?php echo $str_arr['nameCon'] ?></span>
                                    <?php } ?>
                                </div>

                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="text" class="form-control" name="email" placeholder="Email">
                                    <?php if (isset($str_arr) && !empty($str_arr['emailCon'])) { ?>
                                        <span class="form-text text-danger"><?php echo $str_arr['emailCon'] ?></span>
                                    <?php } ?>
                                </div>


                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input type="password" class="form-control" name="pwd" placeholder="Password">
                                    <?php if (isset($str_arr) && !empty($str_arr['passwordCon'])) { ?>
                                        <span class="form-text text-danger"><?php echo $str_arr['passwordCon'] ?></span>
                                    <?php } ?>
                                </div>

                                <div class="form-group">
                                    <label for="password">Confirm Password</label>
                                    <input type="password" class="form-control" name="pwd-second" placeholder="Type Password Again">
                                    <?php if (isset($str_arr) && !empty($str_arr['password2Con'])) { ?>
                                        <span class="form-text text-danger"><?php echo $str_arr['password2Con'] ?></span>
                                    <?php } ?>
                                </div>

                                <button type="submit" class="btn btn-primary" name="contractorsignup-submit">Sign Up</button>
                            </form>
                        </div>
                        <?php if (isset($str_arr) && !empty($str_arr['userCon'])) { ?>
                            <div class="card-footer">
                                <span class="form-text text-danger"><?php echo $str_arr['userCon'] ?></span>
                            </div>
                         <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
</div>




