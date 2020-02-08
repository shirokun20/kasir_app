<!DOCTYPE html>
<html lang="en">
<head>
  <title><?= $title ?></title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</head>
<body>
  <div class="container">
    <div class="row">
      <div class="col-lg"></div>
      <div class="col-lg-6">
        <h1 class="text-center"><?=$nama_aplikasi?></h1>
        <hr>
        <div class="card">
          <form id="form_sunnah">
          <div class="card-body">
            <div class="alert" style="display: none;">
              <div class="pesan"></div>
            </div>
            <div class="form-group">
              <label>Email/Hp</label>
              <div>
                <!-- <input type="text" name="email" class="form-control" placeholder="Masukan Email/Hp" required> -->
                <?php 

                echo form_input('email', '', [
                  'class' => 'form-control',
                  'placeholder' => 'Masukan Email/Hp',
                  'required' => ''
              ]);
                 ?>
              </div>
            </div>
            <div class="form-group password_div" style="display: none;">
              <label>Password</label>
              <div>
                <input type="password" name="password" class="form-control" placeholder="Masukan Password">
              </div>
            </div>
          </div>
          </form>
        </div>
      </div>
      <div class="col-lg"></div>
    </div>
  </div>

  <script>
    var url = location.href;
    var email = $('[name="email"]');
    var password = $('[name="password"]');
    var formSunnah = $('#form_sunnah');
    var password_div = $('.password_div');
    var alert = $('.alert');
    var pesan = $('.pesan');
    $(() => {
      formSunnah.on({
        submit: (e) => {
          // this.checkValidasi();
          return false;
        },
        change: (e) => {
          this.chechDuluInputannya();
        }
      })
    });

    email.on({
      change: (e) => {
        this.checkEmail();
      },
      keyup: (e) => {
        this.checkEmail();
      }
    });

    var chechDuluInputannya = () => {
      if (password.val() != '') {
          this.checkValidasi();
      }
    }

    var checkEmail =  async () => {
      try {
        var { shiro } = await $.ajax({
          url: url + '/home/checkEmail',
          data: {
            email: email.val(),
          },
          type: "POST",
          dataType: "JSON"
        });

        if (shiro.status == 'ada') {
          password_div.slideDown('slow');
          // alert.slideDown('slow');
          // alert.addClass('alert-success');
          // alert.removeClass('alert-danger');
          // pesan.text(shiro.pesan);
        }else {
          password_div.slideUp('slow');
          // alert.slideDown('slow');
          // alert.removeClass('alert-success');
          // alert.addClass('alert-danger');
          // pesan.text(shiro.pesan);
        }
      } catch (e) {

      }
    }

    var checkValidasi =  async () => {
      try {
        var { shiro } = await $.ajax({
          url: url + '/home/checkValidasi',
          data: {
            email: email.val(),
            password: password.val(),
          },
          type: "POST",
          dataType: "JSON"
        });

        if (shiro.status == 'berhasil') {
          alert.slideDown('slow');
          alert.addClass('alert-success');
          alert.removeClass('alert-danger');
          pesan.text(shiro.pesan);
        }else {
          alert.slideDown('slow');
          alert.removeClass('alert-success');
          alert.addClass('alert-danger');
          pesan.text(shiro.pesan);
        }
        alertHilang(shiro.status);
      } catch (e) {

      }
    }

    var alertHilang = (status) => {
      setTimeout(e => {
        alert.slideUp('slow');
        alert.removeClass('alert-danger');
        alert.removeClass('alert-success');
        pesan.text('');
        if (status == 'berhasil') {
          location.reload();
        }
      }, 2000);
    }
  </script>
</body>
</html>
