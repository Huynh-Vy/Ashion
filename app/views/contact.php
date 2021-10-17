<section class="contact">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="product_new">
                <div class="thread">
                    <span>Thông tin liên hệ</span>
                </div>
                <div class="thread_decorate"></div>
            </div>
        </div>

        <?php include './app/views/admin/errors.php' ?>
        <div class="row">
            <div class="col-md-6">
                <div class="contact_info">
                    <ul class="contact_address">
                        <li>
                            <h6><i class="fa fa-map-marker"></i>Địa chỉ</h6>
                            <p><address style="color:#756868">Vincom Center, Tầng B2, 72 Lê Thánh Tôn, Bến Nghé, Quận 1, 
                            Thành phố Hồ Chí Minh 700000</address></p>
                        </li>
                        <li>
                            <h6><i class="fa fa-phone"></i>Số điện thoại</h6>
                            <p><a href="tel:028 7300 0205">028 7300 0205</a></p>
                        </li>
                        <li>
                            <h6><i class="fa fa-headphones"></i>Hỗ trợ</h6>
                            <p><a href="email:support.ashion@gmail.com">support.ashion@gmail.com</a></p>
                        </li>
                    </ul>
                </div>

                <div class="contact_form">
                    <h5>Gởi tin nhắn</h5>
                    <form action="/lien-he.html" method="post">
                        <input type="text" placeholder="Tên" name="name" required>
                        <input type="email" placeholder="Email" name="email" required>
                        <textarea placeholder="Gởi tin nhắn" name="message" required></textarea>
                        <button type="submit" class="site_btn">Send Message</button>
                    </form>
                </div>
            </div>

            <div class="col-md-6">
                <div class="map" style="width: 50%">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3919.4637802604543!2d106.69970251416046!3d10.775746992321995!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31752f47df3d1ecf%3A0x2b9938216230e217!2zVmluY29tIENlbnRlciAoVmluY29tIMSQ4buTbmcgS2jhu59pKQ!5e0!3m2!1sen!2s!4v1622548430984!5m2!1sen!2s" width="536" height="654" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
            </div>
        </div>
    </div>
</section>