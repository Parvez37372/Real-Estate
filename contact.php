<?php include('include/header.php') ?>

<!-- Page Title -->
<section class="flat-title-page" style="background-image: url(img/img.jpg);">
    <div class="container">
        <div class="breadcrumb-content">
            <ul class="breadcrumb">
                <li><a href="index.html" class="text-white">Home</a></li>
                <li class="text-white">/ Pages</li>
                <li class="text-white">/ Contact Us</li>
            </ul>
            <h1 class="text-center text-white title">Contact Us</h1>
        </div>
    </div>
</section>
<!-- End Page Title -->
<section class="flat-section flat-contact">
    <div class="container">
        <div class="row" style="justify-content: center;">
            <div class="col-lg-6 frm">
                <div class="contact-content">
                    <h4>Enquiry Now</h4>
                    <form id="contactform" method="post" action="enquiry.php" class="form-contact">
                        <div class="box grid-2">
                            <fieldset>
                                <label for="name">Full Name:</label>
                                <input type="text" class="form-control" placeholder="Your name" name="name" id="name" required>
                            </fieldset>
                            <fieldset>
                                <label for="email">Email Address:</label>
                                <input type="text" class="form-control" placeholder="Email" name="email" id="email" required>
                            </fieldset>
                        </div>
                        <div class="box grid-2">
                            <fieldset>
                                <label for="phone">Phone Numbers:</label>
                                <input type="text" class="form-control style-1" placeholder="Enter Your Number" name="phone" id="phone" maxlength="10" minlength="8" required>
                            </fieldset>
                            <fieldset>
                                <label for="subject">Subject:</label>
                                <select class="form-control" name="subject" id="subject" required style="border-radius: 30px; padding: 8px 20px;">
                                    <option value="">Select Property Type</option>
                                    <option value="Apartment">Apartment</option>
                                    <option value="Flat">Flat</option>
                                    <option value="House">House</option>
                                    <option value="Villa">Villa</option>
                                    <option value="Shop">Shop</option>
                                    <option value="Office">Office</option>
                                </select>
                            </fieldset>
                        </div>
                        <fieldset>
                            <label for="message">Your Message:</label>
                            <textarea name="message" class="form-control" cols="30" rows="10" placeholder="Message" id="message" required></textarea>
                        </fieldset>
                        <div class="send-wrap pt-3">
                            <button class="tf-btn primary size-1" type="submit">Send Message</button>
                        </div>
                        <?php if (isset($_GET['success']) && $_GET['success'] == 1): ?>
                            <div id="success-message" style="background-color: #d4edda; color: #155724; padding: 10px; margin-bottom: 15px; border: 1px solid #c3e6cb; border-radius: 10px; margin: 20px 100px;">
                                Thank you! Your enquiry has been submitted successfully.
                            </div>
                        <?php endif; ?>

                    </form>
                </div>
            </div>
            <script>
                setTimeout(() => {
                    const msg = document.getElementById("success-message");
                    if (msg) {
                        msg.style.display = "none";
                    }

                    if (window.history.replaceState) {
                        const url = new URL(window.location.href);
                        url.searchParams.delete("success");
                        window.history.replaceState({}, document.title, url.pathname);
                    }
                }, 3000);
            </script>
<!--  -->
            <div class="col-lg-4">
                <div class="contact-info">
                    <h4>Contact Us</h4>
                    <ul>
                        <li class="box">
                            <h6 class="title">Address:</h6>
                            <p class="text-variant-1">Plot no - 28 sector 5 Rajendra Nagar opp. Metro pillar NO -222 sahibabad, ghaziabad -201005</p>
                        </li>
                        <li class="box">
                            <h6 class="title">Infomation:</h6>
                            <p class="text-variant-1">+91-9811845757<br> hi.themesflat@gmail.com</p>
                        </li>
                        <li class="box">
                            <div class="title">Opentime:</div>
                            <p class="text-variant-1">Monay - Friday: 08:00 - 20:00 <br> Saturday - Sunday: 10:00 - 18:00</p>

                        </li>
                        <li class="box">
                            <div class="title">Follow Us:</div>
                            <ul class="box-social">
                                <li><a href="#" class="item">
                                        <svg width="10" height="18" viewBox="0 0 10 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M9.00879 10.125L9.50871 6.86742H6.38297V4.75348C6.38297 3.86227 6.81961 2.99355 8.21953 2.99355H9.64055V0.220078C9.64055 0.220078 8.35102 0 7.11809 0C4.54395 0 2.86137 1.56023 2.86137 4.38469V6.86742H0V10.125H2.86137V18H6.38297V10.125H9.00879Z" fill="#161E2D" />
                                        </svg>
                                    </a></li>
                                <li><a href="#" class="item">
                                        <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M9.00245 4.38427C6.4484 4.38427 4.38828 6.44438 4.38828 8.99844C4.38828 11.5525 6.4484 13.6126 9.00245 13.6126C11.5565 13.6126 13.6166 11.5525 13.6166 8.99844C13.6166 6.44438 11.5565 4.38427 9.00245 4.38427ZM9.00245 11.9983C7.35195 11.9983 6.00264 10.653 6.00264 8.99844C6.00264 7.34392 7.34794 5.99862 9.00245 5.99862C10.657 5.99862 12.0023 7.34392 12.0023 8.99844C12.0023 10.653 10.653 11.9983 9.00245 11.9983ZM14.8816 4.19552C14.8816 4.79388 14.3997 5.27176 13.8054 5.27176C13.207 5.27176 12.7291 4.78986 12.7291 4.19552C12.7291 3.60118 13.211 3.11928 13.8054 3.11928C14.3997 3.11928 14.8816 3.60118 14.8816 4.19552ZM17.9376 5.28782C17.8694 3.84615 17.5401 2.56912 16.4839 1.51697C15.4318 0.46483 14.1547 0.135534 12.7131 0.0632491C11.2272 -0.021083 6.77368 -0.021083 5.28782 0.0632491C3.85016 0.131518 2.57313 0.460815 1.51697 1.51296C0.460815 2.5651 0.135534 3.84213 0.0632491 5.28381C-0.021083 6.76966 -0.021083 11.2232 0.0632491 12.7091C0.131518 14.1507 0.460815 15.4278 1.51697 16.4799C2.57313 17.532 3.84615 17.8613 5.28782 17.9336C6.77368 18.018 11.2272 18.018 12.7131 17.9336C14.1547 17.8654 15.4318 17.5361 16.4839 16.4799C17.5361 15.4278 17.8654 14.1507 17.9376 12.7091C18.022 11.2232 18.022 6.77368 17.9376 5.28782ZM16.0181 14.3033C15.7048 15.0904 15.0985 15.6968 14.3073 16.0141C13.1227 16.4839 10.3116 16.3755 9.00245 16.3755C7.6933 16.3755 4.87821 16.4799 3.69756 16.0141C2.91046 15.7008 2.30407 15.0944 1.98682 14.3033C1.51697 13.1187 1.6254 10.3076 1.6254 8.99844C1.6254 7.68928 1.52099 4.8742 1.98682 3.69355C2.30006 2.90645 2.90645 2.30006 3.69756 1.98281C4.88223 1.51296 7.6933 1.62139 9.00245 1.62139C10.3116 1.62139 13.1267 1.51697 14.3073 1.98281C15.0944 2.29604 15.7008 2.90243 16.0181 3.69355C16.4879 4.87821 16.3795 7.68928 16.3795 8.99844C16.3795 10.3076 16.4879 13.1227 16.0181 14.3033Z" fill="#161E2D" />
                                        </svg>

                                    </a></li>
                                <li><a href="#" class="item">
                                        <svg width="20" height="14" viewBox="0 0 20 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M19.2775 2.16608C19.051 1.31346 18.3839 0.641967 17.5368 0.414086C16.0013 0 9.84445 0 9.84445 0C9.84445 0 3.68759 0 2.15212 0.414086C1.30502 0.642003 0.637857 1.31346 0.411419 2.16608C0 3.71149 0 6.93586 0 6.93586C0 6.93586 0 10.1602 0.411419 11.7056C0.637857 12.5583 1.30502 13.2018 2.15212 13.4296C3.68759 13.8437 9.84445 13.8437 9.84445 13.8437C9.84445 13.8437 16.0013 13.8437 17.5368 13.4296C18.3839 13.2018 19.051 12.5583 19.2775 11.7056C19.6889 10.1602 19.6889 6.93586 19.6889 6.93586C19.6889 6.93586 19.6889 3.71149 19.2775 2.16608ZM7.8308 9.86334V4.00837L12.9767 6.93593L7.8308 9.86334Z" fill="#161E2D" />
                                        </svg>

                                    </a></li>
                                <li><a href="#" class="item">
                                        <svg width="19" height="16" viewBox="0 0 19 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M16.9797 3.83062C16.9917 3.99873 16.9917 4.16688 16.9917 4.33498C16.9917 9.46249 13.089 15.3706 5.95611 15.3706C3.75858 15.3706 1.71719 14.7341 0 13.6294C0.312227 13.6654 0.612403 13.6774 0.936643 13.6774C2.74986 13.6774 4.41904 13.065 5.75196 12.0203C4.04678 11.9843 2.61779 10.8675 2.12545 9.33042C2.36563 9.36643 2.60578 9.39045 2.85798 9.39045C3.20621 9.39045 3.55447 9.3424 3.87868 9.25838C2.10146 8.8981 0.768498 7.33705 0.768498 5.45175V5.40373C1.28483 5.69193 1.8853 5.87205 2.52169 5.89604C1.47697 5.19955 0.792524 4.01075 0.792524 2.66581C0.792524 1.94533 0.984621 1.28487 1.32087 0.70847C3.2302 3.06209 6.10019 4.59912 9.31838 4.76727C9.25835 4.47907 9.22231 4.17889 9.22231 3.87868C9.22231 1.74118 10.9515 0 13.101 0C14.2177 0 15.2264 0.468321 15.9349 1.22484C16.8115 1.05674 17.6521 0.732496 18.3966 0.288201C18.1084 1.18884 17.496 1.94536 16.6915 2.42566C17.472 2.34164 18.2285 2.12545 18.925 1.82527C18.3967 2.59377 17.7362 3.27821 16.9797 3.83062Z" fill="#161E2D" />
                                        </svg>
                                    </a></li>
                                <li><a href="#" class="item">
                                        <svg width="14" height="18" viewBox="0 0 14 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M7.35713 0C3.65693 0 0 2.4668 0 6.45913C0 8.99806 1.42815 10.4406 2.29369 10.4406C2.65073 10.4406 2.8563 9.44526 2.8563 9.16395C2.8563 8.82856 2.00157 8.11448 2.00157 6.71879C2.00157 3.81922 4.20871 1.76355 7.06501 1.76355C9.52099 1.76355 11.3386 3.15924 11.3386 5.72341C11.3386 7.63843 10.5705 11.2304 8.08202 11.2304C7.18402 11.2304 6.41585 10.5813 6.41585 9.65082C6.41585 8.28759 7.36795 6.96763 7.36795 5.56112C7.36795 3.17366 3.9815 3.60644 3.9815 6.49158C3.9815 7.09747 4.05724 7.76826 4.32772 8.32005C3.83003 10.4623 2.81302 13.654 2.81302 15.8611C2.81302 16.5427 2.91039 17.2135 2.97531 17.8951C3.09793 18.0322 3.03662 18.0178 3.22415 17.9492C5.0418 15.4608 4.97688 14.9739 5.79915 11.7173C6.24274 12.5612 7.38959 13.0156 8.29841 13.0156C12.1284 13.0156 13.8487 9.28297 13.8487 5.91816C13.8487 2.33697 10.7544 0 7.35713 0Z" fill="#161E2D" />
                                        </svg>
                                    </a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>


<section class="">
    <div style="width: 100%">
        <div style="width: 100%"><iframe width="100%" height="400" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?width=100%25&amp;height=600&amp;hl=en&amp;q=Plot%20no%20-%2028%20sector%205%20Rajendra%20Nagar%20opp.%20Metro%20pillar%20NO%20-222%20sahibabad,%20ghaziabad%20-201005+(My%20Business%20Name)&amp;t=&amp;z=14&amp;ie=UTF8&amp;iwloc=B&amp;output=embed"><a href="https://www.gps.ie/collections/drones/">buy drones</a></iframe></div>
    </div>
</section>

<!-- faq -->
<section class="flat-section">
    <div class="container" style="max-width: 1000px;">
  
                    <div class="tf-faq">
                        <div class="box-title style-1 text-center wow fadeInUpSmall" data-wow-delay=".2s" data-wow-duration="2000ms">
                        <h5 class="title fw-6 text-center">Frequently Asked Questions</h5>
                        </div>
                        <ul class="box-faq" id="wrapper-faq">
                            <li class="faq-item">
                                <a href="#accordion-faq-one" class="faq-header collapsed" data-bs-toggle="collapse" aria-expanded="false" aria-controls="accordion-faq-one">
                                   1. What types of properties does Mahi Realty deal with?
                                </a>
                                <div id="accordion-faq-one" class="collapse" data-bs-parent="#wrapper-faq">
                                    <p class="faq-body">
                                        We deal with a wide variety of properties, including residential, commercial, and industrial properties. Whether you're looking to buy your dream home, invest in commercial spaces, or explore industrial property options, we have something to suit your needs.

                                    </p>
                                </div>
                            </li>
                            <li class="faq-item active">
                                <a href="#accordion-faq-two" class="faq-header" data-bs-toggle="collapse" aria-expanded="false" aria-controls="accordion-faq-two">
                                   2. How can I schedule a property viewing?
                                </a>
                                <div id="accordion-faq-two" class="collapse show" data-bs-parent="#wrapper-faq">
                                    <p class="faq-body">
                                       You can schedule a property viewing by contacting us through our website or by calling our customer support team. We will arrange a time that is convenient for you to visit and explore the property in person.

                                    </p>
                                </div>
                            </li>
                            <li class="faq-item">
                                <a href="#accordion-faq-three" class="faq-header collapsed" data-bs-toggle="collapse" aria-expanded="false" aria-controls="accordion-faq-three">
                                  3. Can I get financing or mortgage assistance through Mahi Realty?
                                </a>
                                <div id="accordion-faq-three" class="collapse" data-bs-parent="#wrapper-faq">
                                    <p class="faq-body">
                                       While we do not directly offer financing or mortgages, we work closely with a network of trusted financial institutions and lenders. We can refer you to reliable partners who can assist with financing options.

                                    </p>
                                </div>
                            </li>
                            <li class="faq-item">
                                <a href="#accordion-faq-four" class="faq-header collapsed" data-bs-toggle="collapse" aria-expanded="false" aria-controls="accordion-faq-four">
                                  4. How do I make a payment for a property?
                                </a>
                                <div id="accordion-faq-four" class="collapse" data-bs-parent="#wrapper-faq">
                                    <p class="faq-body">
                                        Payments for properties can be made through the payment methods specified in the sale agreement. You will receive detailed instructions once your purchase agreement is finalized.

                                    </p>
                                </div>
                            </li>
                            <li class="faq-item">
                                <a href="#accordion-faq-five" class="faq-header collapsed" data-bs-toggle="collapse" aria-expanded="false" aria-controls="accordion-faq-five">
                                 5. Are the prices listed on the website negotiable?

                                </a>
                                <div id="accordion-faq-five" class="collapse" data-bs-parent="#wrapper-faq">
                                    <p class="faq-body">
                                       Prices for properties listed on our website are generally fixed, but in some cases, there may be room for negotiation depending on the property and the seller’s terms. We encourage you to discuss this with our team during the buying process.
                                    </p>
                                </div>
                            </li>
                            
                          <!--   <li class="faq-item">-->
                          <!--      <a href="#accordion-faq-six" class="faq-header collapsed" data-bs-toggle="collapse" aria-expanded="false" aria-controls="accordion-faq-five">-->
                          <!--      6. What should I do if I’m interested in purchasing a property?-->


                          <!--      </a>-->
                          <!--      <div id="accordion-faq-seven" class="collapse" data-bs-parent="#wrapper-faq">-->
                          <!--          <p class="faq-body">-->
                          <!--            If you’re interested in a property, simply contact us to express your interest. Our team will guide you through the next steps, including property viewings, paperwork, and negotiations. We will assist you throughout the entire process.-->
                          <!--          </p>-->
                          <!--      </div>-->
                          <!--  </li>-->
                            
                          <!--   <li class="faq-item">-->
                          <!--      <a href="#accordion-faq-five" class="faq-header collapsed" data-bs-toggle="collapse" aria-expanded="false" aria-controls="accordion-faq-five">-->
                          <!--  7. Are the properties listed on the website available for immediate sale?-->

                          <!--      </a>-->
                          <!--      <div id="accordion-faq-five" class="collapse" data-bs-parent="#wrapper-faq">-->
                          <!--          <p class="faq-body">-->
                          <!--            While we strive to keep our listings up to date, the availability of properties may change. It’s always a good idea to check with us directly to confirm that a specific property is still available for purchase.-->

                          <!--          </p>-->
                          <!--      </div>-->
                          <!--  </li>-->
                            
                          <!--     <li class="faq-item">-->
                          <!--      <a href="#accordion-faq-five" class="faq-header collapsed" data-bs-toggle="collapse" aria-expanded="false" aria-controls="accordion-faq-five">-->
                          <!--8. What happens if I change my mind after signing a purchase agreement?-->


                          <!--      </a>-->
                          <!--      <div id="accordion-faq-five" class="collapse" data-bs-parent="#wrapper-faq">-->
                          <!--          <p class="faq-body">-->
                          <!--            Once a purchase agreement is signed, it is legally binding. However, the terms of the agreement will outline any conditions for cancellations or changes, such as deposit forfeiture or specific cancellation clauses. We strongly recommend reviewing the agreement carefully before signing.-->

                          <!--          </p>-->
                          <!--      </div>-->
                          <!--  </li>-->
                            
                          <!--    <li class="faq-item">-->
                          <!--      <a href="#accordion-faq-five" class="faq-header collapsed" data-bs-toggle="collapse" aria-expanded="false" aria-controls="accordion-faq-five">-->
                          <!--     9. Can I sell my property through Mahi Realty?-->


                          <!--      </a>-->
                          <!--      <div id="accordion-faq-five" class="collapse" data-bs-parent="#wrapper-faq">-->
                          <!--          <p class="faq-body">-->
                          <!--             Yes, we offer property sales services for sellers. If you wish to sell your property, please contact us to discuss how we can assist you in listing and selling your property.-->

                          <!--          </p>-->
                          <!--      </div>-->
                          <!--  </li>-->
                            
                          <!--    <li class="faq-item">-->
                          <!--      <a href="#accordion-faq-five" class="faq-header collapsed" data-bs-toggle="collapse" aria-expanded="false" aria-controls="accordion-faq-five">-->
                          <!--   10. How do I contact Mahi Realty if I have further questions?-->


                          <!--      </a>-->
                          <!--      <div id="accordion-faq-five" class="collapse" data-bs-parent="#wrapper-faq">-->
                          <!--          <p class="faq-body">-->
                          <!--            You can reach us by phone, email, or through our website's contact form. Our team is always available to help answer any questions you may have.-->

                          <!--          </p>-->
                          <!--      </div>-->
                          <!--  </li>-->
                            
                          <!--    <li class="faq-item">-->
                          <!--      <a href="#accordion-faq-five" class="faq-header collapsed" data-bs-toggle="collapse" aria-expanded="false" aria-controls="accordion-faq-five">-->
                          <!--     11. Is Mahi Realty involved in property management services?-->


                          <!--      </a>-->
                          <!--      <div id="accordion-faq-five" class="collapse" data-bs-parent="#wrapper-faq">-->
                          <!--          <p class="faq-body">-->
                          <!--            At the moment, we focus primarily on property sales and purchases. We do not currently offer property management services, but we can refer you to trusted partners if you are seeking property management assistance.-->

                          <!--          </p>-->
                          <!--      </div>-->
                          <!--  </li>-->
                            
                          <!--    <li class="faq-item">-->
                          <!--      <a href="#accordion-faq-five" class="faq-header collapsed" data-bs-toggle="collapse" aria-expanded="false" aria-controls="accordion-faq-five">-->
                          <!--    12. Do you offer any warranty or guarantee on the properties you sell?-->


                          <!--      </a>-->
                          <!--      <div id="accordion-faq-five" class="collapse" data-bs-parent="#wrapper-faq">-->
                          <!--          <p class="faq-body">-->
                          <!--            While we ensure that all properties listed are inspected and meet required standards, we do not offer specific warranties or guarantees. It is always recommended to conduct a thorough inspection before finalizing any purchase.-->
                          <!--          </p>-->
                          <!--      </div>-->
                          <!--  </li>-->
                        </ul>
                        
                    </div>
                </div>
            </section>
    </div>
</section>
<!-- /faq -->


<?php include('include/footer.php') ?>