<script>
document.addEventListener("DOMContentLoaded", function() {
    var currentPage = window.location.pathname.split('/').pop();
    var links = document.querySelectorAll('.list-group-item');
    links.forEach(function(link) {
        if (link.getAttribute('href') === currentPage) {
            link.classList.add('active');
        }
    });
});

var activeItem = null;

function setActive(element) {
    if (activeItem !== null) {
        activeItem.classList.remove('active');
    }
    element.classList.add('active');
    activeItem = element;
}
</script>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>