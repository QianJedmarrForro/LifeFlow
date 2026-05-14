<x-layout>

<style>
    .about-hero {
        background: linear-gradient(135deg, #ef4444 0%, #c92a2a 100%);
        color: white;
        padding: 80px 40px;
        text-align: center;
        border-radius: 16px;
        margin-bottom: 60px;
        box-shadow: 0 20px 50px rgba(239, 68, 68, 0.2);
    }

    .about-hero h1 {
        font-size: 48px;
        font-weight: 700;
        margin: 0 0 20px 0;
        letter-spacing: -0.5px;
    }

    .about-hero p {
        font-size: 18px;
        margin: 0;
        opacity: 0.95;
        max-width: 600px;
        margin: 0 auto;
    }

    .section-title {
        font-size: 32px;
        font-weight: 700;
        color: #1e293b;
        margin-bottom: 30px;
        text-align: center;
    }

    .content-section {
        margin-bottom: 60px;
    }

    .mission-cards {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 24px;
        margin-bottom: 40px;
    }

    .mission-card {
        background: white;
        padding: 32px;
        border-radius: 12px;
        border-left: 5px solid #ef4444;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        transition: all 0.3s ease;
    }

    .mission-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 12px 24px rgba(0, 0, 0, 0.1);
    }

    .mission-card-icon {
        font-size: 40px;
        margin-bottom: 15px;
        display: block;
    }

    .mission-card h3 {
        font-size: 20px;
        font-weight: 700;
        color: #1e293b;
        margin: 0 0 12px 0;
    }

    .mission-card p {
        color: #64748b;
        margin: 0;
        font-size: 15px;
        line-height: 1.6;
    }

    .impact-stats {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 20px;
        margin-bottom: 40px;
    }

    .stat-box {
        background: linear-gradient(135deg, #fee2e2 0%, #fecaca 100%);
        padding: 30px;
        border-radius: 12px;
        text-align: center;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
    }

    .stat-number {
        font-size: 42px;
        font-weight: 700;
        color: #dc2626;
        margin-bottom: 8px;
    }

    .stat-label {
        font-size: 15px;
        color: #7f1d1d;
        font-weight: 600;
    }

    .description-text {
        font-size: 16px;
        line-height: 1.8;
        color: #475569;
        max-width: 900px;
        margin: 0 auto 30px;
        text-align: center;
    }

    .cta-section {
        background: linear-gradient(135deg, #1e293b 0%, #0f172a 100%);
        color: white;
        padding: 60px 40px;
        border-radius: 16px;
        text-align: center;
        margin-top: 60px;
    }

    .cta-section h2 {
        font-size: 32px;
        font-weight: 700;
        margin: 0 0 15px 0;
    }

    .cta-section p {
        font-size: 16px;
        margin: 0 0 30px 0;
        opacity: 0.9;
    }

    .cta-button {
        display: inline-block;
        background: #ef4444;
        color: white;
        padding: 14px 32px;
        border-radius: 8px;
        text-decoration: none;
        font-weight: 700;
        transition: all 0.3s ease;
        border: 2px solid #ef4444;
    }

    .cta-button:hover {
        background: #dc2626;
        border-color: #dc2626;
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(239, 68, 68, 0.3);
    }

    .container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 40px;
        font-family: 'DM Sans', sans-serif;
    }

    /* Bag-ong Style para sa Contact Section */
    .contact-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 24px;
        margin-top: 40px;
    }
    
    .contact-card {
        background: white;
        padding: 30px;
        border-radius: 12px;
        text-align: center;
        border: 1px solid #e2e8f0;
        transition: all 0.3s ease;
    }

    .contact-card:hover {
        border-color: #fecaca;
        box-shadow: 0 10px 20px rgba(0,0,0,0.05);
    }

    .contact-icon {
        font-size: 32px;
        margin-bottom: 15px;
        display: block;
    }

    .contact-info {
        color: #1e293b;
        font-weight: 700;
        font-size: 16px;
        margin-bottom: 5px;
    }

    .contact-label {
        color: #64748b;
        font-size: 14px;
    }

    .social-links {
        display: flex;
        justify-content: center;
        gap: 20px;
        margin-top: 30px;
    }

    .social-link {
        color: #ef4444;
        text-decoration: none;
        font-weight: 700;
        font-size: 14px;
    }
</style>

<div class="container">
    <!-- Hero Section -->
    <div class="about-hero">
        <h1>About LifeFlow</h1>
        <p>Connecting life-givers with life-savers. Every drop counts in our mission to save lives.</p>
    </div>

    <!-- Our Story Section -->
    <div class="content-section">
        <h2 class="section-title">Our Story</h2>
        <p class="description-text">
            LifeFlow was founded with a simple yet powerful vision: to revolutionize blood donation and management. 
            We recognized that blood banks needed a modern, efficient solution to connect donors with those in need. 
            Today, we're proud to be at the forefront of blood donation technology, helping healthcare facilities manage 
            inventory while empowering donors to make a real difference in their communities.
        </p>
    </div>

    <!-- Mission & Vision -->
    <div class="content-section">
        <h2 class="section-title">Our Mission & Vision</h2>
        <div class="mission-cards">
            <div class="mission-card">
                <span class="mission-card-icon"><svg width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="#ef4444" stroke-width="2"><circle cx="12" cy="12" r="10"/><circle cx="12" cy="12" r="6"/><circle cx="12" cy="12" r="2"/></svg></span>
                <h3>Our Mission</h3>
                <p>To streamline blood donation management and create a reliable network that ensures safe, efficient blood supply to those who need it most.</p>
            </div>
            <div class="mission-card">
                <span class="mission-card-icon"><svg width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="#ef4444" stroke-width="2"><line x1="9" y1="18" x2="15" y2="18"/><line x1="10" y1="22" x2="14" y2="22"/><path d="M15.09 14c.18-.98.65-1.74 1.41-2.5A4.65 4.65 0 0 0 18 8 6 6 0 0 0 6 8c0 1 .23 2.23 1.5 3.5A4.61 4.61 0 0 1 8.91 14"/></svg></span>
                <h3>Our Vision</h3>
                <p>A world where no one dies from preventable blood loss, powered by technology that makes giving blood simple and rewarding.</p>
            </div>
            <div class="mission-card">
                <span class="mission-card-icon"><svg width="36" height="36" viewBox="0 0 24 24" fill="#ef4444" stroke="#ef4444" stroke-width="2"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/></svg></span>
                <h3>Our Values</h3>
                <p>We believe in compassion, transparency, and innovation. Every action we take is guided by our commitment to saving lives.</p>
            </div>
        </div>
    </div>

    <!-- Impact Section -->
    <div class="content-section">
        <h2 class="section-title">Our Impact</h2>
        <div class="impact-stats">
            <div class="stat-box">
                <div class="stat-number">{{ number_format($totalDonors) }}+</div>
                <div class="stat-label">Registered Donors</div>
            </div>
            <div class="stat-box">
                <div class="stat-number">{{ number_format($totalUnitsDonated) }}+</div>
                <div class="stat-label">Units Collected (ml)</div>
            </div>
            <div class="stat-box">
                <div class="stat-number">{{ number_format($livesSaved) }}+</div>
                <div class="stat-label">Lives Saved</div>
            </div>
            <div class="stat-box">
                <div class="stat-number">24/7</div>
                <div class="stat-label">Emergency Support</div>
            </div>
        </div>
    </div>

    <!-- Why Choose LifeFlow -->
    <div class="content-section">
        <h2 class="section-title">Why Choose LifeFlow?</h2>
        <div class="mission-cards">
            <div class="mission-card">
                <span class="mission-card-icon"><svg width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="#ef4444" stroke-width="2"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg></span>
                <h3>Secure & Reliable</h3>
                <p>Your health data is protected with enterprise-grade security. We never compromise on safety.</p>
            </div>
            <div class="mission-card">
                <span class="mission-card-icon"><svg width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="#ef4444" stroke-width="2"><polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"/></svg></span>
                <h3>Fast & Efficient</h3>
                <p>Real-time blood inventory tracking ensures quick access to the right blood type when needed most.</p>
            </div>
            <div class="mission-card">
                <span class="mission-card-icon"><svg width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="#ef4444" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="2" y1="12" x2="22" y2="12"/><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/></svg></span>
                <h3>Community Driven</h3>
                <p>We're built by donors, for donors. Your feedback shapes our platform and our mission.</p>
            </div>
        </div>
    </div>

    <!-- Contact Us Section (BAG-O) -->
    <div class="content-section">
        <h2 class="section-title">Get In Touch</h2>
        <p class="description-text">Have questions or need assistance? Our team is here to help you 24/7.</p>
        
        <div class="contact-grid">
            <div class="contact-card">
                <span class="contact-icon"><svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="#ef4444" stroke-width="2"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg></span>
                <div class="contact-info">support@lifeflow.ph</div>
                <div class="contact-label">Official Email</div>
            </div>
            <div class="contact-card">
                <span class="contact-icon"><svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="#ef4444" stroke-width="2"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07A19.5 19.5 0 0 1 4.69 13a19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 3.6 2.24h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg></span>
                <div class="contact-info">+63 912 345 6789</div>
                <div class="contact-label">Hotline Number</div>
            </div>
            <div class="contact-card">
                <span class="contact-icon"><svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="#ef4444" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg></span>
                <div class="contact-info">Davao City, PH</div>
                <div class="contact-label">Headquarters</div>
            </div>
        </div>

        <div class="social-links">
            <a href="#" class="social-link">Facebook</a>
            <a href="#" class="social-link">Instagram</a>
            <a href="#" class="social-link">Twitter</a>
        </div>
    </div>

    <!-- CTA Section -->
    <div class="cta-section">
        <h2>Ready to Save Lives?</h2>
        <p>Join thousands of donors making a difference every day. Your blood can save up to three lives.</p>
        <a href="{{ route('register') }}" class="cta-button">Get Started Today</a>
    </div>
</div>

</x-layout>