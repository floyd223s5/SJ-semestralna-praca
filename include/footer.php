  <footer>
    <h3 class="text-center pt-3 pb-2">
      <strong>Menu</strong>
    </h3>
    <ul class="nav justify-content-center pb-3 mb-3">
      <li class="nav-item"><a href="/index" class="nav-link px-2 text-body-secondary">Home</a></li>
      <li class="nav-item"><a href="/catalog" class="nav-link px-2 text-body-secondary">Products</a></li>
      <li class="nav-item"><a href="/faq" class="nav-link px-2 text-body-secondary">FAQ</a></li>
      <li class="nav-item"><a href="/contact" class="nav-link px-2 text-body-secondary">Contact Us</a></li>
      <li class="nav-item"><a href="/privacy-policy" class="nav-link px-2 text-body-secondary">Privacy Policy</a></li>
      <li class="nav-item"><a href="/refund-policy" class="nav-link px-2 text-body-secondary">Refund Policy</a></li>
      <li class="nav-item"><a href="/shipping-policy" class="nav-link px-2 text-body-secondary">Shipping Policy</a></li>
    </ul>
    <div class="container">
      <div class="ps-2">
        <h3><strong>Subscribe to our emails to get discounts !</strong></h3>
      </div>
      <div class="container">
          <form>
            <div class="subscribe">
              <div class="form-group row">
                  <div class="col-sm-12 col-md-4">
                      <input type="email" class="form-control w-100 w-md-30" id="emailInput" placeholder=" " required>
                      <label for="emailInput">Email</label>
                  </div>
              </div>
              </div>
          </form>
      </div>
    </div>
    <div class="pb-2 pt-4">
      <hr>
    </div>

    <div class="container pt-5">
      <p class="text-body-secondary">© 2024, OtaruEmbroidery</p>
    </div>
  </footer>
  <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  <script>
    var prevScrollpos = window.pageYOffset;
    window.onscroll = function() {
      var currentScrollPos = window.pageYOffset;
      document.querySelector('.navbar').classList.toggle('scrolled', currentScrollPos > prevScrollpos);
      prevScrollpos = currentScrollPos;
    };
  </script>
</body>
</html>