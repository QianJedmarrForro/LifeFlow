<x-layout>

<style>
    .contact-hero {
        background: linear-gradient(135deg, #ef4444 0%, #c92a2a 100%);
        color: white;
        padding: 80px 40px;
        text-align: center;
        border-radius: 16px;
        margin-bottom: 60px;
        box-shadow: 0 20px 50px rgba(239, 68, 68, 0.2);
    }

    .contact-hero h1 {
        font-size: 48px;
        font-weight: 700;
        margin: 0 0 20px 0;
        letter-spacing: -0.5px;
    }

    .contact-hero p {
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

    .contact-info-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 24px;
        margin-bottom: 40px;
    }

    .contact-card {
        background: white;
        padding: 32px;
        border-radius: 12px;
        border-left: 5px solid #ef4444;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        transition: all 0.3s ease;
    }

    .contact-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 12px 24px rgba(0, 0, 0, 0.1);
    }

    .contact-card-icon {
        font-size: 40px;
        margin-bottom: 15px;
        display: block;
    }

    .contact-card h3 {
        font-size: 20px;
        font-weight: 700;
        color: #1e293b;
        margin: 0 0 12px 0;
    }

    .contact-card p {
        color: #64748b;
        margin: 8px 0;
        font-size: 15px;
        line-height: 1.6;
    }

    .contact-card a {
        color: #ef4444;
        text-decoration: none;
        font-weight: 600;
        transition: color 0.3s ease;
    }

    .contact-card a:hover {
        color: #dc2626;
        text-decoration: underline;
    }

    .branch-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 30px;
    }

    .branch-card {
        background: white;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        transition: all 0.3s ease;
    }

    .branch-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 12px 24px rgba(0, 0, 0, 0.1);
    }

    .branch-header {
        height: 120px;
        background: linear-gradient(135deg, #ef4444 0%, #c92a2a 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 24px;
    }

    .branch-info {
        padding: 24px;
    }

    .branch-name {
        font-size: 20px;
        font-weight: 700;
        color: #1e293b;
        margin: 0 0 12px 0;
    }

    .branch-detail {
        font-size: 14px;
        color: #64748b;
        margin: 10px 0;
        display: flex;
        align-items: flex-start;
        gap: 10px;
    }

    .branch-detail-icon {
        font-size: 18px;
        margin-top: 2px;
    }

    .contact-form-section {
        background: #f8fafc;
        padding: 40px;
        border-radius: 12px;
        margin-top: 40px;
    }

    .form-group {
        margin-bottom: 20px;
    }

    .form-group label {
        display: block;
        font-weight: 600;
        color: #1e293b;
        margin-bottom: 8px;
        font-size: 14px;
    }

    .form-group input,
    .form-group textarea {
        width: 100%;
        padding: 12px 16px;
        border: 1px solid #e2e8f0;
        border-radius: 8px;
        font-family: 'DM Sans', sans-serif;
        font-size: 14px;
        transition: border-color 0.3s ease;
    }

    .form-group input:focus,
    .form-group textarea:focus {
        outline: none;
        border-color: #ef4444;
        box-shadow: 0 0 0 3px rgba(239, 68, 68, 0.1);
    }

    .form-group textarea {
        resize: vertical;
        min-height: 120px;
    }

    .submit-btn {
        background: #ef4444;
        color: white;
        padding: 14px 32px;
        border: none;
        border-radius: 8px;
        font-weight: 700;
        cursor: pointer;
        transition: all 0.3s ease;
        font-size: 16px;
    }

    .submit-btn:hover {
        background: #dc2626;
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(239, 68, 68, 0.3);
    }

    .social-links {
        display: flex;
        gap: 15px;
        justify-content: center;
        margin-top: 20px;
    }

    .social-link {
        width: 48px;
        height: 48px;
        border-radius: 50%;
        background: #fee2e2;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 24px;
        text-decoration: none;
        transition: all 0.3s ease;
    }

    .social-link:hover {
        background: #ef4444;
        color: white;
        transform: translateY(-4px);
    }

    .container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 40px;
        font-family: 'DM Sans', sans-serif;
    }
</style>

<div class="container">
    <!-- Hero Section -->
    <div class="contact-hero">
        <h1>Get In Touch</h1>
        <p>We're here to help. Contact our LifeFlow centers across Davao Region and start your life-saving journey today.</p>
    </div>

    <!-- Main Contact Info -->
    <div class="content-section">
        <h2 class="section-title">Quick Contact</h2>
        <div class="contact-info-grid">
            <div class="contact-card">
                <span class="contact-card-icon">📞</span>
                <h3>Call Us</h3>
                <p>Speak directly with our team during business hours</p>
                <p><a href="tel:+639123456789">+63 (912) 345-6789</a></p>
                <p style="color: #94a3b8; font-size: 13px;">Monday - Friday, 8:00 AM - 6:00 PM</p>
            </div>
            <div class="contact-card">
                <span class="contact-card-icon">📧</span>
                <h3>Email Us</h3>
                <p>Send us a message and we'll respond within 24 hours</p>
                <p><a href="mailto:support@lifeflow.ph">support@lifeflow.ph</a></p>
                <p><a href="mailto:info@lifeflow.ph">info@lifeflow.ph</a></p>
            </div>
            <div class="contact-card">
                <span class="contact-card-icon">⏰</span>
                <h3>Working Hours</h3>
                <p><strong>Weekdays:</strong> 8:00 AM - 6:00 PM</p>
                <p><strong>Weekends:</strong> 9:00 AM - 4:00 PM</p>
                <p><strong>Holidays:</strong> By appointment</p>
            </div>
        </div>
    </div>

    <!-- Branch Locations -->
    <div class="content-section">
        <h2 class="section-title">Our Branches in Davao Region</h2>
        <div class="branch-grid">
            
            <!-- Tagum Branch -->
            <div class="branch-card">
                <div class="branch-header">📍 Tagum</div>
                <div class="branch-info">
                    <h3 class="branch-name">LifeFlow Tagum Center</h3>
                    <div class="branch-detail">
                        <span class="branch-detail-icon">📍</span>
                        <span>J.P. Laurel Ave, Tagum City, Davao del Norte 8100</span>
                    </div>
                    <div class="branch-detail">
                        <span class="branch-detail-icon">📞</span>
                        <a href="tel:+639211234567" style="color: #ef4444;">+63 (921) 123-4567</a>
                    </div>
                    <div class="branch-detail">
                        <span class="branch-detail-icon">⏰</span>
                        <span>Mon-Fri: 8 AM - 6 PM | Sat-Sun: 9 AM - 4 PM</span>
                    </div>
                </div>
            </div>

            <!-- Davao City (Umindanao) Branch -->
            <div class="branch-card">
                <div class="branch-header">🏥 Umindanao</div>
                <div class="branch-info">
                    <h3 class="branch-name">LifeFlow Umindanao Hub</h3>
                    <div class="branch-detail">
                        <span class="branch-detail-icon">📍</span>
                        <span>Ponciano Lopez Blvd, Davao City, Davao del Sur 8000</span>
                    </div>
                    <div class="branch-detail">
                        <span class="branch-detail-icon">📞</span>
                        <a href="tel:+639209876543" style="color: #ef4444;">+63 (920) 987-6543</a>
                    </div>
                    <div class="branch-detail">
                        <span class="branch-detail-icon">⏰</span>
                        <span>Mon-Fri: 8 AM - 6 PM | Sat-Sun: 9 AM - 5 PM</span>
                    </div>
                </div>
            </div>

            <!-- Visayan Branch -->
            <div class="branch-card">
                <div class="branch-header">🩸 Visayan</div>
                <div class="branch-info">
                    <h3 class="branch-name">LifeFlow Visayan Center</h3>
                    <div class="branch-detail">
                        <span class="branch-detail-icon">📍</span>
                        <span>C.M. Recto St, Davao City, Davao del Sur 8000</span>
                    </div>
                    <div class="branch-detail">
                        <span class="branch-detail-icon">📞</span>
                        <a href="tel:+639215551111" style="color: #ef4444;">+63 (921) 555-1111</a>
                    </div>
                    <div class="branch-detail">
                        <span class="branch-detail-icon">⏰</span>
                        <span>Mon-Fri: 8 AM - 6 PM | Sat-Sun: 9 AM - 4 PM</span>
                    </div>
                </div>
            </div>

            <!-- Davao de Oro Branch -->
            <div class="branch-card">
                <div class="branch-header">🏢 Davao de Oro</div>
                <div class="branch-info">
                    <h3 class="branch-name">LifeFlow Davao de Oro</h3>
                    <div class="branch-detail">
                        <span class="branch-detail-icon">📍</span>
                        <span>Main St, Nabunturan, Davao de Oro 8800</span>
                    </div>
                    <div class="branch-detail">
                        <span class="branch-detail-icon">📞</span>
                        <a href="tel:+639214445555" style="color: #ef4444;">+63 (921) 444-5555</a>
                    </div>
                    <div class="branch-detail">
                        <span class="branch-detail-icon">⏰</span>
                        <span>Mon-Fri: 8 AM - 5 PM | Sat-Sun: 9 AM - 3 PM</span>
                    </div>
                </div>
            </div>

            <!-- Main Office -->
            <div class="branch-card">
                <div class="branch-header">🏛️ Headquarters</div>
                <div class="branch-info">
                    <h3 class="branch-name">LifeFlow Main Office</h3>
                    <div class="branch-detail">
                        <span class="branch-detail-icon">📍</span>
                        <span>Medical Complex, Davao City, Davao del Sur 8000</span>
                    </div>
                    <div class="branch-detail">
                        <span class="branch-detail-icon">📞</span>
                        <a href="tel:+639006661111" style="color: #ef4444;">+63 (900) 666-1111</a>
                    </div>
                    <div class="branch-detail">
                        <span class="branch-detail-icon">⏰</span>
                        <span>Mon-Fri: 8 AM - 6 PM | Closed Weekends</span>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- Contact Form Section -->
    <div class="content-section">
        <h2 class="section-title">Send Us a Message</h2>
        <div class="contact-form-section">
            <form>
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                    <div class="form-group">
                        <label for="name">Full Name *</label>
                        <input type="text" id="name" name="name" required placeholder="Your full name">
                    </div>
                    <div class="form-group">
                        <label for="email">Email Address *</label>
                        <input type="email" id="email" name="email" required placeholder="your@email.com">
                    </div>
                </div>
                <div class="form-group">
                    <label for="subject">Subject *</label>
                    <input type="text" id="subject" name="subject" required placeholder="How can we help?">
                </div>
                <div class="form-group">
                    <label for="branch">Which branch are you interested in? *</label>
                    <select name="branch" id="branch" required style="width: 100%; padding: 12px 16px; border: 1px solid #e2e8f0; border-radius: 8px; font-family: 'DM Sans', sans-serif; font-size: 14px; transition: border-color 0.3s ease; cursor: pointer;">
                        <option value="">Select a branch...</option>
                        <option value="tagum">Tagum Center</option>
                        <option value="umindanao">Umindanao Hub</option>
                        <option value="visayan">Visayan Center</option>
                        <option value="davao-de-oro">Davao de Oro</option>
                        <option value="headquarters">Headquarters</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="message">Message *</label>
                    <textarea id="message" name="message" required placeholder="Tell us more about your inquiry..."></textarea>
                </div>
                <button type="submit" class="submit-btn">Send Message</button>
            </form>
        </div>
    </div>

    <!-- Social Section -->
    <div class="content-section" style="text-align: center;">
        <h2 class="section-title">Follow Us</h2>
        <p style="color: #64748b; margin-bottom: 20px; font-size: 16px;">Connect with LifeFlow on social media for updates and health tips</p>
        <div class="social-links">
            <a href="#" class="social-link" title="Facebook">f</a>
            <a href="#" class="social-link" title="Twitter">𝕏</a>
            <a href="#" class="social-link" title="Instagram">📷</a>
            <a href="#" class="social-link" title="LinkedIn">in</a>
        </div>
    </div>

</div>

</x-layout>
