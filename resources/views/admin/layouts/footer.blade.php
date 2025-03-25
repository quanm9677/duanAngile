
<footer class="site-footer">
    <div class="footer-inner bg-white">
        <div class="row">
            <div class="col-sm-6" style="padding-left:300px;">
                Copyright &copy; {{ date('Y') }} {{ config('app.name', 'BOOK-STORE') }}
            </div>
            <div class="col-sm-6 text-right">
                Designed by <a href="https://colorlib.com">Colorlib</a>
            </div>
        </div>
    </div>
</footer>
<!-- /.site-footer -->
</div>
<!-- /#right-panel -->

<script>
    // Đặt thời gian 3 giây để thông báo tự động tắt
    setTimeout(function() {
        let alerts = document.querySelectorAll('.alert');
        alerts.forEach(function(alert) {
            alert.classList.remove('show');
            alert.classList.add('fade');
        });
    }, 3000);
</script>

<script>
    // Biến để theo dõi trạng thái của trang
    let isReload = false;
    let isAction = false;

    // Theo dõi các hành động trong admin
    document.addEventListener('click', function(e) {
        if (e.target.closest('form') || 
            e.target.closest('a[href*="add"]') || 
            e.target.closest('a[href*="edit"]') || 
            e.target.closest('a[href*="delete"]')) {
            isAction = true;
            setTimeout(() => { isAction = false; }, 1000);
        }
    });

    // Theo dõi reload page
    window.addEventListener('keydown', function(e) {
        if ((e.ctrlKey || e.metaKey) && e.key === 'r') {
            isReload = true;
        }
    });

    // Reset các flag khi trang load xong
    window.addEventListener('load', function() {
        isReload = false;
        isAction = false;
    });

    // Xử lý timeout sau 10 phút không hoạt động
    let inactivityTime = function () {
        let time;
        
        function resetTimer() {
            clearTimeout(time);
            if (document.cookie.includes('XSRF-TOKEN')) {
                time = setTimeout(logout, 600000); // 10 phút = 600,000 milliseconds
            }
        }

        function logout() {
            window.location.href = '';
        }

        window.onload = resetTimer;
        document.onmousemove = resetTimer;
        document.onkeydown = resetTimer;
        document.onclick = resetTimer;
        document.onscroll = resetTimer;

        resetTimer();
    };

    inactivityTime();
</script>

@stack('scripts')