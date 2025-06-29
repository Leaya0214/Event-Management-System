<!-- Footer Section -->
<footer>
    @php
        $link = App\Models\BackEnd\SystemSetting::first();
    @endphp

    <div class="footer-section animatedParent animateOnce" data-sequence="500">
        <!-- Footer Content Container -->
        <div class="footer-content">
            <!-- Left Side - Copyright and Legal Links -->
            <div class="footer-left">
                <div class="copyright-section">
                    <p class="left animated fadeInLeftShort" data-id="1">
                        &copy; {{ date('Y') }} Bridal Harmony. All Rights Reserved.
                    </p>
                </div>

                <div class="legal-links">
                    <p class="left animated fadeInLeftShort" data-id="1">
                        <a href="{{ route('terms_condition') }}" class="footer-link">
                            Terms & Condition
                        </a>
                    </p>
                    <p class="left animated fadeInLeftShort" data-id="1">
                        <a href="{{ route('privacy_policy') }}" class="footer-link">
                            Privacy Policy
                        </a>
                    </p>
                </div>
            </div>

            <!-- Right Side - Developer Credit -->
            <div class="footer-right">
                <p class="right animated fadeInRightShort" data-id="1">
                    Developed By
                    <a href="https://www.stitbd.com" target="_blank" class="developer-link">
                        STIT BD
                    </a>
                </p>
            </div>
        </div>

        <!-- Social Media Section -->
        <div class="social-media">
            <div class="wrapper">
                <h4 class="social-title">Follow Us</h4>

                <div class="social-icons">
                    <!-- Facebook -->
                    @if($link->fb_link)
                        <span class="social-icon animated flipInY" data-id="2">
                            <a href="{{ $link->fb_link }}"
                               target="_blank"
                               aria-label="Follow us on Facebook"
                               title="Facebook">
                                <img src="{{ asset('frontend/images/fb_icon.png') }}"
                                     alt="Bridal Harmony Facebook">
                            </a>
                        </span>
                    @endif

                    <!-- Instagram -->
                    @if($link->instagram_link)
                        <span class="social-icon animated flipInY" data-id="2">
                            <a href="{{ $link->instagram_link }}"
                               target="_blank"
                               aria-label="Follow us on Instagram"
                               title="Instagram">
                                <img src="{{ asset('frontend/images/insta_icon.png') }}"
                                     alt="Bridal Harmony Instagram">
                            </a>
                        </span>
                    @endif

                    <!-- YouTube -->
                    @if($link->you_tube_link)
                        <span class="social-icon animated flipInY" data-id="2">
                            <a href="{{ $link->you_tube_link }}"
                               target="_blank"
                               aria-label="Watch us on YouTube"
                               title="YouTube">
                                <img src="{{ asset('frontend/images/yt_icon.png') }}"
                                     alt="Bridal Harmony YouTube">
                            </a>
                        </span>
                    @endif

                    <!-- Twitter (Placeholder for future use) -->
                    {{--
                    @if($link->twitter_link)
                        <span class="social-icon animated flipInY" data-id="2">
                            <a href="{{ $link->twitter_link }}"
                               target="_blank"
                               aria-label="Follow us on Twitter"
                               title="Twitter">
                                <img src="{{ asset('frontend/images/twitter_icon.png') }}"
                                     alt="Bridal Harmony Twitter">
                            </a>
                        </span>
                    @endif
                    --}}

                    <!-- LinkedIn (Placeholder for future use) -->
                    {{--
                    @if($link->linkedin_link)
                        <span class="social-icon animated flipInY" data-id="2">
                            <a href="{{ $link->linkedin_link }}"
                               target="_blank"
                               aria-label="Connect with us on LinkedIn"
                               title="LinkedIn">
                                <img src="{{ asset('frontend/images/linkedin_icon.png') }}"
                                     alt="Bridal Harmony LinkedIn">
                            </a>
                        </span>
                    @endif
                    --}}

                    <!-- Vimeo (Placeholder for future use) -->
                    {{--
                    @if($link->vimeo_link)
                        <span class="social-icon animated flipInY" data-id="2">
                            <a href="{{ $link->vimeo_link }}"
                               target="_blank"
                               aria-label="Watch us on Vimeo"
                               title="Vimeo">
                                <img src="{{ asset('frontend/images/vimeo_icon.png') }}"
                                     alt="Bridal Harmony Vimeo">
                            </a>
                        </span>
                    @endif
                    --}}
                </div>
            </div>
        </div>

        <!-- Additional Footer Information (Optional) -->
        <div class="footer-bottom">
            <div class="company-info">
                <p>Premium Wedding Photography & Cinematography Services</p>
                <p>Creating beautiful memories since 2013</p>
            </div>
        </div>
    </div>
</footer>

<!-- Optional: Add some basic styling for the new structure -->
<style>
    .footer-content {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        flex-wrap: wrap;
        margin-bottom: 2rem;
    }

    .footer-left {
        display: flex;
        flex-direction: column;
        gap: 1rem;
    }

    .legal-links {
        display: flex;
        gap: 1rem;
        flex-wrap: wrap;
    }

    .footer-link {
        text-decoration: none;
        color: inherit;
        transition: color 0.3s ease;
    }

    .footer-link:hover {
        color: #d1aa34;
    }

    .developer-link {
        text-decoration: none;
        color: #d1aa34;
        font-weight: 500;
    }

    .developer-link:hover {
        text-decoration: underline;
    }

    .social-title {
        text-align: center;
        margin-bottom: 1rem;
        font-size: 1.2rem;
        color: #d1aa34;
    }

    .social-icons {
        display: flex;
        justify-content: center;
        gap: 1rem;
        flex-wrap: wrap;
    }

    .social-icon {
        transition: transform 0.3s ease;
    }

    .social-icon:hover {
        transform: translateY(-3px);
    }

    .footer-bottom {
        text-align: center;
        margin-top: 2rem;
        padding-top: 1rem;
        border-top: 1px solid rgba(209, 170, 52, 0.3);
    }

    .company-info p {
        margin: 0.5rem 0;
        font-size: 0.9rem;
        opacity: 0.8;
    }

    /* Responsive Design */
    @media screen and (max-width: 768px) {
        .footer-content {
            flex-direction: column;
            gap: 1rem;
        }

        .legal-links {
            flex-direction: column;
            gap: 0.5rem;
        }

        .social-icons {
            gap: 0.5rem;
        }

        .footer-bottom {
            margin-top: 1rem;
        }
    }
</style>
