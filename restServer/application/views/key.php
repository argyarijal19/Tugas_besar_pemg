<!DOCTYPE html>
<html lang="">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Api-Key</title>
    <link href="<?= base_url();?>/assets/key.css" rel="stylesheet">
</head>

<body>
    <div class="container">
        <h3 class="text-center">GENERATE KEY</h3>
        <hr>
        <form action="<?php echo base_url('auth/generateKey') ?>" method="POST">
            <?php $id = $this->session->userdata('id_user') ?>
            <?php $this->db->where('user_id', $id);
            // here we select every column of the table
            $q = $this->db->get('keys');
            $data = $q->result_array(); ?>
            <?php if (!isset($data[0]['key'])) : ?>
                <div class="form">
                    <div class="title">Welcome</div>
                    <div class="subtitle">Let's create your key access!</div>
                        <div class="input-container ic1">
                            <input id="firstname" class="input" disabled type="text" placeholder=" " />
                            <div class="cut"></div>
                                <label for="firstname" class="placeholder">Your API Access Click Generate</label>
                        </div>
                        <!-- <button type="submit" name="submit" class="submit">submit</button> -->
                </div>
                <input class="submit" name="submit" type="submit" value="Generate Key">
            <?php else : ?>
                <br>
                <br>
                <br>
                <div class="title"><?= $data[0]['key'] ?></div>
                    <div class="subtitle"><?= strtoupper($this->session->userdata('username')) ?>,USE THIS CODE FOR YOUR ACCESS API KEY
                    </div>
                        <!-- <button type="submit" name="submit" class="submit">submit</button> -->
                        <!-- <input class="submit" name="submit" type="submit" value="Generate Key"> -->
                        <button class="submit">
                            <a  href="<?= base_url('auth/logout') ?>" class="btn-btn-primary">Logout</a>
                        </button>
                    </div>
            <?php endif; ?>
        </form>
    </div>
</body>

</html>