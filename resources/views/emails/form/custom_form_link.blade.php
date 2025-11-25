{{-- resources/views/emails/form/custom_form_link.blade.php --}}

@component('mail::message')

{{-- Menampilkan body yang dimasukkan oleh Admin --}}
{{ $customBody }}

@component('mail::button', ['url' => $formLink])
Isi Formulir Pasca-Wawancara
@endcomponent

<p>
    Tautan ini berlaku hingga {{ \Carbon\Carbon::parse($jadwal->token_expires_at)->isoFormat('dddd, D MMMM YYYY H:m') }} WIB.
</p>

@endcomponent