<!-- jQuery -->
<script src="{{ asset('Panel/plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('Panel/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- FastClick -->
<script src="{{ asset('Panel/plugins/fastclick/fastclick.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('Panel/dist/js/adminlte.min.js') }}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ asset('Panel/dist/js/demo.js') }}"></script>

<!-- Dropzone File Upload -->
<script src="{{ asset('Panel/plugins/dropzone/dropzone.min.js') }}"></script>


<!-- get input file name in setting slider page and show in input box  -->
<script>
    $('#fileUploader').on('change',function(){
        //get the file name
        let filename = $(this).val().split("\\").pop();
        //replace the "Choose a file" label
        $(this).next('.custom-file-label').html(filename);
    })
</script>

<script>
    $("#productImages").dropzone({ url: "/Product/store" });
</script>
