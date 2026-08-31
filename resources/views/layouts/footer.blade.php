    <!-- ═══════════ JAVASCRIPT ═══════════ -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
           // ─── Search Toggle ───
const searchToggle = document.getElementById('searchToggle');
const searchForm = document.getElementById('searchForm');
const searchInput = document.getElementById('searchInput');

searchToggle.addEventListener('click', function () {
    searchForm.classList.toggle('active');

    if (searchForm.classList.contains('active')) {
        searchInput.focus();
    }
});

// Submit search when pressing Enter
searchInput.addEventListener('keydown', function (e) {
    if (e.key === 'Enter') {
        searchForm.submit();
    }
});
      });
    </script>

</body>
</html>