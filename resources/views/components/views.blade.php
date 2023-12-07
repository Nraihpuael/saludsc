<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/line-awesome@1.3.0/dist/line-awesome/css/line-awesome.min.css">


<a href="#" id="info" class="fixed bottom-0 right-0 p-0 rounded-lg bg-blue-800 text-white">
    <i class="las la-school" style="font-size: 30px;"></i>
</a>

<div id="info-box" class="hidden fixed bottom-0 right-0 p-4 rounded-lg bg-blue-800 text-white" style="cursor: pointer; pointer-events: auto;">
    {{ $slot }}
</div>

<script src="{{ asset('js/helpers/button_flotante.js') }}"></script>