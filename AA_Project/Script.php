<!-- Bootstrap core JavaScript-->
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="js/sb-admin-2.min.js"></script>

<!-- Page level plugins -->
<script src="vendor/chart.js/Chart.min.js"></script>
<script src="vendor/datatables/jquery.dataTables.min.js"></script>
<script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

<!-- Page level custom scripts -->
<script src="js/demo/chart-area-demo.js"></script>
<script src="js/demo/chart-pie-demo.js"></script>
<script src="js/demo/chart-bar-demo.js"></script>
<script src="js/demo/chart-bar1-demo.js"></script>
<script src="https://kit.fontawesome.com/40d2a5e3c5.js" crossorigin="anonymous"></script>

<!-- Page level custom scripts -->
<script src="js/demo/datatables-demo.js"></script>

<!-- Core plugin JavaScript-->
<script src="vendor/jquery-easing/jquery.easing.min.js"></script>


<script src="https://code.jquery.com/jquery-3.7.1.min.js"> </script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script src="../JS/datetime.js" type="text/javascript"></script>
<script>
    $(document).ready(function() {
        setInterval(datetime, 200);
    });
</script>

<script src="js/Re_out/Logout.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script src="../js/dropdown.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="../js/checkout.js"></script>
<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
<script>
    var th = {
        NV_menu_up: 'อัพโหลด',
        NV_menu_State: 'สถิติ',
        NV_menu_test: 'ทดสอบ',
        btn_lang: 'TH',
        HFile_upload: 'อัพโหลดไฟล์ของคุณที่นี่',
        P_upload: 'คุณสามารถโหลดจากไฟล์เดียวหรือหลายไฟล์ได้ในคราวเดียวโดยการลากไฟล์เหล่านั้นลงบนเว็บไซต์หรือกดปุ่มอัปโหลด',
        B_upload: 'อัพโหลด',
        P_accuracy: 'ความแม่นยำทั้งหมด:',
    }
    var en = {
        NV_menu_up: 'Upload',
        NV_menu_State: 'Statistic',
        NV_menu_test: 'Test',
        btn_lang: 'EN',
        HFile_upload: 'Upload your files here',
        P_upload: 'You can load from a single file or multiple at once files by dragging them onto the website, or press the upload button.',
        B_upload: 'Upload',
        P_accuracy: 'total accuracy:',
    }

    function readerlang() {
        if(!localStorage.lang) {
            localStorage.setItem('lang', 'en')
        }
        else {
            $(".translate").each(function() {
                var key = $(this).data('key');
                $(this).text(settext(key));
            });
            $("#NV_menu_up").text( settext('NV_menu_up'))
            $("#NV_menu_State").text( settext('NV_menu_State'))
            $("#NV_menu_test").text( settext('NV_menu_test'))
            $("#btn_lang").text( settext('btn_lang'))
            $("#HFile_upload").text( settext('HFile_upload'))
            $("#P_upload").text( settext('P_upload'))
            $("#B_upload").text( settext('B_upload'))
        }
    }

    function settext(key) {
        if(localStorage.lang == 'en') {
            return en[key];
        } else {
            return th[key]
        }
    }

    function togglelang() {
        if(localStorage.lang == 'en')
            localStorage.setItem('lang', 'th')
        else if(localStorage.lang == 'th')
            localStorage.setItem('lang', 'en')

        readerlang();
        return 'now language:' + localStorage.lang;
    }

</script>
