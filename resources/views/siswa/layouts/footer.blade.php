@include('modal_kandidat_siswa')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
    <script src="{{ asset('assets/all/sweetalert/js/sweetalert2.all.min.js') }}"></script>
    @stack('scripts')
    <script>
        $(function () {
            setTimeout(function (){
                $('#pesan').fadeTo(300, 0).slideUp(300, function(){
                    $(this).remove();
                });
            }, 2000);
        })
    </script>
</body>
</html>