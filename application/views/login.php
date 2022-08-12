<div class="box-root padding-top--24 flex-flex flex-direction--column" style="flex-grow: 1; z-index: 9;">
    <div class="box-root padding-top--48 padding-bottom--24 flex-flex flex-justifyContent--center">
        <h1><a href="<?= base_url(''); ?>" rel=" dofollow">Form Login</a></h1>
    </div>
    <div class="formbg-outer ">
        <div class="formbg container-umay">
            <div class="formbg-inner padding-horizontal--24">
                <span class="padding-bottom--15">Silahkan masuk ke akun Anda</span>
                <?= $this->session->flashdata('message'); ?>
                <form method="post" class="card_form" action="<?= base_url('auth/login') ?>">
                    <div class="field padding-bottom--24">
                        <label for="email">Email</label>
                        <input type="text" name="email" id="email" placeholder="Isi Email Anda..." value="<?= set_value('email'); ?>">
                        <?= form_error('email', ''); ?>
                    </div>
                    <div class="field padding-bottom--24">
                        <div class="grid--50-50">
                            <label for="password">Kata Sandi</label>
                        </div>
                        <input type="password" maxlength="15" name="password" id="pwd" placeholder="Isi Kata Sandi Anda...">
                        <?= form_error('password', ''); ?>
                    </div>
                    <div class="field field-checkbox padding-bottom--24 flex-flex align-center">
                    </div>
                    <div class="field padding-bottom--24">
                        <input type="submit" name="submit" value="Masuk">
                    </div>
                </form>
            </div>
            <div class="footer-link">
                <div class="listing padding-bottom--24 flex-flex center-center">
                    <span><a href="https://umaystory.com/">© Chaerul Umam</a></span>
                    <span><a href="https://api.whatsapp.com/send/?phone=6289605428173&text&type=phone_number&app_absent=0" target="_blank"><i class="bi bi-whatsapp fas fa-fw"></i> Hubungi Kami</a></span>
                </div>
            </div>
        </div>
    </div>

    <div class="formbg-outer mt-2 mb-5">
        <div class="formbg container-umay">
            <div class="formbg-inner padding-horizontal--24">
                <label for="email">Email User : user@user.com</label>
                <label for="email">Email Admin : admin@admin.com</label>
                <label for="password">Password : P@ssw0rd</label>
            </div>
        </div>
    </div>
</div>