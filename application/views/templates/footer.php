<!-- ============================================================== -->
<!-- footer -->
<!-- ============================================================== -->
<footer class="footer text-center text-muted">
    &copy; Copyright <strong><span><a href="<?= base_url('') ?>">Chaerul Umam | umaystory</a></span></strong>. All Rights Reserved
</footer>
<!-- ============================================================== -->
<!-- End footer -->
<!-- ============================================================== -->
</div>
<!-- ============================================================== -->
<!-- End Page wrapper  -->
<!-- ============================================================== -->
</div>
<!-- ============================================================== -->
<!-- End Wrapper -->
<!-- ============================================================== -->
<!-- End Wrapper -->
<!-- ============================================================== -->
<!-- All Jquery -->
<!-- ============================================================== -->


<!-- <script src="<?php echo base_url('assets/js/jquery-3.6.0.min.js') ?>"></script> -->
<script src="<?php echo base_url('assets/js/jquery-2.1.4.min.js') ?>"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.33.1/sweetalert2.min.js"></script>

<script src="<?= base_url('assets/'); ?>libs/jquery/dist/jquery.min.js"></script>
<script src="<?= base_url('assets/'); ?>libs/popper.js/dist/umd/popper.min.js"></script>
<script src="<?= base_url('assets/'); ?>libs/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- apps -->
<!-- apps -->
<script src="<?= base_url('assets/'); ?>dist/js/app-style-switcher.js"></script>
<script src="<?= base_url('assets/'); ?>dist/js/feather.min.js"></script>
<script src="<?= base_url('assets/'); ?>libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js"></script>
<script src="<?= base_url('assets/'); ?>dist/js/sidebarmenu.js"></script>
<!--Custom JavaScript -->
<script src="<?= base_url('assets/'); ?>dist/js/custom.min.js"></script>
<!--This page JavaScript -->
<script src="<?= base_url('assets/'); ?>extra-libs/c3/d3.min.js"></script>
<script src="<?= base_url('assets/'); ?>extra-libs/c3/c3.min.js"></script>
<script src="<?= base_url('assets/'); ?>libs/chartist/dist/chartist.min.js"></script>
<script src="<?= base_url('assets/'); ?>libs/chartist-plugin-tooltips/dist/chartist-plugin-tooltip.min.js"></script>
<script src="<?= base_url('assets/'); ?>extra-libs/jvector/jquery-jvectormap-2.0.2.min.js"></script>
<script src="<?= base_url('assets/'); ?>extra-libs/jvector/jquery-jvectormap-world-mill-en.js"></script>
<script src="<?= base_url('assets/'); ?>dist/js/pages/dashboards/dashboard1.min.js"></script>

<!-- Datatables -->
<script src="<?php echo base_url('assets/datatables/datatables/js/jquery.dataTables.min.js') ?>"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.15.7/dist/sweetalert2.all.min.js"></script>

<?php if ($titleMenu == 'Menu Order') echo include('order_js.php'); ?>

<script type="text/javascript">
    function timerAutomatic() {
        var detik = 3;

        function hitung() {
            var to = setTimeout(hitung, 1000);
            detik--;
            if (detik < 0) {
                clearTimeout(to);
                detik = 3;
                $(".msg-add-success").hide('slow');
                $(".msg-update-success").hide('slow');
                $(".msg-delete-success").hide('slow');
            }
        }
        hitung();
    }



    function hanyaAngka(evt) {
        var charCode = (evt.which) ? evt.which : event.keyCode
        if (charCode > 31 && (charCode < 48 || charCode > 57))

            return false;
        return true;
    }

    function number_format(number, decimals, decPoint, thousandsSep) {
        number = (number + '').replace(/[^0-9+\-Ee.]/g, '')
        var n = !isFinite(+number) ? 0 : +number
        var prec = !isFinite(+decimals) ? 0 : Math.abs(decimals)
        var sep = (typeof thousandsSep === 'undefined') ? ',' : thousandsSep
        var dec = (typeof decPoint === 'undefined') ? '.' : decPoint
        var s = ''

        var toFixedFix = function(n, prec) {
            var k = Math.pow(10, prec)
            return '' + (Math.round(n * k) / k)
                .toFixed(prec)
        }

        // @todo: for IE parseFloat(0.55).toFixed(0) = 0;
        s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.')
        if (s[0].length > 3) {
            s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep)
        }
        if ((s[1] || '').length < prec) {
            s[1] = s[1] || ''
            s[1] += new Array(prec - s[1].length + 1).join('0')
        }

        return s.join(dec)
    }
</script>
<script src="https://code.jquery.com/ui/1.11.3/jquery-ui.min.js"></script>
</body>

</html>