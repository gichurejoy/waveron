@component('mail::message')
# New Contact Form Submission

You have received a new message from the contact form.

**Name:** {{ $data['name'] }}  
**Email:** {{ $data['email'] }}  
**Subject:** {{ $data['subject'] }}

@if(isset($data['company']))
**Company:** {{ $data['company'] }}
@endif
@if(isset($data['budget']))
**Budget:** {{ $data['budget'] }}
@endif
@if(isset($data['timeline']))
**Timeline:** {{ $data['timeline'] }}
@endif
@if(isset($data['services']))
**Services:** {{ $data['services'] }}
@endif

**Message:**  
{{ $data['message'] }}

@component('mail::button', ['url' => config('app.url')])
View Website
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
