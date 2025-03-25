<!-- Core Scripts -->
<script src="https://cdn.jsdelivr.net/npm/jquery@2.2.4/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.4/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"></script>
<!-- ... các script khác ... -->

<script>
document.addEventListener('DOMContentLoaded', function() {
    const menuToggle = document.querySelector('#menuToggle');
    const leftPanel = document.querySelector('#left-panel');
    
    if (menuToggle) {
        menuToggle.addEventListener('click', function(e) {
            e.preventDefault();
            leftPanel.classList.toggle('show');
        });
    }
});
</script>