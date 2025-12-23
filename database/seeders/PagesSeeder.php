<?php

namespace Database\Seeders;

use App\Models\Page;
use Illuminate\Database\Seeder;

class PagesSeeder extends Seeder
{
    public function run(): void
    {
        $pages = [
            [
                'title' => 'Home',
                'slug' => 'home',
                'description' => 'Waveron Technologies - Innovation\'s Crest, Tomorrow\'s Best',
                'hero_title' => 'Innovation\'s Crest, Tomorrow\'s Best',
                'hero_subtitle' => 'A pioneering technology firm dedicated to creating cutting-edge solutions that propel businesses into the future.',
                'content' => '<p>At Waveron Technologies, we believe in the boundless potential of technology. Our team of visionary engineers, designers, and strategists work collaboratively to push the boundaries of what\'s possible.</p>',
                'is_published' => true,
                'sort_order' => 1,
                'meta_data' => [
                    'meta_title' => 'Waveron Technologies - Innovation\'s Crest, Tomorrow\'s Best',
                    'meta_description' => 'A pioneering technology firm dedicated to creating cutting-edge solutions',
                    'keywords' => 'technology, innovation, software development',
                ],
            ],
            [
                'title' => 'About Us',
                'slug' => 'about',
                'description' => 'Learn more about Waveron Technologies and our mission',
                'hero_title' => 'Innovating for Tomorrow',
                'hero_subtitle' => 'At Waveron Technologies, we\'re dedicated to transforming ideas into cutting-edge solutions that drive the future of technology.',
                'content' => '<h2>Our Story</h2><p>Founded with a vision to revolutionize the technological landscape, Waveron Technologies has grown from a small startup to a leading innovator in the industry.</p><h2>Our Values</h2><ul><li>Excellence - Striving for excellence in every project we undertake</li><li>Integrity - Maintaining the highest standards of integrity and ethics</li><li>Innovation - Embracing new ideas and cutting-edge technologies</li><li>Passion - Passionate about creating impactful solutions</li></ul>',
                'is_published' => true,
                'sort_order' => 2,
                'meta_data' => [
                    'meta_title' => 'About Us - Waveron Technologies',
                    'meta_description' => 'Learn about our vision, values, and the team driving innovation',
                    'keywords' => 'about, company, team, mission, values',
                ],
            ],
            [
                'title' => 'Services',
                'slug' => 'services',
                'description' => 'Comprehensive digital solutions to help your business thrive',
                'hero_title' => 'Our Services',
                'hero_subtitle' => 'Comprehensive digital solutions to help your business thrive in the modern world.',
                'content' => '<h2>Our Core Services</h2><p>We offer a wide range of services including Software Development, Graphic Design, Digital Marketing, and Branding.</p>',
                'is_published' => true,
                'sort_order' => 3,
                'meta_data' => [
                    'meta_title' => 'Our Services - Waveron Technologies',
                    'meta_description' => 'Explore our comprehensive digital solutions',
                    'keywords' => 'services, software development, design, marketing',
                ],
            ],
            [
                'title' => 'Portfolio',
                'slug' => 'portfolio',
                'description' => 'Discover our successful projects and digital innovations',
                'hero_title' => 'Our Portfolio',
                'hero_subtitle' => 'Discover our successful projects and digital innovations that have helped businesses grow.',
                'content' => '<h2>Our Work</h2><p>Browse through our portfolio of successful projects across various industries.</p>',
                'is_published' => true,
                'sort_order' => 4,
                'meta_data' => [
                    'meta_title' => 'Portfolio - Waveron Technologies',
                    'meta_description' => 'View our portfolio of successful projects',
                    'keywords' => 'portfolio, projects, work, case studies',
                ],
            ],
            [
                'title' => 'Contact Us',
                'slug' => 'contact',
                'description' => 'Get in touch with Waveron Technologies',
                'hero_title' => 'Get In Touch',
                'hero_subtitle' => 'Have a question or project in mind? We\'d love to hear from you.',
                'content' => '<h2>Contact Information</h2><p><strong>Location:</strong> Westlands, Nairobi City, Kenya</p><p><strong>Email:</strong> contact@waveron.com</p><p><strong>Phone:</strong> +2547 98 717 800</p><p><strong>Working Hours:</strong> Monday - Friday: 9:00 AM - 6:00 PM<br>Saturday: 10:00 AM - 7:00 PM</p>',
                'is_published' => true,
                'sort_order' => 5,
                'meta_data' => [
                    'meta_title' => 'Contact Us - Waveron Technologies',
                    'meta_description' => 'Get in touch with our team',
                    'keywords' => 'contact, email, phone, location',
                ],
            ],
            [
                'title' => 'Privacy Policy',
                'slug' => 'privacy-policy',
                'description' => 'Waveron Technologies Privacy Policy',
                'hero_title' => 'Privacy Policy',
                'hero_subtitle' => 'Your privacy is important to us.',
                'content' => '<h2>1. Information We Collect</h2><p>We may collect information about you in a variety of ways, including information you provide to us directly, information we collect automatically, and information from third parties.</p><h2>2. How We Use Your Information</h2><p>We may use the information we collect to provide and maintain our services, improve and personalize our services, and communicate with you.</p>',
                'is_published' => true,
                'sort_order' => 6,
                'meta_data' => [
                    'meta_title' => 'Privacy Policy - Waveron Technologies',
                    'meta_description' => 'Read our privacy policy',
                    'keywords' => 'privacy, policy, data protection',
                ],
            ],
            [
                'title' => 'Terms of Service',
                'slug' => 'terms-of-service',
                'description' => 'Waveron Technologies Terms of Service',
                'hero_title' => 'Terms of Service',
                'hero_subtitle' => 'Please read these terms carefully.',
                'content' => '<h2>1. Introduction</h2><p>These Terms of Service outline the rules and regulations for the use of Waveron Technologies\' services.</p><h2>2. User Obligations</h2><p>As a user, you agree to provide accurate information, maintain the confidentiality of your account, and notify us of any unauthorized use.</p>',
                'is_published' => true,
                'sort_order' => 7,
                'meta_data' => [
                    'meta_title' => 'Terms of Service - Waveron Technologies',
                    'meta_description' => 'Read our terms of service',
                    'keywords' => 'terms, service, legal',
                ],
            ],
        ];

        foreach ($pages as $pageData) {
            Page::updateOrCreate(
                ['slug' => $pageData['slug']],
                $pageData
            );
        }

        $this->command->info('Pages seeded successfully!');
    }
}