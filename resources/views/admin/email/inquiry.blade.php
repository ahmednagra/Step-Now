<!-- resources/views/emails/inquiry.blade.php -->
<h1>New Inquiry Received</h1>
<p><strong>Name:</strong> {{ $inquiry->name }}</p>
<p><strong>Phone Number:</strong> {{ $inquiry->phone_no }}</p>
<p><strong>Email:</strong> {{ $inquiry->email }}</p>
<p><strong>Message:</strong> {{ $inquiry->enquiry_message }}</p>
