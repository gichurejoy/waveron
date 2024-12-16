@extends('layouts.app')

@section('title', 'Terms of Service - Waveron Technologies')

@section('content')
<div class="container" style="padding-top: 0; padding-bottom: 20px;">
    <h1 class="mb-2 text-center" style="background-color: #e9ecef; padding: 1px; border-radius: 5px;">Terms of Service</h1>
    <div class="policy-terms-container" style="border: 1px solid #ddd; padding: 20px; background-color: #f8f9fa;">
        <p>Welcome to Waveron Technologies! These terms of service govern your use of our services. By using our services, you agree to these terms.</p>
        <h2>1. Introduction</h2>
        <p>These Terms of Service outline the rules and regulations for the use of Waveron Technologies’ services. Please read these terms carefully.</p>
        <h2>2. Definitions</h2>
        <p>In these terms, the following definitions apply:</p>
        <ul>
            <li><strong>“Services”</strong> refers to the services provided by Waveron Technologies.</li>
            <li><strong>“User”</strong> refers to any individual or entity using our services.</li>
        </ul>
        <h2>3. User Obligations</h2>
        <p>As a user, you agree to:</p>
        <ul>
            <li>Provide accurate and complete information during registration.</li>
            <li>Maintain the confidentiality of your account information.</li>
            <li>Notify us immediately of any unauthorized use of your account.</li>
        </ul>
        <h2>4. Account Management</h2>
        <p>Users are responsible for maintaining their accounts and for all activities that occur under their accounts.</p>
        <h2>5. Payment Terms</h2>
        <p>If applicable, users agree to pay all fees associated with their use of the services. Payment details and refund policies will be outlined during the registration process.</p>
        <h2>6. Third-Party Links</h2>
        <p>Our services may contain links to third-party websites. We do not endorse or assume responsibility for the content or practices of these websites.</p>
        <h2>7. Limitation of Liability</h2>
        <p>In no event shall Waveron Technologies be liable for any indirect, incidental, or consequential damages arising from your use of the services.</p>
        <h2>8. Governing Law</h2>
        <p>These terms shall be governed by and construed in accordance with the laws of the jurisdiction in which Waveron Technologies operates.</p>
        <h2>9. Amendments</h2>
        <p>We may revise these terms from time to time. We will notify you of any changes by posting the new terms on this page.</p>
        <h2>10. Contact Us</h2>
        <p>If you have any questions about these terms, please contact us at support@waveron.com.</p>
    </div>
</div>
@include('partials.footer')
@endsection
