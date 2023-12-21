<!-- jQuery with AJAX -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.js"> </script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js" charset="UTF-8"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/locales/bootstrap-datepicker.id.min.js"></script>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous">
</script>

<!-- Bootstrap Select JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>

<!-- Font Awesome JS -->
<script src="https://kit.fontawesome.com/c2ff6e34d8.js" crossorigin="anonymous"></script>

<!-- Noty JS -->
<script src="{{ url('js/app.js')}}" type="text/javascript"></script>

<!-- Chart JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-deferred"></script>

<!-- Day JS -->
<script src="https://unpkg.com/dayjs@1.8.21/dayjs.min.js"></script>

<script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.21/b-1.6.2/b-colvis-1.6.2/cr-1.5.2/fc-3.3.1/fh-3.1.7/r-2.2.5/rg-1.1.2/rr-1.2.7/sp-1.1.1/sl-1.3.1/datatables.min.js"></script>

<script type="text/javascript" src="{{url('/asset/layout/js/main.js')}}"></script>

<script>
$(function () {
    $('.selectpicker').selectpicker({
        style:'',
        styleBase:'form-control'
    });
});
</script>

@include('helper.alerts')
