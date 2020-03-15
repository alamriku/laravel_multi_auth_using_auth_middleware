<!-- All Jquery -->
<!-- ============================================================== -->

<!-- Bootstrap popper Core JavaScript -->
<script src="{{asset('public')}}/assets/node_modules/popper/popper.min.js"></script>
<script src="{{asset('public')}}/assets/node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- slimscrollbar scrollbar JavaScript -->
<script src="{{asset('public')}}/dist/js/perfect-scrollbar.jquery.min.js"></script>
<!--Wave Effects -->
<script src="{{asset('public')}}/dist/js/waves.js"></script>
<!--Menu sidebar -->
<script src="{{asset('public')}}/dist/js/sidebarmenu.js"></script>
<!--Custom JavaScript -->
<script src="{{asset('public')}}/dist/js/custom.min.js"></script>
<!-- ============================================================== -->
<!-- This page plugins -->
<!-- ============================================================== -->
<!--morris JavaScript -->
<script src="{{asset('public')}}/assets/node_modules/raphael/raphael-min.js"></script>
<script src="{{asset('public')}}/assets/node_modules/morrisjs/morris.min.js"></script>
<script src="{{asset('public')}}/assets/node_modules/jquery-sparkline/jquery.sparkline.min.js"></script>
<!-- Popup message jquery -->
<script src="{{asset('public')}}/assets/node_modules/toast-master/js/jquery.toast.js"></script>
<!-- Chart JS -->
<script src="{{asset('public')}}/dist/js/dashboard1.js"></script>

<script src="{{asset('public')}}/assets/node_modules/toast-master/js/jquery.toast.js"></script>
<script src="{{asset('public')}}/assets/node_modules/dropify/dist/js/dropify.min.js"></script>
<script src="http://malsup.github.com/jquery.form.js"></script>
<!-- Sweet-Alert  -->
<script src="{{asset('public')}}/assets/node_modules/sweetalert2/dist/sweetalert2.all.min.js"></script>
<!--Custom JavaScript -->
<script type="text/javascript">
    $(function() {
        $(".preloader").fadeOut();
    });
    $(function() {
        $('[data-toggle="tooltip"]').tooltip()
    });
    // ==============================================================
    // Login and Recover Password
    // ==============================================================
    $('#to-recover').on("click", function() {
        $("#loginform").slideUp();
        $("#recoverform").fadeIn();
    });
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(document).ready(function () {
        $('.dropify').dropify();
        {{--$('#submit-form').on('submit',function (event) {--}}
            {{--event.preventDefault();--}}

            {{--$.ajax({--}}
                {{--url:"{{route('submit-image')}}",--}}
                {{--method:"POST",--}}
                {{--data:new FormData(this),--}}
                {{--dataType:'JSON',--}}
                {{--contentType: false,--}}
                {{--cache: false,--}}
                {{--processData: false,--}}

                {{--success:function(data)--}}
                {{--{--}}


                    {{--var drEvent =  $('.dropify').dropify();--}}
                    {{--drEvent = drEvent.data('dropify');--}}
                    {{--if(data.success === false){--}}
                        {{--if( data.errors.image !== undefined){--}}
                            {{--$.toast({--}}
                                {{--heading: 'Error'--}}
                                {{--, text: data.errors.image[0]--}}
                                {{--, position: 'top-right'--}}
                                {{--, loaderBg: '#ff6849'--}}
                                {{--, icon: 'info'--}}
                                {{--, hideAfter: 3500--}}
                                {{--, stack: 6--}}
                            {{--});--}}
                        {{--}else if(data.errors.image_title !== undefined){--}}
                            {{--$.toast({--}}
                                {{--heading: 'Error'--}}
                                {{--, text: data.errors.image_title[0]--}}
                                {{--, position: 'top-right'--}}
                                {{--, loaderBg: '#ff6849'--}}
                                {{--, icon: 'info'--}}
                                {{--, hideAfter: 3500--}}
                                {{--, stack: 6--}}
                            {{--});--}}
                        {{--}--}}

                       {{--document.getElementById('submit-form').reset();--}}
                        {{--drEvent.resetPreview();--}}
                    {{--}else {--}}
                        {{--$.toast({--}}
                            {{--heading: 'Success'--}}
                            {{--, text: 'record added successfully'--}}
                            {{--, position: 'top-right'--}}
                            {{--, loaderBg: '#ff6849'--}}
                            {{--, icon: 'info'--}}
                            {{--, hideAfter: 3500--}}
                            {{--, stack: 6--}}
                        {{--});--}}
                        {{--document.getElementById('submit-form').reset();--}}
                        {{--drEvent.resetPreview();--}}
                        {{--$('#data').empty();--}}
                        {{--$('#data').html(data.desc_images);--}}
                    {{--}--}}

                {{--}--}}
            {{--});--}}
        {{--});--}}
        $('form').ajaxForm({
            beforeSend:function(){
                $('#success').empty();
            },
            uploadProgress:function(event, position, total, percentComplete)
            {
                $('.progress-bar').text(percentComplete + '%');
                $('.progress-bar').css('width', percentComplete + '%');
            },
            success:function(data)
            {
                if(data.errors)
                {
                    $('.progress-bar').text('0%');
                    $('.progress-bar').css('width', '0%');
                    $('#success').html('<span class="text-danger"><b>'+data.errors+'</b></span>');
                }
                if(data.success)
                {
                    $('.progress-bar').text('Uploaded');
                    $('.progress-bar').css('width', '100%');
                    setTimeout(function () {
                        $('.progress-bar').css('width','0%');
                        $('.progress-bar').empty();
                    },3000);
                }
                var drEvent =  $('.dropify').dropify();
                drEvent = drEvent.data('dropify');
                if(data.success === false){
                    if( data.errors.image !== undefined){
                        $.toast({
                            heading: 'Error'
                            , text: data.errors.image[0]
                            , position: 'top-right'
                            , loaderBg: '#ff6849'
                            , icon: 'info'
                            , hideAfter: 3500
                            , stack: 6
                        });
                    }else if(data.errors.image_title !== undefined){
                        $.toast({
                            heading: 'Error'
                            , text: data.errors.image_title[0]
                            , position: 'top-right'
                            , loaderBg: '#ff6849'
                            , icon: 'info'
                            , hideAfter: 3500
                            , stack: 6
                        });
                    }

                    document.getElementById('submit-form').reset();
                    drEvent.resetPreview();
                }else {
                    $.toast({
                        heading: 'Success'
                        , text: 'record added successfully'
                        , position: 'top-right'
                        , loaderBg: '#ff6849'
                        , icon: 'info'
                        , hideAfter: 3500
                        , stack: 6
                    });
                    document.getElementById('submit-form').reset();
                    drEvent.resetPreview();
                    $('#data').empty();
                    $('#data').html(data.desc_images);
                }
            }
        });

    });

    $(document).on('click',".btn_del",function () {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.value) {
            var prev = $(this).prev();
            var id = $(prev).val();
            $.ajax({
                url:'{{route('data-delete')}}',
                method:'post',
                data:{id:id},
                success:function (res) {
                    $.toast({
                        heading: 'Success'
                        , text: 'record Deleted successfully'
                        , position: 'top-right'
                        , loaderBg: '#ff6849'
                        , icon: 'info'
                        , hideAfter: 1000
                        , stack: 6
                    });
                    $('#'+id).remove();
                }
            });
            Swal.fire(
                'Deleted!',
                'Your file has been deleted.',
                'success'
            )
        }
    })
    });
    {{--$(document).on('click','.btn_del',function () {--}}
        {{----}}

        {{--var prev = $(this).prev();--}}
        {{--var id = $(prev).val();--}}
        {{--$.ajax({--}}
            {{--url:'{{route('data-delete')}}',--}}
            {{--method:'post',--}}
            {{--data:{id:id},--}}
            {{--success:function (res) {--}}
                {{--$.toast({--}}
                    {{--heading: 'Success'--}}
                    {{--, text: 'record Deleted successfully'--}}
                    {{--, position: 'top-right'--}}
                    {{--, loaderBg: '#ff6849'--}}
                    {{--, icon: 'info'--}}
                    {{--, hideAfter: 1000--}}
                    {{--, stack: 6--}}
                {{--});--}}
                {{--$('#'+id).remove();--}}
            {{--}--}}
        {{--});--}}
    {{--});--}}
    $(document).on('keyup','.search',function () {
        var text = $(this).val();
        $.ajax({
            url:'{{route('search-image')}}',
            type:'get',
            data:{text:text},
            success:function (data) {
                console.log(data);
                $('#data').empty();
                $('#data').html(data.desc_images);
            }
        });
    });
    $(document).imagePreview({

        elements : ['.preview','.custom-element']

    });
</script>