{{-- NewStock Modern Footer --}}

<style>
.footer-new {
    background: var(--gray-900);
    color: var(--gray-300);
    padding-top: var(--space-16);
}

.footer-main {
    padding-bottom: var(--space-12);
    border-bottom: var(--border-1) solid var(--gray-800);
}

.footer-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: var(--space-8);
}

.footer-column h3 {
    color: var(--white);
    font-size: var(--text-lg);
    font-weight: var(--font-bold);
    margin-bottom: var(--space-4);
}

.footer-column p {
    line-height: var(--leading-relaxed);
    margin-bottom: var(--space-3);
}

.footer-links {
    list-style: none;
    padding: 0;
    margin: 0;
}

.footer-links li {
    margin-bottom: var(--space-3);
}

.footer-links a {
    color: var(--gray-300);
    text-decoration: none;
    transition: all var(--transition-base);
    display: flex;
    align-items: center;
    gap: var(--space-2);
}

.footer-links a:hover {
    color: var(--primary-400);
    padding-left: var(--space-2);
}

[dir="rtl"] .footer-links a:hover {
    padding-left: 0;
    padding-right: var(--space-2);
}

.footer-logo {
    margin-bottom: var(--space-4);
}

.footer-logo img {
    height: 60px;
    width: auto;
}

.footer-contact-item {
    display: flex;
    align-items: flex-start;
    gap: var(--space-3);
    margin-bottom: var(--space-3);
}

.footer-contact-icon {
    color: var(--primary-400);
    font-size: var(--text-lg);
    margin-top: 2px;
}

.footer-social {
    display: flex;
    gap: var(--space-3);
    margin-top: var(--space-4);
}

.footer-social-link {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 40px;
    height: 40px;
    background: var(--gray-800);
    color: var(--gray-300);
    border-radius: var(--radius-lg);
    text-decoration: none;
    transition: all var(--transition-base);
}

.footer-social-link:hover {
    background: var(--primary-500);
    color: var(--white);
    transform: translateY(-2px);
}

.footer-newsletter {
    margin-top: var(--space-4);
}

.newsletter-form {
    display: flex;
    gap: var(--space-2);
    margin-top: var(--space-3);
}

.newsletter-input {
    flex: 1;
    padding: var(--space-3) var(--space-4);
    border: var(--border-1) solid var(--gray-700);
    border-radius: var(--radius-lg);
    background: var(--gray-800);
    color: var(--white);
    font-size: var(--text-base);
}

.newsletter-input::placeholder {
    color: var(--gray-500);
}

.newsletter-input:focus {
    outline: none;
    border-color: var(--primary-500);
}

.newsletter-btn {
    padding: var(--space-3) var(--space-6);
    background: var(--primary-500);
    color: var(--white);
    border: none;
    border-radius: var(--radius-lg);
    font-weight: var(--font-semibold);
    cursor: pointer;
    transition: all var(--transition-base);
    white-space: nowrap;
}

.newsletter-btn:hover {
    background: var(--primary-600);
}

.footer-bottom {
    padding: var(--space-6) 0;
    text-align: center;
}

.footer-bottom-content {
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    gap: var(--space-4);
}

.footer-copyright {
    color: var(--gray-400);
    font-size: var(--text-sm);
}

.footer-payment {
    display: flex;
    align-items: center;
    gap: var(--space-3);
}

.footer-payment img {
    height: 30px;
    width: auto;
    opacity: 0.7;
    transition: opacity var(--transition-base);
}

.footer-payment img:hover {
    opacity: 1;
}

@media (max-width: 768px) {
    .footer-grid {
        grid-template-columns: 1fr;
    }

    .footer-bottom-content {
        flex-direction: column;
        text-align: center;
    }

    .newsletter-form {
        flex-direction: column;
    }
}
</style>

<footer class="footer-new">
    <div class="footer-main">
        <div class="container">
            <div class="footer-grid">
                {{-- Column 1: About --}}
                <div class="footer-column">
                    <div class="footer-logo">
                        <img src="{{ asset('assets/images/' . $gs->footer_logo) }}" alt="{{ $gs->title }}">
                    </div>
                    <p>{{ $gs->footer_text ?? __('Your trusted source for quality auto parts and accessories.') }}</p>
                    
                    {{-- Social Links --}}
                    <div class="footer-social">
                        @if($socialsetting->f_status == 1)
                            <a href="{{ $socialsetting->facebook }}" target="_blank" class="footer-social-link" title="Facebook">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                        @endif
                        @if($socialsetting->t_status == 1)
                            <a href="{{ $socialsetting->twitter }}" target="_blank" class="footer-social-link" title="Twitter">
                                <i class="fab fa-twitter"></i>
                            </a>
                        @endif
                        @if($socialsetting->i_status == 1)
                            <a href="{{ $socialsetting->instagram }}" target="_blank" class="footer-social-link" title="Instagram">
                                <i class="fab fa-instagram"></i>
                            </a>
                        @endif
                        @if($socialsetting->l_status == 1)
                            <a href="{{ $socialsetting->linkedin }}" target="_blank" class="footer-social-link" title="LinkedIn">
                                <i class="fab fa-linkedin-in"></i>
                            </a>
                        @endif
                    </div>
                </div>

                {{-- Column 2: Quick Links --}}
                <div class="footer-column">
                    <h3>{{ __('Quick Links') }}</h3>
                    <ul class="footer-links">
                        <li>
                            <a href="{{ route('front.index') }}">
                                <i class="fas fa-chevron-right" style="font-size: var(--text-xs);"></i>
                                {{ __('Home') }}
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('front.category', '') }}">
                                <i class="fas fa-chevron-right" style="font-size: var(--text-xs);"></i>
                                {{ __('Shop') }}
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('catlogs.index', 'nissan') }}">
                                <i class="fas fa-chevron-right" style="font-size: var(--text-xs);"></i>
                                {{ __('Catalogs') }}
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('front.blog') }}">
                                <i class="fas fa-chevron-right" style="font-size: var(--text-xs);"></i>
                                {{ __('Blog') }}
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('front.contact') }}">
                                <i class="fas fa-chevron-right" style="font-size: var(--text-xs);"></i>
                                {{ __('Contact Us') }}
                            </a>
                        </li>
                    </ul>
                </div>

                {{-- Column 3: Customer Service --}}
                <div class="footer-column">
                    <h3>{{ __('Customer Service') }}</h3>
                    <ul class="footer-links">
                        @foreach($pages as $page)
                            <li>
                                <a href="{{ route('front.page', $page->slug) }}">
                                    <i class="fas fa-chevron-right" style="font-size: var(--text-xs);"></i>
                                    {{ $page->title }}
                                </a>
                            </li>
                        @endforeach
                        <li>
                            <a href="{{ route('front.faq') }}">
                                <i class="fas fa-chevron-right" style="font-size: var(--text-xs);"></i>
                                {{ __('FAQ') }}
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('user.order.track') }}">
                                <i class="fas fa-chevron-right" style="font-size: var(--text-xs);"></i>
                                {{ __('Track Order') }}
                            </a>
                        </li>
                    </ul>
                </div>

                {{-- Column 4: Contact Info & Newsletter --}}
                <div class="footer-column">
                    <h3>{{ __('Contact Info') }}</h3>
                    
                    <div class="footer-contact-item">
                        <div class="footer-contact-icon">
                            <i class="fas fa-map-marker-alt"></i>
                        </div>
                        <div>{{ $ps->street }}</div>
                    </div>

                    <div class="footer-contact-item">
                        <div class="footer-contact-icon">
                            <i class="fas fa-phone"></i>
                        </div>
                        <div>
                            <a href="tel:{{ $ps->phone }}" style="color: inherit;">{{ $ps->phone }}</a>
                        </div>
                    </div>

                    <div class="footer-contact-item">
                        <div class="footer-contact-icon">
                            <i class="fas fa-envelope"></i>
                        </div>
                        <div>
                            <a href="mailto:{{ $ps->email }}" style="color: inherit;">{{ $ps->email }}</a>
                        </div>
                    </div>

                    {{-- Newsletter --}}
                    <div class="footer-newsletter">
                        <h3>{{ __('Newsletter') }}</h3>
                        <p style="font-size: var(--text-sm); margin-bottom: var(--space-3);">
                            {{ __('Subscribe to get special offers and updates') }}
                        </p>
                        <form class="newsletter-form" action="{{ route('front.subscribe') }}" method="POST">
                            @csrf
                            <input 
                                type="email" 
                                name="email" 
                                class="newsletter-input" 
                                placeholder="{{ __('Your email address') }}"
                                required
                            >
                            <button type="submit" class="newsletter-btn">
                                {{ __('Subscribe') }}
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Footer Bottom --}}
    <div class="footer-bottom">
        <div class="container">
            <div class="footer-bottom-content">
                <div class="footer-copyright">
                    &copy; {{ date('Y') }} {{ $gs->title }}. {{ __('All rights reserved.') }}
                </div>

                {{-- Payment Methods --}}
                <div class="footer-payment">
                    <span style="margin-right: var(--space-3); color: var(--gray-400);">{{ __('We Accept:') }}</span>
                    <img src="{{ asset('assets/images/payment/visa.png') }}" alt="Visa" title="Visa">
                    <img src="{{ asset('assets/images/payment/mastercard.png') }}" alt="Mastercard" title="Mastercard">
                    <img src="{{ asset('assets/images/payment/paypal.png') }}" alt="PayPal" title="PayPal">
                </div>
            </div>
        </div>
    </div>
</footer>

{{-- Back to Top Button --}}
<button id="backToTop" style="position: fixed; bottom: var(--space-6); right: var(--space-6); width: 50px; height: 50px; background: var(--primary-500); color: var(--white); border: none; border-radius: var(--radius-full); cursor: pointer; box-shadow: var(--shadow-lg); opacity: 0; visibility: hidden; transition: all var(--transition-base); z-index: var(--z-fixed); display: flex; align-items: center; justify-content: center; font-size: var(--text-xl);">
    <i class="fas fa-arrow-up"></i>
</button>

<script>
// Back to Top Button
const backToTopBtn = document.getElementById('backToTop');

window.addEventListener('scroll', function() {
    if (window.scrollY > 300) {
        backToTopBtn.style.opacity = '1';
        backToTopBtn.style.visibility = 'visible';
    } else {
        backToTopBtn.style.opacity = '0';
        backToTopBtn.style.visibility = 'hidden';
    }
});

backToTopBtn.addEventListener('click', function() {
    window.scrollTo({
        top: 0,
        behavior: 'smooth'
    });
});

// Newsletter Form Submission
document.querySelector('.newsletter-form').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const form = this;
    const formData = new FormData(form);
    
    fetch(form.action, {
        method: 'POST',
        body: formData,
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            toastr.success(data.message || '{{ __("Successfully subscribed!") }}');
            form.reset();
        } else {
            toastr.error(data.message || '{{ __("Subscription failed!") }}');
        }
    })
    .catch(error => {
        toastr.error('{{ __("An error occurred. Please try again.") }}');
    });
});
</script>
